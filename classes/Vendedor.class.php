<?php

include_once "Pessoa.class.php";

class Vendedor extends Pessoa {

    public function __toString() {
        return " { Vendedor:"
            . parent::__toString() . " } ";
    }
}

?>