<?php

require_once "autoload.php";

/**
 * Classe MarcaDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class MarcaDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;

    const OPERADOR_IGUAL = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Marca $marca)
    {
        try {
            $sql = ""
                . "INSERT INTO marca (descricao) VALUES(:descricao)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $descricao = $marca->getDescricao();

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
                . "UPDATE marca SET descricao = :descricao WHERE idMarca = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $id = $marca->getID();
            
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $descricao = $marca->getDescricao();

            $stmt->execute();
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($IDMarca)
    {
        try {
            $sql = ""
                . "DELETE FROM marca WHERE idMarca = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = $IDMarca;

            $stmt->execute();
            return [true, "Deletado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function select($campoBusca, $tipo, $valorBusca, $operador = null)
    {
        try {
            if ($campoBusca && $tipo && $valorBusca) {
                // POSSUI PARAMETROS
                $op = self::OPERADOR_IGUAL;
                if ($tipo == self::TIPO_NUMERO) {
                    if ($operador == self::OPERADOR_MAIOR
                        || $operador == self::OPERADOR_MAIORIGUAL
                        || $operador == self::OPERADOR_MENOR
                        || $operador == self::OPERADOR_MENORIGUAL) {
                        $op = $operador;
                    }
                    $sql = ""
                        . "SELECT * FROM marca WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM marca WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = "ID: {$linha['idMarca']} - Descricao: {$linha['descricao']}";
                }
    
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}