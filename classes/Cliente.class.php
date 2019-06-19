<?php

include_once "Pessoa.class.php";

class Cliente extends Pessoa {

    private $cpf;
    private $rg;
    private $fone;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;

    public function __construct(
        $id, $nome, $usuario, $senha, $cpf, $rg, $fone, $email, 
        $endereco, $numero, $bairro, $cidade, $estado) {
        parent::setId($id);
        parent::setNome($nome);
        parent::setUsuario($usuario);
        parent::setSenha($senha);
        $this->setCpf($cpf);
        $this->setRg($rg);
        $this->setFone($fone);
        $this->setEmail($email);
        $this->setEndereco($endereco);
        $this->setNumero($numero);
        $this->setBairro($bairro);
        $this->setCidade($cidade);
        $this->setEstado($estado);
    }

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of rg
     */ 
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set the value of rg
     *
     * @return  self
     */ 
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get the value of fone
     */ 
    public function getFone()
    {
        return $this->fone;
    }

    /**
     * Set the value of fone
     *
     * @return  self
     */ 
    public function setFone($fone)
    {
        $this->fone = $fone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of endereco
     */ 
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set the value of endereco
     *
     * @return  self
     */ 
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of bairro
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of cidade
     */ 
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function __toString() {
        return "--> Cliente: <br>"
                    . parent::__toString()
                    . "Rg = " . $this->getRg() . "<br>"
                    . "Fone = " . $this->getFone() . "<br>"
                    . "Email = " . $this->getEmail() . "<br>"
                    . "Endereco = " . $this->getEndereco() . "<br>"
                    . "Numero = " . $this->getNumero() . "<br>"
                    . "Bairro = " . $this->getBairro() . "<br>"
                    . "Cidade = " . $this->getCidade() . "<br>"
                    . "Estado = " . $this->getEstado() . "<br>";
    }
}

?>