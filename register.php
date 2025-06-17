<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=escape_room', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $wachtwoord = $_POST['wachtwoord'] ?? '';
        $wachtwoord_confirm = $_POST['wachtwoord_confirm'] ?? '';

        if ($wachtwoord !== $wachtwoord_confirm) {
            echo "De wachtwoorden komen niet overeen.";
            exit;
        }

        // Check of gebruikersnaam of e-mail al bestaat
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$gebruikersnaam, $email]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            echo "Gebruikersnaam of e-mail is al in gebruik.";
            exit;
        }

        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // Insert gebruiker, 3 placeholders, 3 waarden meegeven
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, `admin`) VALUES (?, ?, ?, 0)");
        $stmt->execute([$gebruikersnaam, $email, $hashed_password]);

        echo "Registratie geslaagd! <a href='login.html'>Inloggen</a>";
    } else {
        header("Location: register.html");
        exit;
    }
} catch (PDOException $e) {
    echo "Fout bij registratie: " . $e->getMessage();
}
?>
