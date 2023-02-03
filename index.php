<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "orbit");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    /**
     * find user
     */
    $user_id = null;
    $user_name = "";
    $user_contact = "";

    if(isset($_GET["id"])){
        $user_id = $_GET["id"];
        $select_query = "SELECT * from users WHERE id = '".$user_id."'";
        $result = mysqli_query($connection, $select_query);
        if ($result) {
            $_SESSION["message"] = "user_found_success";

            while($user = mysqli_fetch_assoc($result)){
                $user_id = $user['id'];
                $user_name = $user['name'];
                $user_contact = $user['phone'];
            }
        } else {
            $_SESSION["message"] = "user_found_failed";
        }
    }

}
include_once 'insert.html';