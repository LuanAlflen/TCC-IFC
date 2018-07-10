<?php

    require "IP.php";

class IPCrud
{

    public function subredes($numerodeRedes){
        $resultado = 256/$numerodeRedes;
        return $resultado;
    }

    public function hostsEmCadaRede($mascara){
        $bits = 32 - $mascara;
        $resultado = pow(2,$bits);
        return $resultado;
    }

    public function mascara($decimal){
        if ($decimal <= 8){
            $bits = 8 - $decimal;
            $numero = pow(2,$bits);
            $primeiro = 256 - $numero;
            $mascara = "$primeiro.0.0.0";

            return $mascara;
        }elseif ($decimal > 8 AND $decimal <= 16){
            $bits = 16 - $decimal;
            $numero = pow(2,$bits);
            $segundo = 256 - $numero;
            $mascara = "255.$segundo.0.0";

            return $mascara;
        }elseif ($decimal > 16 AND $decimal <= 24){
            $bits = 24 - $decimal;
            $numero = pow(2,$bits);
            $terceiro = 256 - $numero;
            $mascara = "255.255.$terceiro.0";

            return $mascara;
        }else{
            $bits = 32 - $decimal;
            $numero = pow(2,$bits);
            $quarta = 256 - $numero;
            $mascara = "255.255.255.$quarta";

            return $mascara;
        }
    }

    public function classeIP($ip1){
        if ($ip1 < 128){
            $classe = "Classe A";
            return $classe;
        }elseif ($ip1 >= 128 AND $ip1 < 192){
            $classe = "Classe B";
            return $classe;
        }elseif ($ip1 >= 192 AND $ip1 < 224){
            $classe = "Classe C";
            return $classe;
        }elseif ($ip1 >= 224 AND $ip1 < 240){
            $classe = "Classe D";
            return $classe;
        }else{
            $classe = "Classe E";
            return $classe;
        }
    }

    public function privadoOuPublico($ip1,$ip2)
    {
        $exemplo1 = $ip1 . '.' . $ip2;
        $exemplo2 = $ip1 . '.' . $ip2;
        $exemplo3 = $ip1 . '.' . $ip2;
        if ($ip1 == 10) {
            $resultado = "Privado";
            return $resultado;
        } elseif ($ip1 == 127) {
            $resultado = "Reservado/Privado";
            return $resultado;
        } elseif ($exemplo1 == 172.16) {
            $resultado = "Privado";
            return $resultado;
        } elseif ($exemplo2 == 192.168) {
            $resultado = "Privado";
            return $resultado;
        } elseif ($exemplo2 == 169.254) {
            $resultado = "ZeroConf/Privado";
            return $resultado;
        }
    }

        public function rede($ip4,$numeroRedes){
            $calculo = (int)($ip4/$numeroRedes);
            $rede = ($calculo * $numeroRedes);
            return $rede;
    }
        public function broadcast($ip4,$numeroRedes){
            $calculo = (int)($ip4/$numeroRedes);
            $rede = $calculo * $numeroRedes;
            $broadcast = ($rede + $numeroRedes) - 1;
            return $broadcast;
        }

        public function primeiroValido($ip4,$numeroRedes){
            $calculo = (int)($ip4/$numeroRedes);
            $rede = ($calculo * $numeroRedes) + 1;
            return $rede;
        }
        public function ultimoValido($ip4,$numeroRedes){
            $calculo = (int)($ip4/$numeroRedes);
            $rede = $calculo * $numeroRedes;
            $broadcast = ($rede + $numeroRedes) - 2;
            return $broadcast;
        }
}
