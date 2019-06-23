<?php

require_once "autoload.php";

echo ("\n\nTESTE UPDATE PRODUTO NO DB");
$oProdutoDAO = new ProdutoDAO();

$oMarca = (new Marca())->setID(2);
$oProduto = (new Produto())
    ->setID(1)
    ->setDescricao('Game God of War')
    ->setValor(159.15)
    ->setEstoque(9)
    ->setImagem('Game God of War')
    ->setMarca($oMarca);
echo ("\n" . $oProdutoDAO->update($oProduto)[1]);