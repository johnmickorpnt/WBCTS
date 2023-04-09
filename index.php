<?php
session_start();

if (isset($_SESSION['email'])) {
	echo "Welcome bitch" . $_SESSION["email"];
} else {
	header("");
}


?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blotter Website</title>

	<link rel="stylesheet" href="css/style1.css">
</head>


<body>
	<header>
		<a href="#" class="logo"><img src="image/wbctsLogo.png"></a>
			<nav class="navbar">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Settlements</a></li>
					<li><a href="#">Blotter Records</a></li>
					<li><a href="#">QR Code Tracking</a></li>
					<li><a href="#">Profile</a>
						<ul>
							<li><a href="#">Personal Information</li></a>
							<li><a href="#">Log out</li></a>
						</ul>
					</li>
				</ul>

			</nav>
	</header>
</body>

</html>