<?php
session_start();
include("../../models/BlotterRecord.php");
include("../../models/User.php");
include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$blotterRecordObj = new Blotter($db);
$userObj = new Residents($db);

$valid = array();
$errors = array();
$result = array();

$complaint_id = null;
$respondent_name = null;
$respondent_address = null;
$incident_location = null;
$incident_details = null;
$incident_type = null;
$blotter_status = null;
$investigating_officer = null;
$remarks = null;

// START OF VALIDATION BLOCK
if (!isset($_POST['complaint_id'])) {
    $valid[0] = false;
    array_push($errors, "Complaint ID is empty. Please select a complaint.");
} else {
    $valid[0] = true;
    $complaint_id = $_POST['complaint_id'];
}

if (!isset($_POST['respondent_name'])) {
    $valid[1] = false;
    array_push($errors, "Respondent Name is empty. Please provide a name.");
} else {
    $respondent_name = $_POST['respondent_name'];
    $valid[1] = true;
}

if (!isset($_POST['respondent_address'])) {
    $valid[2] = false;
    array_push($errors, "Respondent Address is empty. Please provide an address.");
} else {
    $respondent_address = $_POST['respondent_address'];
    $valid[2] = true;
}

if (!isset($_POST['incident_location'])) {
    $valid[3] = false;
    array_push($errors, "Incident Location is empty. Please provide a location.");
} else {
    $incident_location = $_POST['incident_location'];
    $valid[3] = true;
}

if (!isset($_POST['incident_details'])) {
    $valid[4] = false;
    array_push($errors, "Incident Details are empty. Please provide details.");
} else {
    $incident_details = $_POST['incident_details'];
    $valid[4] = true;
}

if (!isset($_POST['incident_type'])) {
    $valid[5] = false;
    array_push($errors, "Incident Type is empty. Please select a type.");
} else {
    $incident_type = $_POST['incident_type'];
    $valid[5] = true;
}

if (!isset($_POST['blotter_status'])) {
    $valid[6] = false;
    array_push($errors, "Blotter Status is empty. Please select a status.");
} else {
    $blotter_status = $_POST['blotter_status'];
    $valid[6] = true;
}

if (!isset($_POST['investigating_officer'])) {
    $valid[7] = false;
    array_push($errors, "Investigating Officer is empty. Please provide an officer.");
} else {
    $investigating_officer = $_POST['investigating_officer'];
    $valid[7] = true;
}

if (!isset($_POST['remarks'])) {
    $valid[8] = false;
    array_push($errors, "Remarks are empty. Please provide remarks.");
} else {
    $remarks = $_POST['remarks'];
    $valid[8] = true;
}

if (!$userObj->get($_POST['complaint_id'])) {
    array_push($errors, "Selected User does not exist. Please reload the page and try again.");
    $valid[9] = false;
} else $valid[9] = true;

// EXIT OUT OF SCRIPT IF THERE ARE VALIDATION ERRORS
if (in_array(false, $valid)) {
    $result = array(["status" => 0, "errors" => $errors]);
    echo json_encode($result, JSON_PRETTY_PRINT);
    exit;
}

// END OF VALIDATION BLOCK

$blotterRecord = new Blotters($db);
$blotterRecord->setComplaint_id($complaint_id);
$blotterRecord->setRespondent_name($respondent_name);
$blotterRecord->setRespondent_address($respondent_address);
$blotterRecord->setIncident_location($incident_location);
$blotterRecord->setIncident_details($incident_details);
$blotterRecord->setIncident_type($incident_type);
$blotterRecord->setBlotter_status($blotter_status);
$blotterRecord->setInvestigating_officer($investigating_officer);
$blotterRecord->setRemarks($remarks);

$saveResult = $blotterRecord->save();

$result = array(["status" => 1, "msg" => "Blotter record updated successfully"]);
// echo json_encode($result, JSON_PRETTY_PRINT);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
