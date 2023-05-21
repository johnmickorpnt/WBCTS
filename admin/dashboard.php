<?php
include("php/config/Database.php");
include("php/models/Settlements.php");
include("php/models/Blotters.php");
include("components/Table.php");

$title = "Blotter Dashboard";

$database = new Database();
$db = $database->connect();

$settlement = new Settlements($db);
$settlements = $settlement->getAll();

$blotterObj = new Blotters($db);
$blotterObj->setColumns(["id", "respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->getAll();

$settlementTable = new Table($settlements);
$blottersTable = new Table($blotters);

$settlementTable->setHasActions(false);
$blottersTable->setHasActions(false);

$settlementTable->setTblName("settlements");
$blottersTable->setTblName("blotters");
$blottersTable->setColumnAttributes("5", "style='display:none'");
$blottersTable->setColumnAttributes("8", "style='display:none'");
$blottersTable->setColumnAttributes("10", "style='display:none'");
$blottersTable->setColumnAttributes("11", "style='display:none'");

$content = <<<CONTENT
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
