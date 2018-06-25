<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 25/06/18
 * Time: 16:13
 */


class Comentario
{
    public $id_comentario;
    public $data;
    public $texto;
    public $id_usuario;
    public $id_local;

    public function __construct($data=null, $texto=null,$id_usuario=null,$id_local=null, $id_comentario=null){
        $this->data = $data;
        $this->texto = $texto;
        $this->id_usuario = $id_usuario;
        $this->id_local = $id_local;
        $this->id_comentario = $id_comentario;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getIdLocal()
    {
        return $this->id_local;
    }

    /**
     * @param mixed $id_local
     */
    public function setIdLocal($id_local)
    {
        $this->id_local = $id_local;
    }

}
