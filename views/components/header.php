<header>
	<a href="#" class="logo">
		<img src="<?= img("wbctsLogo.png")?>">
	</a>
	<input type="checkbox" id="menu-bar">
	<label for="menu-bar">Menu</label>
	<nav class="navbar">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="on-settlements.php">Settlements</a></li>
			<li><a href="blotter-records.php">Blotter Records</a>
				<ul>
					<li><a href="new-blotter.php">New Blotter</li></a>
					<li><a href="blotter-records.php">View Records</li></a>
				</ul>
			</li>
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
					<li><a href="auth/user-login.php">Login</a></li>
					<li><a href="auth/user-registration.php">Register</a></li>
				CONTENT;
			?>
		</ul>
	</nav>
</header>