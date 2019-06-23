<?php

require_once "autoload.php";

echo ("\n\nTESTE UPDATE CLIENTE NO DB");
$oClienteDAO = new ClienteDAO();

$oCliente = (new Cliente())
        ->setId(1)
        ->setNome('Mathias Artur Schulz')
        ->setCpf('98798798711')
        ->setRg('1234556')
        ->setUsuario('mathiasschulz')
        ->setSenha('123456schulz')
        ->setFone('47 3357-1234')
        ->setEmail('mathias@gmail.com')
        ->setEndereco('Rua X')
        ->setNumero(2011)
        ->setBairro('Bairro Y')
        ->setCidade('Ibirama')
        ->setEstado('SC');
echo ("\n" . $oClienteDAO->update($oCliente)[1]);

