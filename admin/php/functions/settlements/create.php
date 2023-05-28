<?php
session_start();
include("../../models/Settlements.php");
include("../../models/AuditTrail.php");
include("../../config/Database.php");


$database = new Database();
$db = $database->connect();

$valid = array();
$errors = array();
$result = array();

$id = null;
$blotter_id = null;
$resolution = null;
$settlement_details = null;
$settled_by = null;
$remarks = null;
$date_settled = null;
$updated_at = null;

// START OF VALIDATION BLOCK

// Validate and sanitize the input data
if (!isset($_POST['blotter_id'])) {
    $valid[0] = false;
    array_push($errors, "Blotter ID is empty. Please select a blotter.");
} else {
    $blotter_id = $_POST['blotter_id'];
    $valid[0] = true;
}

if (!isset($_POST['resolution'])) {
    $valid[1] = false;
    array_push($errors, "Resolution is empty. Please provide a resolution.");
} else {
    $resolution = $_POST['resolution'];
    $valid[1] = true;
}

if (!isset($_POST['settlement_details'])) {
    $valid[2] = false;
    array_push($errors, "Settlement details are empty. Please provide details.");
} else {
    $settlement_details = $_POST['settlement_details'];
    $valid[2] = true;
}

if (!isset($_POST['settled_by'])) {
    $valid[3] = false;
    array_push($errors, "Settled by is empty. Please provide the name.");
} else {
    $settled_by = $_POST['settled_by'];
    $valid[3] = true;
}

if (!isset($_POST['remarks'])) {
    $valid[4] = false;
    array_push($errors, "Remarks are empty. Please provide remarks.");
} else {
    $remarks = $_POST['remarks'];
    $valid[4] = true;
}

if (!isset($_POST['date_settled'])) {
    $valid[5] = false;
    array_push($errors, "Date settled is empty. Please provide the date.");
} else {
    $date_settled = $_POST['date_settled'];
    $valid[5] = true;
}

// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array("status" => 0, "errors" => $errors);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

// END OF VALIDATION BLOCK

// Create a new instance of the Settlements object
$settlements = new Settlements($db);

// Set the properties of the Settlements object
$settlements->setBlotter_id($blotter_id);
$settlements->setResolution($resolution);
$settlements->setSettlement_details($settlement_details);
$settlements->setSettled_by($settled_by);
$settlements->setRemarks($remarks);
$settlements->setDate_settled($date_settled);

// Create the settlement
$settlements->save();

$auditTrail = new AuditTrail($db);
$auditTrail->setUserId($_SESSION['user']['id']);
$auditTrail->setAction('Created a settlements record');
$auditTrail->setTimestamp(date('Y-m-d H:i:s'));
$auditTrail->save();

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
