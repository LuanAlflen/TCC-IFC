<?php

require_once '../Models/EstadoCrud.php';

if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index':

        $crud = new EstadoCrud();
        $estados = $crud->getEstados();

        header('Cotent-type:application/json');
        echo json_encode($estados);

        break;
    case 'porId':

        $id = $_GET['id'];
        $crud = new EstadoCrud();
        $estado = $crud->getEstado($id);
        header('Cotent-type:application/json');
        echo json_encode($estado);
        break;

}

?>