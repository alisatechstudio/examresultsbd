/* examresultsbd.online - standalone scripts */

const OFFICIAL_HOME = 'https://examresultsbd.online/';

(function() {
  'use strict';

  const state = {
    currentTab: 'individual', // 'individual' | 'institution' | 'district'
    captchaQuestions: new Map(),
    pendingForm: null,
  };

  const districtsByBoard = {
    dhaka: ['Dhaka','Faridpur','Gazipur','Gopalganj','Jamalpur','Kishoreganj','Madaripur','Manikganj','Munshiganj','Narayanganj','Narsingdi','Netrokona','Rajbari','Shariatpur','Sherpur','Tangail'],
    comilla: ['Comilla','Chandpur','Brahmanbaria','Noakhali','Feni','Lakshmipur'],
    rajshahi: ['Rajshahi','Natore','Pabna','Sirajganj','Bogura','Chapainawabganj','Naogaon','Joypurhat'],
    chittagong: ['Chattogram','Cox\'s Bazar','Rangamati','Bandarban','Khagrachhari'],
    jessore: ['Jessore','Khulna','Kushtia','Satkhira','Jhenaidah','Meherpur','Narail','Magura'],
    barisal: ['Barisal','Bhola','Patuakhali','Pirojpur','Barguna','Jhalokathi'],
    sylhet: ['Sylhet','Moulvibazar','Habiganj','Sunamganj'],
    dinajpur: ['Dinajpur','Rangpur','Thakurgaon','Nilphamari','Kurigram','Lalmonirhat','Gaibandha','Panchagarh'],
    mymensingh: ['Mymensingh','Netrokona','Sherpur','Jamalpur'],
    madrasah: ['All Madrasah Districts'],
    technical: ['All Technical Districts'],
    dibs: ['DIBS Districts']
  };

  function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function generateQuestion() {
    const ops = ['+','-','×'];
    const op = ops[randomInt(0, ops.length - 1)];
    let a = randomInt(1, 20);
    let b = randomInt(1, 20);
    if (op === '-') {
      if (a < b) [a, b] = [b, a];
    }
    let answer;
    if (op === '+') answer = a + b;
    else if (op === '-') answer = a - b;
    else {
      a = randomInt(2, 9);
      b = randomInt(2, 9);
      answer = a * b;
    }
    return {
      html: `<span class="ec-a">${a}</span> <span class="ec-op">${op}</span> <span class="ec-b">${b}</span> <span class="ec-eq">=</span> <span class="ec-q">?</span>`,
      answer: String(answer),
    };
  }

  function initCaptcha(prefix) {
    const display = document.querySelector(`#${prefix}-captcha`);
    const loading = document.querySelector(`#${prefix}-captcha-loading`);
    if (!display || !loading) return;

    loading.style.display = 'inline';
    display.style.display = 'none';

    setTimeout(() => {
      const q = generateQuestion();
      display.dataset.answer = q.answer;
      display.innerHTML = q.html;
      loading.style.display = 'none';
      display.style.display = 'inline-block';
      const input = document.getElementById(`${prefix}-captcha-input`);
      if (input) input.value = '';
    }, randomInt(150, 400));
  }

  function refreshCaptcha(prefix) {
    initCaptcha(prefix);
  }

  function validateCaptcha(prefix) {
    const display = document.querySelector(`#${prefix}-captcha`);
    const input = document.getElementById(`${prefix}-captcha-input`);
    if (!display || !input) return true;
    const expected = (display.dataset.answer || '').trim();
    const given = input.value.trim();
    if (!expected || !given) return false;
    return given === expected;
  }

  function showMessage(form, message, type) {
    const app = form.closest('.bdrc-app');
    if (!app) return;
    const msg = app.querySelector('.bdrc-message');
    if (!msg) return;
    msg.textContent = message;
    msg.style.display = 'block';
    msg.style.background = type === 'error' ? '#fde8e8' : '#e6f9f0';
    msg.style.color = type === 'error' ? '#b91c1c' : '#047857';
    msg.style.border = type === 'error' ? '1px solid #f9a8a8' : '1px solid #6ee7b7';
    msg.style.padding = '10px 12px';
    msg.style.borderRadius = '10px';
    setTimeout(() => {
      msg.style.display = 'none';
    }, 4000);
  }

  function clearMessage(form) {
    const app = form.closest('.bdrc-app');
    if (!app) return;
    const msg = app.querySelector('.bdrc-message');
    if (msg) msg.style.display = 'none';
  }

  function getValues(form) {
    const select = form.querySelector('.bdrc-rt-inline-select');
    const resultType = select ? select.value : '1';
    const exam = form.querySelector('.bdrc-exam');
    const board = form.querySelector('.bdrc-board');
    const year = form.querySelector('.bdrc-year');
    const roll = form.querySelector('.bdrc-roll');
    const reg = form.querySelector('.bdrc-reg');
    const eiin = form.querySelector('.bdrc-eiin');
    const district = form.querySelector('.bdrc-district');
    const captcha = form.querySelector('.bdrc-captcha');

    return {
      resultType,
      exam: exam ? exam.value : '',
      board: board ? board.value : '',
      year: year ? year.value : '',
      roll: roll ? roll.value.trim() : '',
      reg: reg ? reg.value.trim() : '',
      eiin: eiin ? eiin.value.trim() : '',
      district: district ? district.value : '',
      captcha: captcha ? captcha.value.trim() : '',
    };
  }

  function validate(values, tab) {
    if (!values.exam) return 'Please select an examination.';
    if (!values.board) return 'Please select a board.';
    if (!values.year) return 'Please select an exam year.';

    if (tab === 'individual') {
      if (!values.roll) return 'Please enter your roll number.';
      if (!values.captcha) return 'Please enter the captcha text.';
    } else if (tab === 'institution') {
      if (!values.eiin || values.eiin.length < 6) return 'Please enter a valid 6-digit EIIN number.';
      if (!values.captcha) return 'Please enter the captcha text.';
    } else if (tab === 'district') {
      if (!values.district) return 'Please select a district.';
      if (!values.captcha) return 'Please enter the captcha text.';
    }
    return null;
  }

  function setLoading(form, loading) {
    const btn = form.querySelector('.bdrc-submit');
    const btnText = btn ? btn.querySelector('.bdrc-btn-text') : null;
    const btnSpinner = btn ? btn.querySelector('.bdrc-btn-spinner') : null;
    if ( loading ) {
      if (btn) btn.disabled = true;
      if (btnText) btnText.style.display = 'none';
      if (btnSpinner) btnSpinner.style.display = 'inline-flex';
    } else {
      if (btn) btn.disabled = false;
      if (btnText) btnText.style.display = 'inline-flex';
      if (btnSpinner) btnSpinner.style.display = 'none';
    }
  }

  function openModal(form, values) {
    const app = form.closest('.bdrc-app');
    if (!app) return;
    const overlay = app.querySelector('.bdrc-modal-overlay');
    const body = app.querySelector('.bdrc-modal-body');
    if (!overlay || !body) return;

    const base = 'https://api.bangladeshgov.org/';
    const params = new URLSearchParams();
    params.set('exam', values.exam || '');
    params.set('year', values.year || '');
    params.set('board', values.board || '');
    if (values.resultType === '2') {
      params.set('eiin', values.eiin || '');
    } else {
      params.set('roll', values.roll || '');
      params.set('reg', values.reg || '');
    }

    const apiUrl = `${base}?${params.toString()}`;

    body.innerHTML = `
      <div style="padding:16px 18px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <span style="height:10px;width:10px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
          <strong style="font-size:16px;">Fetching real result...</strong>
        </div>
        <div style="font-size:13px;color:#374151;">Contacting official result server. Please wait.</div>
      </div>
    `;
    overlay.style.display = 'flex';
    overlay.setAttribute('aria-hidden', 'false');

    fetch(apiUrl, {
      method: 'GET',
      headers: {
        'Accept': 'application/json, text/plain, */*',
      },
    })
    .then(res => res.text().then(text => ({ ok: res.ok, status: res.status, text })))
    .then(({ ok, status, text }) => {
      if (!ok) {
        body.innerHTML = `
          <div style="padding:16px 18px;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
              <span style="height:10px;width:10px;border-radius:50%;background:#dc2626;display:inline-block;"></span>
              <strong style="font-size:16px;">Could not load real result</strong>
            </div>
            <div style="font-size:13px;color:#374151;line-height:1.5;margin-bottom:10px;">Server responded with status ${status}</div>
            <a href="${OFFICIAL_HOME}" target="_blank" rel="noopener" style="color:#0080b9;font-weight:600;">Open official site</a>
          </div>
        `;
        return;
      }

      const trimmed = text.trim();
      let parsed = null;
      try {
        parsed = JSON.parse(trimmed);
      } catch (e) {
        parsed = null;
      }

      const contentHtml = (() => {
        if (parsed !== null) {
          if (typeof parsed === 'object') {
            const entries = Object.entries(parsed);
            return `<pre style="white-space:pre-wrap;font-size:13px;background:#f8fafc;padding:10px;border-radius:8px;border:1px solid #e5e7eb;">${escapeHtml(JSON.stringify(parsed, null, 2))}</pre>`;
          }
          return `<pre style="white-space:pre-wrap;font-size:13px;background:#f8fafc;padding:10px;border-radius:8px;border:1px solid #e5e7eb;">${escapeHtml(trimmed)}</pre>`;
        }

        if (trimmed.startsWith('<')) {
          return trimmed;
        }

        return `<pre style="white-space:pre-wrap;font-size:13px;background:#f8fafc;padding:10px;border-radius:8px;border:1px solid #e5e7eb;">${escapeHtml(trimmed)}</pre>`;
      })();

      body.innerHTML = `
        <div style="padding:16px 18px;">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
            <span style="height:10px;width:10px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
            <strong style="font-size:16px;">Official Result</strong>
          </div>
          <div style="max-height:60vh;overflow:auto;border:1px solid #e5e7eb;border-radius:10px;background:#fff;">${contentHtml}</div>
          <div style="margin-top:10px;font-size:12px;color:#6b7280;">Source: ${escapeHtml(apiUrl)}</div>
        </div>
      `;
    })
    .catch(err => {
      body.innerHTML = `
        <div style="padding:16px 18px;">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
            <span style="height:10px;width:10px;border-radius:50%;background:#dc2626;display:inline-block;"></span>
            <strong style="font-size:16px;">Network error</strong>
          </div>
          <div style="font-size:13px;color:#374151;line-height:1.5;margin-bottom:10px;">${escapeHtml(err.message)}</div>
          <a href="${OFFICIAL_HOME}" target="_blank" rel="noopener" style="color:#0080b9;font-weight:600;">Open official site</a>
        </div>
      `;
    });
  }

  function escapeHtml(text) {
    if (text == null) return '';
    return String(text)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function closeModal(form) {
    const app = form.closest('.bdrc-app');
    if (!app) return;
    const overlay = app.querySelector('.bdrc-modal-overlay');
    if (!overlay) return;
    overlay.style.display = 'none';
    overlay.setAttribute('aria-hidden', 'true');
  }

  function onSubmit(e) {
    e.preventDefault();
    const form = e.target;
    clearMessage(form);

    const panel = form.closest('.checker-tab-panel');
    const tab = panel ? panel.dataset.panel : state.currentTab;
    const values = getValues(form);

    const prefix = tab === 'institution' ? 'bdrc-2-2' : tab === 'district' ? 'bdrc-5-3' : 'bdrc-1-1';

    const error = validate(values, tab);
    if (error) {
      showMessage(form, error, 'error');
      return;
    }

    if (!validateCaptcha(prefix)) {
      showMessage(form, 'Incorrect captcha. Please try again.', 'error');
      if (tab === 'individual') initCaptcha('bdrc-1-1');
      else if (tab === 'institution') initCaptcha('bdrc-2-2');
      else initCaptcha('bdrc-5-3');
      return;
    }

    setLoading(form, true);
    state.pendingForm = form;
    openModal(form, values);
    setLoading(form, false);
    if (tab === 'individual') initCaptcha('bdrc-1-1');
    else if (tab === 'institution') initCaptcha('bdrc-2-2');
    else initCaptcha('bdrc-5-3');
  }

  function onReset(e) {
    const form = e.target;
    clearMessage(form);
    const panel = form.closest('.checker-tab-panel');
    const tab = panel ? panel.dataset.panel : state.currentTab;
    setTimeout(() => {
      if (tab === 'individual') initCaptcha('bdrc-1-1');
      else if (tab === 'institution') initCaptcha('bdrc-2-2');
      else initCaptcha('bdrc-5-3');
    }, 0);
  }

  function switchTab(panel) {
    const tab = panel.dataset.panel;
    state.currentTab = tab;
    document.querySelectorAll('.checker-tab-panel').forEach(p => p.hidden = true);
    panel.hidden = false;
    document.querySelectorAll('.checker-tab-btn').forEach(btn => btn.classList.remove('active'));
    const btn = document.querySelector(`.checker-tab-btn[data-tab="${tab}"]`);
    if (btn) btn.classList.add('active');

    setTimeout(() => {
      if (tab === 'individual') initCaptcha('bdrc-1-1');
      else if (tab === 'institution') initCaptcha('bdrc-2-2');
      else initCaptcha('bdrc-5-3');
    }, 100);
  }

  function initTabs() {
    document.querySelectorAll('.checker-tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;
        const panel = document.querySelector(`.checker-tab-panel[data-panel="${tab}"]`);
        if (panel) switchTab(panel);
      });
    });
  }

  function initInlineResultTypeSelectors() {
    document.querySelectorAll('.bdrc-rt-inline-select').forEach(select => {
      select.addEventListener('change', () => {
        const val = select.value;
        const panels = document.querySelectorAll('.checker-tab-panel');
        let target = 'individual';
        if (val === '2') target = 'institution';
        else if (val === '5') target = 'district';
        const panel = document.querySelector(`.checker-tab-panel[data-panel="${target}"]`);
        if (panel) switchTab(panel);
      });
    });
  }

  function initBoardDistrictLinkage() {
    document.querySelectorAll('.bdrc-board').forEach(boardSelect => {
      boardSelect.addEventListener('change', () => {
        const app = boardSelect.closest('.bdrc-app');
        if (!app) return;
        const districtSelect = app.querySelector('.bdrc-district');
        const loading = app.querySelector('.bdrc-district-loading');
        if (!districtSelect) return;
        const board = boardSelect.value;
        if (!board) {
          districtSelect.innerHTML = '<option value="">Select Board first</option>';
          return;
        }
        const districts = districtsByBoard[board] || [];
        if (loading) loading.style.display = 'inline';
        districtSelect.innerHTML = '<option value="">Loading districts\u2026</option>';
        setTimeout(() => {
          districtSelect.innerHTML = '<option value="">Select District</option>' +
            districts.map(d => `<option value="${d}">${d}</option>`).join('');
          if (loading) loading.style.display = 'none';
        }, 250);
      });
    });
  }

  function initForms() {
    document.querySelectorAll('.bdrc-form').forEach(form => {
      form.addEventListener('submit', onSubmit);
      form.addEventListener('reset', onReset);
      const closeBtn = form.closest('.bdrc-app').querySelector('.bdrc-modal-close');
      if (closeBtn) closeBtn.addEventListener('click', () => closeModal(form));
    });
  }

  function initCaptchaRefreshes() {
    document.querySelectorAll('.bdrc-refresh-captcha').forEach(btn => {
      btn.addEventListener('click', () => {
        const app = btn.closest('.bdrc-app');
        if (!app) return;
        const panel = app.closest('.checker-tab-panel');
        const tab = panel ? panel.dataset.panel : state.currentTab;
        if (tab === 'individual') initCaptcha('bdrc-1-1');
        else if (tab === 'institution') initCaptcha('bdrc-2-2');
        else initCaptcha('bdrc-5-3');
      });
    });
  }

  function init() {
    initTabs();
    initInlineResultTypeSelectors();
    initBoardDistrictLinkage();
    initForms();
    initCaptchaRefreshes();
    initCaptcha('bdrc-1-1');
    initCaptcha('bdrc-2-2');
    initCaptcha('bdrc-5-3');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

(function() {
  const navToggle = document.getElementById('ebrh-navToggle');
  const mobileMenu = document.getElementById('ebrh-mobileMenu');
  const close = document.getElementById('ebrh-mpClose');
  if (navToggle && mobileMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = mobileMenu.style.display === 'block';
      mobileMenu.style.display = isOpen ? 'none' : 'block';
      navToggle.setAttribute('aria-expanded', String(!isOpen));
    });
  }
  if (close && mobileMenu) {
    close.addEventListener('click', () => {
      mobileMenu.style.display = 'none';
      if (navToggle) navToggle.setAttribute('aria-expanded', 'false');
    });
  }
})();
