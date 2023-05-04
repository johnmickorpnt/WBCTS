<?php
require("templates/template-functions.php");


$title = "Blotter Website";
$content = <<<CONTENT
	<div class="row">
		<div class="col-1">
			<img src="{$img('Justice.jpg')}" alt="Justice" style="width:100%;">
			<br><br><br>
			<h2>Blotter Website <br>Antipolo City</h2>
			<h3>If it matter, file a blotter </h3>
			<p>Browse any blotter records at the Records tab </p>
		</div>
	</div>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
