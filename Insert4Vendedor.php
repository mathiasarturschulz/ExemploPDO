<?php

require_once "autoload.php";

echo ("\n\nTESTE INSERIR VENDEDOR NO DB");
$oVendedorDAO = new VendedorDAO();

$oVendedor = (new Vendedor())
        ->setNome('Hal Jordan')
        ->setUsuario('haljordan')
        ->setSenha('jordan123');
echo ("\n" . $oVendedorDAO->insert($oVendedor)[1]);

$oVendedor = (new Vendedor())
        ->setNome('Bill Gates')
        ->setUsuario('bg')
        ->setSenha('bg999');
echo ("\n" . $oVendedorDAO->insert($oVendedor)[1]);
