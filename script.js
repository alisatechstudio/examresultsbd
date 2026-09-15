// Set date and year dynamically for static GitHub Pages
const dateOpts = { year: 'numeric', month: 'long', day: 'numeric' };
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
  if (clockElement) clockElement.textContent = new Date().toLocaleTimeString('bn-BD') + ' BDT';
};
updateClock();
setInterval(updateClock, 1000);

function toEnglishDigits(str) {
  if (!str) return str;
  const bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
  const en = ['0','1','2','3','4','5','6','7','8','9'];
  return str.replace(/[০-৯]/g, d => en[bn.indexOf(d)]);
}

// --- Custom API Result Handler ---

const customForm = document.getElementById('custom-result-form');
const resultDisplay = document.getElementById('custom-result-display');
const captchaLabel = document.getElementById('captcha-label');
const captchaInput = document.getElementById('captcha-input');
let captchaAnswer = 0;

/**
 * Generates and displays a new CAPTCHA question.
 */
function generateCaptcha() {
  // Simple math question to deter basic bots
  const num1 = Math.floor(Math.random() * 12) + 1;
  const num2 = Math.floor(Math.random() * 12) + 1;
  const useAddition = Math.random() > 0.5;

  if (useAddition) {
    captchaAnswer = num1 + num2;
    captchaLabel.textContent = `নিরাপত্তা প্রশ্ন: ${num1} + ${num2} = ?`;
  } else {
    // For subtraction, ensure the result is not negative
    const max = Math.max(num1, num2);
    const min = Math.min(num1, num2);
    captchaAnswer = max - min;
    captchaLabel.textContent = `নিরাপত্তা প্রশ্ন: ${max} - ${min} = ?`;
  }
  if (captchaInput) {
    captchaInput.value = ''; // Clear previous answer
  }
}

/**
 * Renders the success state with the result data.
 * @param {object} result - The result object from the API.
 */
function renderSuccess(result, year) { // The year parameter is passed from the submit handler
  resultDisplay.className = 'api-result-display success';
  resultDisplay.removeAttribute('role'); // Clear role

  if (result.result.toLowerCase() === 'failed') {
    resultDisplay.innerHTML = `
      <div class="marksheet-failed">
        <h3 id="result-heading" tabindex="-1">দুঃখিত, ফলাফল পাওয়া যায়নি।</h3>
        <p>রোল: ${result.roll} | বোর্ড: ${result.board}</p>
        <p>ফলাফল: <strong class="result-status failed">${result.result}</strong></p>
      </div>
    `;
  } else {
    const gradesTable = `
      <table class="grades-table">
        <thead>
          <tr>
            <th scope="col">বিষয় কোড</th>
            <th scope="col">বিষয়</th>
            <th scope="col">গ্রেড</th>
          </tr>
        </thead>
        <tbody>
          ${result.grades.map(g => `
            <tr>
              <td>${g.code}</td>
              <td>${g.subject}</td>
              <td>${g.grade}</td>
            </tr>
          `).join('')}
        </tbody>
      </table>
    `;

    resultDisplay.innerHTML = `
      <div class="marksheet">
        <div class="marksheet-header" id="result-heading" tabindex="-1">
          <h2>${result.board} Board</h2>
          <p>${result.exam_type} Examination Result - ${year}</p>
        </div>
        <div class="student-info">
          <div class="info-grid">
            <p><strong>Roll No:</strong> ${result.roll}</p>
            <p><strong>Name:</strong> ${result.name}</p>
            <p><strong>Father's Name:</strong> ${result.father_name}</p>
            <p><strong>Mother's Name:</strong> ${result.mother_name}</p>
            <p><strong>Group:</strong> ${result.group}</p>
            <p><strong>Date of Birth:</strong> ${result.dob}</p>
            <p><strong>Institute:</strong> ${result.institute}</p>
            <p><strong>Registration No:</strong> ${result.reg}</p>
          </div>
        </div>
        <div class="grades-section">
          <h4>Subject-wise Grades</h4>
          ${gradesTable}
        </div>
        <div class="marksheet-summary">
          <p><strong>Result:</strong> <span class="result-status ${result.result.toLowerCase()}">${result.result}</span></p>
          <p><strong>GPA:</strong> <span class="gpa-value">${result.gpa}</span></p>
        </div>
      </div>
    `;
  }
  // Move focus to the new content for screen reader users
  const resultHeading = document.getElementById('result-heading');
  if (resultHeading) {
    resultHeading.focus();
  }
}

/**
 * Renders the error state.
 * @param {string} message - The error message to display.
 */
function renderError(message) {
  resultDisplay.className = 'api-result-display error';
  resultDisplay.setAttribute('role', 'alert'); // Use role="alert" for important errors
  resultDisplay.innerHTML = `ত্রুটি: ${message}. অনুগ্রহ করে আপনার তথ্য যাচাই করে আবার চেষ্টা করুন।`;
}

/**
 * Renders the loading state.
 */
function renderLoading() {
  resultDisplay.className = 'api-result-display loading';
  resultDisplay.setAttribute('role', 'status');
  resultDisplay.innerHTML = 'ফলাফল আনা হচ্ছে...';
}

/**
 * Fetches result from the API.
 * @param {object} data - The form data to send.
 * @returns {Promise<object>} - The result data.
 */
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

if (customForm && resultDisplay) {
  generateCaptcha();

  customForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const userAnswer = parseInt(captchaInput.value, 10);
    if (userAnswer !== captchaAnswer) {
      renderError('ভুল নিরাপত্তা উত্তর। অনুগ্রহ করে আবার চেষ্টা করুন।');
      generateCaptcha();
      return;
    }

    renderLoading();
    const rawData = Object.fromEntries(new FormData(customForm).entries());
    const data = {
      exam: toEnglishDigits(rawData.exam),
      year: toEnglishDigits(rawData.year),
      board: toEnglishDigits(rawData.board),
      roll: toEnglishDigits(rawData.roll),
      reg: toEnglishDigits(rawData.reg),
    };
    try {
      const result = await fetchResult(data);
      renderSuccess(result, data.year);
    } catch (error) {
      renderError(error.message);
    } finally {
      generateCaptcha();
    }
  });
}

const liveForm = document.getElementById('live-result-form');
const liveResultDisplay = document.getElementById('live-result-display');

if (liveForm && liveResultDisplay) {
  liveForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    liveResultDisplay.className = 'api-result-display loading';
    liveResultDisplay.setAttribute('role', 'status');
    liveResultDisplay.innerHTML = 'ফলাফল আনা হচ্ছে...';

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
          <div class="marksheet-failed">
            <h3 id="live-result-heading" tabindex="-1">দুঃখিত, ফলাফল পাওয়া যায়নি।</h3>
            <p>রোল: ${result.roll} | বোর্ড: ${result.board}</p>
            <p>ফলাফল: <strong class="result-status failed">${result.result}</strong></p>
          </div>
        `;
      } else {
        const gradesTable = result.grades ? `
          <table class="grades-table">
            <thead>
              <tr>
                <th scope="col">বিষয় কোড</th>
                <th scope="col">বিষয়</th>
                <th scope="col">গ্রেড</th>
              </tr>
            </thead>
            <tbody>
              ${result.grades.map(g => `
                <tr>
                  <td>${g.code}</td>
                  <td>${g.subject}</td>
                  <td>${g.grade}</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        ` : '';

        liveResultDisplay.innerHTML = `
          <div class="marksheet">
            <div class="marksheet-header" id="live-result-heading" tabindex="-1">
              <h2>${result.board} Board</h2>
              <p>${result.exam_type} Examination Result - ${data.year}</p>
            </div>
            <div class="student-info">
              <div class="info-grid">
                ${result.roll ? `<p><strong>Roll No:</strong> ${result.roll}</p>` : ''}
                ${result.name ? `<p><strong>Name:</strong> ${result.name}</p>` : ''}
                ${result.father_name ? `<p><strong>Father's Name:</strong> ${result.father_name}</p>` : ''}
                ${result.mother_name ? `<p><strong>Mother's Name:</strong> ${result.mother_name}</p>` : ''}
                ${result.group ? `<p><strong>Group:</strong> ${result.group}</p>` : ''}
                ${result.dob ? `<p><strong>Date of Birth:</strong> ${result.dob}</p>` : ''}
                ${result.institute ? `<p><strong>Institute:</strong> ${result.institute}</p>` : ''}
                ${result.reg ? `<p><strong>Registration No:</strong> ${result.reg}</p>` : ''}
              </div>
            </div>
            ${gradesTable ? `<div class="grades-section"><h4>Subject-wise Grades</h4>${gradesTable}</div>` : ''}
            <div class="marksheet-summary">
              <p><strong>Result:</strong> <span class="result-status ${result.result ? result.result.toLowerCase() : ''}">${result.result || 'N/A'}</span></p>
              ${result.gpa ? `<p><strong>GPA:</strong> <span class="gpa-value">${result.gpa}</span></p>` : ''}
            </div>
          </div>
        `;
      }

      const heading = document.getElementById('live-result-heading');
      if (heading) heading.focus();
    } catch (error) {
      liveResultDisplay.className = 'api-result-display error';
      liveResultDisplay.setAttribute('role', 'alert');
      liveResultDisplay.innerHTML = `ত্রুটি: ${error.message}. অনুগ্রহ করে আপনার তথ্য যাচাই করে আবার চেষ্টা করুন।`;
    }
  });
}

// --- Interactive Instant Exam Search & Category Filter System ---
const searchInput = document.getElementById('global-exam-search');
const clearSearchBtn = document.getElementById('clear-search-btn');
const filterChips = document.querySelectorAll('.chip');
const searchResultCount = document.getElementById('search-result-count');
const noResultsMsg = document.getElementById('no-results-msg');
const resetSearchBtn = document.getElementById('reset-search-btn');
const allCards = document.querySelectorAll('.card, .faq-item, .sms-item, .board-row');
const allSections = document.querySelectorAll('main > section');

let activeCategoryFilter = 'all';

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
    
    // Check search query match
    const matchesQuery = query === '' || text.includes(query) || keywords.toLowerCase().includes(query);
    
    // Check category match
    const matchesCategory = activeCategoryFilter === 'all' || category.includes(activeCategoryFilter);

    if (matchesQuery && matchesCategory) {
      card.style.display = '';
      visibleCount++;
    } else {
      card.style.display = 'none';
    }
  });

  // Handle section visibility
  allSections.forEach(section => {
    if (section.id === 'lookup' || section.id === 'custom-api') return;
    
    const visibleCardsInSection = section.querySelectorAll('.card:not([style*="display: none"]), .faq-item:not([style*="display: none"]), .sms-item:not([style*="display: none"]), .board-row:not([style*="display: none"])');
    if (query !== '' || activeCategoryFilter !== 'all') {
      if (visibleCardsInSection.length === 0) {
        section.style.display = 'none';
      } else {
        section.style.display = '';
      }
    } else {
      section.style.display = '';
    }
  });

  if (searchResultCount) {
    if (query === '' && activeCategoryFilter === 'all') {
      searchResultCount.textContent = '';
    } else {
      searchResultCount.textContent = `মোট ${visibleCount}টি পোর্টালে মিল পাওয়া গেছে`;
    }
  }

  if (noResultsMsg) {
    noResultsMsg.style.display = (visibleCount === 0 && (query !== '' || activeCategoryFilter !== 'all')) ? 'block' : 'none';
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
    activeCategoryFilter = 'all';
    filterChips.forEach(c => c.classList.remove('active'));
    const allChip = document.querySelector('.chip[data-filter="all"]');
    if (allChip) allChip.classList.add('active');
    filterExams();
  });
}

filterChips.forEach(chip => {
  chip.addEventListener('click', () => {
    filterChips.forEach(c => c.classList.remove('active'));
    chip.classList.add('active');
    activeCategoryFilter = chip.getAttribute('data-filter');
    filterExams();
  });
});