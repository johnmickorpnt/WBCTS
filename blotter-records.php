<?php
require("templates/template-functions.php");

require_once "php/config/Database.php";
require_once "php/models/Blotter.php";
$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);
$data = array();
$result = $blotter->read(null);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	array_push($data, $row);
}

$rows = "";
foreach ($data as $row) {
	$rows .= <<<ROW
		<tr>
			<td>{$row["complainant_id"]}</td>
			<td>{$row["respondent_name"]}</td>
			<td>{$row["incident_details"]}</td>
			<td>{$row["incident_type"]}</td>
			<td>{$row["blotter_status"]}</td>
			<td>{$row["remarks"]}</td>
			<td>
				<button>
					Set as Settled
				</button>
			</td>
		</tr>
	ROW;
}


$containerStyles = "margin-top: 12rem; padding:3rem";
$title = "Registration";
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
				<th>Complainant ID</th>
				<th>Respondent Name</th>
				<th>Incident Details</th>
				<th>Incident Type</th>
				<th>Status</th>
				<th>Remarks</th>
				<th>Action</th>
			</thead>
			<tbody>
				{$rows}
			</tbody>
		</table>
CONTENT;
?>
<?php include 'templates/default.php'; ?>