<?php

include_once "Pessoa.class.php";

class Vendedor extends Pessoa {

    public function __construct($id, $nome, $usuario, $senha) {
        parent::setId($id);
        parent::setNome($nome);
        parent::setUsuario($usuario);
        parent::setSenha($senha);
    }

    public function __toString() {
        return "--> Vendedor: <br>"
                    . parent::__toString();
    }
}

?>