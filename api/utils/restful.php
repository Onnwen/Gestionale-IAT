<?php

require_once("connection.php");

$request_method = $_SERVER["REQUEST_METHOD"];

# Per avere un superglobale `$_PUT` simile a `$_POST`
# Adattato da: https://joshtronic.com/2014/06/01/how-to-process-put-requests-with-php/
# FIXME: Non supporta multipart/form-data

if ($request_method == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    foreach ($_PUT as $key => $value) {
        unset($_PUT[$key]);

        $_PUT[str_replace('amp;', '', $key)] = $value;
    }

    $_REQUEST = array_merge($_REQUEST, $_PUT);
}

switch ($request_method) {
    case "GET":
        handle_get($conn);
        break;
    case "POST":
        handle_post($conn);
        break;
    case "PUT":
        handle_put($conn);
        break;
    case "DELETE":
        handle_delete($conn);
        break;
    default:
        break;
}

function return_json($toReturn)
{
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($toReturn);

    exit;
}

function return_error(int $httpErrorCode, string $errorMessage = "")
{
    http_response_code($httpErrorCode);
    echo ($errorMessage);

    exit;
}

function get_value_from_request_body(string $valueName, $alternativeValue = null)
{
    global $request_method;
    global $_PUT;

    $current_method = null;

    if ($request_method == 'PUT') {
        $current_method = $_PUT;
    } else {
        $current_method = $_POST;
    }

    return isset($current_method[$valueName]) ? $current_method[$valueName] : $alternativeValue;
}

function get_value_from_query_string(string $valueName, $alternativeValue = null)
{
    return isset($_GET[$valueName]) ? $_GET[$valueName] : $alternativeValue;
}