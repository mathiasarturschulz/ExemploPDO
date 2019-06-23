<?php

require_once "autoload.php";

echo ("\n\nTESTE INSERIR CLIENTE NO DB");
$oClienteDAO = new ClienteDAO();

$oCliente = (new Cliente())
        ->setNome('Mathias Schulz')
        ->setCpf('12345678911')
        ->setRg('1234556')
        ->setUsuario('mathias')
        ->setSenha('mathias123456')
        ->setFone('47 3357-3357')
        ->setEmail('mathias@gmail.com')
        ->setEndereco('Rua X')
        ->setNumero(9999)
        ->setBairro('Bairro Y')
        ->setCidade('Ibirama')
        ->setEstado('SC');
echo ("\n" . $oClienteDAO->insert($oCliente)[1]);

$oCliente = (new Cliente())
        ->setNome('Irineu')
        ->setCpf('12332112332')
        ->setRg('1111111')
        ->setUsuario('irineu')
        ->setSenha('irineu123456')
        ->setFone('47 3357-3357')
        ->setEmail('irineu@gmail.com')
        ->setEndereco('Rua Y')
        ->setNumero(9876)
        ->setBairro('Bairro Z')
        ->setCidade('Rio do Sul')
        ->setEstado('SC');
echo ("\n" . $oClienteDAO->insert($oCliente)[1]);
