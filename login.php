<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=escape_room', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['username'] ?? '';
    $wachtwoord = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$gebruikersnaam]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($wachtwoord, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['admin']; // Let op: veld heet 'admin' in je database

        if ($user['admin'] == 1) {
            header("Location: admin.html");
        } else {
            header("Location: user-dashboard.php");
        }
        exit;
    } else {
        echo "<h2>Foutieve inloggegevens</h2>";
        echo '<a href="login.html">Probeer opnieuw</a>';
    }
} else {
    header("Location: login.html");
    exit;
}
?>
