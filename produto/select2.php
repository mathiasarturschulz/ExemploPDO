<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$tipoConsulta = 2;
if ($tipoConsulta == 1){
  $consulta = $pdo->prepare("SELECT * FROM produto WHERE descricao
                             LIKE :descricao ORDER BY descricao;");
  $valor = "L";
  $consulta->bindValue(':descricao', $valor."%", PDO::PARAM_STR);
}else{
  $consulta = $pdo->prepare("SELECT * FROM marca WHERE codigo
                             = :codigo ORDER BY codigo;");
  $valor = 18;
  $consulta->bindValue(':codigo', $valor, PDO::PARAM_INT);
}
$consulta->execute();
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    echo "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
}
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
