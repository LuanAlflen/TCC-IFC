<?php

class Local
{
    public $id_local;
    public $foto;
    public $nome;
    public $email;
    public $endereco;
    public $numero;
    public $telefone;
    public $descricao;
    public $id_estado;
    public $id_municipio;
    public $id_categoria;
    public $id_usuario;

    public function __construct($foto=null, $nome=null,$email=null,$endereco=null,$numero=null,$telefone=null,$descricao=null,$id_estado=null,$id_municipio=null,$id_categoria=null, $id_usuario=null,$id_local=null){
        $this->foto = $foto;
        $this->nome = $nome;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->telefone = $telefone;
        $this->descricao = $descricao;
        $this->id_estado = $id_estado;
        $this->id_municipio = $id_municipio;
        $this->id_categoria = $id_categoria;
        $this->id_usuario = $id_usuario;
        $this->id_local = $id_local;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
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
    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function getIdEstado()
    {
        return $this->id_estado;
    }
    public function setIdEstado($id_estado)
    {
        $this->id_estado = $id_estado;
    }
    public function getIdMunicipio()
    {
        return $this->id_municipio;
    }
    public function setIdMunicipio($id_municipio)
    {
        $this->id_municipio = $id_municipio;
    }




}