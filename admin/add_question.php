<?php
require_once('../funtions.php');

if(isset($_POST) && isset($_POST['insert_button'])){
    insert_question($_POST);
   echo '<script>alert("nieuwe vraag is toegevoegt")</script>';
}
?>
<html>
    <body>

<h1>add questions</h1>
    <nav>
        <a href='show_all_questions.php'>return</a>
        </nav>
        <form method='post'>
            <label for='question'>question: </label>
            <input type='text' id='question' placeholder='question' name='question' required><br>
            <label for='answer'>answer: </label>
            <input type='text' id='answer' placeholder='answer' name='answer' required><br>
            <label for='hint'>hint: </label>
            <input type='text' id='hint' placeholder='hint'  name='hint'  required><br>
            <label for='roomId'>room id: </label>  
            <input type='number' id='roomId' placeholder='room id' name='roomId' required><br>
            <br>
            <input type='submit' name='insert_button'></input>
        </form>
    </body>
</html>

<!-- Op deze pagina kan alleen de admin een nieuwe vraag toevoegen.
     De admin vult een vraag, antwoord, hint en bijbehorend room ID in.
     Deze gegevens worden opgeslagen in de database. -->