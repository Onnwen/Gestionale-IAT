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

    if (any_are_null(
        $name,
        $location,
        $longitude,
        $latitude
    )) {
        return_error(400, "Missing required data in the request body");
    }

    $createServiceQuery = "INSERT INTO servizi(
        nome,
        localita,
        longitudine,
        latitudine
    )   VALUES (
        :name,
        :location,
        :longitude,
        :latitude
    )";

    $response = $conn->prepare($createServiceQuery);

    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while inserting the new service");
    }
}

function handle_get($conn)
{
    $id = get_value_from_query_string("id");

    $toReturn = null;

    # FIXME: Non mi piace moltissimo mischiare la validazione con i percorsi validi
    if (is_null($id)) {
        $toReturn = get_all_services($conn);
    } else if (!is_int($id)) {
        return_error(400, "Provided id was not an integer");
    } else {
        $toReturn = get_single_service($conn, $id);
    }

    return_json($toReturn);
}

function handle_put($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $old_service = get_single_service($conn, $id);

    if (empty($old_service)) {
        return_error(400, "The provided id does not match any service");
    }

    # Prendi i valori da modificare dal body; i valori non presenti nel body restano uguali a prima
    $name        = get_value_from_request_body("nome",          $old_service[0]["nome"]);
    $location    = get_value_from_request_body("localita",      $old_service[0]["localita"]);
    $longitude   = get_value_from_request_body("longitudine",   $old_service[0]["longitudine"]);
    $latitude    = get_value_from_request_body("latitudine",    $old_service[0]["latitudine"]);

    $updateServiceQuery =
        "UPDATE servizi
    SET
        nome = :name,
        localita = :location,
        longitudine = :longitude,
        latitudine = :latitude
    WHERE
        id_servizio = :id
    ";

    $response = $conn->prepare($updateServiceQuery);

    $response->bindParam(":id",          $id,          PDO::PARAM_INT);
    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $updateResult = $response->execute();

    if (!$updateResult) {
        return_error(500, "The database returned an error while updating the service");
    }

    $new_service = get_single_service($conn, $id);
    return_json($new_service);
}

function handle_delete($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $deleteServiceQuery = "DELETE FROM servizi WHERE id_servizio = :id";

    $response = $conn->prepare($deleteServiceQuery);

    $response->bindParam(":id", $id, PDO::PARAM_INT);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while deleting the service");
    }
}


function get_single_service($conn, int $id)
{
    $query = "SELECT * FROM servizi WHERE id_servizio = :id";

    $result = $conn->prepare($query);

    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();

    $service = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($service === false) {
        return_error(500, "The database returned an error while reading the service");
    }

    return $service;
}

function get_all_services($conn)
{
    $query = "SELECT * FROM servizi";

    $result = $conn->prepare($query);

    $result->execute();

    $output = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($output === false) {
        return_error(500, "The database returned an error while reading all services");
    }

    return $output;
}
