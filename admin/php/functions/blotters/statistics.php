<?php
session_start();
include("../../models/Blotters.php");
include("../../models/Residents.php");
include("../../models/AuditTrail.php");

include("../../config/Database.php");

$database = new Database();
$db = $database->connect();

$blotterRecordObj = new Blotters($db);

$num_interval = isset($_POST["num_interval"]) ? $_POST["num_interval"] : null;
$interval_indicator = isset($_POST["interval_indicator"]) ? $_POST["interval_indicator"] : null;


$data = $blotterRecordObj->blotter_statistics($num_interval,$interval_indicator);

echo json_encode($data);
