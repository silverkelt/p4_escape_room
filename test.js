// Houd het aantal correcte antwoorden bij
let correctAnswersCount = 0;
// Houd bij welke vragen al goed zijn beantwoord
let answeredQuestions = new Set();

let huidigkamer = Number(localStorage.getItem('huidigkamer')) || 1;
let score = Number(localStorage.getItem('score')) || 0;

function openModal(index) {
  let box = document.querySelector(`.box[data-index='${index}']`);
  let questionText = box.dataset.question;
  let correctAnswer = box.dataset.answer;

  document.getElementById('question').innerText = questionText;
  document.getElementById('modal').dataset.answer = correctAnswer;
  document.getElementById('modal').dataset.index = index;  // index opslaan
  document.getElementById('answer').value = '';
  document.getElementById('feedback').innerText = '';

  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';
}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
  document.getElementById('feedback').innerText = '';
}

function checkAnswer() {
  let userAnswer = document.getElementById('answer').value.trim();
  let correctAnswer = document.getElementById('modal').dataset.answer;
  let index = parseInt(document.getElementById('modal').dataset.index, 10);
  let feedback = document.getElementById('feedback');

  if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
    if (!answeredQuestions.has(index)) {
      correctAnswersCount++;
      answeredQuestions.add(index);
      score += 100;  // 100 punten per goed antwoord
      localStorage.setItem('score', score); // Score opslaan
    }

    feedback.innerText = 'Goed gedaan! Je score is nu: ' + score;
    feedback.style.color = 'green';

    setTimeout(() => {
      closeModal();

      if (huidigkamer === 1) {
        if (correctAnswersCount >= 5) {
          huidigkamer = 2;
          localStorage.setItem('huidigkamer', huidigkamer);
          correctAnswersCount = 0;
          answeredQuestions.clear();
          window.location.href = 'room_2.php';
        }
      } else if (huidigkamer === 2) {
        if (correctAnswersCount >= 5) {
          huidigkamer = 1;
          localStorage.setItem('huidigkamer', huidigkamer);
          window.location.href = 'win.php';
        }
      }
    }, 1000);
  } else {
    feedback.innerText = 'Fout, probeer opnieuw!';
    feedback.style.color = 'red';
  }
}
