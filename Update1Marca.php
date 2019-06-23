<?php

require_once "autoload.php";

echo ("\n\nTESTE ATUALIZAR MARCA NO DB");
$oMarcaDAO = new MarcaDAO();

$oMarca = (new Marca())->setID(1)->setDescricao('GFallen X99');
echo ("\n" . $oMarcaDAO->update($oMarca)[1]);

$oMarca = (new Marca())->setID(2)->setDescricao('Dell Corporation');
echo ("\n" . $oMarcaDAO->update($oMarca)[1]);
