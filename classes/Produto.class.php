<?php

class Produto {

    private $id;
    private $descricao;
    private $valor;
    private $estoque;
    private $imagem;
    private $Marca;

    public function __construct($id, $descricao, $valor, $estoque, $imagem, $Marca) {
        $this->setId($id);
        $this->setDescricao($descricao);
        $this->setValor($valor);
        $this->setEstoque($estoque);
        $this->setImagem($imagem);
        $this->setMarca($Marca);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of estoque
     */ 
    public function getEstoque()
    {
        return $this->estoque;
    }

    /**
     * Set the value of estoque
     *
     * @return  self
     */ 
    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;

        return $this;
    }

    /**
     * Get the value of imagem
     */ 
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     *
     * @return  self
     */ 
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

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
        echo $this->validaMarca($Marca);
        if ($this->validaMarca($Marca))
            $this->Marca = $Marca;
        else
            $this->Marca = null;
        return $this;
    }

    public function validaMarca($Marca)
    {
        // ID NÃO PODE SER 0 (ZERO)
        return ($Marca->getId() && $Marca->getDescricao()) ? true : false;
    }

    public function __toString() {
        return " { Produto:"
                    . " | ID = " . $this->getId()
                    . " | Descricao = " . $this->getDescricao()
                    . " | Valor = " . $this->getValor()
                    . " | Estoque = " . $this->getEstoque()
                    . " | Imagem = " . $this->getImagem()
                    . " ### Marca = " . $this->getMarca() . " } ";
    }
}

?>