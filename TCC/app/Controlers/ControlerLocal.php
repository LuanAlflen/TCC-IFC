<?php

    require_once __DIR__."/../Models/LocalCrud.php";
    require_once __DIR__."/../Models/CategoriaCrud.php";
    require_once __DIR__."/../Models/UsuarioCrud.php";
    require_once __DIR__."/../Models/ComentarioCrud.php";

    $crud = new LocalCrud();
    $listaLocais = $crud->getLocais();

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

        if (isset($_POST['busca'])){
            //FAZ A BUSCA POR NOME DOS LOCAIS
            $busca = $_POST['busca'];
            $crudLocal = new LocalCrud();
            $resultado = $crudLocal->validaBusca($busca);
            //VERIFICA SE A BUSCA DO LOCAL EXISTE, SE NÃO, EXIBE UMA MENSAGEM DE ERRO, SE SIM, MOSTRA APENAS OS LOCAIS PROCURADOS
            if ($resultado == 0){
                session_start();
                $_SESSION['id'] = $_GET['iduser'];
                $crudCat = new CategoriaCrud();
                $categorias = $crudCat->getCategorias();

                include "../Models/restrito.php";
                include "../Views/Template/Cabecalho.php";
                include "../Views/PaginaPrincipal/index.php";
                include "../Views/Template/Rodape.php";
            }else{
                session_start();
                $_SESSION['id'] = $_GET['iduser'];
                //PARA EXIBIR TODOS OS LOCAIS
                $crudLocal = new LocalCrud();
                @$locais = $crudLocal->buscaLocais($busca);
                $crudCat = new CategoriaCrud();
                $categorias = $crudCat->getCategorias();

                include "../Models/restrito.php";
                include "../Views/Template/Cabecalho.php";
                include "../Views/PaginaPrincipal/index.php";
                include "../Views/Template/Rodape.php";
            }
        }else{
            session_start();
            $_SESSION['id'] = $_GET['iduser'];
            //PARA EXIBIR TODOS OS LOCAIS
            $resultado = 1;
            $crudLocal = new LocalCrud();
            @$locais = $crudLocal->getLocais();
            $crudCat = new CategoriaCrud();
            $categorias = $crudCat->getCategorias();

            include "../Models/restrito.php";
            include "../Views/Template/Cabecalho.php";
            include "../Views/PaginaPrincipal/index.php";
            include "../Views/Template/Rodape.php";
        }


        break;

    case 'show':

        $idlocal = $_GET['idlocal'];
        $_SESSION['id'] = $idlocal;
        $crudLocal = new LocalCrud();
        $local = $crudLocal->getLocal($idlocal);
        include "../Views/Template/Cabecalholocal.php";
        include "../Views/Local/show.php";
        include "../Views/Template/Rodape.php";

        break;

    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            //Pra mostrar os selects das categoria que possuem no banco
            $crudCat = new CategoriaCrud();
            $categorias = $crudCat->getCategorias();
            include "../Views/Local/cadastrar.php";
        } else {

            //VERIFICA SE EXISTE FOTO, SE NÃO RETORNA COMO NULL
            if ($_FILES['foto']['error'] == 0) {
                $nomeArquivo = date('dmYhis') . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/Local/' . $nomeArquivo);

            } else {
                $nomeArquivo = null;
            }

            //TRANSFORMA O NOME DA CATEGORIA EM ID PARA CADASTRAR
            $crudCat = new CategoriaCrud();
            $categoria = $crudCat->getCategoriaNome($_POST['categoria']);
            $idcategoria = $categoria->id_categoria;

            //VERIFICA SE OS CAMPOS DE SELECT FORAM PREENCHIDOS
            if (!isset($idcategoria) || $_POST['estados'] == 0 || $_POST['Municipio'] == 0){
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
                    $_POST['municipios'],
                    $idcategoria,
                    $_POST['iduser']);

                $crudLocal = new LocalCrud();
                $crudLocal->insertLocal($local);
                $id = $_POST['iduser'];
                header("Location: ControlerUsuario.php?acao=show&id=$id");
            }
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
                    $_POST['municipios'],
                    $_POST['categoria'],
                    $_POST['iduser'],
                    $_GET['idlocal']);

                $crudLocal = new LocalCrud();
                $crudLocal->updateLocal($local);
                $id = $_POST['iduser'];
                header("Location: ControlerUsuario.php");
            }
        }

        break;

    case 'excluir':

        //VERIFICAR SE EXISTE COMENTARIOS, SE SIM, EXCLUIR
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
