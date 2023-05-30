<?php
$db = [
    'db_engine' => 'mysql',
    'db_host' => 'thecouriernv.tplinkdns.com',
    'db_name' => 'iat',
    'db_user' => 'IAT',
    'db_password' => 'KZ$jSMX!M4f4gZC7Hb^zq4C&&!A!8Ei@$Nga&FZS*LF82bnnkcDC%vnFEExHkmDR&wCRb68MHk5h#6MtLmqaQhijDhmzPiD3p8*hHzyyDd@^Cd8tRKS8VZDDwk!up85h',
];

$db_config = $db['db_engine'] . ":host=".$db['db_host'] . ";dbname=" . $db['db_name'];

try {
    $conn = new PDO($db_config, $db['db_user'], $db['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    http_response_code(500);
    exit("Impossibile connettersi al database: " . $e->getMessage());
}
?>

