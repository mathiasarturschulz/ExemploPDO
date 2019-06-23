<?php

require_once "autoload.php";

echo ("\n\nTESTE INSERIR PRODUTO NO DB");
$oProdutoDAO = new ProdutoDAO();

$oMarca = (new Marca())->setID(1);
$oProduto = (new Produto())
    ->setDescricao('Smartphone')
    ->setValor(1500)
    ->setEstoque(30)
    ->setImagem('Smartphone')
    ->setMarca($oMarca);
echo ("\n" . $oProdutoDAO->insert($oProduto)[1]);

$oMarca = (new Marca())->setID(1);
$oProduto = (new Produto())
    ->setDescricao('Teclado')
    ->setValor(350.12)
    ->setEstoque(46)
    ->setImagem('Teclado')
    ->setMarca($oMarca);
echo ("\n" . $oProdutoDAO->insert($oProduto)[1]);

$oMarca = (new Marca())->setID(1);
$oProduto = (new Produto())
    ->setDescricao('Notebook')
    ->setValor(4599.99)
    ->setEstoque(7)
    ->setImagem('Notebook')
    ->setMarca($oMarca);
echo ("\n" . $oProdutoDAO->insert($oProduto)[1]);
