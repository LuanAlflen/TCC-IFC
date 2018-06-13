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

function getEstado($id){
    $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/'.$id; // dados de um estado

    $data = file_get_contents($url); // put the contents of the file into a variable
    $estado = json_decode($data); // decode the JSON feed
    return $estado;
}

function getMunicipio($id){
    $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.$id; // dados de um estado

    $data = file_get_contents($url); // put the contents of the file into a variable
    $municipio = json_decode($data); // decode the JSON feed
    return $municipio;
}



switch ($action) {

    case 'show':

        $id = $_GET['idlocal'];
        $crud = new LocalCrud();
        $local = $crud->getLocal($id);
        include "../Views/Template/Cabecalho.php";
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
            if ($_FILES['foto']['error'] == 0) {
                $nomeArquivo = date('dmYhis') . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/Local/' . $nomeArquivo);

            } else {
                $nomeArquivo = null;
            }

            print_r($_POST);

            if (is_string($_POST['categoria']) == true OR is_string($_POST['estados']) == true OR is_string($_POST['municipios']) == true) {
                $idlocal = $_POST['iduser'];
//                header("Location: ControlerLocal.php?acao=cadastrar&erro=1&id=$idlocal");
//                die;
            } else {

                $crudCat = new CategoriaCrud();
                $categoria = $crudCat->getCategoriaNome($_POST['categoria']);
                $idcategoria = $categoria->id_categoria;

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

                print_r($local);
                die;
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
