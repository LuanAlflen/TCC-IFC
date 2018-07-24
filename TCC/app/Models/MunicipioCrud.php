<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 13/07/18
 * Time: 15:02
 */
require_once 'DBConnection.php';
require_once 'Municipio.php';
class MunicipioCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    //RETORNA VERDADEIRO OU FALSA
    public function getMunicipio($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = "select * from municipios where id_municipio=' {$id}'";
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $municipio = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoMunicipio = new Municipio(
            utf8_encode($municipio['nome']),
            $municipio['id_estado'],
            $municipio['id_municipio']
        );

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoMunicipio;

    }

    public function getMunicipiosPorEstado($id)
    {
        $sql = "SELECT * FROM municipios where id_estado=".$id;
        $resultado = $this->conexao->query($sql);

        $municipios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($municipios as $municipio) {
            $nome = utf8_encode($municipio['nome']);
            $id_estado = $municipio['id_estado'];
            $id_municipio = $municipio['id_municipio'];

            $obj = new Municipio($nome, $id_estado,$id_municipio);
            $listaMunicipio[] = $obj;
        }
        return $listaMunicipio;
    }
    public function getMunicipios()
    {
        $sql = "SELECT * FROM municipios";

        $resultado = $this->conexao->query($sql);

        $municipios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($municipios as $municipio) {
            $nome = utf8_encode($municipio['nome']);
            $id_estado = $municipio['id_estado'];
            $id= $municipio['id'];

            $obj = new Municipio($nome, $id_estado,$id);
            $listaMunicipio[] = $obj;
        }
        return $listaMunicipio;
    }

}