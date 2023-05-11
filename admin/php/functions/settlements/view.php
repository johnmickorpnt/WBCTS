<?php
include("../../config/Database.php");
include("../../models/Settlements.php");

$database = new Database();
$db = $database->connect();

$settlement = new Settlements($db);


?>