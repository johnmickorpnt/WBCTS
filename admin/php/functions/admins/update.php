<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/Admins.php";
require_once "../../models/AuditTrail.php";


$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$user = new Admins($db);

$_SESSION["msg"] = array();

$id = $_POST['id'] ?? "";
$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";
$role = $_POST['role'] ?? "";
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

if (empty($id)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "User ID is required.");
} else $valid[0] = true;

if (empty($firstname)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Your First name is Required.");
} else $valid[1] = true;

if (empty($lastname)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Your Last name is Required.");
} else $valid[2] = true;

if (empty($role)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Your Email is Required.");
} else $valid[3] = true;

if (empty($username)) {
    $valid[4] = false;
    array_push($_SESSION["errors"], "Password is required.");
} else $valid[4] = true;


if (in_array(false, $valid)) {
    http_response_code(422);
}

$user->setId($id);
$user->setFirstname($firstname);
$user->setLastname($lastname);
$user->setRole($role);
$user->setUsername($username);
$user->setPassword($password);
$user->setIs_archived(false);

$result = $user->save();

$auditTrail = new AuditTrail($db);
$auditTrail->setUserId($_SESSION['user']['id']);
$auditTrail->setAction('Updated an admin account');
$auditTrail->setTimestamp(date('Y-m-d H:i:s'));
$auditTrail->save();

$auditTrail = new AuditTrail($db);
$auditTrail->setUserId($_SESSION['user']['id']);
$auditTrail->setAction('Updated an admin account');
$auditTrail->setTimestamp(date('Y-m-d H:i:s'));
$auditTrail->save();

http_response_code(200);
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
