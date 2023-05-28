<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}


include("php/config/Database.php");
include("php/models/Settlements.php");
include("components/Table.php");
include("components/Modal.php");


$title = "Blotter Records - Admin";

$database = new Database();
$db = $database->connect();

$settlementsObj = new Settlements($db);
$blotters = $settlementsObj->getAll();

$settlementsTable = new Table($blotters);
$settlementsTable->setHasActions(true);
$settlementsTable->setId("settlements_table");
$settlementsTable->setTblName("settlements");
$settlementsTable->setColumnType("5", "textarea");
$settlementsTable->setColumnAttributes("5", "style='display:none'");
$settlementsTable->setColumnAttributes("8", "style='display:none'");
$settlementsTable->setColumnType("6", "datetime");
$settlementsTable->setColumnType("7", "datetime");
$settlementsTable->setColumnAttributes("10", "style='display:none'");
$settlementsTable->setColumnAttributes("11", "style='display:none'");
$settlementsTable->setUpdateAction("php/functions/settlements/update.php");
$settlementsTable->setAddAction("php/functions/settlements/create.php");

$settlementsTable->setColumnType(1, "select");
$settlementsTable->setColumnAttributes(1, "data-table='blotters'");


$newModal = new Modal("modal");
$newModal->setHeader("Settlements");
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
            <button class="table-action-btn add-button"style="margin-left:auto" data-table="settlements_table">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
        {$settlementsTable->build_table()}
	</section>
	{$newModal->build_modal()}

CONTENT;
?>
<?php include 'templates/default.php'; ?>