<?php
session_start();
require_once "../../config/Database.php";
require_once "../../models/User.php";
require_once "../../models/UserVerification.php";


$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$user = new User($db);
$userVerification = new UserVerification($db);

$email = "";
$pass = "";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(401);
    echo json_encode(array('status' => false, "msg" => 'Username/Password missing', "accesstoken" => 0));
    exit();
}

if (!isset($_POST['email']) || !isset($_POST['pass'])) {
    http_response_code(401);
    array_push($_SESSION["errors"], ["Missing Email/Password"]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);

} else {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $result = $user->login($email, $pass);
    // Fetch the user from the database
    $user = $result->fetch(PDO::FETCH_ASSOC);
    // Verify the password
    // var_dump($user);
    if ($user && password_verify($pass, $user["password"])) {
        // Password is correct
        $_SESSION["id"] = $user["id"];
        $_SESSION["verified"] = $user["verified"];
        header("Location: ../index.php");
        exit();
    } else {
        array_push($_SESSION["errors"], "Invalid Email/Password");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
