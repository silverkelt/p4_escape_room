<?php
session_start();
include 'funtions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tijd = $_POST['tijd'] ?? null;
    $score = $_POST['score'] ?? null;
    $resultaat = $_POST['resultaat'] ?? 'gewonnen';

    // Validate input
    if (!$tijd || $score === null) {
        die("Tijd of score ontbreekt");
    }

    // Get user_id from session
    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        die("Geen gebruiker ingelogd");
    }

    // Get resultaat_id for this user (assumes user is in one team)
    $conn = ConnectDb();
    $stmt = $conn->prepare("SELECT resultaat_id FROM team_rule WHERE user_id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $resultaatId = $stmt->fetchColumn();

    if (!$resultaatId) {
        die("Geen resultaat gevonden voor deze gebruiker");
    }

    // Update the resultaat entry
    $stmt = $conn->prepare("UPDATE resultaten SET tijd = ?, resultaat = ?, score = ? WHERE resultaat_id = ?");
    if ($stmt->execute([$tijd, $resultaat, $score, $resultaatId])) {
        header("Location: index.html");
        exit;
    } else {
        echo "Fout bij bijwerken: " . implode(", ", $stmt->errorInfo());
    }
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
