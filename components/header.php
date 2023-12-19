<header>
	<a href="#" class="logo">
		<img src="<?= img("sanroq.png")?>">
	</a>
	<input type="checkbox" id="menu-bar">
	<label for="menu-bar">Menu</label>
	<nav class="navbar">
		<ul>
			<li><a href="index">Home</a></li>
			<li><a href="on-settlements">Settlements</a></li>
			<li><a href="blotter-records">Blotter Records</a>
				<ul>
					<li><a href="javascript:void(0)" onclick="openNewBlotterDialog()">New Blotter</li></a>
					<li><a href="blotter-records">View Records</li></a>
				</ul>
			</li>
			<!-- <li><a href="qr-code">QR Code Tracking</a></li> -->
			<?php
			echo isset($_SESSION["id"]) ? <<<CONTENT
				<li><a href="blotter-records">Profile</a>
					<ul>
						<li><a href="php/functions/auth/logout">Logout</li></a>
					</ul>
				</li>
				CONTENT :
				<<<CONTENT
					<li><a href="auth/user-login">Login</a></li>
					<li><a href="auth/user-registration">Register</a></li>
				CONTENT;
			?>
		</ul>
	</nav>
</header>