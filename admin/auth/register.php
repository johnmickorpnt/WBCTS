<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    $_SESSION["errors"] = array();
    array_push($_SESSION["errors"], "To create a new admin account, please login to an account with a special role.");
    
    header('Location: login');
    exit;
}
include_once("../php/models/Admins.php");
include_once("../php/config/Database.php");

require("../../php/PHPMailer/src/Exception.php");
require("../../php/PHPMailer/src/PHPMailer.php");
require("../../php/PHPMailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$database = new Database();
$db = $database->connect();
// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valid = array();
    $adminObj = new Admins($db);

    $_SESSION["errors"] = array();

    $firstname = $_POST["firstname"] ?? "";
    $lastname = $_POST["lastname"] ?? "";
    $email = $_POST["email"] ?? "";

    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";

    $role = $_POST['role'] ?? "";


    $errors = array();
    if (empty($username)) {
        $valid[0] = false;
        array_push($_SESSION["errors"], "Admin username is Required.");
    } else $valid[0] = true;

    if (empty($password)) {
        $valid[1] = false;
        array_push($_SESSION["errors"], "Password is required.");
    } else $valid[1] = true;

    if ($password !== $confirm_password) {
        $valid[2] = false;
        array_push($_SESSION["errors"], "Passwords do not match.");
    } else $valid[2] = true;

    if (empty($firstname)) {
        $valid[3] = false;
        array_push($_SESSION["errors"], "First name is missing.");
    } else $valid[3] = true;

    if (empty($lastname)) {
        $valid[4] = false;
        array_push($_SESSION["errors"], "Last name is missing.");
    } else $valid[4] = true;

    if ($adminObj->isUsernameUnique($username) >= 1) {
        $valid[5] = false;
        array_push($_SESSION["errors"], "Username has already been taken.");
    } else $valid[5] = true;

    if ($adminObj->isEmailUnique($email) >= 1) {
        $valid[6] = false;
        array_push($_SESSION["errors"], "Email has already been taken.");
    } else $valid[6] = true;


    if (empty($role)) {
        $valid[7] = false;
        array_push($_SESSION["errors"], "Please pick the role of the user.");
    } else $valid[7] = true;

    if (in_array(false, $valid)) {
        http_response_code(422);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $adminObj->setFirstname($firstname);
    $adminObj->setLastname($lastname);
    $adminObj->setUsername($username);
    $adminObj->setPassword($password);
    $adminObj->setEmail($email);
    $adminObj->setRole($role);

    // $result = true;
    $result = $adminObj->save();

    if ($result) {
        $verificationToken = generateVerificationToken();
        $mail = new PHPMailer(true);
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication


        $mail->Username = 'blotter.wbcts.project@gmail.com';
        $mail->Password = 'ouynrinftcjzpmdf';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->setFrom('blotter.wbcts.project@gmail.com', "WBCTS Blotter System");
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Admin Blotter Account Verification";

        $mail->Body = <<<MSG
        <h1>Dear {$firstname},</h1>

        <div style="font-size: 16px">
            Welcome to Blotter MS! To ensure the security of your admin account, we require verification. <br>

            Please use the following 6-digit code to complete the verification: <br>

            Verification Code: <b>{$verificationToken}</b> <br>

            <b>Note: This code is valid for 15 minutes.</b> <br>

            If you didn't request this verification, please ignore this email.

            Best regards,
            The Blotter MS Team
        </div>
        MSG;
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        http_response_code(200);
        header("Location: verify");
    }
}

function generateVerificationToken($length = 32)
{
    $verificationCode = rand(100000, 999999);

    // Set the verification code in a session with an expiration time
    $_SESSION['verification_code'] = [
        'code' => $verificationCode,
        'expiry_time' => time() + (15 * 60) // 15 minutes expiration
    ];

    return $verificationCode;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Register Admin</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-form h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 1%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #357ae8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h1>Admin Register</h1>
            <?php
            if (isset($_SESSION["errors"])) {
                echo "<ul>";
                foreach ($_SESSION["errors"] as $error) {
                    echo <<<MSG
                    <li style="color:red">$error</li>
                    MSG;
                }
                echo "</ul>";
                unset($_SESSION["errors"]);
            }
            ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="firstname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group" >
                    <label for="firstname">Role</label>
                    <select id="role" name="role" required style="width: 100%; padding:4px">
                        <option value=1>Admin</option>
                        <option value=2>Staff</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>