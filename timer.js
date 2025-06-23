// timer.js

const timerElement = document.querySelector('.timer');

// Haal eerder gebruikte tijd op, of start op 300 seconden
let totalTime = 600; // totaal 10 minuten (2 kamers x 5 minuten)
let timeUsedRoom1 = Number(localStorage.getItem('timeUsedRoom1')) || 0;
let timeUsedRoom2 = Number(localStorage.getItem('timeUsedRoom2')) || 0;

let room = Number(localStorage.getItem('huidigkamer')) || 1;

let timeLeft;

if(room === 1) {
  timeLeft = 300 - timeUsedRoom1; // start met resterende tijd van kamer 1
} else {
  timeLeft = 300 - timeUsedRoom2; // start met resterende tijd van kamer 2
}

function updateTimer() {
  const minutes = Math.floor(timeLeft / 60);
  const seconds = timeLeft % 60;
  timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

  if (timeLeft > 0) {
    timeLeft--;
    // Sla tijdgebruik op per kamer
    if(room === 1) {
      localStorage.setItem('timeUsedRoom1', 300 - timeLeft);
    } else {
      localStorage.setItem('timeUsedRoom2', 300 - timeLeft);
    }
  } else {
    clearInterval(timerInterval);
    timerElement.textContent = "Tijd is om!";
    window.location.href = "lose.html";
  }
}

updateTimer();
const timerInterval = setInterval(updateTimer, 1000);
