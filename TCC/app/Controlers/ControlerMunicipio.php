<?php

require_once '../Models/MunicipioCrud.php';

if (isset($_GET['acao'])){
    $action = $_GET['acao'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index':

        $id = $_GET['id'];
        $crud = new MunicipioCrud();
        $municipios = $crud->getMunicipiosPorEstado($id);

        header('Cotent-type:application/json');
        echo json_encode($municipios);
        break;
}

?>