<?php

require_once "autoload.php";

echo ("TESTE BUSCA");


echo ("\n\nTESTE BUSCA MARCA NO DB");
$oMarcaDAO = new MarcaDAO();

echo ("\n" . json_encode($oMarcaDAO->select('descricao', $oMarcaDAO::TIPO_STRING, 'GFallen')[1], JSON_PRETTY_PRINT));


