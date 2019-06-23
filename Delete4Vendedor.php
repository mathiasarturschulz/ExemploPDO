<?php

require_once "autoload.php";

echo ("\n\nTESTE DELETAR VENDEDOR NO DB");
$oVendedorDAO = new VendedorDAO();

echo ("\n" . $oVendedorDAO->delete(2)[1]);
