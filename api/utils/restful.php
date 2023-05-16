<?php
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case "GET":
        handle_get();
        break;
    case "POST":
        handle_post();
        break;
    case "PUT":
        handle_put();
        break;
    case "DELETE":
        handle_delete();
        break;
    default:
        break;
}
