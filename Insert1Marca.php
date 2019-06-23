<?php

require_once "autoload.php";

echo ("\n\nTESTE INSERIR MARCA NO DB");
$oMarcaDAO = new MarcaDAO();

$oMarca = (new Marca())->setDescricao('GFallen');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);

$oMarca = (new Marca())->setDescricao('Dell');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);

$oMarca = (new Marca())->setDescricao('Samsung');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);

$oMarca = (new Marca())->setDescricao('LG');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);

$oMarca = (new Marca())->setDescricao('Apple');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);

$oMarca = (new Marca())->setDescricao('Microsoft');
echo ("\n" . $oMarcaDAO->insert($oMarca)[1]);
