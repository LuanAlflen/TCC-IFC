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

        //////////////////////////////////////////////////////BUSCA NÃO FUNCIONANDO////////////////////////////////////////////////////////////////////////////////
//        session_start();
//        $_SESSION['id'] = $_GET['iduser'];
//        $id = $_SESSION['id'];
//        //PARA EXIBIR TODOS OS LOCAIS COM LIMIT
//        $resultado = 1;
//        $crudLocal = new LocalCrud();
//        $crudCat = new CategoriaCrud();
//        $categorias = $crudCat->getCategorias();
//
//        ///////////////////////////////PAGINANÇÃ0////////////////////////////////////////////////////////////////////
//        $locais_por_pagina = 9;
//        $pagina = intval($_GET['pagina']);
//        $inicio = $pagina*$locais_por_pagina;
//        @$locais = $crudLocal->getLocaisLimit($locais_por_pagina,$inicio);
//        $num_total_locais = $crudLocal->numeroTotalDeLocais();
//        $num_paginas = ceil($num_total_locais/$locais_por_pagina);
//        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//        include "../Models/restrito.php";
//        include "../Views/Template/Cabecalho.php";
//        include "../Views/PaginaPrincipal/index.php";
//        include "../Views/Template/Rodape.php";


        //////////////////////////////////////////////////////BUSCA FUNCIONANDO MAS PROBLEMA DE REEVIO DE FORMULARIO///////////////////////////////////////////////

        session_start();
        $_SESSION['id'] = $_GET['iduser'];
        $crudCat = new CategoriaCrud();
        $categorias = $crudCat->getCategorias();
        $crudLocal = new LocalCrud();
        $locais_por_pagina = 9;
        $pagina = intval($_GET['pagina']);
        $inicio = $pagina*$locais_por_pagina;
        $num_total_locais = $crudLocal->numeroTotalDeLocais();
        $num_paginas = ceil($num_total_locais/$locais_por_pagina);
        if (isset($_POST['busca'])){
            //FAZ A BUSCA POR NOME DOS LOCAIS
            $busca = $_POST['busca'];
            $resultado = $crudLocal->validaBusca($busca);
            //VERIFICA SE A BUSCA DO LOCAL EXISTE, SE NÃO, EXIBE UMA MENSAGEM DE ERRO, SE SIM, MOSTRA APENAS OS LOCAIS PROCURADOS
            if ($resultado != 0){
                @$locais = $crudLocal->buscaLocais($busca, $locais_por_pagina,$inicio);
            }
        }else {
            @$locais = $crudLocal->getLocaisLimit($locais_por_pagina, $inicio);
        }
        include "../Models/restrito.php";
        include "../Views/Template/Cabecalho.php";
        include "../Views/PaginaPrincipal/index.php";
        include "../Views/Template/Rodape.php";

        break;

    case 'locais':

        $_SESSION['id'] = $_GET['iduser'];
        $busca = $_GET['busca'];
        $_GET['pagina'] = 0;
        $pagina = intval($_GET['pagina']);
        $locais_por_pagina = 9;
        $inicio = $pagina*$locais_por_pagina;
        $crudLocal = new LocalCrud();
        $num_total_locais = $crudLocal->numeroTotalDeLocais();
        $num_paginas = ceil($num_total_locais/$locais_por_pagina);
        @$locais = $crudLocal->buscaLocais($busca, $locais_por_pagina,$inicio);
        include "../Views/Local/locais.php";
        break;

    case 'show':

        $idlocal = $_GET['idlocal'];
        $iduser = $_GET['iduser'];
        $_SESSION['id'] = $iduser;
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
                header("Location: ControlerUsuario.php?acao=show&iduser=$id");

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
            $idEstado = $local->id_estado;
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
                header("Location: ControlerUsuario.php?acao=show&iduser=$id");

        }

        break;

    case 'excluir':

        //VERIFICAR SE EXISTE COMENTARIOS, SE SIM, EXCLUIR
        $idlocal = $_GET['idlocal'];
        $iduser = $_GET['iduser'];
        $crud = new LocalCrud();
        $crud->deleteLocal($idlocal);
        header("Location: ControlerUsuario.php?acao=show&iduser=$iduser");

        break;




}

?>
