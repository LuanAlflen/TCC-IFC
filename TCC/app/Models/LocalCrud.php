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
        $objetoLocal = new Local(
            $local['foto']
            ,$local['nome'],
            $local['email'],
            $local['endereco'],
            $local['numero'],
            $local['telefone'],
            $local['descricao'],
            $local['id_estado'],
            $local['id_municipio'],
            $local['id_categoria'],
            $local['id_usuario'],
            $local['id_local']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoLocal;

    }


    public function getLocais()
    {
        $sql = "SELECT * FROM locais";

        $resultado = $this->conexao->query($sql);

        $locais = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($locais as $local) {
            $foto = $local['foto'];
            $nome = $local['nome'];
            $email = $local['email'];
            $endereco = $local['endereco'];
            $numero = $local['numero'];
            $telefone = $local['telefone'];
            $descricao = $local['descricao'];
            $estados = $local['id_estado'];
            $municipios = $local['id_municipio'];
            $idcategoria = $local['id_categoria'];
            $iduser = $local['id_usuario'];
            $idlocal = $local['id_local'];

            $obj = new Local($foto,$nome, $email, $endereco, $numero, $telefone, $descricao, $estados, $municipios, $idcategoria, $iduser, $idlocal);
            $Listalocal[] = $obj;
        }
        return $Listalocal;
    }

    public function insertLocal(Local $local){
        $sql = "insert into locais (foto, nome, email, endereco, numero, telefone, descricao, id_estado, id_municipio, id_categoria, id_usuario)
                values (
                '{$local->getFoto()}',
                '{$local->getNome()}',
                '{$local->getEmail()}',
                '{$local->getEndereco()}',
                '{$local->getNumero()}',
                '{$local->getTelefone()}',
                '{$local->getDescricao()}',
                '{$local->getIdEstado()}', 
                '{$local->getIdMunicipio()}', 
                '{$local->getIdCategoria()}',
                '{$local->getIdUsuario()}')";
        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
            }
        }

    public function getLocalUser($id){
        $sql = $this->conexao->prepare("SELECT * FROM locais WHERE id_usuario = $id");
        $sql->execute();
        $resultado = $sql->rowCount();

        if($resultado == 0){
            header("Location: ?acao=login&erro=4");
            die;
        }else{
            $sql = "SELECT * FROM locais WHERE id_usuario = $id";

            $result = $this->conexao->query($sql);

            $locais = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach ($locais as $local) {
                $foto = $local['foto'];
                $nome = $local['nome'];
                $email = $local['email'];
                $endereco = $local['endereco'];
                $numero = $local['numero'];
                $telefone = $local['telefone'];
                $descricao = $local['descricao'];
                $id_estado = $local['id_estado'];
                $id_municipio = $local['id_municipio'];
                $idcategoria = $local['id_categoria'];
                $idusuarios = $local['id_usuario'];
                $idlocal = $local['id_local'];


                $obj = new Local($foto, $nome, $email, $endereco, $numero, $telefone, $descricao, $id_estado, $id_municipio, $idcategoria, $idusuarios, $idlocal);
                $listaLocais[] = $obj;
            }
            return $listaLocais;
        }
    }

    public function updateLocal(Local $local)
    {

        //MONTA O TEXTO DA INSTRUÇÃO SQL DE INSERT
        $sql = "UPDATE locais 
                SET id_local = '{$local->getIdLocal()}', 
                foto = '{$local->getFoto()}', 
                nome = '{$local->getNome()}', 
                email = '{$local->getEmail()}', 
                endereco = '{$local->getEndereco()}',
                numero = '{$local->getNumero()}',
                telefone = '{$local->getTelefone()}',
                descricao = '{$local->getDescricao()}',
                id_estado = '{$local->getIdEstado()}',
                id_municipio = '{$local->getIdMunicipio()}',
                id_categoria = '{$local->getIdCategoria()}',
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

    public function deleteLocalUser($iduser){
        //VERIFICA SE O USUARIO POSSUI LOCAIS, SE SIM, EXCLUI TODOS E RETORNA TRUE, SE NAO, RETORNA FALSE
        $sql = $this->conexao->prepare("SELECT * FROM locais WHERE id_usuario = '{$iduser}'");
        $sql->execute();
        $resultado = $sql->rowCount();

        if ($resultado == 0){
            echo "nenhum";
            return false;
        }else{
            $sql = "DELETE FROM locais WHERE id_usuario = '{$iduser}'";
            $this->conexao->exec($sql);
            echo "exclui";
            return true;
        }
    }


}