<?php
session_start();

if ($_SESSION['email']) {
	echo "Welcome bitch" . $_SESSION["email"];
}else{
	header("");
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blotter Website</title>
</head>
<body>
	<h1>Sample Page</h1>
		<a href="logout.php">LOGOUT</a> 

		<p>Hello User, please give me money</p>
</body>
</html>