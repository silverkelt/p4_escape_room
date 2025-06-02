<?php
  require_once 'config.php';
function ConnectDb(){
    include 'config.php';
   //attempt to connect to the database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // echo "Connected successfully";
        return $conn;
    }
    //failed connection handling
    catch(PDOException $e) {
        echo "Connection failed: <br>" . $e->getMessage();
    }
 
}
$conn = ConnectDb();

//insert question function
function insert_question($post){
    try{ 
        //connect database
        $conn = connectDb();
        include '../config.php';
        echo "connection succes";
        $query = $conn -> prepare("
        INSERT INTO $tablename (question, answer, hint, roomId )
        VALUES (:question, :answer, :hint, :roomId)");
        $query->execute(
            [
                'question'=>$post['question'],
                'answer'=>$post['answer'],
                'hint'=>$post['hint'],
                'roomId'=>$post['roomId']
            ]
            );
    }
    catch(PDOException $e){
        echo "error" . $e->getMessage();
    }
}


function register_user($post){
    try{ 
        // Connect to database
        $conn = ConnectDb();
        include 'config.php';
        // Use a separate table for users, e.g., 'users'
        $query = $conn->prepare("
            INSERT INTO users (email, username, password)
            VALUES (:email, :username, :password)
        ");
        // Hash the password before storing
        $hashed_password = password_hash($post['password'], PASSWORD_DEFAULT);
        $query->execute([
            'email' => $post['email'],
            'username' => $post['username'],
            'password' => $hashed_password
        ]);
    }
    catch(PDOException $e){
        echo "error: " . $e->getMessage();
    }
}
