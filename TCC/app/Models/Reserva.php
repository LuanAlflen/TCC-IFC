<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 31/07/2018
 * Time: 22:31
 */

class Reserva
{
    public $id;
    public $nome;
    public $cor;
    public $entrada;
    public $saida;
    public $id_local;
    public $id_user;

    public function __construct($nome=null,$cor=null,$entrada=null,$saida=null,$idlocal=null,$iduser=null,$id=null){
        $this->nome = $nome;
        $this->cor = $cor;
        $this->entrada = $entrada;
        $this->saida = $saida;
        $this->id_local = $idlocal;
        $this->id_user = $iduser;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function getEntrada()
    {
        return $this->entrada;
    }

    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;
    }

    public function getSaida()
    {
        return $this->saida;
    }

    public function setSaida($saida)
    {
        $this->saida = $saida;
    }

    public function getIdLocal()
    {
        return $this->id_local;
    }

    public function setIdLocal($id_local)
    {
        $this->id_local = $id_local;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }


}