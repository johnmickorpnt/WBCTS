<?php
include("../config/Database.php");
include("../models/Settlements.php");
include("../models/Blotters.php");
include("../models/Admins.php");
include("../models/Residents.php");
include("../models/User.php");



$database = new Database();
$db = $database->connect();

if(!isset($_POST["id"])){
    echo "no id";
    exit;
}

if(!isset($_POST["table"])){
    echo "no tbl";
    exit;
}

$tbl = $_POST["table"];
$id = $_POST["id"];
$obj;

if($tbl == "blotter_records") $obj = new Blotters($db);
else if($tbl == "admin_users") $obj = new Admins($db);
else if($tbl == "residents") $obj = new Residents($db);
else if($tbl == "settlements") $obj = new Settlements($db);
else if($tbl == "users") $obj = new User($db);


if(!$obj->is_exists($id)) exit;

$obj->delete($id);
echo json_encode(["msg"=>"Row deleted"]);
?>