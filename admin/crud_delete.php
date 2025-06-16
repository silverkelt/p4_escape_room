<?php

include '../funtions.php';

// Haal uit de database
if(isset($_POST['nr'])){
    $nr = $_POST['nr'];
    echo "Received primarykey: " . $_POST['nr'] . "<br>"; // Debug statement
    Verwijderen($conn, $nr);

    echo '<script>alert("primarykey: ' . $_POST['nr'] . ' is verwijderd")</script>';
    echo "<script>location.href='show_all_teams.php';</script>";
} else {
    echo "No primary key received"; // Debug statement
}
?>