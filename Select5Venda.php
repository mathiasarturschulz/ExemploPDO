<?php

require_once "autoload.php";

echo ("\n\nTESTE BUSCA VENDA NO DB");
$oVendaDAO = new VendaDAO();

echo ("\n" . json_encode(
    $oVendaDAO->select('idVenda', $oVendaDAO::TIPO_NUMERO, 1, $oVendaDAO::OPERADOR_MAIOR)[1], 
    JSON_PRETTY_PRINT
));
