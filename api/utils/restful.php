<?php

require_once("connection.php");
require_once("http.php");

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