<?php
require("../templates/template-functions.php");


$title = "Login";
$errors = "";
if (isset($_SESSION["errors"])) {
	$errors .= "<ul>";
	foreach ($_SESSION["errors"] as $error) {
		$errors .= "<li class='error'>{$error}</li>";
	}
	$errors .= "</ul>";
	unset($_SESSION["errors"]);
}

$content = <<<CONTENT
	<center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
		<h1>LOGIN</h1>
		<p>Please fill up the form to login the account</p>
		<hr>
	</center>

	<form name="LoginForm" method="post" action="../php/functions/auth/login.php">
		<div class="field">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" placeholder="Enter Email" required>
		</div>
		<div class="field">
			<label for="pass">Password:</label>
			<input type="password" id="pass" name="pass" placeholder="Enter Password" required>
			<hr>
			<p>Don't have an account yet? <a href="user-registration">Register here</a>.</p>
			<div class="loginbtn">
				<button type="onsubmit" />
				<a href="index.php">LOGIN</a></button>
			</div>
	</form>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>