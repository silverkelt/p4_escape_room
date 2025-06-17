<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href='add_question.php'>Add New Question</a>
        <a href='crud_users.php'>Manage Users</a>
        <a href='crud_questions.php'>Manage Questions</a>
        <a href='logout.php'>Logout</a>
    </nav>

    <?php
    session_start();
    
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
        header("Location: login.html");
        exit;
    }

    require_once 'functions.php';
    
    // Display user management and question management sections
    printCrud_users(getData('users'), 'users');
    printCrud_questions(getData('questions'), 'questions');
    ?>  