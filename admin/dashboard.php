<?php
include("php/config/Database.php");
include("php/models/Settlements.php");
include("php/models/Blotters.php");
include("components/Table.php");

$title = "Blotter Dashboard";

$database = new Database();
$db = $database->connect();

$settlement = new Settlements($db);
$settlements = $settlement->read();

$blotterObj = new Blotters($db);
$blotterObj->setColumns(["respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->read();


$settlementTable = new Table($settlements);
$blottersTable = new Table($blotters);

$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest Settlements</h4>
		{$settlementTable->build_table()}
	</section>
	<section class="dashboard-section">
		<h4>Latest Blotters</h4>
		{$blottersTable->build_table()}
	</section>
	<section class="dashboard-section">
		<h4>Latest Blotters</h4>
		{$settlementTable->build_table()}
	</section>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
