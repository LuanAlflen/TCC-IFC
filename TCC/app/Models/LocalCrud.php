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

    public function getLocaisPesquisa($texto)
    {
        $sql = "SELECT * FROM locais WHERE nome like '%{$texto}%'";
//        echo $sql;die;

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

    public function getLocaisOrdem()
    {
        $sql = "SELECT * FROM locais ORDER BY nome ASC ";

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

    public function getLocaisLimit($pagina, $inicio)
    {
        $sql = "SELECT * FROM locais LIMIT $pagina OFFSET $inicio";
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

    public function numeroTotalDeLocais(){
        $sql = $this->conexao->prepare("SELECT * FROM locais");
        $sql->execute();
        $resultado = $sql->rowCount();
        return $resultado;
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
            $id = $this->conexao->lastInsertId();
            return $id;
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
            }
        }

    public function getLocalUser($id){

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
        $sql = $this->conexao->prepare("SELECT * FROM comentarios WHERE id_local = '{$id}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        if ($resultado != 0){
            $sql = "DELETE FROM comentarios WHERE id_local = '{$id}'";
            $this->conexao->exec($sql);
        }

        $this->conexao = DBConnection::getConexao();
        //VERIFICA SE EXISTE RESERVAS, SE SIM, EXCLUI
        $sqlreserva = $this->conexao->prepare("SELECT * FROM reservas WHERE id_local = '{$id}'");
        $sqlreserva->execute();
        $resultado = $sqlreserva->rowCount();
        if ($resultado != 0){
            $sqlreserva = "DELETE FROM reservas WHERE id_local= '{$id}'";
            $this->conexao->exec($sqlreserva);
        }

        $this->conexao = DBConnection::getConexao();
        //VERIFICA SE EXISTE RESERVAS, SE SIM, EXCLUI
        $sqlhorario = $this->conexao->prepare("SELECT * FROM horario_funcionamento WHERE id_local = '{$id}'");
        $sqlhorario->execute();
        $resultado = $sqlhorario->rowCount();
        if ($resultado != 0){
            $sqlhorario= "DELETE FROM horario_funcionamento WHERE id_local = '{$id}'";
            $this->conexao->exec($sqlhorario);
        }

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
            return false;
        }else{
            //VERIFICA SE ESSE(s) LOCAL POSSUIEM COMENTARIOS, SE SIM, EXCLUI
            $crud = new LocalCrud();
            $locais = $crud->getLocalUser($iduser);

            foreach ($locais as $local){


                //VERIFICA SE EXISTE COMENTARIOS, SE SIM, EXCLUI
                $sqlcomentario = $this->conexao->prepare("SELECT * FROM comentarios WHERE id_local = '{$local->id_local}'");
                $sqlcomentario->execute();
                $resultado = $sqlcomentario->rowCount();
                if ($resultado != 0){
                    $sqlcomentario = "DELETE FROM comentarios WHERE id_local = '{$local->id_local}'";
                    $this->conexao->exec($sqlcomentario);
                }

                $this->conexao = DBConnection::getConexao();
                //VERIFICA SE EXISTE RESERVAS, SE SIM, EXCLUI
                $sqlreserva = $this->conexao->prepare("SELECT * FROM reservas WHERE id_local = '{$local->id_local}'");
                $sqlreserva->execute();
                $resultado = $sqlreserva->rowCount();
                if ($resultado != 0){
                    $sqlreserva = "DELETE FROM reservas WHERE id_local= '{$local->id_local}'";
                    $this->conexao->exec($sqlreserva);
                }

                $this->conexao = DBConnection::getConexao();
                //VERIFICA SE EXISTE HORARIOS, SE SIM, EXCLUI
                $sqlhorario = $this->conexao->prepare("SELECT * FROM horario_funcionamento WHERE id_local = '{$local->id_local}'");
                $sqlhorario->execute();
                $resultado = $sqlhorario->rowCount();
                if ($resultado != 0){
                    $sqlhorario= "DELETE FROM horario_funcionamento WHERE id_local = '{$local->id_local}'";
                    $this->conexao->exec($sqlhorario);
                }


            }



            $sqllocal = "DELETE FROM locais WHERE id_usuario = '{$iduser}'";
            $this->conexao->exec($sqllocal);
            return true;
        }
    }

    public function existeComentarios($idlocal){
        $sql = $this->conexao->prepare("SELECT * FROM comentarios WHERE id_local = '{$idlocal}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        return $resultado;
    }

    public function validaBusca($busca){
        $sql = $this->conexao->prepare("SELECT * FROM locais WHERE nome LIKE '%{$busca}%'");
        $sql->execute();
        $resultado = $sql->rowCount();
        return $resultado;
    }

    public function buscaLocais($busca, $pagina, $inicio){
        $sql = "SELECT * FROM locais WHERE nome LIKE '%{$busca}%' LIMIT $pagina OFFSET $inicio";
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

}