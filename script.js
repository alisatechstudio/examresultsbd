// Set date and clock
const dateOpts = { year: 'numeric', month: 'long', day: 'numeric' };
document.getElementById('today-date').textContent = 'তারিখ: ' + new Date().toLocaleDateString('bn-BD', dateOpts);

const clockElement = document.getElementById('clock');
const updateClock = () => {
  clockElement.textContent = new Date().toLocaleTimeString('bn-BD') + ' BDT';
};
updateClock();
setInterval(updateClock, 1000);

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
  const num1 = Math.floor(Math.random() * 10) + 1;
  const num2 = Math.floor(Math.random() * 10) + 1;
  captchaAnswer = num1 + num2;
  if (captchaLabel) {
    captchaLabel.textContent = `নিরাপত্তা প্রশ্ন: ${num1} + ${num2} = ?`;
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
    const errorData = await response.json().catch(() => ({ message: 'An unknown server error occurred.' }));
    throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
  }

  return response.json();
}

if (customForm && resultDisplay) {
  generateCaptcha(); // Generate the first CAPTCHA on page load

  customForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // --- CAPTCHA Verification ---
    const userAnswer = parseInt(captchaInput.value, 10);
    if (userAnswer !== captchaAnswer) {
      renderError('ভুল নিরাপত্তা উত্তর। অনুগ্রহ করে আবার চেষ্টা করুন।');
      generateCaptcha(); // Generate a new question after a wrong attempt
      return; // Stop the form submission
    }

    renderLoading();
    const data = Object.fromEntries(new FormData(customForm).entries());
    try {
      const result = await fetchResult(data);
      renderSuccess(result, data.year);
    } catch (error) {
      renderError(error.message);
    } finally {
      // Regenerate captcha for the next attempt, regardless of success or failure
      generateCaptcha();
    }
  });
}