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
if (isset($_GET["search"]))
	$audits = $auditTrail->search($_GET["search"], 0);
$searchTerm = isset($_GET["search"]) ? $_GET["search"] : "";

$auditsTbl = new Table($audits);
$auditsTbl->setTblName("users");
$auditsTbl->setHasActions(false);
$auditsTbl->setId("users_tbl");
$auditsTbl->setUpdateAction("php/functions/users/update.php");
$auditsTbl->setAddAction("php/functions/users/create.php");

$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest Actions</h4>
        <div class="row-actions">
			<form class="search-bar" method="GET" action="#">
				<input type="text" id="search-input" name="search" placeholder="Search..." value={$searchTerm}>
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</form>
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