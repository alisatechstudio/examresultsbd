// Set date and clock
const dateOpts = { year: 'numeric', month: 'long', day: 'numeric' };
document.getElementById('today-date').textContent = 'তারিখ: ' + new Date().toLocaleDateString('bn-BD', dateOpts);

const clockElement = document.getElementById('clock');
const updateClock = () => {
  clockElement.textContent = new Date().toLocaleTimeString('bn-BD') + ' BDT';
};
updateClock();
setInterval(updateClock, 1000);