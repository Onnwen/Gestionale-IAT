<?php

$db = [
    'db_engine' => 'mysql',
    'db_host' => '',
    'db_name' => '',
    'db_user' => '',
    'db_password' => '',
];

$db_config = $db['db_engine'] . ":host=" . $db['db_host'] . ";dbname=" . $db['db_name'];

try {
    $conn = new PDO($db_config, $db['db_user'], $db['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    exit("Impossibile connettersi al database: " . $e->getMessage());
}
