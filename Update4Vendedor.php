<?php

require_once "autoload.php";

echo ("\n\nTESTE UPDATE VENDEDOR NO DB");
$oVendedorDAO = new VendedorDAO();

$oVendedor = (new Vendedor())
        ->setId(1)
        ->setNome('Artur Schulz')
        ->setUsuario('schulz')
        ->setSenha('schulz');
echo ("\n" . $oVendedorDAO->update($oVendedor)[1]);

