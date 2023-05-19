<?php
require_once('../connection.php');
//post of inforomation for registratin
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$surname = isset($_POST['surname']) ? $_POST['surname'] : '';

//check if the email is already in the database
$select = "SELECT email FROM Users WHERE email = :email";
$pre = $conn->prepare($select);
$pre->bindParam(':email', $email, PDO::PARAM_STR);
$pre->execute();
$check = $pre->fetch(PDO::FETCH_ASSOC);
if (!$check) {
    try{
        $insert = "INSERT INTO Users (email, hashed_password, first_name, last_name, active)
               VALUES (:email, :hashed_password, :name, :surname, '0')";
        $pre = $conn->prepare($insert);
        $pre->bindParam(':email', $email, PDO::PARAM_STR);
        $password_hash = password_hash($pw, PASSWORD_DEFAULT);
        $pre->bindParam(':hashed_password', $password_hash, PDO::PARAM_STR);
        $pre->bindParam(':name', $name, PDO::PARAM_STR);
        $pre->bindParam(':surname', $surname, PDO::PARAM_STR);
        $pre->execute();
        http_response_code(200);
    } catch (PDOException $e){
        echo $e->getMessage();
        http_response_code(500);
        exit;
    }
} else {
    echo 'emailAlreadyExist';
    http_response_code(403);
    exit;
}
?>





