<?php
session_start();

if (isset($_SESSION['email'])) {
	echo "Welcome bitch" . $_SESSION["user_id"];
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

	<link rel="stylesheet" href="css/style.css">
</head>


<body>
	<?php
	include("header.php");
	?>
	<div class="row">
		<div class="col-1">
			<img src="image/Justice.jpg" alt="Justice" style="width:100%;">
			<br><br><br>
			<h2>Blotter Website <br>Antipolo City</h2>
			<h3>If it matter, file a blotter </h3>
			<p>Browse any blotter records at the Records tab </p>
		</div>
	</div>
	<?php
	include("footer.php");
	?>
</body>

</html>