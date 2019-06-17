<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('UPDATE produto SET descricao = :descricao, preco = :preco, codigodebarra = :codigodebarra, marca_codigo = :marca_codigo WHERE codigo = :codigo');
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
  $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
  $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
  $stmt->bindParam(':codigodebarra', $codigodebarra,  PDO::PARAM_STR);
  $stmt->bindParam(':marca_codigo', $marca_codigo,  PDO::PARAM_INT);

  $codigo = 50;
  $descricao = "Novo nome do Rodrigo - PDO33333333";
  $preco = 123.54;
  $codigodebarra = "ADS294293";
  $marca_codigo = 1;
  echo $stmt->execute();
  echo "<br>";
  echo $stmt->rowCount();
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
