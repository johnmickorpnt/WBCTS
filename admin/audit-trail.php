<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}

include("php/config/Database.php");
include("components/Table.php");
include("components/Modal.php");

include("php/models/Admins.php");
include("php/models/User.php");
include("php/models/AuditTrail.php");


$title = "Blotters - Residents";

$database = new Database();
$db = $database->connect();

$auditTrail = new AuditTrail($db);
$audits = $auditTrail->getAll();
$auditsTbl = new Table($audits);
$auditsTbl->setTblName("users");
$auditsTbl->setHasActions(false);
$auditsTbl->setId("users_tbl");
$auditsTbl->setUpdateAction("php/functions/users/update.php");
$auditsTbl->setAddAction("php/functions/users/create.php");

$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest User</h4>
        <div class="row-actions">
			<div class="search-bar">
				<input type="text" id="search-input" placeholder="Search...">
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</div>
			<button class="table-action-btn add-button"style="margin-left:auto" data-table="users_tbl">
				<i class="fa-solid fa-plus"></i> Add
			</button>
		</div>
		{$auditsTbl->build_table()}
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