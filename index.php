<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = mysqli_connect("localhost", "root", "", "orbit");

    if (!$connection) {
        $_SESSION["message"] = "connection_failed";
    } else {
        if (!empty($_POST["name"]) and !empty($_POST["phone"])) {
            $name = $_POST["name"];
            $phone = $_POST["phone"];

            $insert_query = "INSERT INTO users (name, phone) VALUES ('" . $name . "','" . $phone . "'); ";
            $result = mysqli_query($connection, $insert_query);

            if ($result) {
                $_SESSION["message"] = "insert_success";
                sleep(2);
                //session_reset();
                header('location:retrieve.php');
            } else {
                $_SESSION["message"] = "insert_error";
            }
        } else {
            $_SESSION["message"] = "empty_inputs";
        }
    }
} else {
    #GET
    $_SESSION["message"] = "welcome";
}
include_once 'insert.html';