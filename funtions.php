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
function crud_users(){
    $txt = "<h1>create,read,update,delete</h1>
    <nav>
        <a href='insert_users.php'>add new</a>
        </nav>";
        echo $txt;
        printCrud_users(getData('users'), 'users');
}

function crud_questions(){
    $txt = "<h1>create,read,update,delete</h1>
    <nav>
        <a href='add_question.php'>add new</a>
        </nav>";
        echo $txt;
        printCrud_questions(getData('questions'), 'questions');
}


//get the data from the database and add it to the array
function getData($table){
    //connect database
    $conn = connectDb();
    $query = $conn->prepare("SELECT * FROM $table");
    $query -> execute();
    $result = $query -> fetchAll();

    return $result;
}


function printCrud_users($result, $table){
    $primarykey = getprimarykey($table);
    $tableHtml = "<table border='1'>";
    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    //print data for table header
    $headers = array_keys($result[0]);
    $tableHtml .= "<tr>";
    foreach($headers as $header){
        $tableHtml .= "<th bgcolor=gray>" . $header . "</th>";  
    }
    //print data for table body for each entry in the database
    foreach ($result as $row) {
        $tableHtml .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $tableHtml .= "<td>" . $cell . "</td>";
        }
        //add edit and delete button
        $tableHtml .= "<td>
            <form method='post' action='update_users.php' >   
                <input type='hidden' name='nr' value='$row[$primarykey]'>         
                <button name='wzg'>Wijzigen</button>
            </form>
        </td>";

        $tableHtml .= "<td>
            <form method='post' action='crud_users_delete.php'>
                <input type='hidden' name='nr' value='$row[$primarykey]'>      
                <button name='del'>delete</button>    
            </form>
        </td>";
        $tableHtml .= "</tr>";
    }
    $tableHtml .= "</table>";
    //print full crud tables
    echo $tableHtml;
}
function printCrud_questions($result, $table){
    $primarykey = getprimarykey($table);
    $tableHtml = "<table border='1'>";
    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    //print data for table header
    $headers = array_keys($result[0]);
    $tableHtml .= "<tr>";
    foreach($headers as $header){
        $tableHtml .= "<th bgcolor=gray>" . $header . "</th>";  
    }
    //print data for table body for each entry in the database
    foreach ($result as $row) {
        $tableHtml .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $tableHtml .= "<td>" . $cell . "</td>";
        }
        //add edit and delete button
        $tableHtml .= "<td>
            <form method='post' action='update_questions.php' >   
                <input type='hidden' name='nr' value='$row[$primarykey]'>         
                <button name='wzg'>Wijzigen</button>
            </form>
        </td>";

        $tableHtml .= "<td>
            <form method='post' action='crud_questions_delete.php'>
                <input type='hidden' name='nr' value='$row[$primarykey]'>      
                <button name='del'>delete</button>    
            </form>
        </td>";
        $tableHtml .= "</tr>";
    }
    $tableHtml .= "</table>";
    //print full crud tables
    echo $tableHtml;
}
function getprimarykey($table) {
    $conn = connectDb();
    $query = $conn->prepare("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
    $query->execute();
    $result = $query->fetch();
    return $result['Column_name'];
}
function Verwijderen_users($conn, $nr)
{
    $table = 'users'; 
    $primarykey = getprimarykey($table);    
    $sql = "DELETE FROM $table WHERE $primarykey = :nr";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nr' => $nr]);
    return ($stmt->rowCount() == 1) ? true : false;
}
function Verwijderen_questions($conn, $nr)
{
    $table = 'questions'; 
    $primarykey = getprimarykey($table);    
    $sql = "DELETE FROM $table WHERE $primarykey = :nr";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nr' => $nr]);
    return ($stmt->rowCount() == 1) ? true : false;
}

function insertusers($post){
    $conn = connectDb();
    $sql = "
        INSERT INTO users (email, username, password, admin)
        VALUES (:email, :username, :password, :admin)
    ";
    $hashed_password = password_hash($post['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':email' => $post['email'],
        ':username' => $post['username'],
        ':password' => $hashed_password,
        ':admin' => $post['admin']
    ]);
    return ($stmt->rowCount() == 1) ? true : false;
}
function update_users($row){
    // Maak database connectie
    $conn = connectDb();

    // Corrected query: table name, no trailing comma
    $sql = "UPDATE users
        SET 
            email = :email, 
            username = :username, 
            password = :password, 
            admin = :admin
        WHERE user_id = :user_id";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':email'=>$row['email'],
        ':username'=>$row['username'],
        ':password'=>$row['password'],
        ':admin'=>$row['admin'],
        ':user_id'=>$row['user_id']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}
function getUserById($user_id) {
    $conn = connectDb();
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetch();
}
function getquestionById($id) {
    $conn = connectDb();
    $sql = "SELECT * FROM questions WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}


function update_question($row){
    // Maak database connectie
    $conn = connectDb();

    // Corrected query: table name, no trailing comma
    $sql = "UPDATE questions
        SET 
            question = :question, 
            answer = :answer, 
            hint = :hint, 
            roomId = :roomId
        WHERE id = :id";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':question'=>$row['question'],
        ':answer'=>$row['answer'],
        ':hint'=>$row['hint'],
        ':roomId'=>$row['roomId'],
        ':id' => $row['id']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}
function insertquetions($post){
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "
        INSERT INTO questions (question, answer, hint, roomId)
        VALUES (:question, :answer, :hint, :roomId) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':question'=>$_POST['question'],
        ':answer'=>$_POST['answer'],
        ':hint'=>$_POST['hint'],
        ':roomId'=>$_POST['roomId']
    ]);

    
    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}