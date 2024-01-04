<?php
require_once("../connection.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET["id"]) ? $_GET["id"] : -1;

    if ($id == -1) {
        http_response_code(400);
        die();
    }

    $sql = "SELECT * FROM eventi WHERE id_evento = " . $id . ";";
    $result = $conn->prepare($sql);
    $result->execute();
    $event = $result->fetch(PDO::FETCH_ASSOC);
    $json = json_encode($event);

    echo $json;
}
else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = isset($_GET["id"]) ? $_GET["id"] : -1;

    if ($id == -1) {
        http_response_code(400);
        die();
    }

    $sql = "UPDATE eventi SET ";
    $sql .= "nome = :nome, ";
    $sql .= "url_immagine = :url_immagine, ";
    $sql .= "data_inizio = :data_inizio, ";
    $sql .= "data_fine = :data_fine, ";
    $sql .= "descrizione = :descrizione, ";
    $sql .= "tipologie = :tipologie, ";
    $sql .= "localita = :localita, ";
    $sql .= "telefono = :telefono, ";
    $sql .= "longitudine = :longitudine, ";
    $sql .= "latitudine = :latitudine ";
    $sql .= "WHERE id_evento = " . $id . ";";

    $nome = $_POST["nome"] ?? "";
    $url_immagine = $_POST["url_immagine"] ?? "";
    $data_inizio = $_POST["data_inizio"] ?? "";
    $data_inizio = date("Y-m-d", strtotime($data_inizio));
    $data_fine = $_POST["data_fine"] ?? "";
    $data_fine = date("Y-m-d", strtotime($data_fine));
    $descrizione = $_POST["descrizione"] ?? "";
    $tipologie = $_POST["tipologie"] ?? "";
    $localita = $_POST["localita"] ?? "";
    $longitudine = $_POST["longitudine"] ?? "0";
    $latitudine = $_POST["latitudine"] ?? "0";
    $telefono = $_POST["telefono"] ?? "0";

    $result->bindParam(':nome', $nome);
    $result->bindParam(':url_immagine', $url_immagine);
    $result->bindParam(':data_inizio', $data_inizio);
    $result->bindParam(':data_fine', $data_fine);
    $result->bindParam(':descrizione', $descrizione);
    $result->bindParam(':tipologie', $tipologie);
    $result->bindParam(':localita', $localita);
    $result->bindParam(':longitudine', $longitudine);
    $result->bindParam(':latitudine', $latitudine);
    $result->bindParam(':telefono', $telefono);

    $result->execute();

    http_response_code(200);
}
else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET["id"] ?? -1;

    if ($id == -1) {
        http_response_code(400);
        die();
    }

    $sql = "DELETE FROM eventi WHERE id_evento = " . $id . ";";
    $result = $conn->prepare($sql);
    $result->execute();

    http_response_code(200);
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET["id"]) ? $_GET["id"] : -1;

    $sql = "INSERT INTO eventi (nome, url_immagine, data_inizio, data_fine, descrizione, tipologie, telefono, localita, longitudine, latitudine) VALUES (";
    $sql .= ":nome, ";
    $sql .= ":url_immagine, ";
    $sql .= ":data_inizio, ";
    $sql .= ":data_fine, ";
    $sql .= ":descrizione, ";
    $sql .= ":tipologie,";
    $sql .= ":telefono, ";
    $sql .= ":localita, ";
    $sql .= ":longitudine, ";
    $sql .= ":latitudine);";

    $result = $conn->prepare($sql);

    $nome = $_POST["nome"] ?? "";
    $url_immagine = $_POST["url_immagine"] ?? "";
    $data_inizio = $_POST["data_inizio"] ?? "";
    $data_inizio = date("Y-m-d", strtotime($data_inizio));
    $data_fine = $_POST["data_fine"] ?? "";
    $data_fine = date("Y-m-d", strtotime($data_fine));
    $descrizione = $_POST["descrizione"] ?? "";
    $tipologie = $_POST["tipologie"] ?? "";
    $localita = $_POST["localita"] ?? "";
    $longitudine = $_POST["longitudine"] ?? "0";
    $latitudine = $_POST["latitudine"] ?? "0";
    $telefono = $_POST["telefono"] ?? "0";

    $result->bindParam(':nome', $nome);
    $result->bindParam(':url_immagine', $url_immagine);
    $result->bindParam(':data_inizio', $data_inizio);
    $result->bindParam(':data_fine', $data_fine);
    $result->bindParam(':descrizione', $descrizione);
    $result->bindParam(':tipologie', $tipologie);
    $result->bindParam(':localita', $localita);
    $result->bindParam(':longitudine', $longitudine);
    $result->bindParam(':latitudine', $latitudine);
    $result->bindParam(':telefono', $telefono);

    $result->execute();

    http_response_code(200);
}
else {
    http_response_code(405);
    die();
}
