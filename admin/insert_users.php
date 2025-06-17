<?php
    // functie: code om nieuwe users toe te voegen
    // auteur: ramon kieboom

    echo "<h1>Insert user</h1>";

    require_once('../funtions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertusers($_POST) == true){
            echo "<script>alert('user is toegevoegd')</script>";
        } else {
            echo '<script>alert("user is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="email">email:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="username">username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="type">password:</label>
        <input type="text" id="password" name="password" required><br>

        <label for="type">admin:</label>
        <input type="text" id="admin" name="admin" required><br>


        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='show_all_teams.php'>Home</a>
    </body>
</html>
