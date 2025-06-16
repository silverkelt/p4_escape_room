<?php
require_once('dbcon.php');

try {
  $stmt = $db_connection->query("SELECT * FROM questions WHERE roomId = 1");
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
  <title>Escape Room 1</title>
  <link rel="stylesheet" href="style.css">
</head>



<body>
  <article id="body1">

   <div class="timer" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;"></div>


  <div class="container">
    <?php foreach ($questions as $index => $question) : ?>
      <!-- de php code in de class zorgt ervoor dat elke box uniek is zodat je deze apart kunt stylen. Zo krijg je dus box1, box2 en box3 -->
      <div class="box box1<?php echo $index + 1; ?>" onclick="openModal(<?php echo $index; ?>)"
        data-index="<?php echo $index; ?>" data-question="<?php echo htmlspecialchars($question['question']); ?>"
        data-answer="<?php echo htmlspecialchars($question['answer']); ?>"> 
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
  </article>
  <script src="test.js"></script>
  <script src="timer.js"></script>
</body>

</html>