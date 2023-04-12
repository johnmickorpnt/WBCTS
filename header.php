<html>

<head>
	<link rel="stylesheet" href="css/style1.css">
</head>

<body>
	<header>
		<a href="#" class="logo"><img src="image/wbctsLogo.png"></a>
		<input type="checkbox" id="menu-bar">
		<label for="menu-bar">Menu</label>
		<nav class="navbar">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="OnSettlements.php">Settlements</a></li>
				<li><a href="blotter-records.php">Blotter Records</a>
					<ul>
						<li><a href="new-blotter.php">New Blotter</li></a>
						<li><a href="blotter-records.php">View Records</li></a>
					</ul>
				</li>
				<!-- <li><a href="blotter-records.php">Blotter Records</a></li> -->
				<li><a href="qr-code.php">QR Code Tracking</a></li>
				<?php
				echo isset($_SESSION["id"]) ? <<<CONTENT
				<li><a href="blotter-records.php">Profile</a>
					<ul>
						<li><a href="php/functions/auth/logout.php">Logout</li></a>
					</ul>
				</li>
				CONTENT : 
				<<<CONTENT
					<li><a href="login.php">Login</a></li>
					<li><a href="registration.php">Register</a></li>
				CONTENT;
				?>
				

				<!-- <li><a href="profile.php">Profile</a>
						<ul>
							<li><a href="#">Personal Information</li></a>
							<li><a href="logout.php">Log out</li></a>
						</ul>
					</li> -->
			</ul>
		</nav>
	</header>
</body>

</html>