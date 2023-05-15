<?php
session_start();
require_once ('../connection.php');
if(isset($_SESSION['session_id']) && $_SESSION['session_id'] != ''){
    header('Location: ../index.php');
    exit;
}

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : '';
if ($email != '' and $password != '') {
    $select = "SELECT users_id AS id, hashed_password AS password, first_name AS name, last_name AS surname, email AS email, active AS active
            FROM Users
            WHERE email = '$email'";
    $pre = $conn->prepare($select);
    $pre->execute();
    $check = $pre->fetch(PDO::FETCH_ASSOC);
    if (!$check) {
        echo 'wrongLogin';
        http_response_code(404);
        exit;
    } else if ($check['active'] == '0') {
        echo 'userNotActive';
        http_response_code(405);
        exit;
    } else if (password_verify($password, $check['password'])) {
        $_SESSION['session_id'] = session_id();
        $_SESSION['id'] = $check['id'];
        $_SESSION['name'] = $check['name'];
        $_SESSION['surname'] = $check['surname'];
        $_SESSION['email'] = $check['email'];
        if ($remember_me != '0'){
            $time_cookie=3600*24*7;
            setcookie ("email",$email,time()+ $time_cookie);
            setcookie ("password",$password,time()+ $time_cookie);
        }
        http_response_code(200);
    } else {
        echo 'wrongLogin';
        http_response_code(403);
    }
}

