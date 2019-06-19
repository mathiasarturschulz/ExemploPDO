<?php

require_once "Conexao.class.php";
require_once "Marca.class.php";

/**
 * Classe MarcaDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class MarcaDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;
 
    public function insert(Marca $marca)
    {
        try {
            $sql = ""
                . "INSERT INTO marca (descricao) VALUES(:descricao)";
            $stmt = Conexao::startConnection();
            $stmt->prepare($sql);
            $stmt->bindParam(':descricao', $marca->getDescricao(), PDO::PARAM_STR);
 
            //return $stmt->execute();
            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Marca $marca)
    {
        try {
            $sql = ""
                . "UPDATE marca SET descricao = :descricao WHERE codigo = :codigo";
            $stmt = Conexao::startConnection()->prepare($sql);
            $stmt->bindParam(':descricao', $marca->getDescricao(), PDO::PARAM_STR);

            return [true, $stmt->execute() . " Row Count: " . $stmt->rowCount()];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($ID)
    {
        try {
            $sql = ""
                . "DELETE FROM marca WHERE codigo = :id";
            $stmt = Conexao::startConnection()->prepare($sql);
            $stmt->bindParam(':id', $ID);

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Deletado com Sucesso"];
            else
                return [false, "Erro ao Deletar"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function select($campoBusca, $tipo, $valorBusca)
    {
        try {
            if ($campoBusca && $tipo && $valorBusca) {
                // POSSUI PARAMETROS
                if ($tipo == self::TIPO_NUMERO) {
                    $sql = ""
                        . "SELECT * FROM marca WHERE " . $campoBusca . " = :valor";
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM marca WHERE " . $campoBusca . " LIKE :valor";
                }
                $stmt = Conexao::startConnection()->prepare($sql);
                $stmt->bindValue(':valor', "%" . $valorBusca . "%", PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}";
                }
    
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}