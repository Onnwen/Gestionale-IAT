<?php
require_once("../connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$elementsPerPage = isset($_GET["elementsPerPage"]) ? $_GET["elementsPerPage"] : 10;

$sql = "SELECT * FROM eventi GROUP BY id_evento ORDER BY id_evento DESC LIMIT " . ($page - 1) * $elementsPerPage . ", " . $elementsPerPage;
$result = $conn->prepare($sql);
$result->execute();
$events = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) as elementsCount, CEILING(COUNT(*) / " . ($elementsPerPage) . ") as totalPages FROM eventi;";
$result = $conn->prepare($sql);
$result->execute();
$elementsCount = $result->fetch(PDO::FETCH_ASSOC);

$result = array();
$result["elementsCount"] = $elementsCount["elementsCount"];
$result["totalPages"] = $elementsCount["totalPages"];
$result["page"] = $page;
$result["elementsPerPage"] = $elementsPerPage;
$result["events"] = $events;

$json = json_encode($result);
echo $json;