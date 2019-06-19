<?php
$oVendedor = new Vendedor(
    149, 'Hal Jordan', 'haljordan', 'jordan123'
);
$oCliente = new Cliente(
    23, 'Mathias Schulz', 'mathias', 'mathias123456', '12345678911', '1234556', '47 3357-3357', 
    'mathias@gmail.com', 'Rua X', 9999, 'Bairro Y', 'Ibirama', 'SC'
);

$oMarca1 = new Marca(61, 'Samsung');
$oMarca2 = new Marca(62, 'Dell');
$oMarca3 = new Marca(63, 'GFallen');

$oProduto1 = new Produto(15, 'Smartphone', 1500, 30, 'imagem_produto_1', $oMarca1);
$oProduto2 = new Produto(30, 'Notebook Alienware', 5999, 13, 'imagem_produto_2', $oMarca2);
$oProduto3 = new Produto(45, 'Mouse', 99.90, 45, 'imagem_produto_3', $oMarca3);

$oVendaProduto1 = new VendaProduto($oProduto1, 2);
$oVendaProduto2 = new VendaProduto($oProduto2, 5);
$oVendaProduto3 = new VendaProduto($oProduto3, 10);

$oVenda = new Venda(
    99, new DateTime('2019-05-25'), $oCliente, $oVendedor, 
    new DateTime('2019-07-10'), new DateTime('2019-06-13'), 
    [$oVendaProduto1, $oVendaProduto2, $oVendaProduto3]
);

echo $oVendedor;
echo "<br><br>";
echo $oCliente;
echo "<br><br>";
echo $oVenda;

echo "<br><br>";
echo $oVenda->listaDeItens();

echo "<br><br>";
echo "---> Valor Total: " . $oVenda->valorTotal() . " R$";

echo "<br><br>";
echo "---> Quantidade de Itens: " . $oVenda->somaQtdProdutos() . " unidade(s)";

echo "<br><br>";
echo "---> Média de Preço da Venda: " . $oVenda->valorMedioVenda() . " R$";

echo "<br><br>";




/**
 * TESTE INSERIR MARCA NO DB
 */
require_once "Marca.class.php";
require_once "MarcaDAO.class.php";

$oMarca = new Marca('Mathias');

$oMarcaDAO = new MarcaDAO();

$oMarcaDAO->insert($oMarca);

