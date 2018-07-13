<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 13/07/18
 * Time: 15:01
 */
require_once 'DBConnection.php';

class Estado
{
    public $id;
    public $sigla;
    public $nome;

    public function __construct($sigla=null,$nome=null, $id=null){
        $this->sigla = $sigla;
        $this->nome = $nome;
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getIdEstado()
    {
        return $this->id;
    }

    /**
     * @param null $id_estado
     */
    public function setIdEstado($id_estado)
    {
        $this->id = $id_estado;
    }

    /**
     * @return null
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param null $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * @return null
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param null $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }




}