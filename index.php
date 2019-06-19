<?php

require_once "Marca.class.php";
require_once "MarcaDAO.class.php";

$oMarca = new Marca('TESTE123321');

$oMarcaDAO = new MarcaDAO();

$oMarcaDAO->insert($oMarca);

?>
