<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 13/07/18
 * Time: 15:02
 */

require_once 'DBConnection.php';

class Municipio
{
    public $id_municipio;
    public $nome;
    public $id_estado;

    public function __construct($nome=null,$id_estado=null,$id_municipio=null){
        $this->nome = $nome;
        $this->id_estado = $id_estado;
        $this->id = $id_municipio;
    }

    /**
     * @return null
     */
    public function getIdMunicipio()
    {
        return $this->id;
    }

    /**
     * @param null $id_municipio
     */
    public function setIdMunicipio($id_municipio)
    {
        $this->id = $id_municipio;
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

    /**
     * @return null
     */
    public function getIdEstado()
    {
        return $this->id_estado;
    }

    /**
     * @param null $id_estado
     */
    public function setIdEstado($id_estado)
    {
        $this->id_estado = $id_estado;
    }




}