<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO marca (descricao) VALUES(:descricao)');
  $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
  $descricao = "Teste Foiiiii";
  $stmt->execute();
  if ($stmt->rowCount())
    echo "Inserido com Sucesso";
  else
    echo "Erro ao Inserir";
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

?>
