<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/User.php";

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$user = new User($db);

$_SESSION["msg"] = array();

$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";
$email = $_POST['email'] ?? "";
$contact_number = $_POST['contact_number'] ?? "";
$address = $_POST['address'] ?? "";
$password = $_POST['password'] ?? "";



if (empty($firstname)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "User First name is Required.");
} else $valid[0] = true;

if (empty($lastname)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "User Last name is Required.");
} else $valid[1] = true;

if (empty($email)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "User Email is Required.");
} else $valid[2] = true;

if (empty($contact_number)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Contact number is required.");
} else $valid[3] = true;

if (empty($address)) {
    $valid[4] = false;
    array_push($_SESSION["errors"], "Address is required.");
} else $valid[4] = true;

if (empty($password)) {
    $valid[5] = false;
    array_push($_SESSION["errors"], "Password is required.");
} else $valid[5] = true;

if (in_array(false, $valid)) {
    http_response_code(422);
    // Handle error response
    $response['success'] = false;
    $response['message'] = "Validation error";
    $response['errors'] = $_SESSION["errors"];
    echo json_encode($response);
    exit();
}

$user->setFirstname($firstname);
$user->setLastname($lastname);
$user->setEmail($email);
$user->setAddress($address);
$user->setContact_number($contact_number);
$user->setPassword($password);

$result = $user->save();

if ($result) {
    http_response_code(200);
    // Handle success response
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
