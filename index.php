<?php
require("templates/template-functions.php");


$title = "Blotter Website";
$content = <<<CONTENT
		<img src="{$img('bg.png')}" alt="Justice" style="width:100%;">
		<div style="position:absolute; top:50%; left:10%; color:white;">
			<h2>Blotter Website <br>Antipolo City</h2>
			<h3>If it matter, file a blotter </h3>
			<p>Browse any blotter records at the Records tab </p>
		</div>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
