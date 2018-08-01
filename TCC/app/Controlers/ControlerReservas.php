<?php

        require_once __DIR__."/../Models/LocalCrud.php";
        require_once __DIR__."/../Models/CategoriaCrud.php";
        require_once __DIR__."/../Models/UsuarioCrud.php";
        require_once __DIR__."/../Models/ComentarioCrud.php";
        require_once __DIR__."/../Models/ReservaCrud.php";


if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

function getEstado($id){
    $url = 'http://localhost/3info1/TCC/app/Controlers/ControlerEstado.php?acao=porId&id='.$id; // dados de um estado

    $data = file_get_contents($url); // put the contents of the file into a variable
    $estado = json_decode($data); // decode the JSON feed
    return $estado;
}

function getMunicipio($id){
    $url = 'http://localhost/3info1/TCC/app/Controlers/ControlerMunicipio.php?acao=porId&id='.$id; // dados de um estado

    $data = file_get_contents($url); // put the contents of the file into a variable
    $municipio = json_decode($data); // decode the JSON feed
    return $municipio;
}


switch ($action) {
    case 'index':

        $idlocal = $_GET['idlocal'];
        @session_start();
        $_SESSION['id'] = $_GET['iduser'];

        include "../Views/Template/Cabecalho.php";
        include "../Views/CalendarioReservas/index.php";

        break;
}

?>