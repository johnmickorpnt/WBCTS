<?php
include("php/config/Database.php");
include("php/models/Admins.php");
include("components/Table.php");

$title = "Blotter - Admin Users";

$database = new Database();
$db = $database->connect();

$usersObj = new Admins($db);

// Evaluate if the current user's role
$users = $usersObj->read();

$usersTable = new Table($users);

// Add a button for new admin user and for staff user
$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Current Users</h4>
		{$usersTable->build_table()}
	</section>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
