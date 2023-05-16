<?php

# FIXME: Spostare connection.php
require_once("../php/connection.php");

require_once("utils/dataClasses.php");
require_once("utils/restful.php");

# TODO: Aggiungere file di autenticazione/autorizzazione



function handle_post()
{
}

function handle_get()
{
    # FIXME: Per sostituire lista/eventi.php

    $has_id = isset($_GET['id']);

    if ($has_id) {
    }
}

function handle_put()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (is_null($id)) {
        http_response_code(400);
        echo "Missing id";

        exit;
    }

    # TODO: Leggi il vecchio evento per vedere se esiste

    $query = "SELECT * FROM eventi WHERE id_evento = :id";

    $old_event = null;

    if ($old_event)

        # FIXME: I dati mancanti dovrebbero rimanere uguali a come erano prima
        $new_event = new Event(
            $id,
            $name,
            $startDate,
            $endDate,
            $description,
            $type,
            $location,
            $phoneNumber,
            $longitude,
            $latitude
        );
}

function handle_delete()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (is_null($id)) {
        http_response_code(400);
        echo "Missing id";

        exit;
    }
}
