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

        include "../Views/Home/index.php";

        break;

    case 'visitante':

        $iduser = 1;
        header("Location: ControlerLocal.php?iduser=$iduser&pagina=0");

        break;

    case 'show':


        $id = $_GET['iduser'];
        session_start();
        $_SESSION['id'] = $id;
        $crud = new LocalCrud();
        @$locais = $crud->getLocalUser($id);
        if (!isset($locais)){
            header("Location: ControlerLocal.php?iduser=$id&erro=1&pagina=0");
        }
        $cruduser = new UsuarioCrud();
        $user = $cruduser->getUsuarioId($id);
        include "../Models/restrito.php";
        include "../Views/Template/Cabecalho.php";
        include "../Views/Usuario/show.php";
        include "../Views/Template/Rodape.php";

        break;





    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            include "../Views/Usuario/cadastrar.php";
        } else {

            $cpf = $_POST['cpf'];
            $crud = new UsuarioCrud();
            $resultado = $crud->existeCPF($cpf);
            if ($resultado != 0){
                header("Location: ControlerUsuario.php?acao=cadastrar&erro=existeCPF");
                die;
            }

            $user = new Usuario($_POST['nome'], $_POST['login'], $_POST['senha'], $_POST['email'], $_POST['telefone'], $_POST['cpf'], $_POST['tipuser']);
            $crud = new UsuarioCrud();
            $crud->insertUsuario($user);
            header("Location: ?acao=login");

        }

        break;
    case 'login':

        if (!isset($_POST['gravar'])){
            include "../Views/Usuario/login.php";
        }else {

            $user = new Usuario(null, $_POST['login'], $_POST['senha']);
            $crud = new UsuarioCrud();
            $resultado = $crud->LoginUsuario($user);
            $login = $user->getLogin();
            $user = $crud->getUsuario($login);
            if ($resultado == 0) {
                header("Location: ?acao=login&erro=1");
            } else {
                $iduser = $user->getId();
                header("Location: ControlerLocal.php?iduser=$iduser&pagina=0");
            }
        }
            break;

    case 'logout':

        session_start();
        session_destroy();
        header("Location: ControlerUsuario.php?acao=login");

            break;

    case 'editar':

        if(!isset($_POST['gravar'])){ // vai para o form
            $id = $_GET['id'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            include "../Views/Usuario/editar.php";
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

            header("Location: ?acao=login&erro=3"); // chama o controlador
        }

        break;

    case 'excluir':

        $iduser = $_GET['id'];
        //EXCLUI LOCAIS, CASO TENHA
        $crudLocal = new LocalCrud();
        $crudLocal->deleteLocalUser($iduser);
        //EXCLUI USUARIO
        $cruduser = new UsuarioCrud();
        $resultado = $cruduser->deleteUsuario($iduser);
        header("Location: ControlerUsuario.php");

            break;

    case 'contato':

        include "../Views/Formularios/contato.html";

        break;


        }

