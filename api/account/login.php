<?php

require_once("../utils/connection.php");
require_once("../utils/http.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$result = null;

if (get_value_from_cookie("id")) {
    $result = array(
        'id'      => get_value_from_cookie("id"),
        'nome'    => get_value_from_cookie("nome"),
        'cognome' => get_value_from_cookie("cognome")
    );

    return_json($result);
}

$email    = get_value_from_request_body("email");
$password = get_value_from_request_body("password");

$sql = "SELECT * FROM `utenti` WHERE `email` = :email AND `password` = :password";

$res = $conn->prepare($sql);

$res->bindParam(":email", $email, PDO::PARAM_STR);
$res->bindParam(":password", $password, PDO::PARAM_STR);

$res->execute();

$array = $res->fetch(PDO::FETCH_ASSOC);

$result = array(
    'id' => $array['id'],
    'nome' => $array['nome'],
    'cognome' => $array['cognome']
);

if ($array['id']) {
    setcookie("id", $array['id'], strtotime("+1 year"));
    setcookie("nome", $array['nome'], strtotime("+1 year"));
    setcookie("cognome", $array['cognome'], strtotime("+1 year"));
} else {
    unset($_COOKIE['id']);
    unset($_COOKIE['nome']);
    unset($_COOKIE['cognome']);
}

return_json($result);