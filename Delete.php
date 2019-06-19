<?php

require_once "autoload.php";

echo ("TESTE DELETAR");


echo ("\n\nTESTE DELETAR MARCA NO DB");
$oMarcaDAO = new MarcaDAO();

echo ("\n" . $oMarcaDAO->delete(3)[1]);
echo ("\n" . $oMarcaDAO->delete(4)[1]);

