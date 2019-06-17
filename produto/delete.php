<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=vendaSimples', "root","");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('DELETE FROM produto WHERE codigo = :id');
  $stmt->bindParam(':id', $id);

  $id = 41;
  $stmt->execute();
  if ($stmt->rowCount())
    echo "Deletado com Sucesso";
  else
    echo "Erro ao Deletar";
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
