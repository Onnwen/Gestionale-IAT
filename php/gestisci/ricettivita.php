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

    $sql = "SELECT * FROM ricettivita WHERE id_ricettivita = " . $id . ";";
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

    $sql = "UPDATE ricettivita SET ";
    $sql .= "nome = :nome, ";
    $sql .= "url_immagine = :url_immagine, ";
    $sql .= "descrizione = :descrizione, ";
    $sql .= "tipologia = :tipologia, ";
    $sql .= "localita = :localita, ";
    $sql .= "longitudine = :longitudine, ";
    $sql .= "latitudine = :latitudine, ";
    $sql .= "telefono = :telefono ";
    $sql .= "WHERE id_ricettivita = " . $id . ";";

    parse_str(file_get_contents("php://input"),$post_vars);

    $nome = $post_vars["nome"] ?? "";
    $url_immagine = $post_vars["url_immagine"] ?? "";
    $descrizione = $post_vars["descrizione"] ?? "";
    $tipologia = $post_vars["tipologia"] ?? "";
    $localita = $post_vars["localita"] ?? "";
    $longitudine = $post_vars["longitudine"] ?? "0";
    $latitudine = $post_vars["latitudine"] ?? "0";
    $telefono = $post_vars["telefono"] ?? "";

    $result = $conn->prepare($sql);

    $result->bindParam(':nome', $nome);
    $result->bindParam(':url_immagine', $url_immagine);
    $result->bindParam(':descrizione', $descrizione);
    $result->bindParam(':tipologia', $tipologia);
    $result->bindParam(':localita', $localita);
    $result->bindParam(':longitudine', $longitudine);
    $result->bindParam(':latitudine', $latitudine);
    $result->bindParam(':telefono', $telefono);

    try {
        $result->execute();
        echo "ok";
        http_response_code(200);
    }
    catch (PDOException $e) {
        echo "error";
        http_response_code(400);
        die();
    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET["id"] ?? -1;

    if ($id == -1) {
        http_response_code(400);
        die();
    }

    $sql = "DELETE FROM ricettivita WHERE id_ricettivita = " . $id . ";";
    $result = $conn->prepare($sql);

    try {
        $result->execute();
    }
    catch (PDOException $e) {
        echo "error: " . $e->getMessage();
        http_response_code(500);
        die();
    }

    http_response_code(200);
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO ricettivita (nome, url_immagine, descrizione, tipologia, localita, longitudine, latitudine, telefono) VALUES (:nome, :url_immagine, :descrizione, :tipologia, :localita, :longitudine, :latitudine, :telefono);";

    parse_str(file_get_contents("php://input"),$post_vars);

    $nome = $post_vars["nome"] ?? "";
    $url_immagine = $post_vars["url_immagine"] ?? "";
    $descrizione = $post_vars["descrizione"] ?? "";
    $tipologia = $post_vars["tipologia"] ?? "";
    $localita = $post_vars["localita"] ?? "";
    $longitudine = $post_vars["longitudine"] ?? "0";
    $latitudine = $post_vars["latitudine"] ?? "0";
    $telefono = $post_vars["telefono"] ?? "";

    $result = $conn->prepare($sql);

    $result->bindParam(':nome', $nome);
    $result->bindParam(':url_immagine', $url_immagine);
    $result->bindParam(':descrizione', $descrizione);
    $result->bindParam(':tipologia', $tipologia);
    $result->bindParam(':localita', $localita);
    $result->bindParam(':longitudine', $longitudine);
    $result->bindParam(':latitudine', $latitudine);
    $result->bindParam(':telefono', $telefono);

    try {
        $result->execute();
    }
    catch (PDOException $e) {
        echo "error: " . $e->getMessage();
        http_response_code(400);
        die();
    }

    http_response_code(200);
}
else {
    http_response_code(405);
    die();
}
