<?php
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/User.php";
require_once "../../models/UserVerification.php";


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
$userVerification = new UserVerification($db);

$user_id = $_POST['user_id'] ?? "";

$userObj = $user->read($user_id);
$user->verify($user_id);
$userObj = $userObj->fetch(PDO::FETCH_ASSOC);

$userVerification->setUser_id($user_id);
$userVerification->setToken($userVerification->generateToken());


$verifyresults = $userVerification->save();
if ($verifyresults) {
    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication


    $mail->Username = 'blotter.wbcts.project@gmail.com';
    $mail->Password = 'ouynrinftcjzpmdf';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom('blotter.wbcts.project@gmail.com', "WBCTS Blotter System");
    $mail->addAddress($userObj["email"]);
    $mail->isHTML(true);
    $mail->Subject = "WBCTS - Verify Account";

    $mail->Body = <<<MSG
        <h1>Welcome to Blotter MS!</h1>
        
        <h5>Dear $fname,</h5>

        <p>Thank you for signing up with San Roque Blotter System. To complete your registration and activate your account, please click on the verification link below:</p>
        <a href="http://localhost/wbcts/auth/verify?id={$userVerification->getId()}&token={$userVerification->getToken()}">Click Here</a>
        <p>Please ensure that you click on the link within the next <b>30 Minutes</b> to verify your account. If you did not sign up for an account on San Roque Blotter System, you can safely ignore this email.</p>

        <p>If you have any questions or need assistance, please contact our support team at blotter.wbcts.project@gmail.com.</p>

        <h5>What is Blotter MS?</h5>
        <ul>
            <li>Blotter MS is a powerful system that empowers you to create blotters, manage settlements, and utilize QR code tracking.</li>
            <li>With Blotter MS, you can easily create and manage blotters, record settlements, and track cases using QR codes for efficient and streamlined processes.</p>
            <li>Explore the features of Blotter MS and experience a new level of convenience and efficiency in managing legal cases.</li>
            <li>If you have any questions or need assistance, feel free to reach out to our support team.</li>
            <li>Once again, welcome aboard!</li>
        </ul>

        <p>Best regards,</p>
        San Roque Blotter System Team
    MSG;
    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    http_response_code(200);
    header('Location: ' . '../../../auth/verification-sent.php');
    exit();
}
