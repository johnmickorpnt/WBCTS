<?php
include("php/config/Database.php");
include("components/Table.php");
include("components/Modal.php");

include("php/models/Admins.php");

$title = "Blotters - Admin Users";

$database = new Database();
$db = $database->connect();

$adminUserObj = new Admins($db);
$adminUsers = $adminUserObj->getAll();
$adminUsersTbl = new Table($adminUsers);
$adminUsersTbl->setTblName("admin_users");
$adminUsersTbl->setHasActions(true);
$adminUsersTbl->setColumnType(3, "select");
$adminUsersTbl->setColumnType(6, "datetime");
$adminUsersTbl->setColumnType(7, "datetime");
$adminUsersTbl->setColumnAttributes(3, "data-table='roles'");
$adminUsersTbl->setId("admins_tbl");
$adminUsersTbl->setUpdateAction("php/functions/admins/update.php");
$adminUsersTbl->setAddAction("php/functions/admins/create.php");

$newModal = new Modal("modal");
$newModal->setHeader("Admin User");
$newModal->setContent(<<<CONTENT
<form id="data-form"></form>
CONTENT);
$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest System Users</h4>
        <div class="row-actions">
			<div class="search-bar">
				<input type="text" id="search-input" placeholder="Search...">
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</div>
			<button class="table-action-btn add-button"style="margin-left:auto" data-table="admins_tbl">
				<i class="fa-solid fa-plus"></i> Add
			</button>
		</div>
		{$adminUsersTbl->build_table()}
	</section>
	{$newModal->build_modal()}
	
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