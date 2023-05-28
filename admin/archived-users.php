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


$title = "Blotters - Residents";

$database = new Database();
$db = $database->connect();

$userObj = new User($db);
$users = $userObj->getAllWhere(["is_archived" => 1]);
$userTbl = new Table($users);
$userTbl->setTblName("users");
$userTbl->setHasActions(true);
$userTbl->setColumnAttributes("5", "style='display:none'");
$userTbl->setColumnAttributes("6", "style='display:none'");
$userTbl->setColumnAttributes("7", "style='display:none'");
$userTbl->setColumnAttributes("8", "style='display:none'");
$userTbl->setColumnAttributes("9", "style='display:none'");
$userTbl->setIsArchiveTable(true);

$userTbl->setId("users_tbl");
$userTbl->setUpdateAction("php/functions/users/update.php");
$userTbl->setAddAction("php/functions/users/create.php");

$newModal = new Modal("modal");
$newModal->setHeader("Admin User");
$newModal->setContent(<<<CONTENT
<form id="data-form"></form>
CONTENT);
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
		{$userTbl->build_table()}
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