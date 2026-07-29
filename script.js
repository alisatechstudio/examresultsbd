// Set date and clock
const dateOpts = { year: 'numeric', month: 'long', day: 'numeric' };
document.getElementById('today-date').textContent = 'তারিখ: ' + new Date().toLocaleDateString('bn-BD', dateOpts);

const clockElement = document.getElementById('clock');
const updateClock = () => {
  clockElement.textContent = new Date().toLocaleTimeString('bn-BD') + ' BDT';
};
updateClock();
setInterval(updateClock, 1000);

// Custom API form handler
const customForm = document.getElementById('custom-result-form');
const resultDisplay = document.getElementById('custom-result-display');

if (customForm && resultDisplay) {
  customForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Show loading state
    resultDisplay.className = 'api-result-display loading';
    resultDisplay.innerHTML = 'ফলাফল আনা হচ্ছে...';

    const formData = new FormData(customForm);
    const data = Object.fromEntries(formData.entries());

    try {
      // Using the example endpoint from the documentation
      const response = await fetch('https://eduboardapi.vercel.app/fetch', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({ message: 'An unknown error occurred.' }));
        throw new Error(errorData.message || `HTTP error! Status: ${response.status}`);
      }

      const result = await response.json();

      // Show success state and render result
      resultDisplay.className = 'api-result-display success';
      if (result.result.toLowerCase() === 'failed') {
         resultDisplay.innerHTML = `<h3>দুঃখিত, ফলাফল পাওয়া যায়নি।</h3><p>রোল: ${result.roll} | বোর্ড: ${result.board}</p><p>ফলাফল: <strong>${result.result}</strong></p>`;
      } else {
         resultDisplay.innerHTML = `
          <h3>${result.name} এর ফলাফল</h3>
          <div class="result-grid">
            <p><strong>রোল:</strong> ${result.roll}</p>
            <p><strong>রেজিঃ</strong> ${result.reg}</p>
            <p><strong>বোর্ড:</strong> ${result.board}</p>
            <p><strong>পরীক্ষা:</strong> ${result.exam_type}</p>
            <p><strong>ফলাফল:</strong> ${result.result}</p>
            <p><strong>জিপিএ:</strong> ${result.gpa}</p>
          </div>
          <h4 style="margin-top: 20px;">বিষয়ভিত্তিক গ্রেড:</h4>
          <p>${result.grades.map(g => `${g.subject} (${g.code}): <strong>${g.grade}</strong>`).join('<br>')}</p>
        `;
      }
    } catch (error) {
      // Show error state
      resultDisplay.className = 'api-result-display error';
      resultDisplay.innerHTML = `ত্রুটি: ${error.message}. অনুগ্রহ করে আপনার তথ্য যাচাই করে আবার চেষ্টা করুন।`;
    }
  });
}