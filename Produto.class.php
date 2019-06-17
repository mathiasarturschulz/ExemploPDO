<?php

class Produto {

    private $ID;
    private $descricao;
    private $preco;
    private $codigodebarra;
    private $Marca;

    public function __construct($descricao) 
    {
        $this->setDescricao($descricao);
    }

    /**
     * Get the value of ID
     */ 
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     *
     * @return  self
     */ 
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of preco
     */ 
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @return  self
     */ 
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get the value of codigodebarra
     */ 
    public function getCodigodebarra()
    {
        return $this->codigodebarra;
    }

    /**
     * Set the value of codigodebarra
     *
     * @return  self
     */ 
    public function setCodigodebarra($codigodebarra)
    {
        $this->codigodebarra = $codigodebarra;

        return $this;
    }

    /**
     * Get the value of Marca
     */ 
    public function getMarca()
    {
        return $this->Marca;
    }

    /**
     * Set the value of Marca
     *
     * @return  self
     */ 
    public function setMarca($Marca)
    {
        $this->Marca = $Marca;

        return $this;
    }

    public function __toString() {
        return "{ Produto:"
            . " | ID = " . $this->getID()()
            . " | Descricao = " . $this->getDescricao()
            . " | Preco = " . $this->getDescricao()
            . " | Codigo de Barra = " . $this->getDescricao()
            . " | Marca = " . $this->getDescricao() . " }";
    }
}

?>