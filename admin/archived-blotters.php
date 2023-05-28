<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}

include("php/config/Database.php");
include("php/models/Blotters.php");
include("components/Table.php");
include("components/Modal.php");


$title = "Blotter Records - Admin";

$database = new Database();
$db = $database->connect();

$blotterObj = new Blotters($db);
$blotterObj->setColumns(["respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->getAllWhere(["is_archived" => 1]);

$blottersTable = new Table($blotters);
$blottersTable->setHasActions(false);
$blottersTable->setId("blotters_table");
$blottersTable->setTblName("blotter_records");
$blottersTable->setColumnType("1", "select");
$blottersTable->setColumnAttributes(1, "data-table='users'");
$blottersTable->setColumnAttributes("4", "style='display:none'");
$blottersTable->setColumnAttributes("5", "style='display:none'");
$blottersTable->setColumnAttributes("6", "style='display:none'");
$blottersTable->setColumnAttributes("8", "style='display:none'");
$blottersTable->setColumnAttributes("10", "style='display:none'");
$blottersTable->setColumnAttributes("11", "style='display:none'");
$blottersTable->setUpdateAction("php/functions/blotters/update.php");
$blottersTable->setAddAction("php/functions/blotters/create.php");
$blottersTable->setIsArchiveTable(true);

$newModal = new Modal("modal");
$newModal->setHeader("Blotter Records");
$newModal->setContent(<<<CONTENT
<form id="data-form"></form>
CONTENT);

// Add button and modal for new row
$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest Blotters</h4>
        <div class="row-actions">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search...">
                <button id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="table-action-btn add-button"style="margin-left:auto" data-table="blotters_table">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
        {$blottersTable->build_table()}
	</section>
	{$newModal->build_modal()}

CONTENT;
?>
<?php include 'templates/default.php'; ?>