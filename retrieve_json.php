<?php
$connection = mysqli_connect('localhost','root','','orbit');
//include_once 'Database.php';
//$database = new Database();
//$connection = $database->getConnection();
$selectquery = "SELECT * FROM users";
if ($result = mysqli_query($connection, $selectquery)) {

    $resultArray = array();
    $tempArray = array();

    while ($row = $result->fetch_object()) {
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    echo json_encode(['users' => $resultArray]);
}