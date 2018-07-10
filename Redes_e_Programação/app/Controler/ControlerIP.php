<?php


require "../Model/IPCrud.php";
if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

    switch ($action){
        case 'index':

            include "../View/index.php";

            break;

        case 'resposta':

            $ip1 = $_POST['primeiroip'];
            $ip2 = $_POST['segundoip'];
            $ip3 = $_POST['terceiroip'];
            $ip4 = $_POST['quartoip'];
            $decimal = $_POST['mascara'];

            $ip = "$ip1".'.'."$ip2".'.'."$ip3".'.'."$ip4";
            $teste = new IP($ip,$decimal);
            $crud = new IPCrud();
            $numeroRedes = $crud->hostsEmCadaRede($decimal);
            $subredes = $crud->subredes($numeroRedes);
            $mascara = $crud->mascara($decimal);
            $classe = $crud->classeIP($ip1);
            $publicoOuPrivado = $crud->privadoOuPublico($ip1,$ip2);
            $rede = $crud->rede($ip4,$numeroRedes);
            $broadcast = $crud->broadcast($ip4,$numeroRedes);
            $primeiroValido = $crud->primeiroValido($ip4,$numeroRedes);
            $ultimoValido = $crud->ultimoValido($ip4,$numeroRedes);
            echo "IP: $ip/$decimal. \n
            Mascara: $mascara. \n
            A quantidade de sub-redes:$subredes  \n
            A quantidade de endereços por sub-rede; $numeroRedes.,
            A quantidade de endereços de hosts em cada sub-rede: ,
            Rede: $rede,
            Broadcast: $broadcast,
            Intervalo valido: $primeiroValido ~ $ultimoValido,
            Mascara em decimal: $decimal,
            Classe: $classe,
            Publico ou Privado: $publicoOuPrivado.
            
            ";

            break;
    }
?>