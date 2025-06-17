<?php
    // functie: update user
    // auteur: ramon kieboom
    
    require_once('../funtions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(update_users($_POST) == true){
            header("Location: show_all_teams.php");
            exit;
        } else {
            echo '<script>alert("user is NIET gewijzigd")</script>';
        }
    }

// Test of user_id is meegegeven in de URL of via POST
if(isset($_GET['user_id'])){  
    $user_id = $_GET['user_id'];
    $row = getUserById($user_id);
} elseif (isset($_POST['nr'])) {
    $user_id = $_POST['nr'];
    $row = getUserById($user_id);
} else {
    echo "Geen user_id opgegeven<br>";
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
    
    <input type="hidden" id="user_id" name="user_id" required value="<?php echo $row['user_id']; ?>"><br>
    <label for="merk">email:</label>
    <input type="text" id="email" name="email" required value="<?php echo $row['email']; ?>"><br>

    <label for="username">username:</label>
    <input type="text" id="username" name="username" required value="<?php echo $row['username']; ?>"><br>
    
    <label for="password">password:</label>
    <input type="text" id="password" name="password" required value="<?php echo $row['password']; ?>"><br>

    <label for="admin">admin:</label>
    <input type="text" id="admin" name="admin" required value="<?php echo $row['admin']; ?>"><br>

    <label for="user_id">user_id:</label>
    <input type="text" id="user_id" name="user_id" required value="<?php echo $row['user_id']; ?>"><br>
    
    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='show_all_teams.php'>Home</a>
</body>
</html>

