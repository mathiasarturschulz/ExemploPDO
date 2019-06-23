<?php

require_once "autoload.php";

echo ("\n\nTESTE BUSCA CLIENTE NO DB");
$oClienteDAO = new ClienteDAO();

echo ("\n" . json_encode(
    $oClienteDAO->select('cidade', $oClienteDAO::TIPO_STRING, 'Ibirama')[1], 
    JSON_PRETTY_PRINT
));
