<?php

require_once("../utils/connection.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-type: application/json");

if ($_COOKIE['id'] != null) {
    $result = array(
        'id' => $_COOKIE['id'],
        'nome' => $_COOKIE['nome'],
        'cognome' => $_COOKIE['cognome']
    );
    echo json_encode($result);
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `utenti` WHERE `email` = :email AND `password` = :password'";

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

    if ($array['id'] != null) {
        setcookie("id", $array['id'], strtotime("+1 year"));
        setcookie("nome", $array['nome'], strtotime("+1 year"));
        setcookie("cognome", $array['cognome'], strtotime("+1 year"));
    } else {
        unset($_COOKIE['id']);
        unset($_COOKIE['nome']);
        unset($_COOKIE['cognome']);
    }

    echo json_encode($result);
}
