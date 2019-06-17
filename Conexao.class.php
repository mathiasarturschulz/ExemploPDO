<?php

class Conexao {

    private const DB_TYPE = 'mysql';
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'vendaSimples';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';

    public function startConnection()
    {
        
        try {
            $oConexaoPDO = new oConexaoPDO(self::DB_TYPE . ':host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASSWORD);
            $oConexaoPDO->setAttribute(oConexaoPDO::ATTR_ERRMODE, oConexaoPDO::ERRMODE_EXCEPTION);

            $stmt = $oConexaoPDO->prepare('INSERT INTO marca (descricao) VALUES(:descricao)');
            $stmt->bindParam(':descricao', $descricao, oConexaoPDO::PARAM_STR);
            $descricao = "Teste Foiiiii";
            $stmt->execute();
            if ($stmt->rowCount())
                echo "Inserido com Sucesso";
            else
                echo "Erro ao Inserir";
        } catch(oConexaoPDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

/*

$nome = 'Bill Gates';
$site = 'http://microsoft.com';
$sql = "INSERT INTO programadores(nome, site) VALUES(:nome, :site)";
$stmt = $PDO->prepare( $sql );
$stmt->bindParam( ':nome', $nome );
$stmt->bindParam( ':site', $site );
 
$result = $stmt->execute();
 
if ( ! $result )
{
    var_dump( $stmt->errorInfo() );
    exit;
}
 
echo $stmt->rowCount() . "linhas inseridas";

*/