<?php

class Venda {

    private $id;
    private $data;
    private $Cliente;
    private $Vendedor;
    private $dataVencimento;
    private $dataPagamento;
    private $ListaVendaProdutos = [];

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
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of Cliente
     */ 
    public function getCliente()
    {
        return $this->Cliente;
    }

    /**
     * Set the value of Cliente
     *
     * @return  self
     */ 
    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;

        return $this;
    }

    /**
     * Get the value of Vendedor
     */ 
    public function getVendedor()
    {
        return $this->Vendedor;
    }

    /**
     * Set the value of Vendedor
     *
     * @return  self
     */ 
    public function setVendedor($Vendedor)
    {
        $this->Vendedor = $Vendedor;

        return $this;
    }

    /**
     * Get the value of dataVencimento
     */ 
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * Set the value of dataVencimento
     *
     * @return  self
     */ 
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    /**
     * Get the value of dataPagamento
     */ 
    public function getDataPagamento()
    {
        return $this->dataPagamento;
    }

    /**
     * Set the value of dataPagamento
     *
     * @return  self
     */ 
    public function setDataPagamento($dataPagamento)
    {
        $this->dataPagamento = $dataPagamento;

        return $this;
    }

    /**
     * Get the value of ListaVendaProdutos
     */ 
    public function getListaVendaProdutos()
    {
        return $this->ListaVendaProdutos;
    }

    /**
     * Set the value of ListaVendaProdutos
     *
     * @return  self
     */ 
    public function setListaVendaProdutos($ListaVendaProdutos)
    {
        $this->ListaVendaProdutos = $ListaVendaProdutos;

        return $this;
    }


    // MÉTODOS

    public function listaDeItens()
    {
        $sLista = '---> Lista de Produtos da Venda: <br><br>';
        foreach ($this->getListaVendaProdutos() as $oVendaProduto) {
            $sLista .= $oVendaProduto;
        }

        return $sLista;
    }

    public function valorTotal()
    {
        $fValorTotal = 0;
        foreach ($this->getListaVendaProdutos() as $oVendaProduto) {
            $fValorProduto = $oVendaProduto->getProduto()->getValor();
            $iQtdProduto = $oVendaProduto->getQuantidadeProduto();
            $fValorTotal = $fValorTotal + ($fValorProduto * $iQtdProduto);
        }

        return $fValorTotal;
    }

    public function somaQtdProdutos()
    {
        $iQtdProdutos = 0;
        foreach ($this->getListaVendaProdutos() as $oVendaProduto) {
            $iQtdProdutos = $iQtdProdutos + $oVendaProduto->getQuantidadeProduto();
        }

        return $iQtdProdutos;
    }

    public function valorMedioVenda()
    {
        return $this->valorTotal() / $this->somaQtdProdutos();
    }


    
    public function __toString() {
        return " { Venda:"
                    . " | ID = " . $this->getId()
                    . " | Data = " . $this->getData()->format('d-m-Y')
                    . " ### Cliente = " . $this->getCliente()
                    . " ### Vendedor = " . $this->getVendedor()
                    . " | Data Vencimento = " . $this->getDataVencimento()->format('d-m-Y')
                    . " | Data Pagamento = " . $this->getDataPagamento()->format('d-m-Y')
                    . " ### Lista Produtos = " . implode("", $this->getListaVendaProdutos()) . " } ";
    }
}

?>