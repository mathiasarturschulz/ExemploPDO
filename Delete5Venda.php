<?php

require_once "autoload.php";

echo ("\n\nTESTE DELETAR VENDA NO DB");
$oVendaDAO = new VendaDAO();

echo ("\n" . $oVendaDAO->delete(7)[1]);
