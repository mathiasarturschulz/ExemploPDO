<?php

require_once "autoload.php";

echo ("\n\nTESTE BUSCA VENDEDOR NO DB");
$oVendedorDAO = new VendedorDAO();

echo ("\n" . json_encode(
    $oVendedorDAO->select('nome', $oVendedorDAO::TIPO_STRING, 'A')[1], 
    JSON_PRETTY_PRINT
));
