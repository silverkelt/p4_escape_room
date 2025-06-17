<?php
    // functie: update user
    // auteur: ramon kieboom
    
    require_once('../funtions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(update_question($_POST) == true){
            header("Location: show_all_questions.php");
            exit;
        } else {
            echo '<script>alert("user is NIET gewijzigd")</script>';
        }
    }

// Test of id is meegegeven in de URL of via POST
if(isset($_GET['id'])){  
    $id = $_GET['id'];
    $row = getquestionbyid($id);
} elseif (isset($_POST['nr'])) {
    $id = $_POST['nr'];
    $row = getquestionbyid($id);
} else {
    echo "Geen id opgegeven<br>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig user</title>
</head>
<body>
  <h2>Wijzig user</h2>
  <form method="post">
    
    <input type="hidden" id="id" name="id" required value="<?php echo $row['id']; ?>"><br>
    <label for="merk">question:</label>
    <input type="text" id="question" name="question" required value="<?php echo $row['question']; ?>"><br>

    <label for="answer">answer:</label>
    <input type="text" id="answer" name="answer" required value="<?php echo $row['answer']; ?>"><br>
    
    <label for="hint">hint:</label>
    <input type="text" id="hint" name="hint" required value="<?php echo $row['hint']; ?>"><br>

    <label for="roomId">roomId:</label>
    <input type="text" id="roomId" name="roomId" required value="<?php echo $row['roomId']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='show_all_teams.php'>Home</a>
</body>
</html>

