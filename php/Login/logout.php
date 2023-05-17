<?php
    session_start();
    $toReturn = '';
    $deleteCookie = isset($_GET['deleteCookie']) ? $_GET['deleteCookie'] : '';
    if (isset($_SESSION['session_id'])) {
        unset($_SESSION['session_id']);
        $toReturn = 'sessionDeleted';
        if ($deleteCookie == '1') {
            $time_cookie = 3600 * 24 * 7;
            setcookie("email", "", time() - $time_cookie, "/");
            setcookie("password", "", time() - $time_cookie, "/");
            $toReturn .= ' and cookieDeleted';
        }
        echo $toReturn;
    } else {
        echo 'problem to solve logout';
    }
    exit;
?>
