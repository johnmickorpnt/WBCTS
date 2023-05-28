<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/User.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$user = new User($db);

$_SESSION["msg"] = array();

$fname = $_POST['fname'] ?? "";
$lname = $_POST['lname'] ?? "";
$pass = $_POST['pass'] ?? "";
$conpass = $_POST['conpass'] ?? "";
$email = $_POST['email'] ?? "";
$address = $_POST['address'] ?? "";
$contact_number = $_POST['contact_number'] ?? "";

if (empty($fname)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Your First name is Required.");
} else $valid[0] = true;

if (empty($lname)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "Your Last name is Required.");
} else $valid[1] = true;

if (empty($email)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Your Email is Required.");
} else $valid[2] = true;

if (empty($pass)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Password is required.");
} else $valid[3] = true;

if (empty($conpass)) {
    array_push($_SESSION["errors"], "Password Confirmation is required.");
    $valid[4] = false;
} else $valid[4] = true;

if ($pass != $conpass) {
    $valid[5] = false;
    array_push($_SESSION["errors"], "Your password and Password Confirmation does not match.");
} else $valid[5] = true;

if (empty($address)) {
    $valid[6] = false;
    array_push($_SESSION["errors"], "Address is missing.");
} else $valid[6] = true;

if (empty($contact_number)) {
    $valid[7] = false;
    array_push($_SESSION["errors"], "Contact number is missing.");
} else $valid[7] = true;

if ($user->is_email_unique($email)) {
    $valid[8] = false;
    array_push($_SESSION["errors"], "Email already exist.");
} else $valid[8] = true;

if (in_array(false, $valid)) {
    http_response_code(422);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$user->setFirst_name($fname);
$user->setLast_name($lname);
$user->setEmail($email);
$user->setContact_number($contact_number);
$user->setAddress($address);
$user->setPass(password_hash($pass, PASSWORD_DEFAULT));
$user->setIs_archived(false);

$result = $user->save();

if ($result) {
    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication


    $mail->Username = 'jacobmartindummy@gmail.com';
    $mail->Password = 'topldwzedgeifuge';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('jacobmartindummy@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Hubz Bistro Account Creation";



    $mail->Body = <<<MSG
        <h1>Welcome to Blotter MS!</h1>
        <p>Thank you for joining us. We are excited to have you on board.</p>
        <p>Blotter MS is a powerful system that empowers you to create blotters, manage settlements, and utilize QR code tracking.</p>
        <p>With Blotter MS, you can easily create and manage blotters, record settlements, and track cases using QR codes for efficient and streamlined processes.</p>
        <p>Explore the features of Blotter MS and experience a new level of convenience and efficiency in managing legal cases.</p>
        <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
        <p>Once again, welcome aboard!</p>
    MSG;
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    http_response_code(200);
    header('Location: ' . '../../../auth/user-login.php');
    exit();
}
