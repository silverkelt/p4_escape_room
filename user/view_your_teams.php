<?php
include '../funtions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your teams.";
    exit;
}

$user_id = $_SESSION['user_id'];
$conn = ConnectDb();

// Get all teams for this user
$stmt = $conn->prepare("
    SELECT t.team_naam, t.teamcode
    FROM teams t
    INNER JOIN team_rule tr ON t.team_id = tr.team_id
    WHERE tr.user_id = :user_id
");
$stmt->execute([':user_id' => $user_id]);
$teams = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Teams</title>
</head>
<body>
    <h1>Your Teams</h1>
    <?php if (count($teams) > 0): ?>
        <table border="1">
            <tr>
                <th>Team Name</th>
                <th>Team Code</th>
            </tr>
            <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?php echo htmlspecialchars($team['team_naam']); ?></td>
                    <td><?php echo htmlspecialchars($team['teamcode']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>You are not a member of any teams.</p>
    <?php endif; ?>
</body>
</html>