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
include("php/models/User.php");


$title = "Blotters - Residents";

$database = new Database();
$db = $database->connect();

$userObj = new User($db);
$users = $userObj->getAllWhere(["is_archived" => 0]);

if (isset($_GET["search"]))
    $blotters = $blotterObj->search($_GET["search"], 0);
$searchTerm = isset($_GET["search"]) ? $_GET["search"] : "";

$userTbl = new Table($users);
$userTbl->setTblName("users");
$userTbl->setHasActions(true);
$userTbl->setColumnAttributes("5", "style='display:none'");
$userTbl->setColumnAttributes("6", "style='display:none'");
$userTbl->setColumnAttributes("7", "style='display:none'");
$userTbl->setColumnAttributes("8", "style='display:none'");
$userTbl->setColumnAttributes("9", "style='display:none'");

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
			<form class="search-bar" method="GET" action="#">
				<input type="text" id="search-input" name="search" placeholder="Search..." value={$searchTerm}>
				<button id="search-button">
					<i class="fas fa-search"></i>
				</button>
			</form>
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