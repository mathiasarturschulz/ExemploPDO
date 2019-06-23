<?php

require_once "autoload.php";

/**
 * Classe ClienteDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class ClienteDAO {

    const TIPO_NUMERO = 1;
    const TIPO_STRING = 2;

    const OPERADOR_IGUAL = "=";
    const OPERADOR_MAIOR      = ">";
    const OPERADOR_MAIORIGUAL = ">=";
    const OPERADOR_MENOR      = "<";
    const OPERADOR_MENORIGUAL = "<=";
 
    public function insert(Cliente $Cliente)
    {
        try {
            $sql = ""
                . "INSERT INTO cliente (nome, cpf, rg, usuario, senha, fone, email, endereco, numero, bairro, cidade, estado)"
                . "VALUES (:nome, :cpf, :rg, :usuario, :senha, :fone, :email, :endereco, :numero, :bairro, :cidade, :estado)";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->bindParam(':rg', $rg, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':fone', $fone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
            $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $nome = $Cliente->getNome();
            $cpf = $Cliente->getCpf();
            $rg = $Cliente->getRg();
            $usuario = $Cliente->getUsuario();
            $senha = $Cliente->getSenha();
            $fone = $Cliente->getFone();
            $email = $Cliente->getEmail();
            $endereco = $Cliente->getEndereco();
            $numero = $Cliente->getNumero();
            $bairro = $Cliente->getBairro();
            $cidade = $Cliente->getCidade();
            $estado = $Cliente->getEstado();

            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function update(Cliente $Cliente)
    {
        try {
            $sql = ""
                . "UPDATE cliente "
                . "    SET nome = :nome, "
                . "    cpf = :cpf, "
                . "    rg = :rg, "
                . "    usuario = :usuario, "
                . "    senha = :senha, "
                . "    fone = :fone, "
                . "    email = :email, "
                . "    endereco = :endereco, "
                . "    numero = :numero, "
                . "    bairro = :bairro, "
                . "    cidade = :cidade, "
                . "    estado = :estado "
                . "WHERE idCliente = :id; ";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->bindParam(':rg', $rg, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':fone', $fone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
            $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $id = $Cliente->getID();
            $nome = $Cliente->getNome();
            $cpf = $Cliente->getCpf();
            $rg = $Cliente->getRg();
            $usuario = $Cliente->getUsuario();
            $senha = $Cliente->getSenha();
            $fone = $Cliente->getFone();
            $email = $Cliente->getEmail();
            $endereco = $Cliente->getEndereco();
            $numero = $Cliente->getNumero();
            $bairro = $Cliente->getBairro();
            $cidade = $Cliente->getCidade();
            $estado = $Cliente->getEstado();

            $stmt->execute();
            return [true, "Atualizado com Sucesso"];
        } catch (PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($IDCliente)
    {
        try {
            $sql = ""
                . "DELETE FROM cliente WHERE idCliente = :id";
            $pdo = Conexao::startConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $id = $IDCliente;

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
                        . "SELECT * FROM cliente WHERE " . $campoBusca . " " . $op .  " :valor";
                    $valor = $valorBusca;
                } elseif ($tipo == self::TIPO_STRING) {
                    $sql = ""
                        . "SELECT * FROM cliente WHERE " . $campoBusca . " LIKE :valor";
                    $valor = "%" . $valorBusca . "%";
                }
                $pdo = Conexao::startConnection();
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':valor', $valor, PDO::PARAM_STR);
    
                $stmt->execute();
    
                $result = [];
                while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = ""
                        . "ID: {$linha['idCliente']} "
                        . "- Nome: {$linha['nome']} "
                        . "- Cpf: {$linha['cpf']} "
                        . "- Rg: {$linha['rg']} "
                        . "- Usuario: {$linha['usuario']} "
                        . "- Senha: {$linha['senha']} "
                        . "- Fone: {$linha['fone']} "
                        . "- Email: {$linha['email']} "
                        . "- Endereco: {$linha['endereco']} "
                        . "- Numero: {$linha['numero']} "
                        . "- Bairro: {$linha['bairro']} "
                        . "- Cidade: {$linha['cidade']} "
                        . "- Estado: {$linha['estado']} ";
                }
                return [true, $result];
            }
            return [false, "Sem resultados. "];
        } catch(PDOException $e) {
            return [false, 'Error: ' . $e->getMessage()];
        }
    }
}