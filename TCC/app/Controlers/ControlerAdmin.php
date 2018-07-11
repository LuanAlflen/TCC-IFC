<?php

require '../../app/Models/UsuarioCrud.php';
require '../../app/Models/LocalCrud.php';
require '../../app/Models/CategoriaCrud.php';
require '../../app/Models/ComentarioCrud.php';

if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}
switch ($action){
    case 'index':

        $crudUser = new UsuarioCrud();
        $usuarios = $crudUser->getUsuarios();
        @session_start();
        $_SESSION['id'] = $_GET['id'];
        $crudLocais = new LocalCrud();
        $locais = $crudLocais->getLocais();
        include "../Views/Template/CabecalhoAdmin.php";
        include "../Views/Admin/admin.php";
        include "../Views/Template/Rodape.php";

        break;
}