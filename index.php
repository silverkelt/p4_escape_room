<?php
require_once('dbcon.php');

try {
  // Haal 4 willekeurige vragen op
  $stmt = $db_connection->query("SELECT * FROM questions_room_one ORDER BY RAND() LIMIT 4");
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Databasefout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <?php foreach ($questions as $index => $question) : ?>
    <div class="box" onclick="openModal(<?php echo $index; ?>)" data-index="<?php echo $index; ?>"
      data-question="<?php echo htmlspecialchars($question['question']); ?>"
      data-answer="<?php echo htmlspecialchars($question['answer']); ?>">
      Box <?php echo $index + 1; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <section class="overlay" id="overlay" onclick="closeModal()"></section>

  <section class="modal" id="modal">
    <h2>Escape Room Vraag</h2>
    <p id="question"></p>
    <input type="text" id="answer" placeholder="Typ je antwoord">
    <button onclick="checkAnswer()">Verzenden</button>
    <p id="feedback"></p>
  </section>



  <script src="app.js"></script>

</body>

</html>