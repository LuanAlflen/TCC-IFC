<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 13/07/18
 * Time: 15:02
 */

require_once 'DBConnection.php';
require_once 'Estado.php';
class EstadoCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    //RETORNA VERDADEIRO OU FALSA

    public function getEstado($id_estado)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = "select * from estados where id_estado='{$id_estado}'";
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $estado = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoEstado = new Estado(
            $estado['sigla'],
            utf8_encode($estado['nome']),
            $estado['id_estado']
        );

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoEstado;

    }

    public function getEstados()
    {
        $sql = "SELECT * FROM estados";

        $resultado = $this->conexao->query($sql);

        $estados = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($estados as $estado) {
            $sigla = $estado['sigla'];
            $nome = utf8_encode($estado['nome']);
            $id = $estado['id_estado'];

            $obj = new Estado($sigla, $nome, $id);
            $listaEstado[] = $obj;
        }
        return $listaEstado;
    }
}