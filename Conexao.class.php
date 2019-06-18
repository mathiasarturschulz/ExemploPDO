<?php

class Conexao {

    private const DB_TYPE = 'mysql';
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'vendaSimples';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';

    // instance
    public static $conexao;

    // getInstance
    public function startConnection()
    {
        if (isset(self::$conexao))
            return self::$conexao;
        
        try {
            $conexao = new PDO(self::DB_TYPE . ':host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASSWORD);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$conexao;
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}