<?php
session_start();
require_once ('connessione.php');
if(isset($_SESSION['session_id']) && $_SESSION['session_id'] != ''){
    echo "userLoggedIn";
    exit;
} else {
    echo "sessionExpired";
}
?>
