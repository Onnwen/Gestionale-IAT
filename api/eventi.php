<?php

require_once("utils/validation.php");
require_once("utils/restful.php");

# TODO: Aggiungere file di autenticazione/autorizzazione

function handle_post($conn)
{
    $name        = get_value_from_request_body("nome");
    $startDate   = get_value_from_request_body("data_inizio");
    $endDate     = get_value_from_request_body("data_fine");
    $description = get_value_from_request_body("descrizione");
    $type        = get_value_from_request_body("tipologia");
    $location    = get_value_from_request_body("localita");
    $phoneNumber = get_value_from_request_body("telefono");
    $longitude   = get_value_from_request_body("longitudine");
    $latitude    = get_value_from_request_body("latitudine");

    if (any_are_null(
        $name,
        $startDate,
        $endDate,
        $description,
        $type,
        $location,
        $phoneNumber,
        $longitude,
        $latitude
    )) {
        return_error(400, "Missing required data in the request body");
    }

    $createEventQuery = "INSERT INTO eventi(
        nome,
        data_inizio,
        data_fine,
        descrizione,
        tipologie,
        localita,
        telefono,
        longitudine,
        latitudine
    )   VALUES (
        :name,
        :startDate,
        :endDate,
        :description,
        :type,
        :location,
        :phoneNumber,
        :longitude,
        :latitude
    )";

    $response = $conn->prepare($createEventQuery);

    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":startDate",   $startDate,   PDO::PARAM_STR);
    $response->bindParam(":endDate",     $endDate,     PDO::PARAM_STR);
    $response->bindParam(":description", $description, PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while inserting the new event");
    }
}

function handle_get($conn)
{
    $id = get_value_from_query_string("id");

    $toReturn = null;

    # FIXME: Non mi piace moltissimo mischiare la validazione con i percorsi validi
    if (is_null($id)) {
        $toReturn = get_all_events($conn);
    } else if (!is_int($id)) {
        return_error(400, "Provided id was not an integer");
    } else {
        $toReturn = get_single_event($conn, $id);
    }

    return_json($toReturn);
}

function handle_put($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $old_event = get_single_event($conn, $id);

    if (empty($old_event)) {
        return_error(400, "The provided id does not match any event");
    }

    # Prendi i valori da modificare dal body; i valori non presenti nel body restano uguali a prima
    $name        = get_value_from_request_body("nome",          $old_event[0]["nome"]);
    $startDate   = get_value_from_request_body("data_inizio",   $old_event[0]["data_inizio"]);
    $endDate     = get_value_from_request_body("data_fine",     $old_event[0]["data_fine"]);
    $description = get_value_from_request_body("descrizione",   $old_event[0]["descrizione"]);
    $type        = get_value_from_request_body("tipologia",     $old_event[0]["tipologie"]);
    $location    = get_value_from_request_body("localita",      $old_event[0]["localita"]);
    $phoneNumber = get_value_from_request_body("telefono",      $old_event[0]["telefono"]);
    $longitude   = get_value_from_request_body("longitudine",   $old_event[0]["longitudine"]);
    $latitude    = get_value_from_request_body("latitudine",    $old_event[0]["latitudine"]);

    $updateEventQuery =
        "UPDATE eventi
    SET
        nome = :name,
        data_inizio = :startDate,
        data_fine = :endDate,
        descrizione = :description,
        tipologie = :type,
        localita = :location,
        telefono = :phoneNumber,
        longitudine = :longitude,
        latitudine = :latitude
    WHERE
        id_evento = :id
    ";

    $response = $conn->prepare($updateEventQuery);

    $response->bindParam(":id",          $id,          PDO::PARAM_INT);
    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":startDate",   $startDate,   PDO::PARAM_STR);
    $response->bindParam(":endDate",     $endDate,     PDO::PARAM_STR);
    $response->bindParam(":description", $description, PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_INT);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $updateResult = $response->execute();

    if (!$updateResult) {
        return_error(500, "The database returned an error while updating the event");
    }

    $new_event = get_single_event($conn, $id);
    return_json($new_event);
}

function handle_delete($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $deleteEventQuery = "DELETE FROM eventi WHERE id_evento = :id";

    $response = $conn->prepare($deleteEventQuery);

    $response->bindParam(":id", $id, PDO::PARAM_INT);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while deleting the event");
    }
}


function get_single_event($conn, int $id)
{
    $query = "SELECT * FROM eventi WHERE id_evento = :id";

    $result = $conn->prepare($query);

    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();

    $event = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($event === false) {
        return_error(500, "The database returned an error while reading the event");
    }

    return $event;
}

function get_all_events($conn)
{
    $query = "SELECT * FROM eventi";

    $result = $conn->prepare($query);

    $result->execute();

    $output = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($output === false) {
        return_error(500, "The database returned an error while reading all events");
    }

    return $output;
}