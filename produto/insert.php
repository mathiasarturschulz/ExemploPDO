<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO produto (descricao,preco,codigodebarra,marca_codigo) VALUES(:descricao,:preco,:codigodebarra,:marca_codigo)');

  $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
  $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
  $stmt->bindParam(':codigodebarra', $codigodebarra,  PDO::PARAM_STR);
  $stmt->bindParam(':marca_codigo', $marca_codigo,  PDO::PARAM_INT);
  $descricao = "Teste Foiiiii";
  $preco = 123.54;
  $codigodebarra = "ABC1234";
  $marca_codigo = 1;
  $stmt->execute();
  if ($stmt->rowCount())
    echo "Inserido com Sucesso";
  else
    echo "Erro ao Inserir";
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

?>
