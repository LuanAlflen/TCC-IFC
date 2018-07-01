<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 25/06/18
 * Time: 16:13
 */

    require_once 'DBConnection.php';
    require_once 'Comentario.php';


class ComentarioCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    public function getComentarioUser($iduser)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from comentarios where id_usuario='.$iduser;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $comentario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoComentario = new Comentario(
            $comentario['data'],
            $comentario['texto'],
            $comentario['id_usuario'],
            $comentario['id_local'],
            $comentario['id_comentario']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoComentario;

    }
    public function getComentarioLocal($idlocal)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from comentarios where id_local='.$idlocal;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $comentario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoComentario = new Comentario(
            $comentario['data'],
            $comentario['texto'],
            $comentario['id_usuario'],
            $comentario['id_local'],
            $comentario['id_comentario']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoComentario;

    }
    public function getComentario($idcomentario)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from comentarios where id_comentario='.$idcomentario;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $comentario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoComentario = new Comentario(
            $comentario['data'],
            $comentario['texto'],
            $comentario['id_usuario'],
            $comentario['id_local'],
            $comentario['id_comentario']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoComentario;

    }

    public function getComentarios()
    {
        $sql = "SELECT * FROM comentarios";

        $resultado = $this->conexao->query($sql);

        $comentarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($comentarios as $comentario) {
            $data = $comentario['data'];
            $texto = $comentario['texto'];
            $id_user = $comentario['id_user'];
            $id_local = $comentario['id_local'];
            $id_comentario = $comentario['id_comentario'];

            $obj = new Comentario($data,$texto,$id_user,$id_local,$id_comentario);
            $Listacomentario[] = $obj;
        }
        return $Listacomentario;
    }

    public function getComentariosLocal($idlocal)
    {
        $sql = 'SELECT * FROM comentarios where id_local = '.$idlocal;

        $resultado = $this->conexao->query($sql);

        $comentarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($comentarios as $comentario) {
            $data = $comentario['data'];
            $texto = $comentario['texto'];
            $id_user = $comentario['id_usuario'];
            $id_local = $comentario['id_local'];
            $id_comentario = $comentario['id_comentario'];

            $obj = new Comentario($data,$texto,$id_user,$id_local,$id_comentario);
            $Listacomentario[] = $obj;
        }
        return $Listacomentario;
    }

    public function insereComentario(Comentario $comentario){
        //$data = date_create('now')->format('Y-m-d H:i:s');
        $sql = "INSERT INTO comentarios (texto, id_usuario,id_local) 
                values ('{$comentario->getTexto()}','{$comentario->getIdUsuario()}','{$comentario->getIdLocal()}')";

        try {//TENTA EXECUTAR A INSTRUCAO

            echo $sql;
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }


    public function deleteComentario($idcomentario){

        $sql = "DELETE FROM comentarios WHERE id_comentario = '{$idcomentario}'";
        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

}