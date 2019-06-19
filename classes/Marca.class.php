<?php

class Marca {

    private $ID;
    private $descricao;

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

    public function __toString() {
        return " { Marca:"
            . " | ID = " . $this->getID()
            . " | Descricao = " . $this->getDescricao() . " } ";
    }
}

?>