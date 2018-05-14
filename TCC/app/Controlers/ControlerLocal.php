<?php

    require_once __DIR__."/../Models/LocalCrud.php";

    $crud = new LocalCrud();
    $listaLocais = $crud->getLocais();

    if (isset($_GET['acao'])){
        $action = $_GET['acao'];
    }else{
        $action = 'index';
    }

    switch ($action) {


    case 'show':

        $id = $_GET['idlocal'];
        $crud = new LocalCrud();
        $local = $crud->getLocal($id);
        include "../Views/template/Cabecalho.php";
        include "../Views/Local/show.php";
        include "../Views/template/Rodape.php";

        break;

    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            include "../Views/Local/cadastrar.php";
        } else {
            $local = new Local($_POST['nome'],  $_POST['email'], $_POST['endereco'], $_POST['telefone'], $_POST['descricao'], $_POST['categoria'], $_POST['iduser']);
            $test = new LocalCrud();
            $resultado = $test->insertLocal($local);
            $id = $_POST['iduser'];
            header("Location: ControlerUsuario.php?acao=show&id=$id");
        }

        break;

    case 'editar':

        if(!isset($_POST['gravar'])){ // vai para o form
            $idlocal = $_GET['idlocal'];
            $crud = new LocalCrud();
            $local = $crud->getLocal($idlocal);
            include "../Views/Local/editar.php";
        }else{ // já passou no form e fez submit
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $descricao = $_POST['descricao'];
            $categoria= $_POST['categoria'];
            $iduser= $_POST['iduser'];
            $idlocal = $_GET['id'];

            $local = new Local($nome, $email, $endereco,$telefone,$descricao, $categoria,  $iduser,  $idlocal);
            $crud = new LocalCrud();
            $crud->updateLocal($local);
            $locais = $crud->getLocalUser($iduser);
            include "../Views/Template/Cabecalho.php";
            include "../Views/Usuario/show.php";
            include "../Views/Template/Rodape.php";
        }

        break;

    case 'excluir':

        $idlocal = $_GET['idlocal'];
        $iduser = $_GET['iduser'];
        $crud = new LocalCrud();
        $resultado = $crud->deleteLocal($idlocal);
        $locais = $crud->getLocalUser($iduser);
        include "../Views/Template/Cabecalho.php";
        include "../Views/Usuario/show.php";
        include "../Views/Template/Rodape.php";

        break;




}

?>
