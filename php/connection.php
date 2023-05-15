<?php
$db = [
    'db_engine' => 'mysql',
    'db_host' => 'thecouriernv.tplinkdns.com',
    'db_name' => 'iat',
    'db_user' => 'IAT',
    'db_password' => 'Ld2$dyU6xdUwU8ivDeYo#i2FpkH9m#Y&CfB9TpRELp2%XC3FpSP&4HcQQKw6KhQ4wuT8K*Lnkj4wTbuersm^3^8Ww4f%*fwgKc@#Ks3of&acK^K@ydFKSdbcw88@ax5B',
];

$db_config = $db['db_engine'] . ":host=".$db['db_host'] . ";dbname=" . $db['db_name'];

try {
    $conn = new PDO($db_config, $db['db_user'], $db['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    exit("Impossibile connettersi al database: " . $e->getMessage());
}
?>
