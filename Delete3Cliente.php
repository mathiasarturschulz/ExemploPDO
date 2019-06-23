<?php

require_once "autoload.php";

echo ("\n\nTESTE DELETAR CLIENTE NO DB");
$oClienteDAO = new ClienteDAO();

echo ("\n" . $oClienteDAO->delete(1)[1]);
