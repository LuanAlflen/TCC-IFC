<?php

require_once 'DBConnection.php';
require_once 'Local.php';

class LocalCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }

    public function getLocal($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from locais where id_local='.$id;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $local = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoLocal = new Local($local['nome'], $local['email'], $local['endereco'], $local['telefone'], $local['descricao'], $local['categoria'], $local['id_usuario'], $local['id_local']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoLocal;

    }


    public function getLocais()
    {
        $sql = "SELECT * FROM locais";

        $resultado = $this->conexao->query($sql);

        $locais = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($locais as $local) {
            $idlocal = $local['id_local'];
            $nome = $local['nome'];
            $email = $local['email'];
            $endereco = $local['endereco'];
            $telefone = $local['telefone'];
            $descricao = $local['descricao'];
            $categoria = $local['categoria'];
            $iduser = $local['id_usuario'];

            $obj = new Local($nome, $email, $endereco, $telefone, $descricao, $categoria, $iduser, $idlocal);
            $Listalocal[] = $obj;
        }
        return $Listalocal;
    }

    public function insertLocal(Local $local){
        $sql = "insert into locais (nome, email, endereco, telefone, descricao, categoria, id_usuario)
                values ('{$local->getNome()}','{$local->getEmail()}','{$local->getEndereco()}','{$local->getTelefone()}','{$local->getDescricao()}','{$local->getCategoria()}','{$local->getIdUsuario()}')";

        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
            }
        }

    public function getLocalUser($id)
    {
        $sql = "SELECT * FROM locais WHERE id_usuario = $id";

        $result = $this->conexao->query($sql);

        $locais = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($locais as $local){
            $idlocal = $local['id_local'];
            $nome = $local['nome'];
            $email = $local['email'];
            $endereco = $local['endereco'];
            $telefone = $local['telefone'];
            $descricao = $local['descricao'];
            $categoria = $local['categoria'];
            $idusuarios = $local['id_usuario'];


            $obj = new Local($nome,$email,$endereco,$telefone,$descricao,$categoria,$idusuarios,$idlocal);
            $listaLocais[] = $obj;
        }
        return $listaLocais;

    }

    public function updateLocal(Local $local)
    {

        //MONTA O TEXTO DA INSTRUÇÃO SQL DE INSERT
        $sql = "UPDATE locais 
                SET id_local = '{$local->getIdLocal()}', 
                nome = '{$local->getNome()}', 
                email = '{$local->getEmail()}', 
                endereco = '{$local->getEndereco()}',
                telefone = '{$local->getTelefone()}',
                descricao = '{$local->getDescricao()}',
                categoria = '{$local->categoria}',
                id_usuario = '{$local->getIdUsuario()}'
                WHERE id_local = '{$local->getIdLocal()}'";


        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function deleteLocal($id)
    {

        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "DELETE FROM locais WHERE id_local = '{$id}'";
        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

}