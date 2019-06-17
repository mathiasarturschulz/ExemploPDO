<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$consulta = $pdo->prepare("SELECT * FROM produto
                           WHERE descricao
                           LIKE :descricao
                           ORDER BY descricao;");
$valor = "V";
$consulta->bindValue(':descricao', $valor."%", PDO::PARAM_STR);
$consulta->execute();

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    echo "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
}
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
