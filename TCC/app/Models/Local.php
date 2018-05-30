<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 26/03/2018
 * Time: 14:33
 */

class Local
{
    public $id_local;
    public $nome;
    public $email;
    public $endereco;
    public $telefone;
    public $descricao;
    public $id_categoria;
    public $id_usuario;

    public function __construct($nome=null,$email=null,$endereco=null,$telefone=null,$descricao=null,$id_categoria=null, $id_usuario=null,$id_local=null){
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->descricao = $descricao;
        $this->id_categoria = $id_categoria;
        $this->id_usuario = $id_usuario;
        $this->id_local = $id_local;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function getIdLocal()
    {
        return $this->id_local;
    }

    public function setIdLocal($id_local)
    {
        $this->id_local = $id_local;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }



}