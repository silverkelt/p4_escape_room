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
        <a href='crud_insert.php'>add new</a>
        </nav>";
        echo $txt;
        printCrud(getData('users'), 'users');
}

function crud_questions(){
    $txt = "<h1>create,read,update,delete</h1>
    <nav>
        <a href='crud_insert.php'>add new</a>
        </nav>";
        echo $txt;
        printCrud(getData('questions'), 'questions');
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


function printCrud($result, $table){
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
            <form method='post' action='crud_update.php' >   
                <input type='hidden' name='nr' value='$row[$primarykey]'>         
                <button name='wzg'>Wijzigen</button>
            </form>
        </td>";

        $tableHtml .= "<td>
            <form method='post' action='crud_delete.php'>
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
function Verwijderen($conn, $nr)
{
    $table = 'users'; 
    $primarykey = getprimarykey($table);    
    $sql = "DELETE FROM $table WHERE $primarykey = :nr";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['nr' => $nr]);
    return ($stmt->rowCount() == 1) ? true : false;
}