<?php

class Categoria
{
    public $id_categoria;
    public $nome;

    public function __construct($nome=null, $id_categoria=null){
        $this->nome = $nome;
        $this->id_categoria = $id_categoria;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }
    public function setIdCategoria($id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }
}