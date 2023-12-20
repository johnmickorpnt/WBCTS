<?php
session_start();
include("../../models/Blotters.php");
include("../../models/InvestigatingOfficer.php");
include("../../models/AuditTrail.php");

include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$blotterRecordObj = new Blotters($db);
$officerObj = new InvestigatingOfficer($db);

$id = $_POST["id"];
$officer = $_POST["officer"];

// END OF VALIDATION BLOCK

$blotterRecord = new Blotters($db);
$blotterRecord->assignOfficer($id, $officer);

// Create the audit trail entry
$auditTrail = new AuditTrail($db);
$auditTrail->setUserId($_SESSION['user']['id']);
$auditTrail->setAction('Assigned an officer to a case');
$auditTrail->setCreated_at(date('Y-m-d H:i:s'));
$auditTrail->save();




$result = array(["status" => 1, "msg" => "Blotter record updated successfully"]);
echo json_encode($result, JSON_PRETTY_PRINT);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
