<?php
require 'vendor\autoload.php';
// register Slim auto-loader
\Slim\Slim::registerAutoloader();

// initialize app
$app = new \Slim\Slim();

$app->get('/users', 'getUsers');
$app->get('/users/:id',    'getUser');

$app->get('/codes', 'getCodes');

$app->run();


function getUsers() {
    $sql_query = "select * FROM personnel ORDER BY ID";
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_query);
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"users": ' . json_encode($users) . '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }   
}

function getUser($id) {
    $sql = "SELECT * FROM personnel WHERE id=:id";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $user = $stmt->fetchObject();  
        $dbCon = null;
        echo json_encode($user); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getCodes() {
    $sql = "SELECT * from codetable";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->query($sql);
        $codes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"codes": ' . json_encode($codes).  '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() . '}}';
    }
}

function getConnection() {
    try {
        $db_username = "root";
        $db_password = "2736lunar69";
        $conn = new PDO('mysql:host=localhost;dbname=1sqn', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}

