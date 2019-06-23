<?php

require_once "autoload.php";

echo ("\n\nTESTE BUSCA PRODUTO NO DB");
$oProdutoDAO = new ProdutoDAO();

echo ("\n" . json_encode(
    $oProdutoDAO->select('valor', $oProdutoDAO::TIPO_NUMERO, 1000, $oProdutoDAO::OPERADOR_MAIORIGUAL)[1], 
    JSON_PRETTY_PRINT
));
