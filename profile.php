<?php
require("templates/template-functions.php");

require_once "php/config/Database.php";
require_once "php/models/User.php";
$database = new Database();
$db = $database->connect();

$user = new User($db);

$title = "Your Profile";

$data = array();
$result = $user->read($_SESSION["id"]);
$row = $result->fetch(PDO::FETCH_ASSOC);

$containerStyles = "margin-top: 5rem; padding:3rem; height:100%; margin-bottom:5rem";
$content = <<<CONTENT
<table class="table table-striped" style="width:100%">
	<thead>
		<th>Your Information</th>
		<th>Details</th>
	</thead>
	<tbody>
		<tr>
			<td>First Name</td>
			<td>{$row["firstname"]}</td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td>{$row["lastname"]}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{$row["email"]}</td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td>{$row["contact_number"]}</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>{$row["address"]}</td>
		</tr>
	</tbody>
</table>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
