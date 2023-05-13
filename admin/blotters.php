<?php
include("php/config/Database.php");
include("php/models/Blotters.php");
include("components/Table.php");

$title = "Blotter Records - Admin";

$database = new Database();
$db = $database->connect();

$blotterObj = new Blotters($db);
$blotterObj->setColumns(["respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->read();

$blottersTable = new Table($blotters);

// Add button and modal for new row
$content = <<<CONTENT
    <button>
        Add new
    </button>
	<section class="dashboard-section">
		<h4>Latest Blotters</h4>
        {$blottersTable->build_table()}
	</section>
CONTENT;
?>
<?php include 'templates/default.php'; ?>