<?php
session_start();
require_once('dbcon.php');

// Check of de gebruiker is ingelogd
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Je moet ingelogd zijn om resultaten op te slaan.";
    exit;
}

// Controleer of het een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_SESSION['user'];
    $tijd = $_POST['tijd'] ?? null; // Verwacht formaat 'HH:MM:SS'
    $resultaat = $_POST['resultaat'] ?? null; // 'gewonnen' of 'verloren'

    // Valideer invoer
    if (!$tijd || !preg_match('/^\d{2}:\d{2}:\d{2}$/', $tijd) || !in_array($resultaat, ['gewonnen', 'verloren'])) {
        http_response_code(400);
        echo "Ongeldige gegevens.";
        exit;
    }

    try {
        // Prepareer en voer insert uit
        $stmt = $db_connection->prepare("INSERT INTO resultaten (naam, tijd, resultaat) VALUES (?, ?, ?)");
        $stmt->execute([$naam, $tijd, $resultaat]);

        echo "Resultaat succesvol opgeslagen. Bedankt voor het spelen, " . htmlspecialchars($naam) . "!";
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Fout bij opslaan: " . $e->getMessage();
    }
} else {
    http_response_code(405);
    echo "Ongeldig verzoek.";
}
