<?php

require_once "autoload.php";

echo ("\n\nTESTE UPDATE VENDA NO DB");
$oVendaDAO = new VendaDAO();

$oVendedor = (new Vendedor())->setID(1);
$oCliente = (new Cliente())->setID(2);

$oProduto1 = (new Produto())->setID(1);
$oVendaProduto1 = (new VendaProduto())
    ->setProduto($oProduto1)
    ->setQuantidadeProduto(19);

$oVenda = (new Venda())
    ->setID(6)
    ->setData(new DateTime('2021-06-20'))
    ->setDataVencimento(new DateTime('2021-07-21'))
    ->setDataPagamento(new DateTime('2021-06-28'))
    ->setVendedor($oVendedor)
    ->setCliente($oCliente)
    ->setListaVendaProdutos([$oVendaProduto1]);
echo ("\n" . $oVendaDAO->update($oVenda)[1]);
