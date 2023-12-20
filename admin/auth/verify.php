<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
include_once("../php/models/Admins.php");
include_once("../php/config/Database.php");

$database = new Database();
$db = $database->connect();
// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminObj = new Admins($db);
    $valid = array();

    $_SESSION["errors"] = array();

    $code = $_POST['code'] ?? "";

    $errors = array();
    if (empty($code)) {
        $valid[0] = false;
        array_push($_SESSION["errors"], "Verification is empty.");
    } else $valid[0] = true;

    if ($_SESSION["verification_code"]["code"] == $code) {
        $valid[1] = false;
        array_push($_SESSION["errors"], "Verification is doesn't match.");
    } else $valid[1] = true;

    if (!in_array(false, $valid)) {
        unset($_SESSION["verification_code"]);
        // Redirect to the dashboard
        header('Location: ../admins');
        exit();
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
    <title>Verify Account</title>
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
            <h1>Verify Account</h1>
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
                <div>
                    General Instructions:
                    <ul style="font-size: small;">
                        <li>Enter the 6-digit code we sent to your email.</li>
                        <li>Check your email for the verification code and enter it below.</li>
                        <li>Please enter the code you received in your email.</li>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="code">6 Digit Code</label>
                    <input type="number" id="code" name="code" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>