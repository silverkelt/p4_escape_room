
// Starttijd in seconden (10 minuten = 600 seconden)
let timeLeft = 600;

const timerElement = document.querySelector('.timer');

function updateTimer() {
  const minutes = Math.floor(timeLeft / 60);
  const seconds = timeLeft % 60;

  timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

  if (timeLeft > 0) {
    timeLeft--;
  } else {
    clearInterval(timerInterval);
    timerElement.textContent = "Tijd is om!";
  }
}

updateTimer();
const timerInterval = setInterval(updateTimer, 1000);
