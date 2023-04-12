<?php
session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blotter Website | Records</title>

	<link rel="stylesheet" href="css/style.css">
</head>


<body>
	<?php
	include("header.php");
	?>

	<main style="margin-top: 12rem; padding:3rem">
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
				<?php
				foreach ($data as $row) {
					echo <<<ROW
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
				?>
			</tbody>
		</table>
	</main>

	<?php
	include("footer.php");
	?>
</body>

</html>