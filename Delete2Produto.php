<?php

require_once "autoload.php";

echo ("\n\nTESTE DELETAR Produto NO DB");
$oProdutoDAO = new ProdutoDAO();

echo ("\n" . $oProdutoDAO->delete(2)[1]);
