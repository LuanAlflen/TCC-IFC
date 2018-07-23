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

    case 'editarUsuario':

        if(!isset($_POST['gravar'])){ // vai para o form
            $id = $_GET['id'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            include "../Views/Admin/editar.php";
        }else{ // já passou no form e fez submit
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $senha= $_POST['senha'];
            $telefone= $_POST['telefone'];
            $email= $_POST['email'];
            $cpf= $_POST['cpf'];
            $tipuser= $_POST['tipuser'];
            $id = $_GET['id'];
            $user = new Usuario($nome, $login, $senha, $email, $telefone, $cpf,  $tipuser, $id);
            $crud = new UsuarioCrud();
            $crud->updateUsuario($user);
            $idAdm = $_GET['idAdm'];
            header("Location: ControlerAdmin.php?id=$idAdm"); // chama o controlador
        }

        break;

    case 'excluirUsuario':

        $iduser = $_GET['id'];
        //EXCLUI LOCAIS, CASO TENHA
        $crudLocal = new LocalCrud();
        $crudLocal->deleteLocalUser($iduser);
        //EXCLUI USUARIO
        $cruduser = new UsuarioCrud();
        $resultado = $cruduser->deleteUsuario($iduser);
        $idAdm = $_GET['idAdm'];
        header("Location: ControlerAdmin.php?id=$idAdm");

        break;

    case 'editarLocal':

        if(!isset($_POST['gravar'])){ // vai para o form
            $idlocal = $_GET['idlocal'];
            $crud = new LocalCrud();
            $local = $crud->getLocal($idlocal);
            $idCat = $local->id_categoria;
            $crudCat = new CategoriaCrud();
            $categorias = $crudCat->getCategorias();
            $categoria = $crudCat->getCategoria($idCat);
            $nomeCat = $categoria->nome;
            include "../Views/Local/editar.php";
        }else{ // já passou no form e fez submit

            //VERIFICA SE EXISTE FOTO, SE NÃO RETORNA COMO NULL
            if ($_FILES['foto']['error'] == 0) {
                $nomeArquivo = date('dmYhis') . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/Local/' . $nomeArquivo);

            } else {
                //Pega a foto ja existente do banco;
                $idlocal = $_GET['idlocal'];
                $crud = new LocalCrud();
                $local = $crud->getLocal($idlocal);
                $nomeArquivo = $local->getFoto();
            }

            //VERIFICA SE OS CAMPOS DE SELECT FORAM PREENCHIDOS
            if ($_POST['categoria'] == 0 || $_POST['estados'] == 0 || $_POST['Municipio'] == 0){
                echo "Todos os campos devem ser preenchidos";
            } else {

                $local = new Local(
                    $nomeArquivo,
                    $_POST['nome'],
                    $_POST['email'],
                    $_POST['endereco'],
                    $_POST['numero'],
                    $_POST['telefone'],
                    $_POST['descricao'],
                    $_POST['estados'],
                    $_POST['Municipio'],
                    $_POST['categoria'],
                    $_POST['iduser'],
                    $_GET['idlocal']);

                $crudLocal = new LocalCrud();
                $crudLocal->updateLocal($local);
                $id = $_POST['iduser'];
                $idAdm = $_GET['idAdm'];
                header("Location: ControlerAdmin.php?id=$idAdm");
            }
        }

        break;

    case 'excluirLocal':

        $idlocal = $_GET['idlocal'];
        $iduser = $_GET['iduser'];
        $crud = new LocalCrud();
        $resultado = $crud->deleteLocal($idlocal);
        $locais = $crud->getLocalUser($iduser);
        $idAdm = $_GET['idAdm'];
        header("Location: ControlerAdmin.php?id=$idAdm");

        break;
}