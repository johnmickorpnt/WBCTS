<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/Admins.php";

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$user = new Admins($db);

$_SESSION["msg"] = array();

$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";
$role = $_POST['role'] ?? "";
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

if (empty($firstname)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Your First name is Required.");
} else $valid[0] = true;

if (empty($lastname)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Your Last name is Required.");
} else $valid[1] = true;

if (empty($role)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Your Email is Required.");
} else $valid[2] = true;

if (empty($username)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Password is required.");
} else $valid[3] = true;

if (empty($password)) {
    array_push($_SESSION["errors"], "Password Confirmation is required.");
    $valid[4] = false;
} else $valid[4] = true;



if (in_array(false, $valid)) {
    http_response_code(422);
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    var_dump($errors);
    // exit();
}


$user->setFirstname($firstname);
$user->setLastname($lastname);
$user->setRole($role);
$user->setUsername($username);
$user->setPassword($password);
// $user->setPass(password_hash($pass, PASSWORD_DEFAULT));

$result = $user->save();

if ($result) {
    http_response_code(200);
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
