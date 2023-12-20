<?php
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json; charset=utf-8');
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

$_SESSION["msg"] = array();

$id = $_POST['id'] ?? "";
$token = $_POST['token'] ?? "";


$result = $userVerification->validate($id, $token);

if ($result) {
    $userVerficiationDetails = $userVerification->read($id);
    $userVerficiationDetails = $userVerficiationDetails->fetch(PDO::FETCH_ASSOC);

    $user->verify($userVerficiationDetails["user_id"]);

    if (isset($_SESSION["id"])) {
        header("Location: ../../../index");
        $_SESSION["verified"] = 1;
    }
    else{
        header("Location: ../../../auth/user-login");
    }
}
