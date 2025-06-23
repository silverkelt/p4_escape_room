
<?php
include '../funtions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to join a team.";
    exit;
}

if (isset($_POST['join_button'])) {
    $teamcode = $_POST['teamcode'] ?? '';
    $user_id = $_SESSION['user_id'];

    // Check if the team exists
    $conn = ConnectDb();
    $stmt = $conn->prepare("SELECT team_id FROM teams WHERE teamcode = :teamcode");
    $stmt->execute([':teamcode' => $teamcode]);
    $team = $stmt->fetch();

    if ($team) {
        $team_id = $team['team_id'];

        // Get the resultaat_id for this team (use the first one found)
        $stmt2 = $conn->prepare("SELECT resultaat_id FROM team_rule WHERE team_id = :team_id LIMIT 1");
        $stmt2->execute([':team_id' => $team_id]);
        $rule = $stmt2->fetch();

        if ($rule) {
            $resultaat_id = $rule['resultaat_id'];

            // Check if user is already in this team
            $stmt3 = $conn->prepare("SELECT * FROM team_rule WHERE team_id = :team_id AND user_id = :user_id");
            $stmt3->execute([':team_id' => $team_id, ':user_id' => $user_id]);
            if ($stmt3->fetch()) {
                echo "<script>alert('You are already a member of this team!');</script>";
            } else {
                // Add user to team_rule
                $insert = $conn->prepare("INSERT INTO team_rule (team_id, user_id, resultaat_id) VALUES (:team_id, :user_id, :resultaat_id)");
                $insert->execute([
                    'team_id' => $team_id,
                    'user_id' => $user_id,
                    'resultaat_id' => $resultaat_id
                ]);
                echo "<script>alert('You have joined the team!');</script>";
            }
        } else {
            echo "<script>alert('No result entry found for this team. Please contact an admin.');</script>";
        }
    } else {
        echo "<script>alert('Teamcode not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Team</title>
</head>
<body>
    <h1>Join an Existing Team</h1>
    <form method="post">
        <label for="teamcode">Enter Team Code:</label>
        <input type="text" id="teamcode" name="teamcode" required>
        <button type="submit" name="join_button">Join Team</button>
    </form>
</body>
</html>