<?php

require_once("utils/validation.php");
require_once("utils/restful.php");

# TODO: Aggiungere file di autenticazione/autorizzazione

function handle_post($conn)
{
    $name        = get_value_from_request_body("nome");
    $description = get_value_from_request_body("descrizione");
    $type        = get_value_from_request_body("tipologia");
    $location    = get_value_from_request_body("localita");
    $longitude   = get_value_from_request_body("longitudine");
    $latitude    = get_value_from_request_body("latitudine");

    if (any_are_null(
        $name,
        $description,
        $type,
        $location,
        $longitude,
        $latitude
    )) {
        return_error(400, "Missing required data in the request body");
    }

    $createItineraryQuery = "INSERT INTO itinerari(
        nome,
        descrizione,
        tipologia,
        localita,
        longitudine,
        latitudine
    )   VALUES (
        :name,
        :description,
        :type,
        :location,
        :longitude,
        :latitude
    )";

    $response = $conn->prepare($createItineraryQuery);

    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":description", $description, PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while inserting the new itinerary");
    }
}

function handle_get($conn)
{
    $id = get_value_from_query_string("id");

    $toReturn = null;

    # FIXME: Non mi piace moltissimo mischiare la validazione con i percorsi validi
    if (is_null($id)) {
        $toReturn = get_all_itineraries($conn);
    } else if (filter_int($id)) {
        return_error(400, "Provided id was not an integer");
    } else {
        $toReturn = get_single_itinerary($conn, $id);
    }

    return_json($toReturn);
}

function handle_put($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $old_itinerary = get_single_itinerary($conn, $id);

    if (empty($old_itinerary)) {
        return_error(400, "The provided id does not match any itinerary");
    }

    # Prendi i valori da modificare dal body; i valori non presenti nel body restano uguali a prima
    $name        = get_value_from_request_body("nome",          $old_itinerary[0]["nome"]);
    $description = get_value_from_request_body("descrizione",   $old_itinerary[0]["descrizione"]);
    $type        = get_value_from_request_body("tipologia",     $old_itinerary[0]["tipologia"]);
    $location    = get_value_from_request_body("localita",      $old_itinerary[0]["localita"]);
    $longitude   = get_value_from_request_body("longitudine",   $old_itinerary[0]["longitudine"]);
    $latitude    = get_value_from_request_body("latitudine",    $old_itinerary[0]["latitudine"]);

    $updateItineraryQuery =
        "UPDATE itinerari
    SET
        nome = :name,
        descrizione = :description,
        tipologia = :type,
        localita = :location,
        longitudine = :longitude,
        latitudine = :latitude
    WHERE
        id_itinerario = :id
    ";

    $response = $conn->prepare($updateItineraryQuery);

    $response->bindParam(":id",          $id,          PDO::PARAM_INT);
    $response->bindParam(":name",        $name,        PDO::PARAM_STR);
    $response->bindParam(":description", $description, PDO::PARAM_STR);
    $response->bindParam(":type",        $type,        PDO::PARAM_STR);
    $response->bindParam(":location",    $location,    PDO::PARAM_STR);
    $response->bindParam(":longitude",   $longitude,   PDO::PARAM_STR);
    $response->bindParam(":latitude",    $latitude,    PDO::PARAM_STR);

    $updateResult = $response->execute();

    if (!$updateResult) {
        return_error(500, "The database returned an error while updating the itinerary");
    }

    $new_itinerary = get_single_itinerary($conn, $id);
    return_json($new_itinerary);
}

function handle_delete($conn)
{
    $id = get_value_from_query_string("id");

    validate_id($id);

    $deleteItineraryQuery = "DELETE FROM itinerari WHERE id_itinerario = :id";

    $response = $conn->prepare($deleteItineraryQuery);

    $response->bindParam(":id", $id, PDO::PARAM_INT);

    $result = $response->execute();

    if (!$result) {
        return_error(500, "The database returned an error while deleting the itinerary");
    }
}


function get_single_itinerary($conn, int $id)
{
    $query = "SELECT * FROM itinerari WHERE id_itinerario = :id";

    $result = $conn->prepare($query);

    $result->bindParam(":id", $id, PDO::PARAM_INT);
    $result->execute();

    $itinerary = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($itinerary === false) {
        return_error(500, "The database returned an error while reading the itinerary");
    }

    return $itinerary;
}

function get_all_itineraries($conn)
{
    $query = "SELECT * FROM itinerari";

    $result = $conn->prepare($query);

    $result->execute();

    $output = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($output === false) {
        return_error(500, "The database returned an error while reading all itineraries");
    }

    return $output;
}
