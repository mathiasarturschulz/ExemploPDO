<?php

require_once "autoload.php";

echo ("\n\nTESTE INSERIR VENDA NO DB");
$oVendaDAO = new VendaDAO();

$oVendedor = (new Vendedor())->setID(1);
$oCliente = (new Cliente())->setID(2);

$oProduto1 = (new Produto())->setID(1);
$oVendaProduto1 = (new VendaProduto())
    ->setProduto($oProduto1)
    ->setQuantidadeProduto(19);

$oProduto2 = (new Produto())->setID(3);
$oVendaProduto2 = (new VendaProduto())
    ->setProduto($oProduto2)
    ->setQuantidadeProduto(5);

$oVenda = (new Venda())
    ->setData(new DateTime('2019-06-20'))
    ->setDataVencimento(new DateTime('2019-07-21'))
    ->setDataPagamento(new DateTime('2019-06-28'))
    ->setVendedor($oVendedor)
    ->setCliente($oCliente)
    ->setListaVendaProdutos([$oVendaProduto1, $oVendaProduto2]);
echo ("\n" . $oVendaDAO->insert($oVenda)[1]);
