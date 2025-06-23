<?php
session_start();
include 'funtions.php'; // jouw DB-verbinding

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tijd = $_POST['tijd'] ?? null;
    $score = $_POST['score'] ?? null;
    $resultaat = $_POST['resultaat'] ?? 'gewonnen';

    // Stap 1: Validatie
    if (!$tijd || !$score) {
        die("Tijd of score ontbreekt");
    }

    // Stap 2: Haal user_id op uit sessie
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        die("Geen gebruiker ingelogd");
    }

    // Stap 3: Haal resultaat_id op dat bij deze gebruiker hoort
    $sql = "SELECT resultaat_id FROM team_rule WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($resultaatId);
    $stmt->fetch();
    $stmt->close();

    if (!$resultaatId) {
        die("Geen resultaat gevonden voor deze gebruiker");
    }

    // Stap 4: Update het resultaat
    $sql = "UPDATE resultaten SET tijd = ?, resultaat = ?, score = ? WHERE resultaat_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $tijd, $resultaat, $score, $resultaatId);

    if ($stmt->execute()) {
        // Optioneel: redirect naar index
        header("Location: index.html");
        exit;
    } else {
        echo "Fout bij bijwerken: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Je hebt gewonnen!</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <section class="screen win">
    <h1>Gefeliciteerd!</h1>
    <p>Je hebt de tempel weten te ontsnappen en de goden verslagen!</p>
    <p id="totalTime">Je totale speeltijd is: ...</p>
    <p id="finalScore">Je eindscore is: ...</p>

    <form method="POST">
      <input type="hidden" name="tijd" id="tijdInput">
      <input type="hidden" name="score" id="scoreInput">
      <input type="hidden" name="resultaat" value="gewonnen">
      <button type="submit">Speel opnieuw</button>
    </form>
  </section>

  <script>
    // Haal tijden op uit localStorage
    const timeUsedRoom1 = Number(localStorage.getItem('timeUsedRoom1')) || 0;
    const timeUsedRoom2 = Number(localStorage.getItem('timeUsedRoom2')) || 0;
    const totalTimeSeconds = timeUsedRoom1 + timeUsedRoom2;

    // Formatteer tijd
    const minutes = Math.floor(totalTimeSeconds / 60);
    const seconds = totalTimeSeconds % 60;
    const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    // Haal score op
    const score = Number(localStorage.getItem('score')) || 0;

    // Vul tekst in
    document.getElementById('totalTime').textContent = `Je totale speeltijd is: ${formattedTime}`;
    document.getElementById('finalScore').textContent = `Je eindscore is: ${score}`;

    // Zet waarden in formulier
    document.getElementById('tijdInput').value = formattedTime;
    document.getElementById('scoreInput').value = score;

    // Leeg localStorage
    localStorage.removeItem('timeUsedRoom1');
    localStorage.removeItem('timeUsedRoom2');
    localStorage.removeItem('score');
    localStorage.removeItem('huidigkamer');
  </script>
</body>
</html>
