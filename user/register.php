<!-- Op deze pagina kan een gebruiker een account aanmaken.
     Na het registreren kom je automatisch op de inlogpagina terecht. -->
<?php
require_once('../funtions.php');

if(isset($_POST) && isset($_POST['insert_button'])){
    // Check if passwords match
    if ($_POST['password'] !== $_POST['repeat_password']) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {
        register_user($_POST);
        echo '<script>alert("new user registered")</script>';
    }
}
?>
<html>
    <body>

<h1>register</h1>
    <nav>
        <a href='crud.php'>return</a>
        </nav>
        <form method='post'>
            <label for='email'>email: </label>
            <input type='email' id='email' placeholder='email' name='email' required><br>
            <label for='username'>username: </label>
            <input type='text' id='username' placeholder='username' name='username' required><br>
            <label for='password'>password: </label>
            <input type='password' id='password' placeholder='password' name='password' required><br>
            <label for='repeat_password'>repeat_password: </label>
            <input type='password' id='repeat_password' placeholder='repeat password'  name='repeat_password'  required><br>
            <br>
            <input type='submit' name='insert_button'></input>
        </form>
    </body>
</html>