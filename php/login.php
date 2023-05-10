<?php
require_once ('connessione.php');
$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {
    $select = "SELECT user_id AS id, hashed_password AS password, name AS name, surname AS surname, email AS email, role AS role
            FROM Users
            WHERE email = '$email'";
    $pre = $pdo->prepare($select);
    $pre->execute();
    $check = $pre->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $check['password'])) {
        session_start();
        $_SESSION['session_id'] = session_id();
        $_SESSION['id'] = $check['id'];
        $_SESSION['name'] = $check['name'];
        $_SESSION['surname'] = $check['surname'];
        $_SESSION['email'] = $check['email'];
        $_SESSION['role'] = $check['role'];
        echo 'correctLogin';
    } else {
        echo 'wrongLogin';
    }
    exit;
}

