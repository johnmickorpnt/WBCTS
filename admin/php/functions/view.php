<?php
include("../config/Database.php");
include("../models/Settlements.php");
include("../models/Blotters.php");
include("../models/Admins.php");
include("../models/Residents.php");
include("../models/Roles.php");


header('Content-Type: application/json');


$database = new Database();
$db = $database->connect();


if (!isset($_POST["table"])) {
    echo "no tbl";
    exit;
}

$tbl = $_POST["table"];
$obj;


// If table exists and id doesn't, return all rows
if (isset($_POST["table"]) && !isset($_POST["id"])) {
    if ($tbl == "blotters") $obj = new Blotters($db);

    else if ($tbl == "admins") $obj = new Admins($db);

    else if ($tbl == "residents") $obj = new Residents($db);

    else if ($tbl == "settlements") $obj = new Settlements($db);

    else if ($tbl == "roles") $obj = new Roles($db);

    echo json_encode($obj->getAll(), JSON_PRETTY_PRINT);

    exit;
}

$id = $_POST["id"];

if ($tbl == "blotters") $obj = new Blotters($db);

else if ($tbl == "admins") $obj = new Admins($db);

else if ($tbl == "residents") $obj = new Residents($db);

else if ($tbl == "settlements") $obj = new Settlements($db);

else {
    echo "invalid table";
    exit;
}

if (!$obj->is_exists($id)) {
    echo "record does not exist";
    exit;
}

$data = $obj->getById($id);
echo json_encode($data);
