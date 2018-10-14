<?php
@session_start();

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

        $_SESSION['id'] = 1;
        header("Location: ControlerLocal.php");

        break;

    case 'show':


        $id = $_SESSION['id'];
        $_SESSION['id'] = $id;
        $crud = new LocalCrud();
        @$locais = $crud->getLocalUser($id);
        if (!isset($locais)){
            $_SESSION['erro'] = "<div style='margin-left: 20%; margin-right: 20%' class='alert alert-danger' role='alert'>Você não possui locais cadastrados no momento!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";;
            header("Location: ControlerLocal.php");
        }
        $cruduser = new UsuarioCrud();
        $user = $cruduser->getUsuarioId($id);
        include "../Models/restrito.php";
        include "../Views/Template/CabecalhoUsuario.php";
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
                $_SESSION['erro'] = "<div class=\"error-text\" style=\"color: red\">CPF ja cadastrado, tente novamente.</div>";
                header("Location: ControlerUsuario.php?acao=cadastrar");
                die;
            }
            $senha = base64_encode($_POST['senha']);
//            echo "senha é: ".$senha;die;
            $user = new Usuario($_POST['nome'], $_POST['login'],$senha , $_POST['email'], $_POST['telefone'], $_POST['cpf'], $_POST['tipuser']);
            $crud = new UsuarioCrud();
            $crud->insertUsuario($user);
            header("Location: ?acao=login");

        }

        break;
    case 'login':

        if (!isset($_POST['gravar'])){
            include "../Views/Usuario/login.php";
        }else {

            $user = new Usuario(null, $_POST['login']);
            $crud = new UsuarioCrud();
            $resultado = $crud->LoginUsuario($user);
            print_r($resultado);
            if ($resultado == 0){
                $_SESSION['erro'] = "<div class=\"error-text\" style=\"color: red\">Não existe login com este nome!</div>";
                header("Location: ?acao=login");
                die;
            }
            $senhacriptografada = $crud->senhaCriptografada($_POST['login']);
            $login = $user->getLogin();
            $senhadigitada = $_POST['senha'];
            $senha = base64_decode($senhacriptografada['senha']);
            if ($senhadigitada != $senha){
                $_SESSION['erro'] = "<div class=\"error-text\" style=\"color: red\">Senha incorreta. Por favor tente novamente</div>";
                header("Location: ?acao=login");
            }else{
                $iduser = $senhacriptografada['id_usuario'];
                $_SESSION['id'] = $iduser;
                header("Location: ControlerLocal.php");
            }
            die;
        }
            break;

    case 'logout':

        session_start();
        session_destroy();
        header("Location: ControlerUsuario.php");

            break;

    case 'editar':

        if(!isset($_POST['gravar'])){ // vai para o form
            $id = $_SESSION['id'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuarioId($id);
            include "../Views/Usuario/editar.php";
        }else{ // já passou no form e fez submit
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $senha= $_POST['senha'];
            $senha = base64_encode($senha);
            $telefone= $_POST['telefone'];
            $email= $_POST['email'];
            $cpf= $_POST['cpf'];
            $tipuser= $_POST['tipuser'];
            $id = $_GET['id'];
            $user = new Usuario($nome, $login, $senha, $email, $telefone, $cpf,  $tipuser, $id);
            $crud = new UsuarioCrud();
            $crud->updateUsuario($user);

            $_SESSION['erro'] = "<div class=\"error-text\" style=\"color: red\">Por favor, confirme suas alterações</div>";
            header("Location: ?acao=login"); // chama o controlador
        }

        break;

    case 'excluir':

        session_start();
        session_destroy();
        $iduser = $_SESSION['id'];
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

