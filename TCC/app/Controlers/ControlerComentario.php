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

    case 'cadastrar':

        $idlocal = $_POST['idlocal'];
        $iduser = $_POST['iduser'];
        $comentario = new Comentario(null,$_POST['texto'], $_POST['iduser'], $idlocal);
        $crud = new ComentarioCrud();
        $crud->insereComentario($comentario);
        header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal&iduser=$iduser");

        break;

    case 'excluir':

        $idcomentario = $_GET['idcomentario'];
        $idUserComentario = $_GET['idusercomentario'];
        $idUserLogado = $_GET['iduserlogado'];
        $idlocal = $_GET['idlocal'];

        if ($idUserComentario == $idUserLogado){
            $crud = new ComentarioCrud();
            $crud->deleteComentario($idcomentario);
            header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal&iduser=$idUserLogado");
        }else{
            header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal&iduser=$idUserLogado&erro=1");
        }
        break;



}