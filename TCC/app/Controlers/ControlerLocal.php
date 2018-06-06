<?php

    require_once __DIR__."/../Models/LocalCrud.php";
    require_once __DIR__."/../Models/CategoriaCrud.php";

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
        //include "../Views/template/Cabecalho.php";
        include "../Views/Local/show.php";
        //include "../Views/template/Rodape.php";

        break;

    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            //Pra mostrar os selects das categoria que possuem no banco
            $crudCat = new CategoriaCrud();
            $categorias = $crudCat->getCategorias();
            include "../Views/Local/cadastrar.php";
        } else {
            $crudCat = new CategoriaCrud();
            $categoria = $crudCat->getCategoriaNome($_POST['categoria']);
            $idcategoria = $categoria->id_categoria;
            $nomeArquivo = date('dmYhis').$_FILES['foto']['name'];
            $local = new Local($nomeArquivo, $_POST['nome'],  $_POST['email'], $_POST['endereco'], $_POST['telefone'], $_POST['descricao'], $idcategoria, $_POST['iduser']);
            $crudLocal = new LocalCrud();
            move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/Local/'.$nomeArquivo);
            $crudLocal->insertLocal($local);
            $id = $_POST['iduser'];
            header("Location: ControlerUsuario.php?acao=show&id=$id");
        }

        break;

    case 'editar':

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

            if ($_FILES['foto']['error'] == 0){
                $nomeArquivo = date('dmYhis').$_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/Local/'.$nomeArquivo);
            }else{
                $idlocal = $_GET['id'];
                $crud = new LocalCrud();
                $local = $crud->getLocal($idlocal);
                $nomeArquivo = $local->getFoto();
            }

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $descricao = $_POST['descricao'];
            $categoria= $_POST['categoria'];
            $iduser= $_POST['iduser'];
            $idlocal = $_GET['id'];

            $local = new Local($nomeArquivo,$nome, $email, $endereco,$telefone,$descricao, $categoria,  $iduser,  $idlocal);
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
