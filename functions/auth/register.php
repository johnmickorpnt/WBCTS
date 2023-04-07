<?php
session_start();

include("config/Database.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
        mysqli_query($query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter valid information!";
    }
}
