<?php

require 'config.php';

class DB
{

    private static $instance;

    public static function getInstance()
    {

        if (!isset(self::$instance)) {
            try {
                //instância dos dados do banco de dados
                self::$instance = new PDO('mysql:host=' . HOST . '; dbname=' . BASE, USER, PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            } catch (PDOException $e) {
                //se houver algum erro de conexão disparar o erro...
                echo "<p>" . $e->getMessage() . "</p>";
            }
        }
        return self::$instance;

    }

    public static function prepare($sql)
    {

        return self::getInstance()->prepare($sql);

    }

}