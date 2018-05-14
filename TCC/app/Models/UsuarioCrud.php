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
                //MONTA O TEXTO DA INSTRUÇÂO SQL
                $sql = "insert into usuarios (nome, login, senha, endereco, telefone, email, cpf, tipuser)
                values ('{$user->getNome()}','{$user->getLogin()}','{$user->getSenha()}','{$user->getEndereco()}','{$user->getTelefone()}','{$user->getEmail()}','{$user->getCpf()}',1)";

                try {//TENTA EXECUTAR A INSTRUCAO

                    $this->conexao->exec($sql);
                } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
                    return $e->getMessage();
                }
            }else{
                header("Location: ?acao=cadastrar&erro=1");
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function LoginUsuario(Usuario $user){
        $sql = $this->conexao->prepare("SELECT login,senha FROM usuarios WHERE login = '{$user->getLogin()}' AND senha = '{$user->getSenha()}'");
        $sql->execute();
        $resultado = $sql->rowCount();

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
            $usuario['endereco'],
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
            $endereco = $usuario['endereco'];
            $tipuser = $usuario['tipuser'];

            $obj = new Usuario($nome, $login, $senha, $email, $telefone, $cpf, $endereco, $tipuser);
            $listaUsuario[] = $obj;
        }
        return $listaUsuario;
    }

    public function deleteUsuario($id)
    {

        //EFETUA A CONEXAO
        $this->conexao = DBConnection::getConexao();
        //MONTA O TEXTO DA INSTRUÇÂO SQL
        $sql = "DELETE FROM usuarios WHERE id_usuario = '{$id}'";
        try {//TENTA EXECUTAR A INSTRUCAO

            $this->conexao->exec($sql);
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
                endereco = '{$user->getEndereco()}',
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



}