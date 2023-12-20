<?php
require("templates/template-functions.php");
if (!isset($_SESSION["id"])) header("Location: auth/user-login");

require_once "php/config/Database.php";
require_once "php/models/Blotter.php";
$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);
$data = array();
$result = $blotter->readWithUser( $_SESSION["id"]);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	array_push($data, $row);
}

$rows = "";
foreach ($data as $row) {
	$rows .= <<<ROW
		<tr>
			<td>{$row["respondent_name"]}</td>
			<td>{$row["incident_type"]}</td>
			<td>
				<a href="{$row["qrcode"]}" target="_blank">
					View QR Code
				</a>
			</td>
			<td>{$row["created_at"]}</td>

		</tr>
	ROW;
}


$containerStyles = "margin-top: 3rem; padding:3rem; height:100%";
$title = "Your Submitted Blotter Records";
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
	<table class="table table-striped" style="width:100%">
			<thead>
				<th>Respondent Name</th>
				<th>Incident Type</th>
				<th>QR Code Image</th>
				<th>Date</th>
			</thead>
			<tbody>
				{$rows}
			</tbody>
		</table>
CONTENT;
?>
<?php include 'templates/default.php'; ?>