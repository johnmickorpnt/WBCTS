<?php
require("templates/template-functions.php");

require_once "php/config/Database.php";
require_once "php/models/Blotter.php";
$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);
$data = array();

$result = $blotter->read($_GET["id"]);
$row = $result->fetch(PDO::FETCH_ASSOC);
$containerStyles = "margin-top: 5rem; padding:3rem; height:100%; margin-bottom:5rem;";
$title = "View Blotter";
$errors = "";
$content = <<<CONTENT
	<table class="table table-striped" style=" width:50vw">
			<thead>
				<th>Blotter Information</th>
				<th>Details</th>
			</thead>
			<tbody>
				<tr>
                    <td>Blotter Number</td>
                    <td>{$row["id"]}</td>
                </tr>
                <tr>
                    <td>Respondent Name</td>
                    <td>{$row["respondent_name"]}</td>
                </tr>
                <tr>
                    <td>Respondent Address</td>
                    <td>{$row["respondent_address"]}</td>
                </tr>
                <tr>
                    <td>Incident Location</td>
                    <td>{$row["incident_location"]}</td>
                </tr>
                <tr>
                    <td>Statement</td>
                    <td>{$row["incident_details"]}</td>
                </tr>
                <tr>
                    <td>Investigating Officer</td>
                    <td>{$row["investigating_officer"]}</td>
                </tr>
			</tbody>
		</table>
CONTENT;
?>
<?php include 'templates/auth.php'; ?>