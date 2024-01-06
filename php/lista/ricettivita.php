<?php
require_once("../connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$elementsPerPage = isset($_GET["elementsPerPage"]) ? $_GET["elementsPerPage"] : 10;

$tipologia = isset($_GET["tipologia"]) ? $_GET["tipologia"] : "";
if ($tipologia != "") {
    $type = " WHERE tipologia = '" . $tipologia . "'";
}
else {
    $type = "";
}

$sql = "SELECT * FROM ricettivita" . $type . " GROUP BY id_ricettivita ORDER BY id_ricettivita DESC LIMIT " . ($page - 1) * $elementsPerPage . ", " . $elementsPerPage;
$result = $conn->prepare($sql);
$result->execute();
$ricettivita = $result->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) as elementsCount, CEILING(COUNT(*) / " . ($elementsPerPage) . ") as totalPages FROM itinerari;";
$result = $conn->prepare($sql);
$result->execute();
$elementsCount = $result->fetch(PDO::FETCH_ASSOC);

$result = array();
$result["elementsCount"] = $elementsCount["elementsCount"];
$result["totalPages"] = $elementsCount["totalPages"];
$result["page"] = $page;
$result["elementsPerPage"] = $elementsPerPage;
$result["ricettivita"] = $ricettivita;

$json = json_encode($result);
echo $json;