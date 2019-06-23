<?php

require_once "autoload.php";

/**
 * Classe VendaDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class VendaDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;

    const OPERADOR_IGUAL = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Venda $Venda)
    {
        try {
            $retornoQtdVenda = $this->selectUltimaVenda();
            if (!$retornoQtdVenda[0])
                return [false, "Erro ao Inserir"];

            $sql = ""
                . "INSERT INTO Venda (idVenda, data, dataVencimento, dataPagamento, idVendedor, idCliente)"
                . "VALUES (:idVenda, :data, :dataVencimento, :dataPagamento, :idVendedor, :idCliente)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':idVenda', $idVenda, PDO::PARAM_STR);
            $stmt->bindParam(':data', $data, PDO::PARAM_STR);
            $stmt->bindParam(':dataVencimento', $dataVencimento, PDO::PARAM_STR);
            $stmt->bindParam(':dataPagamento', $dataPagamento, PDO::PARAM_STR);
            $stmt->bindParam(':idVendedor', $idVendedor, PDO::PARAM_STR);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
            $idVenda = $retornoQtdVenda[1] + 1;
            $data = $Venda->getData()->format('Y-m-d');
            $dataVencimento = $Venda->getDataVencimento()->format('Y-m-d');
            $dataPagamento = $Venda->getDataPagamento()->format('Y-m-d');
            $idVendedor = $Venda->getVendedor()->getID();
            $idCliente = $Venda->getCliente()->getID();

            $stmt->execute();
            if ($stmt->rowCount())
                return $this->insertProdutos($idVenda, $Venda->getListaVendaProdutos());
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Venda $Venda)
    {
        try {
            $sql = ""
                . "UPDATE venda "
                . "    SET data = :data, "
                . "    dataVencimento = :dataVencimento, "
                . "    dataPagamento = :dataPagamento, "
                . "    idVendedor = :idVendedor, "
                . "    idCliente = :idCliente "
                . "WHERE idVenda = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':data', $data, PDO::PARAM_STR);
            $stmt->bindParam(':dataVencimento', $dataVencimento, PDO::PARAM_STR);
            $stmt->bindParam(':dataPagamento', $dataPagamento, PDO::PARAM_STR);
            $stmt->bindParam(':idVendedor', $idVendedor, PDO::PARAM_STR);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
            $id = $Venda->getID();
            $data = $Venda->getData()->format('Y-m-d');
            $dataVencimento = $Venda->getDataVencimento()->format('Y-m-d');
            $dataPagamento = $Venda->getDataPagamento()->format('Y-m-d');
            $idVendedor = $Venda->getVendedor()->getID();
            $idCliente = $Venda->getCliente()->getID();

            $stmt->execute();
            return $this->updateProdutos($id, $Venda->getListaVendaProdutos());
        } catch (PDOException $e) {
            return [false, 'Error1: ' . $e->getMessage()];
        }
    }

    public function delete($IDVenda)
    {
        try {
            if (!$this->deleteProdutos($IDVenda)[0])
                return [false, 'Erro ao Deletar'];

            $sql = ""
                . "DELETE FROM venda WHERE idVenda = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = $IDVenda;

            $stmt->execute();
            return [true, 'Deletado com Sucesso'];
        } catch (PDOException $e) {
            return [false, 'Error1: ' . $e->getMessage()];
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
                        . "SELECT * FROM venda WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM venda WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $string = ""
                        . "ID: {$linha['idVenda']} "
                        . "- Data: {$linha['data']} "
                        . "- Data Vencimento: {$linha['dataVencimento']} "
                        . "- Data Pagamento: {$linha['dataPagamento']} "
                        . "- Id Vendedor: {$linha['idVendedor']} "
                        . "- Id Cliente: {$linha['idCliente']} ";
                    $aProdutos = $this->selectProdutos($linha['idVenda'])[1];
                    foreach ($aProdutos as $produto) {
                        $string .= json_encode($produto, JSON_PRETTY_PRINT);
                    }
                    $result[] = $string;
                }
    
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Método que retorna a última Venda cadastrada no DB
     */
    public function selectUltimaVenda()
    {
        try {
            $sql = ""
                . "select max(idVenda) as ultima from venda;";

            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $total = $linha['ultima'];

            return [true, $total];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function insertProdutos(int $IDVenda, array $arrayVendaProduto)
    {
        try {
            foreach ($arrayVendaProduto as $chave => $oVendaProduto) {
                $sql = ""
                    . "INSERT INTO produtovenda (idProduto, idVenda, quantidadeProduto)"
                    . "VALUES (:idProduto, :idVenda, :quantidadeProduto)";
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindParam(':idProduto', $idProduto, PDO::PARAM_STR);
                $stmt->bindParam(':idVenda', $idVenda, PDO::PARAM_STR);
                $stmt->bindParam(':quantidadeProduto', $quantidadeProduto, PDO::PARAM_STR);
                $idProduto = $oVendaProduto->getProduto()->getID();
                $idVenda = $IDVenda;
                $quantidadeProduto = $oVendaProduto->getQuantidadeProduto();

                $stmt->execute();
                if (!$stmt->rowCount())
                    return [false, "Erro ao Inserir"];
            }
            return [true, "Inserido com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function updateProdutos(int $IDVenda, array $arrayVendaProduto)
    {
        try {
            if (!$this->deleteProdutos($IDVenda)[0])
                return [false, "Erro ao Atualizar"]; 

            foreach ($arrayVendaProduto as $chave => $oVendaProduto) {
                $sql = ""
                    . "INSERT INTO produtovenda (idProduto, idVenda, quantidadeProduto)"
                    . "VALUES (:idProduto, :idVenda, :quantidadeProduto)";
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindParam(':idProduto', $idProduto, PDO::PARAM_STR);
                $stmt->bindParam(':idVenda', $idVenda, PDO::PARAM_STR);
                $stmt->bindParam(':quantidadeProduto', $quantidadeProduto, PDO::PARAM_STR);
                $idProduto = $oVendaProduto->getProduto()->getID();
                $idVenda = $IDVenda;
                $quantidadeProduto = $oVendaProduto->getQuantidadeProduto();

                $stmt->execute();
                if (!$stmt->rowCount())
                    return [false, "Erro ao Atualizar"];
            }
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function deleteProdutos($IDVenda)
    {
        try {
            $sql = ""
                . "DELETE FROM produtovenda WHERE idVenda = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = $IDVenda;

            $stmt->execute();
            return [true, "Deletado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function selectProdutos($IDVenda)
    {
        try {
            $sql = ""
                . "SELECT * FROM produtovenda WHERE idVenda = :id";

            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $IDVenda, PDO::PARAM_STR);
            // $id = $IDVenda;

            $stmt->execute();

            $result = [];
            $iCont = 0;
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $iCont++;
                $result[] = ""
                    . "### Produto" . $iCont . " "
                    . "ID: {$linha['idProduto']} "
                    . "- Quantidade: {$linha['quantidadeProduto']} ";
            }

            return [true, $result];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}