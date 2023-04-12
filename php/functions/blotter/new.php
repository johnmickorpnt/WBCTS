<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/Blotter.php";

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);

$_SESSION["msg"] = array();

$complainant_id = $_POST['complainant_id'] ?? "";
$respondent_name = $_POST['respondent_name'] ?? "";
$respondent_address = $_POST['respondent_address'] ?? "";
$incident_location = $_POST['incident_location'] ?? "";
$incident_details = $_POST['incident_details'] ?? "";
$incident_type = $_POST['incident_type'] ?? "";
$remarks = $_POST['remarks'] ?? "";

if (empty($complainant_id)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Please login first before filing a blotter.");
} else $valid[0] = true;

if (empty($respondent_name)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "The respondent's name is required");
} else $valid[1] = true;

if (empty($respondent_address)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Respondent Address is missing");
} else $valid[2] = true;

if (empty($incident_location)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Incident Location Missing");
} else $valid[3] = true;

if (empty($incident_details)) {
    array_push($_SESSION["errors"], "Incident details missing");
    $valid[4] = false;
} else $valid[4] = true;

if (empty($incident_type)) {
    $valid[5] = false;
    array_push($_SESSION["errors"], "Incident type missing");
} else $valid[5] = true;

if (empty($remarks)) {
    $valid[6] = false;
    array_push($_SESSION["errors"], "Remarks is missing.");
} else $valid[6] = true;


if (in_array(false, $valid)) {
    http_response_code(422);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$blotter->setComplainant_id($complainant_id);
$blotter->setRespondent_name($respondent_name);
$blotter->setRespondent_address($respondent_address);
$blotter->setIncident_location($incident_location);
$blotter->setIncident_details($incident_details);
$blotter->setIncident_type($incident_type);
$blotter->setRemarks($remarks);

$result = $blotter->save();

if ($result) {
    http_response_code(200);
    header('Location: ' . '../../../blotter-records.php');
    exit();
}
