<?php
require_once("../connection.php");

header("Content-Type: application/json; charset=UTF-8");

$id = isset($_GET["id"]) ? $_GET["id"] : -1;

if ($id == -1) {
    http_response_code(400);
    die();
}

$sql = "SELECT * FROM eventi WHERE id_evento = " . $id . ";";
$result = $conn->prepare($sql);
$result->execute();
$event = $result->get_result()->fetch_all(MYSQLI_ASSOC);
$json = json_encode($event[0]);

echo $json;