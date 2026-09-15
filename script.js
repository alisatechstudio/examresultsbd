/**
 * ExamResultsBD - Complete Modern Application Engine
 * Features: Dark/Light Mode, Instant Search Hub, Interactive SMS Composer,
 * Live API Result Lookup, Dynamic BDT Clock, Toast Notifications
 */

// --- 1. Theme Management (Dark / Light) ---
const themeToggleBtn = document.getElementById('theme-toggle-btn');
const themeIcon = document.getElementById('theme-icon');

function initTheme() {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);
  } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.documentElement.setAttribute('data-theme', 'dark');
    updateThemeIcon('dark');
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
    updateThemeIcon('light');
  }
}

function updateThemeIcon(theme) {
  if (themeIcon) {
    themeIcon.textContent = theme === 'dark' ? '☀️' : '🌙';
  }
}

if (themeToggleBtn) {
  themeToggleBtn.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
    showToast(newTheme === 'dark' ? 'ডার্ক মোড সক্রিয় করা হয়েছে' : 'লাইট মোড সক্রিয় করা হয়েছে');
  });
}

initTheme();

// --- 2. Live BDT Clock & Date ---
const dateOpts = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
const todayDateEl = document.getElementById('today-date');
if (todayDateEl) {
  todayDateEl.textContent = 'তারিখ: ' + new Date().toLocaleDateString('bn-BD', dateOpts);
}

const footerYearEl = document.getElementById('footer-year');
if (footerYearEl) {
  footerYearEl.textContent = new Date().getFullYear();
}

const clockElement = document.getElementById('clock');
const updateClock = () => {
  if (clockElement) {
    clockElement.textContent = new Date().toLocaleTimeString('bn-BD') + ' BDT';
  }
};
updateClock();
setInterval(updateClock, 1000);

// --- 3. Toast Notification Helper ---
function showToast(message) {
  let toast = document.getElementById('toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toast';
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.classList.add('show');
  setTimeout(() => {
    toast.classList.remove('show');
  }, 2500);
}

// --- 4. Digit Translator ---
function toEnglishDigits(str) {
  if (!str) return str;
  const bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
  const en = ['0','1','2','3','4','5','6','7','8','9'];
  return str.replace(/[০-৯]/g, d => en[bn.indexOf(d)]);
}

// --- 5. Interactive Instant Search & Category Filter System ---
const searchInput = document.getElementById('global-exam-search');
const clearSearchBtn = document.getElementById('clear-search-btn');
const filterChips = document.querySelectorAll('.chip, .pill');
const searchResultCount = document.getElementById('search-result-count');
const noResultsMsg = document.getElementById('no-results-msg');
const resetSearchBtn = document.getElementById('reset-search-btn');

const allCards = document.querySelectorAll('.card, .faq-item, .sms-item, .board-row');
const allSections = document.querySelectorAll('main > section');

let activeCategory = 'all';

function filterExams() {
  const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
  
  if (clearSearchBtn) {
    clearSearchBtn.style.display = query.length > 0 ? 'block' : 'none';
  }

  let visibleCount = 0;

  allCards.forEach(card => {
    const text = card.textContent.toLowerCase();
    const category = card.getAttribute('data-category') || '';
    const keywords = card.getAttribute('data-keywords') || '';
    
    const matchesQuery = query === '' || text.includes(query) || keywords.toLowerCase().includes(query);
    const matchesCategory = activeCategory === 'all' || category.includes(activeCategory);

    if (matchesQuery && matchesCategory) {
      card.style.display = '';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Handle section visibility
  allSections.forEach(section => {
    if (section.id === 'lookup' || section.id === 'sms-tool') return;
    
    const visibleCards = section.querySelectorAll('.card:not([style*="display: none"]), .faq-item:not([style*="display: none"]), .sms-item:not([style*="display: none"]), .board-row:not([style*="display: none"])');
    if (query !== '' || activeCategory !== 'all') {
      section.style.display = visibleCards.length === 0 ? 'none' : '';
    } else {
      section.style.display = '';
    }
  });

  if (searchResultCount) {
    if (query === '' && activeCategory === 'all') {
      searchResultCount.textContent = '৫০+ টি অফিসিয়াল পোর্টাল সক্রিয়';
    } else {
      searchResultCount.textContent = `মোট ${visibleCount}টি পোর্টালে মিল পাওয়া গেছে`;
    }
  }

  if (noResultsMsg) {
    noResultsMsg.style.display = (visibleCount === 0 && (query !== '' || activeCategory !== 'all')) ? 'block' : 'none';
  }
}

if (searchInput) {
  searchInput.addEventListener('input', filterExams);
}

if (clearSearchBtn) {
  clearSearchBtn.addEventListener('click', () => {
    searchInput.value = '';
    filterExams();
    searchInput.focus();
  });
}

if (resetSearchBtn) {
  resetSearchBtn.addEventListener('click', () => {
    if (searchInput) searchInput.value = '';
    activeCategory = 'all';
    filterChips.forEach(c => c.classList.remove('active'));
    const allChip = document.querySelector('.chip[data-filter="all"], .pill[data-filter="all"]');
    if (allChip) allChip.classList.add('active');
    filterExams();
  });
}

filterChips.forEach(chip => {
  chip.addEventListener('click', () => {
    filterChips.forEach(c => c.classList.remove('active'));
    chip.classList.add('active');
    activeCategory = chip.getAttribute('data-filter') || 'all';
    filterExams();
  });
});

// Initialize search count
filterExams();

// --- 6. Interactive SMS Generator Tool ---
const smsExamSelect = document.getElementById('sms-exam-select');
const smsBoardSelect = document.getElementById('sms-board-select');
const smsRollInput = document.getElementById('sms-roll-input');
const smsYearInput = document.getElementById('sms-year-input');
const smsPreviewText = document.getElementById('sms-preview-text');
const copySmsBtn = document.getElementById('copy-sms-btn');
const sendSmsBtn = document.getElementById('send-sms-btn');

function updateSmsPreview() {
  if (!smsPreviewText) return;
  const exam = (smsExamSelect ? smsExamSelect.value : 'SSC').toUpperCase();
  const board = (smsBoardSelect ? smsBoardSelect.value : 'DHA').toUpperCase();
  const roll = (smsRollInput && smsRollInput.value.trim()) ? toEnglishDigits(smsRollInput.value.trim()) : '123456';
  const year = (smsYearInput && smsYearInput.value.trim()) ? toEnglishDigits(smsYearInput.value.trim()) : new Date().getFullYear();

  let formattedSms = '';
  if (exam === 'DPE' || exam === 'EBT') {
    formattedSms = `${exam} ${roll} ${year}`;
  } else {
    formattedSms = `${exam} ${board} ${roll} ${year}`;
  }

  smsPreviewText.textContent = formattedSms;

  if (sendSmsBtn) {
    sendSmsBtn.href = `sms:16222?body=${encodeURIComponent(formattedSms)}`;
  }
}

if (smsExamSelect) smsExamSelect.addEventListener('change', updateSmsPreview);
if (smsBoardSelect) smsBoardSelect.addEventListener('change', updateSmsPreview);
if (smsRollInput) smsRollInput.addEventListener('input', updateSmsPreview);
if (smsYearInput) smsYearInput.addEventListener('input', updateSmsPreview);

if (copySmsBtn) {
  copySmsBtn.addEventListener('click', () => {
    const textToCopy = smsPreviewText ? smsPreviewText.textContent : '';
    if (navigator.clipboard && textToCopy) {
      navigator.clipboard.writeText(textToCopy).then(() => {
        showToast(`SMS টেক্সট কপি হয়েছে: "${textToCopy}"`);
      }).catch(() => {
        showToast('কপি করা যায়নি, অনুগ্রহ করে ম্যানুয়ালি কপি করুন');
      });
    } else {
      showToast(`SMS টেক্সট: ${textToCopy}`);
    }
  });
}

updateSmsPreview();

// --- 7. Live API Board Result Lookup ---
const liveForm = document.getElementById('live-result-form');
const liveResultDisplay = document.getElementById('live-result-display');

async function fetchResult(data) {
  const response = await fetch('https://eduboardapi.vercel.app/fetch', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data),
  });

  if (!response.ok) {
    const errorData = await response.json().catch(() => ({ message: 'সার্ভার থেকে ফলাফল পাওয়া যায়নি। অনুগ্রহ করে eboardresults.com সরাসরি ব্যবহার করুন।' }));
    throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
  }

  return response.json();
}

if (liveForm && liveResultDisplay) {
  liveForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    liveResultDisplay.className = 'api-result-display loading';
    liveResultDisplay.setAttribute('role', 'status');
    liveResultDisplay.innerHTML = '⚡ সার্ভার থেকে ফলাফল অনুসন্ধান করা হচ্ছে... অনুগ্রহ করে অপেক্ষা করুন';

    const rawData = Object.fromEntries(new FormData(liveForm).entries());
    const data = {
      exam: toEnglishDigits(rawData.exam),
      year: toEnglishDigits(rawData.year),
      board: toEnglishDigits(rawData.board),
      roll: toEnglishDigits(rawData.roll),
      reg: toEnglishDigits(rawData.reg),
    };

    try {
      const result = await fetchResult(data);
      liveResultDisplay.className = 'api-result-display success';
      liveResultDisplay.removeAttribute('role');

      if (result.result && result.result.toLowerCase() === 'failed') {
        liveResultDisplay.innerHTML = `
          <div class="marksheet" style="border-color: var(--accent-rose);">
            <div class="marksheet-header">
              <h2 style="color: var(--accent-rose);">দুঃখিত, ফলাফল পাওয়া যায়নি</h2>
              <p>রোল: ${result.roll || data.roll} | বোর্ড: ${result.board || data.board}</p>
            </div>
            <p style="text-align:center; color:var(--text-secondary);">আপনার রোল, রেজিস্ট্রেশন নম্বর ও পরীক্ষার সাল পুনরায় যাচাই করুন অথবা <a href="https://www.eboardresults.com" target="_blank" style="color:var(--primary); font-weight:700;">eboardresults.com</a>-এ সরাসরি দেখুন।</p>
          </div>
        `;
      } else {
        const gradesTable = result.grades ? `
          <table class="grades-table">
            <thead>
              <tr>
                <th>বিষয় কোড</th>
                <th>বিষয়</th>
                <th>প্রাপ্ত গ্রেড</th>
              </tr>
            </thead>
            <tbody>
              ${result.grades.map(g => `
                <tr>
                  <td class="mono">${g.code}</td>
                  <td>${g.subject}</td>
                  <td class="mono"><strong>${g.grade}</strong></td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        ` : '';

        liveResultDisplay.innerHTML = `
          <div class="marksheet">
            <div class="marksheet-header" id="live-result-heading" tabindex="-1">
              <h2>${result.board ? result.board.toUpperCase() : ''} BOARD RESULT</h2>
              <p>${result.exam_type ? result.exam_type.toUpperCase() : 'EXAMINATION'} - ${data.year}</p>
            </div>
            <div class="info-grid">
              ${result.roll ? `<p><strong>রোল নম্বর:</strong> <span class="mono">${result.roll}</span></p>` : ''}
              ${result.reg ? `<p><strong>রেজিস্ট্রেশন:</strong> <span class="mono">${result.reg}</span></p>` : ''}
              ${result.name ? `<p><strong>শিক্ষার্থীর নাম:</strong> ${result.name}</p>` : ''}
              ${result.father_name ? `<p><strong>পিতার নাম:</strong> ${result.father_name}</p>` : ''}
              ${result.mother_name ? `<p><strong>মাতার নাম:</strong> ${result.mother_name}</p>` : ''}
              ${result.group ? `<p><strong>বিভাগ/গ্রুপ:</strong> ${result.group}</p>` : ''}
              ${result.institute ? `<p><strong>শিক্ষা প্রতিষ্ঠান:</strong> ${result.institute}</p>` : ''}
            </div>
            ${gradesTable ? `<div style="margin-top:16px;"><h4 style="margin-bottom:8px;">বিষয়ভিত্তিক গ্রেড বিবরণী:</h4>${gradesTable}</div>` : ''}
            <div class="marksheet-summary">
              <p>ফলাফল: <span style="color: ${result.result && result.result.toLowerCase() === 'passed' ? 'var(--accent-emerald)' : 'var(--accent-rose)'}; font-weight:800;">${result.result || 'PASSED'}</span></p>
              ${result.gpa ? `<p>জিপিএ (GPA): <strong class="mono" style="font-size:20px; color:var(--primary);">${result.gpa}</strong></p>` : ''}
            </div>
          </div>
        `;
      }

      const heading = document.getElementById('live-result-heading');
      if (heading) heading.focus();
    } catch (error) {
      liveResultDisplay.className = 'api-result-display error';
      liveResultDisplay.setAttribute('role', 'alert');
      liveResultDisplay.innerHTML = `⚠️ ত্রুটি: ${error.message} <br><br>আপনি সরাসরি সরকারি সার্ভার <a href="https://www.eboardresults.com" target="_blank" rel="noopener" style="color:inherit; text-decoration:underline; font-weight:bold;">eboardresults.com</a> অথবা <a href="https://www.educationboardresults.gov.bd/result" target="_blank" rel="noopener" style="color:inherit; text-decoration:underline; font-weight:bold;">educationboardresults.gov.bd</a> ব্যবহার করতে পারেন।`;
    }
  });
}