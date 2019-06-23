<?php

require_once "autoload.php";

/**
 * Classe ProdutoDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class ProdutoDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;

    const OPERADOR_IGUAL = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Produto $produto)
    {
        try {
            $sql = ""
                . "INSERT INTO produto (descricao, valor, estoque, imagem, idMarca)"
                . "VALUES (:descricao, :valor, :estoque, :imagem, :idMarca)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
            $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
            $stmt->bindParam(':idMarca', $idMarca, PDO::PARAM_STR);
            $descricao = $produto->getDescricao();
            $valor = $produto->getValor();
            $estoque = $produto->getEstoque();
            $imagem = $produto->getImagem();
            $idMarca = $produto->getMarca()->getID();

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Produto $produto)
    {
        try {
            $sql = ""
                . "UPDATE produto "
                . "    SET descricao = :descricao, "
                . "    valor = :valor, "
                . "    estoque = :estoque, "
                . "    imagem = :imagem, "
                . "    idMarca = :idMarca "
                . "WHERE idProduto = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
            $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
            $stmt->bindParam(':idMarca', $idMarca, PDO::PARAM_STR);
            $id = $produto->getID();
            $descricao = $produto->getDescricao();
            $valor = $produto->getValor();
            $estoque = $produto->getEstoque();
            $imagem = $produto->getImagem();
            $idMarca = $produto->getMarca()->getID();

            $stmt->execute();
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($IDProduto)
    {
        try {
            $sql = ""
                . "DELETE FROM produto WHERE idProduto = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = $IDProduto;

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
                        . "SELECT * FROM produto WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM produto WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = ""
                        . "ID: {$linha['idProduto']} "
                        . "- Descricao: {$linha['descricao']} "
                        . "- Valor: {$linha['valor']} "
                        . "- Estoque: {$linha['estoque']} "
                        . "- Imagem: {$linha['imagem']} "
                        . "- Id Marca: {$linha['idMarca']} ";
                }
    
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}