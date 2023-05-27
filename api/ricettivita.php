<?php

require_once("utils/validation.php");
require_once("utils/restful.php");

# TODO: Aggiungere file di autenticazione/autorizzazione

function handle_post($conn)
{
    $name        = get_value_from_request_body("nome");
    $location    = get_value_from_request_body("localita");
    $longitude   = get_value_from_request_body("longitudine");
    $latitude    = get_value_from_request_body("latitudine");
    $type        = get_value_from_request_body("tipologia");

    if (any_are_null(
        $name,
        $location,
        $longitude,
        $latitude,
        $type
    )) {
        return_error(400, "Missing required data in the request body");
    }

    $createReceptivityQuery = "INSERT INTO ricettivita(
        nome,
        localita,
        longitudine,
        latitudine,
        tipologia
    )   VALUES (
        :name,
        :location,
        :longitude,
        :latitude,
        :type
    )";

    $response = $conn->prepare($createReceptivityQuery);

    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while inserting the new receptivity");
    }
}

function handle_get($conn)
{
    $id = get_value_from_query_string("id");

    $toReturn = null;

    # FIXME: Non mi piace moltissimo mischiare la validazione con i percorsi validi
    if (is_null($id)) {
        $toReturn = get_all_receptivities($conn);
    } else if (filter_int($id)) {
        return_error(400, "Provided id was not an integer");
    } else {
        $toReturn = get_single_receptivity($conn, $id);
    }

    return_json($toReturn);
}

function handle_put($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $old_receptivity = get_single_receptivity($conn, $id);

    if (empty($old_receptivity)) {
        return_error(400, "The provided id does not match any receptivity");
    }

    # Prendi i valori da modificare dal body; i valori non presenti nel body restano uguali a prima
    $name        = get_value_from_request_body("nome",          $old_receptivity[0]["nome"]);
    $location    = get_value_from_request_body("localita",      $old_receptivity[0]["localita"]);
    $longitude   = get_value_from_request_body("longitudine",   $old_receptivity[0]["longitudine"]);
    $latitude    = get_value_from_request_body("latitudine",    $old_receptivity[0]["latitudine"]);
    $type        = get_value_from_request_body("tipologia",     $old_receptivity[0]["tipologia"]);

    $updatereceptivityQuery =
        "UPDATE ricettivita
    SET
        nome = :name,
        localita = :location,
        longitudine = :longitude,
        latitudine = :latitude,
        tipologia = :type
    WHERE
        id_ricettivita = :id
    ";

    $response = $conn->prepare($updatereceptivityQuery);

    $response->bindParam(":id",          $id,          PDO::PARAM_INT);
    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);

    $updateResult = $response->execute();

    if (!$updateResult) {
        return_error(500, "The database returned an error while updating the receptivity");
    }

    $new_receptivity = get_single_receptivity($conn, $id);
    return_json($new_receptivity);
}

function handle_delete($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $deleteReceptivityQuery = "DELETE FROM ricettivita WHERE id_ricettivita = :id";

    $response = $conn->prepare($deleteReceptivityQuery);

    $response->bindParam(":id", $id, PDO::PARAM_INT);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while deleting the receptivity");
    }
}


function get_single_receptivity($conn, int $id)
{
    $query = "SELECT * FROM ricettivita WHERE id_ricettivita = :id";

    $result = $conn->prepare($query);

    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();

    $receptivity = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($receptivity === false) {
        return_error(500, "The database returned an error while reading the receptivity");
    }

    return $receptivity;
}

function get_all_receptivities($conn)
{
    $query = "SELECT * FROM ricettivita";

    $result = $conn->prepare($query);

    $result->execute();

    $output = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($output === false) {
        return_error(500, "The database returned an error while reading all receptivities");
    }

    return $output;
}
