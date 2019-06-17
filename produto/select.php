<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$consulta = $pdo->query("SELECT * FROM produto;");

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    echo "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
}
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
