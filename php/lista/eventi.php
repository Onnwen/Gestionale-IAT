<?php
require_once("../connection.php");

header("Content-Type: application/json; charset=UTF-8");

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$elementsPerPage = isset($_GET["elementsPerPage"]) ? $_GET["elementsPerPage"] : 10;

$sql = "SELECT * FROM eventi GROUP BY id_evento ORDER BY id_evento ASC LIMIT " . ($page - 1) * $elementsPerPage . ", " . $elementsPerPage;
$result = $conn->prepare($sql);
$result->execute();
$events = $result->get_result()->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT COUNT(*) as elementsCount, CEILING(COUNT(*) / " . ($elementsPerPage) . ") as totalPages FROM eventi;";
$result = $conn->prepare($sql);
$result->execute();
$elementsCount = $result->get_result()->fetch_all(MYSQLI_ASSOC);

$result = array();
$result["elementsCount"] = $elementsCount[0]["elementsCount"];
$result["totalPages"] = $elementsCount[0]["totalPages"];
$result["page"] = $page;
$result["elementsPerPage"] = $elementsPerPage;
$result["events"] = $events;

$json = json_encode($result);
echo $json;