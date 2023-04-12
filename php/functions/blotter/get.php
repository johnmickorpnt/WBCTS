<?php

require_once "../../config/Database.php";
require_once "../../models/Blotter.php";

$database = new Database();
$db = $database->connect();

$blotter = new Blotter($db);
$data = array();
$result = $blotter->read(null);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
    array_push($data, $row);
}

echo (["data" => $data, "count" => $result->rowCount()]);
