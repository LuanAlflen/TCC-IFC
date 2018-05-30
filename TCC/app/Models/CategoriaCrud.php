<?php

require_once 'DBConnection.php';
require_once 'Categoria.php';

class CategoriaCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }

    public function getCategoria($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from categoria where id_categoria='.$id;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $categoria = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoLocal = new Categoria(
            $categoria['nome'],
            $categoria['id_categoria']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoLocal;

    }


    public function getCategorias()
    {
        $sql = "SELECT * FROM categoria";

        $resultado = $this->conexao->query($sql);

        $categorias = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categorias as $categoria) {
            $nome = $categoria['nome'];
            $idcategoria = $categoria['id_categoria'];

            $obj = new Categoria($nome,$idcategoria);
            $Listacategoria[] = $obj;
        }
        return $Listacategoria;
    }
}