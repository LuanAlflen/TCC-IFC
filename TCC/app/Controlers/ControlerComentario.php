<?php
if (!isset($_SESSION)) {
    session_start();
}
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
        $iduser = $_SESSION['id'];


        if ($iduser == 1){
            header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal&erro=naologado");
            die;
        }
        $comentario = new Comentario(null,$_POST['texto'], $_SESSION['id'], $idlocal);
        $crud = new ComentarioCrud();
        $crud->insereComentario($comentario);
        header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal");

        break;

    case 'excluir':

        $idcomentario = $_GET['idcomentario'];
        $crud = new ComentarioCrud();
        $comentario = $crud->getComentario($idcomentario);
        $idUserComentario = $comentario->getIdUsuario();
        $idUserLogado = $_SESSION['id'];
        $idlocal = $_GET['idlocal'];
        $crudUser = new UsuarioCrud();
        $user = $crudUser->getUsuarioId($idUserLogado);
        $tipuser = $user->getTipuser();

        if ($idUserComentario == $idUserLogado OR $tipuser == 'admin'){
            $crud->deleteComentario($idcomentario);
            $_SESSION['erro'] = "<div class='alert alert-success' role='alert'>Comentário excluído com sucesso!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal");
        }else{
            $_SESSION['erro'] = "<div class='alert alert-danger' role='alert'>Só é possível excluir seus próprios comentários!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: ControlerLocal.php?acao=show&idlocal=$idlocal");
        }
        break;



}