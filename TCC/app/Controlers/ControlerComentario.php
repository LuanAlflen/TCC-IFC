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

switch ($action) {

    case 'cadastrar':

        $idlocal = $_POST['idlocal'];
        $comentario = new Comentario($_POST['texto'], $_POST['iduser'], $idlocal);
        $crud = new ComentarioCrud();
        $crud->insereComentario($comentario);
        header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal");

        break;

    case 'excluir':

        echo "para excluir comentario é necessario verificar se o cara logado é o mesmo de quem fez o comentario ou seja o dono da quadra";

        break;
}