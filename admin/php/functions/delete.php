<?php
session_start();

include("../config/Database.php");
include("../models/Settlements.php");
include("../models/Blotters.php");
include("../models/Admins.php");
include("../models/Residents.php");
include("../models/User.php");
include("../models/AuditTrail.php"); // Add the AuditTrail model

$database = new Database();
$db = $database->connect();

if (!isset($_POST["id"])) {
    echo "no id";
    exit;
}

if (!isset($_POST["table"])) {
    echo "no tbl";
    exit;
}

$tbl = $_POST["table"];
$id = $_POST["id"];
$obj;

if ($tbl == "blotter_records") $obj = new Blotters($db);
else if ($tbl == "admin_users") $obj = new Admins($db);
else if ($tbl == "residents") $obj = new Residents($db);
else if ($tbl == "settlements") $obj = new Settlements($db);
else if ($tbl == "users") $obj = new User($db);

if (!$obj->is_exists($id)) exit;

// Create an instance of the AuditTrail model
$auditTrail = new AuditTrail($db);

// Set the necessary information in the audit trail
$auditTrail->setUserId($_SESSION['user']['id']);
$auditTrail->setAction('Deleted a row from the ' . $tbl . ' table'); // Set the action performed
$auditTrail->setTimestamp(date('Y-m-d H:i:s')); // Set the timestamp

$auditTrail->save(); // Save the audit trail

$obj->delete($id);
echo json_encode(["msg" => "Row deleted"]);
