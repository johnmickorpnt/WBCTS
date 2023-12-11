<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if($_SESSION["role"] == "2") header("Location: access-denied");

if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}

include("php/config/Database.php");
include("components/Table.php");
include("components/Modal.php");

include("php/models/Admins.php");

$title = "Blotters - Admin Users";

$database = new Database();
$db = $database->connect();

$adminUserObj = new Admins($db);

$adminUsers = $adminUserObj->getAll();
if (isset($_GET["search"]))
	$adminUsers = $adminUserObj->search($_GET["search"], 0);
$searchTerm = isset($_GET["search"]) ? $_GET["search"] : "";

$adminUsersTbl = new Table($adminUsers);
$adminUsersTbl->setTblName("admin_users");
$adminUsersTbl->setHasActions(false);
$adminUsersTbl->setColumnType(3, "select");
$adminUsersTbl->setColumnType(6, "datetime");
$adminUsersTbl->setColumnType(7, "datetime");
$adminUsersTbl->setColumnAttributes("6", "style='display:none'");
$adminUsersTbl->setColumnAttributes("7", "style='display:none'");
$adminUsersTbl->setIsArchiveTable(true);

$searchTerm = isset($_GET["search"]) ? $_GET["search"] : "";

$adminUsersTbl->setColumnAttributes(3, "data-table='roles'");
$adminUsersTbl->setId("admins_tbl");
$adminUsersTbl->setUpdateAction("php/functions/admins/update.php");
$adminUsersTbl->setAddAction("php/functions/admins/create.php");
$adminUsersTbl->setIsArchiveTable(false);

$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest System Users</h4>
        <div class="row-actions">
			<form class="search-bar" method="GET" action="#">
				<input type="text" id="search-input" name="search" placeholder="Search..." value={$searchTerm}>
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</form>
			<a href="auth/register" class="table-action-btn add-button"style="margin-left:auto; text-decoration:none"">
				<i class="fa-solid fa-plus"></i> Add
			</a>
		</div>
		{$adminUsersTbl->build_table()}
	</section>
CONTENT;
?>

<!-- <div id="modal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<h3>Modal Title</h3>
		<form id="data-form">
		</form>
	</div>
</div> -->
<?php include 'templates/default.php'; ?>