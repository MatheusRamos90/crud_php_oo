<?php

require 'DB.php';

abstract class Produtos extends DB {

    //GETTERS E SETTERS dos Produtos

    protected $table;
    public $nome;
    public $categoria;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }
    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

}