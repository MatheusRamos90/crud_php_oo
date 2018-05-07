<?php

require 'Produtos.php';

class CrudProdutos extends Produtos{

    protected $table = 'produtos';

    //trago todos os resultados da tabela
    public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $stm = DB::prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    //crio um novo produto
    public function create(){
        $data_now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $data = $data_now->format('Y-m-d H:i:s');
        $sql = "INSERT INTO $this->table(nome,categoria,data_) VALUES(:nome, :categoria, :data)";
        $stm = DB::prepare($sql);
        $stm->bindParam(':nome',$this->nome);
        $stm->bindParam(':categoria',$this->categoria);
        $stm->bindParam(':data',$data);
        return $stm->execute();
    }

    public function edit($id){
        $data_now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $data = $data_now->format('Y-m-d H:i:s');
        $sql = "UPDATE $this->table SET nome = :nome, categoria = :categoria, data_ = :data WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindParam(':nome',$this->nome);
        $stm->bindParam(':categoria',$this->categoria);
        $stm->bindParam(':data',$data);
        return $stm->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }

    //opcional
    /*public function getViewEdit($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stm = DB::prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
    }*/

}