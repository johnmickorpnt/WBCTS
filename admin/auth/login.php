<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include_once("../php/models/Admins.php");
include_once("../php/config/Database.php");

$database = new Database();
$db = $database->connect();
// Check if the user is already logged in, if yes, redirect to the dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: ../dashboard');
    exit();
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform your authentication logic here (e.g., check credentials against database)
    $userObj = new Admins($db);
    $result = $userObj->login($username, $password);

    if ($result) {
        // Assuming authentication is successful, set session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['user'] = $result["user"];
        $_SESSION['role'] = $result["role"];

        // Redirect to the dashboard
        header('Location: ../dashboard');
        exit();
    } else {
        // Authentication failed, display an error message or redirect to an error page
        echo "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
            <h1>Admin Login</h1>
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
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>