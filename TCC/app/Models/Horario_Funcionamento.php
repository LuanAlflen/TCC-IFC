<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 06/08/2018
 * Time: 00:35
 */

class Horario_Funcionamento
{
    public $id;
    public $seg;
    public $seg1;
    public $ter;
    public $ter1;
    public $qua;
    public $qua1;
    public $qui;
    public $qui1;
    public $sex;
    public $sex1;
    public $sab;
    public $sab1;
    public $dom;
    public $dom1;
    public $id_local;

    public function __construct($seg=null,$seg1=null,$ter=null,$ter1=null,$qua=null,$qua1=null,$qui=null,$qui1=null,$sex=null,$sex1=null,$sab=null,$sab1=null,$dom=null,$dom1=null,$id_local=null,$id=null){
        $this->seg= $seg;
        $this->seg1= $seg1;
        $this->ter= $ter;
        $this->ter1= $ter1;
        $this->qua= $qua;
        $this->qua1= $qua1;
        $this->qui= $qui;
        $this->qui1= $qui1;
        $this->sex= $sex;
        $this->sex1= $sex1;
        $this->sab= $sab;
        $this->sab1= $sab1;
        $this->dom= $dom;
        $this->dom1= $dom1;
        $this->id_local= $id_local;
        $this->id= $id;
    }


    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getSeg()
    {
        return $this->seg;
    }

    /**
     * @param null $seg
     */
    public function setSeg($seg)
    {
        $this->seg = $seg;
    }

    /**
     * @return null
     */
    public function getSeg1()
    {
        return $this->seg1;
    }

    /**
     * @param null $seg1
     */
    public function setSeg1($seg1)
    {
        $this->seg1 = $seg1;
    }

    /**
     * @return null
     */
    public function getTer()
    {
        return $this->ter;
    }

    /**
     * @param null $ter
     */
    public function setTer($ter)
    {
        $this->ter = $ter;
    }

    /**
     * @return null
     */
    public function getTer1()
    {
        return $this->ter1;
    }

    /**
     * @param null $ter1
     */
    public function setTer1($ter1)
    {
        $this->ter1 = $ter1;
    }

    /**
     * @return null
     */
    public function getQua()
    {
        return $this->qua;
    }

    /**
     * @param null $qua
     */
    public function setQua($qua)
    {
        $this->qua = $qua;
    }

    /**
     * @return null
     */
    public function getQua1()
    {
        return $this->qua1;
    }

    /**
     * @param null $qua1
     */
    public function setQua1($qua1)
    {
        $this->qua1 = $qua1;
    }

    /**
     * @return null
     */
    public function getQui()
    {
        return $this->qui;
    }

    /**
     * @param null $qui
     */
    public function setQui($qui)
    {
        $this->qui = $qui;
    }

    /**
     * @return null
     */
    public function getQui1()
    {
        return $this->qui1;
    }

    /**
     * @param null $qui1
     */
    public function setQui1($qui1)
    {
        $this->qui1 = $qui1;
    }

    /**
     * @return null
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param null $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return null
     */
    public function getSex1()
    {
        return $this->sex1;
    }

    /**
     * @param null $sex1
     */
    public function setSex1($sex1)
    {
        $this->sex1 = $sex1;
    }

    /**
     * @return null
     */
    public function getSab()
    {
        return $this->sab;
    }

    /**
     * @param null $sab
     */
    public function setSab($sab)
    {
        $this->sab = $sab;
    }

    /**
     * @return null
     */
    public function getSab1()
    {
        return $this->sab1;
    }

    /**
     * @param null $sab1
     */
    public function setSab1($sab1)
    {
        $this->sab1 = $sab1;
    }

    /**
     * @return null
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * @param null $dom
     */
    public function setDom($dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return null
     */
    public function getDom1()
    {
        return $this->dom1;
    }

    /**
     * @param null $dom1
     */
    public function setDom1($dom1)
    {
        $this->dom1 = $dom1;
    }

    /**
     * @return null
     */
    public function getIdLocal()
    {
        return $this->id_local;
    }

    /**
     * @param null $id_local
     */
    public function setIdLocal($id_local)
    {
        $this->id_local = $id_local;
    }


}