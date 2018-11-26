<?php
if (!isset($_SESSION)) {
    session_start();
}
    require_once __DIR__."/../Models/LocalCrud.php";
    require_once __DIR__."/../Models/CategoriaCrud.php";
    require_once __DIR__."/../Models/UsuarioCrud.php";
    require_once __DIR__."/../Models/ComentarioCrud.php";
    require_once __DIR__."/../Models/Horario_FuncionamentoCrud.php";

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
        $id = $_SESSION['id'];
        if (!isset($_GET['pagina'])){
            $_GET['pagina'] = 0;
        }

        //PARA EXIBIR TODOS OS LOCAIS COM LIMIT
        $resultado = 1;
        $crudLocal = new LocalCrud();
        $crudCat = new CategoriaCrud();
        $categorias = $crudCat->getCategorias();

        ///////////////////////////////PAGINANÇÃ0////////////////////////////////////////////////////////////////////
        $pagina = intval($_GET['pagina']);
        $locais_por_pagina = 9;
        $inicio = $pagina * $locais_por_pagina;
        $num_total_locais = $crudLocal->numeroTotalDeLocais();
        $num_paginas = ceil($num_total_locais / $locais_por_pagina);
        if ($pagina == 0){
            if (isset($_GET['pesquisa']) OR !empty($_GET['pesquisa'])){
                @$locais = $crudLocal->getLocaisPesquisa($_GET['pesquisa']);
                $pagina = -1;
            }else {
                @$locais = $crudLocal->getLocais();
            }
        }else {
            @$locais = $crudLocal->getLocaisLimit($locais_por_pagina, $inicio);
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        include "../Models/restrito.php";
        include "../Views/Template/Cabecalho.php";
        include "../Views/PaginaPrincipal/index.php";
        include "../Views/Template/Rodape.php";

        break;

    case 'show':

        $idlocal = $_GET['idlocal'];
        $iduser = $_SESSION['id'];
        $crudLocal = new LocalCrud();
        $local = $crudLocal->getLocal($idlocal);
        include "../Models/restrito.php";
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
                $nomeArquivo = 'image.jpeg';
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
                    $_SESSION['id']);


                $crudLocal = new LocalCrud();
                $id_local = $crudLocal->insertLocal($local);

                $horario = [];
                $json = $_POST['horario'];
                $arrayhorario = json_decode($json);
                $horario = new Horario_Funcionamento(
                    $arrayhorario[0]->timeFrom,
                    $arrayhorario[0]->timeTill,
                    $arrayhorario[1]->timeFrom,
                    $arrayhorario[1]->timeTill,
                    $arrayhorario[2]->timeFrom,
                    $arrayhorario[2]->timeTill,
                    $arrayhorario[3]->timeFrom,
                    $arrayhorario[3]->timeTill,
                    $arrayhorario[4]->timeFrom,
                    $arrayhorario[4]->timeTill,
                    $arrayhorario[5]->timeFrom,
                    $arrayhorario[5]->timeTill,
                    $arrayhorario[6]->timeFrom,
                    $arrayhorario[6]->timeTill,
                    $id_local
                );
                $crudHorario = new Horario_FuncionamentoCrud();
                $crudHorario->insertHorario($horario);
                $id = $_POST['iduser'];
                header("Location: ControlerLocal.php?acao=show&idlocal=$id_local");

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
                    $_SESSION['id'],
                    $_GET['idlocal']);

                $crudLocal = new LocalCrud();
                $crudLocal->updateLocal($local);

                $id = $_POST['iduser'];
                header("Location: ControlerUsuario.php?acao=show");

        }

        break;

    case 'editarHorario':


            if(!isset($_POST['gravar'])){ // vai para o form
                include "../Views/Local/editarHorario.php";
            }else {
                $horario = [];
                $json = $_POST['horario'];
                $arrayhorario = json_decode($json);
                $crudHorario = new Horario_FuncionamentoCrud();
                $horario1 = $crudHorario->getHorarioLocal($_GET['idlocal']);
                $idhorario = $horario1->id;
                $horario = new Horario_Funcionamento(
                    $arrayhorario[0]->timeFrom,
                    $arrayhorario[0]->timeTill,
                    $arrayhorario[1]->timeFrom,
                    $arrayhorario[1]->timeTill,
                    $arrayhorario[2]->timeFrom,
                    $arrayhorario[2]->timeTill,
                    $arrayhorario[3]->timeFrom,
                    $arrayhorario[3]->timeTill,
                    $arrayhorario[4]->timeFrom,
                    $arrayhorario[4]->timeTill,
                    $arrayhorario[5]->timeFrom,
                    $arrayhorario[5]->timeTill,
                    $arrayhorario[6]->timeFrom,
                    $arrayhorario[6]->timeTill,
                    $_GET['idlocal'],
                    $idhorario
                );
                $crudHorario = new Horario_FuncionamentoCrud();
                $crudHorario->updateHorario($horario);
                $id = $_POST['iduser'];
                header("Location: ControlerUsuario.php?acao=show");

            }


    break;

    case 'excluir':

        //VERIFICAR SE EXISTE COMENTARIOS, SE SIM, EXCLUIR
        $idlocal = $_GET['idlocal'];
        $iduser = $_SESSION['id'];
        $crud = new LocalCrud();
        $crud->deleteLocal($idlocal);
        header("Location: ControlerUsuario.php?acao=show");

        break;




}

?>
