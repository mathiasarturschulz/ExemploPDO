<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('UPDATE marca SET descricao = :descricao WHERE codigo = :codigo');
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
  $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
  $codigo = 50;
  $descricao = "Novo nome do Rodrigo - PDO33333333";
  echo $stmt->execute();
  echo "<br>";
  echo $stmt->rowCount();
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
