<?php
require_once ('../Mailer.php');

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$email = "onnwen.cassitto@icloud.com";

$mailer = new Mailer($email, 'alfatecnicasrl.mailer@gmail.com', 'Contatto dal form del sito IAT', mb_convert_encoding('
È stato inviato un messaggio dal form del sito IAT.<br>
<br>
<b>Nome:</b> ' . $_POST["nome"] . '<br>
<b>Cognome:</b> ' . $_POST["cognome"] . '<br>
<b>Email:</b> <a href="mailto:' . $_POST["email"] . '">' . $_POST["email"] . '</a><br>
<b>Telefono:</b> <a href="tel:' . $_POST["telefono"] . '">' . $_POST["telefono"] . '</a><br>
<b>Messaggio:</b> ' . $_POST["messaggio"] . '<br>
<br>
È importante NON rispondere a questa email, ma contattare l\'utente direttamente all\'indirizzo email o al numero di telefono indicato. Qualsiasi risposta a questa email verrà ignorata.<br>', 'utf8'), 'Gestionale IAT');

$mailer->send();

echo "ok";