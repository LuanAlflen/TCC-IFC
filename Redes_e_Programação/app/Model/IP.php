<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 29/06/18
 * Time: 14:13
 */

class IP
{
    public $ip;
    public $mascara;

    public function __construct($ip=null,$mascara=null)
    {
        $this->ip = $ip;
        $this->mascara = $mascara;
    }

    /**
     * @return null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param null $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return null
     */
    public function getMascara()
    {
        return $this->mascara;
    }

    /**
     * @param null $mascara
     */
    public function setMascara($mascara)
    {
        $this->mascara = $mascara;
    }


}