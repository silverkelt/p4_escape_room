<!-- Op deze pagina zie je een overzicht van alle teams met hun score.
     De score laat zien hoelang een team erover heeft gedaan om te ontsnappen,
     of hoeveel tijd ze nog over hadden toen ze ontsnapten. -->
<?php
session_start();
include '../funtions.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your teams' scores.";
    exit;
}

$user_id = $_SESSION['user_id'];
$conn = ConnectDb();

// Get all teams for this user, with their scores and times
$stmt = $conn->prepare("
    SELECT t.team_naam, t.teamcode, r.score, r.tijd, r.resultaat
    FROM teams t
    INNER JOIN team_rule tr ON t.team_id = tr.team_id
    INNER JOIN resultaten r ON tr.resultaat_id = r.resultaat_id
    WHERE tr.user_id = :user_id
");
$stmt->execute([':user_id' => $user_id]);
$teams = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Jouw Teams & Scores</title>
</head>
<body>
    <h1>Jouw Teams & Scores</h1>
    <?php if (count($teams) > 0): ?>
        <table border="1">
            <tr>
                <th>Teamnaam</th>
                <th>Teamcode</th>
                <th>Score</th>
                <th>Tijd</th>
                <th>Resultaat</th>
            </tr>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?php echo htmlspecialchars($team['team_naam']); ?></td>
                    <td><?php echo htmlspecialchars($team['teamcode']); ?></td>
                    <td><?php echo htmlspecialchars($team['score']); ?></td>
                    <td><?php echo htmlspecialchars($team['tijd']); ?></td>
                    <td><?php echo htmlspecialchars($team['resultaat']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Je bent nog geen lid van een team of er zijn geen scores beschikbaar.</p>
    <?php endif; ?>
</body>
</html>