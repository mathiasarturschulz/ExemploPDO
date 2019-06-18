<?php

require_once "Conexao.class.php";
require_once "Marca.class.php";

/**
 * Classe MarcaDAO responsável por realizar: SELECT, INSERT, DELETE e UPDATE no DB
 */
class MarcaDAO {
 
    public function inserir(Marca $marca) {
        try {
            $sql = ""
                . "INSERT INTO marca (descricao) VALUES(:descricao)";
            $stmt = Conexao::startConnection()->prepare($sql);
            $stmt->bindParam(':descricao', $marca->getDescricao(), PDO::PARAM_STR);
 
            //return $stmt->execute();
            $stmt->execute();
            if ($stmt->rowCount())
                return [true, "Inserido com Sucesso"];
            else
                return [false, "Erro ao Inserir"];
        } catch (Exception $e) {
            return [false, 'Error: ' . $e->getMessage())];
        }
    }


    
 
    public function Editar(PojoUsuario $usuario) {
        try {
            $sql = "UPDATE usuario set
        nome = :nome,
                email = :email,
                senha = :senha,
                ativo = :ativo,
                cod_perfil = :cod_perfil WHERE cod_usuario = :cod_usuario";
 
            $p_sql = Conexao::getInstance()->prepare($sql);
 
            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":email", $usuario->getEmail());
            $p_sql->bindValue(":senha", $usuario->getSenha());
            $p_sql->bindValue(":ativo", $usuario->getAtivo());
            $p_sql->bindValue(":cod_perfil", $usuario->getPerfil()->
getCod_perfil());
            $p_sql->bindValue(":cod_usuario", $usuario->getCod_usuario());
 
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }
 
    public function Deletar($cod) {
        try {
            $sql = "DELETE FROM usuario WHERE cod_usuario = :cod";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $cod);
 
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }
 
    public function BuscarPorCOD($cod) {
        try {
            $sql = "SELECT * FROM usuario WHERE cod_usuario = :cod";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":cod", $cod);
            $p_sql->execute();
            return $this->populaUsuario($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado
 um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getInstance()->inserirLog("Erro: Código: " . $e->
getCode() . " Mensagem: " . $e->getMessage());
        }
    }
private function populaUsuario($row) {
        $pojo = new PojoUsuario;
        $pojo->setCod_usuario($row['cod_usuario']);
        $pojo->setNome($row['nome']);
        $pojo->setEmail($row['email']);
        $pojo->setSenha($row['senha']);
        $pojo->setAtivo($row['ativo']);
        $pojo->setPerfil(ControllerPerfil::getInstance()-
        >BuscarPorCOD($row['cod_perfil']));
        return $pojo;
    }
 
}