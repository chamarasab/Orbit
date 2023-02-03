<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {}
else {
    $connection = mysqli_connect("localhost", "root", "", "orbit");

    $id = $_GET["id"];

    if (!$connection) {
        $_SESSION["message"] = "connection_failed";
    } else {
        if (!empty($_GET["id"])) {
            $id = $_GET["id"];

            $delete_query = "DELETE FROM users  where id = '".$id."'";
            $result = mysqli_query($connection, $delete_query);

            if ($result) {
                $_SESSION["message"] = "delete_success";
                sleep(2);
                header('location:retrieve.php');
                //session_reset();
            } else {
                $_SESSION["message"] = "insert_error";
            }
        } else {
            $_SESSION["message"] = "empty_inputs";
        }
    }

    //header('location:retrieve.php');
}