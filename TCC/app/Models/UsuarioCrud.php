<?php

require_once 'DBConnection.php';
require_once 'Usuario.php';
class UsuarioCrud
{
    //SEMPRE QUE A CLASSE FOR INSTANCIADA, JA FAZ A CONEXÃO E GUARDA
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }
    //RETORNA VERDADEIRO OU FALSA

    public function insertUsuario(Usuario $user){
        $sql = $this->conexao->prepare("SELECT login FROM usuarios WHERE login = '{$user->getLogin()}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        try{
            if ($resultado < 1){
                //EFETUA A CONEXAO
                $this->conexao = DBConnection::getConexao();
                $sql = "insert into usuarios (nome, login, senha, telefone, email, cpf, tipuser)
                values ('{$user->getNome()}','{$user->getLogin()}','{$user->getSenha()}','{$user->getTelefone()}','{$user->getEmail()}','{$user->getCpf()}','comum')";

                try {//TENTA EXECUTAR A INSTRUCAO
                    $this->conexao->exec($sql);
                } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
                    return $e->getMessage();
                }
            }else{
                $_SESSION['erro'] = "<div class=\"error-text\" style=\"color: red\">Este login ja existe, tente novamente.</div>";
                header("Location: ?acao=cadastrar");
                die();
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function LoginUsuario(Usuario $user){
        $sql = $this->conexao->prepare("SELECT login FROM usuarios WHERE login = '{$user->getLogin()}'");
        $sql->execute();
        $resultado = $sql->rowCount();
       return $resultado;
    }

    public function senhaCriptografada($login){
        $sql = "SELECT * FROM usuarios WHERE login = '{$login}'";
        $resultado = $this->conexao->query($sql);
        $resultado = $resultado->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getUsuario($login)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = "select * from usuarios where login='{$login}'";
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoUsuario = new Usuario(
            $usuario['nome'],
            $usuario['login'],
            $usuario['senha'],
            $usuario['email'],
            $usuario['telefone'],
            $usuario['cpf'],
            $usuario['tipuser'],
            $usuario['id_usuario']
        );

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoUsuario;

    }

    public function getUsuarioId($iduser)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = "select * from usuarios where id_usuario='{$iduser}'";
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $usuario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoUsuario = new Usuario(
            $usuario['nome'],
            $usuario['login'],
            $usuario['senha'],
            $usuario['email'],
            $usuario['telefone'],
            $usuario['cpf'],
            $usuario['tipuser'],
            $usuario['id_usuario']
        );

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoUsuario;

    }

    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";

        $resultado = $this->conexao->query($sql);

        $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario) {
            $nome = $usuario['nome'];
            $login = $usuario['login'];
            $senha = $usuario['senha'];
            $email = $usuario['email'];
            $telefone = $usuario['telefone'];
            $cpf = $usuario['cpf'];
            $tipuser = $usuario['tipuser'];
            $id = $usuario['id_usuario'];

            $obj = new Usuario($nome, $login, $senha, $email, $telefone, $cpf, $tipuser,$id);
            $listaUsuario[] = $obj;
        }
        return $listaUsuario;
    }
    public function getUsuariosOrdem()
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";

        $resultado = $this->conexao->query($sql);

        $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario) {
            $nome = $usuario['nome'];
            $login = $usuario['login'];
            $senha = $usuario['senha'];
            $email = $usuario['email'];
            $telefone = $usuario['telefone'];
            $cpf = $usuario['cpf'];
            $tipuser = $usuario['tipuser'];
            $id = $usuario['id_usuario'];

            $obj = new Usuario($nome, $login, $senha, $email, $telefone, $cpf, $tipuser,$id);
            $listaUsuario[] = $obj;
        }
        return $listaUsuario;
    }

    public function deleteUsuario($id)
    {
        $this->conexao = DBConnection::getConexao();
        //VERIFICA SE EXISTE COMENTARIOS, SE SIM, EXCLUI
        $sql = $this->conexao->prepare("SELECT * FROM comentarios WHERE id_usuario = '{$id}'");
        $sql->execute();
        $resultado = $sql->rowCount();
        if ($resultado != 0){
            $sql = "DELETE FROM comentarios WHERE id_usuario = '{$id}'";
            $this->conexao->exec($sql);
        }

        $this->conexao = DBConnection::getConexao();
        //VERIFICA SE EXISTE RESERVAS, SE SIM, EXCLUI
        $sqlreserva = $this->conexao->prepare("SELECT * FROM reservas WHERE id_usuario = '{$id}'");
        $sqlreserva->execute();
        $resultado = $sqlreserva->rowCount();
        if ($resultado != 0){
            $sqlreserva = "DELETE FROM reservas WHERE id_usuario = '{$id}'";
            $this->conexao->exec($sqlreserva);
        }

        //EXCLUI O USUARIO
        $sqluser = "DELETE FROM usuarios WHERE id_usuario = '{$id}'";
        try {//TENTA EXECUTAR A INSTRUCAO
            $this->conexao->exec($sqluser);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function updateUsuario(Usuario $user)
    {

        //MONTA O TEXTO DA INSTRUÇÃO SQL DE INSERT
        $sql = "UPDATE usuarios 
                SET id_usuario = '{$user->getId()}', 
                nome = '{$user->getNome()}', 
                login = '{$user->getLogin()}', 
                senha = '{$user->getSenha()}',
                telefone = '{$user->getTelefone()}',
                email = '{$user->getEmail()}',
                cpf = '{$user->getCpf()}',
                tipuser = '{$user->getTipuser()}'
                WHERE id_usuario = '{$user->getId()}'";


        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

    public function existeCPF($cpf){
        $sql = $this->conexao->prepare("SELECT * FROM usuarios WHERE cpf = '{$cpf}'");
        $sql->execute();
        $resultado = $sql->rowCount();

        return $resultado;

    }


}
