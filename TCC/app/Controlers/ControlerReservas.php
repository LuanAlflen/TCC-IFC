<?php

        require_once __DIR__."/../Models/LocalCrud.php";
        require_once __DIR__."/../Models/CategoriaCrud.php";
        require_once __DIR__."/../Models/UsuarioCrud.php";
        require_once __DIR__."/../Models/ComentarioCrud.php";
        require_once __DIR__."/../Models/ReservaCrud.php";
        require_once __DIR__."/../Models/Horario_FuncionamentoCrud.php";


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
    case 'show':

        $idlocal = $_GET['idlocal'];
        @session_start();
        $_SESSION['id'] = $_GET['iduser'];
        $iduser = $_SESSION['id'];
        $crudLocal = new LocalCrud();
        $local = $crudLocal->getLocal($idlocal);

        $crud = new ReservaCrud();
        $resultado = $crud->existeReservasUsuario($iduser, $idlocal);

        @session_start();
        if (!isset($_SESSION['id']) OR empty($_SESSION['id']) OR $_SESSION['id'] == 1){
            header("Location: ControlerUsuario.php?acao=login&erro=naologado");
        }
        include "../Views/Template/Cabecalho.php";
        include "../Views/CalendarioReservas/index.php";
        include "../Views/Template/Rodape.php";

        break;

    case 'cadastrar':


        session_start();
        $idlocal = $_POST['idlocal'];
        @session_start();
        $_SESSION['id'] = $_POST['iduser'];
        $iduser = $_SESSION['id'];

        $cor = $_POST['cor'];
        $entrada = $_POST['entrada'];
        $saida = $_POST['saida'];


        if (!empty($cor) AND !empty($entrada) AND !empty($saida)){
            //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
            $data = explode(" ", $entrada);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $entrada_sem_barra = $data_sem_barra . " " . $hora;

            $data = explode(" ", $saida);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $saida_sem_barra = $data_sem_barra . " " . $hora;


            $date  = new DateTime($entrada_sem_barra);
            $date2 = new DateTime($saida_sem_barra);

            //SE A DATA DE ENTRADA VIER DEPOIS DA DATA DE SAIDA, RETORNA DANDO ERRO
            $diferenca = ($date->diff($date2));
            if ($diferenca->invert != 0){
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Datas incorretas!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }

            //DEFININDO ENTRADA EM UM ARRAY(WEEK,HORA);
            $diasemana = array(0,1,2,3,4,5,6);
            $data = substr($entrada_sem_barra, 0, -9);
            $diasemana_numero = date('w', strtotime($data));
            $startWeek = $diasemana[$diasemana_numero];
            $startHour = substr($entrada_sem_barra,  -8);
            $startHour = substr($startHour,  0,-3);
            $entrada = array($startWeek,$startHour);
            //print_r($entrada);

            //DEFININDO SAIDA EM UM ARRAY(WEEK,HORA);
            $data = substr($saida_sem_barra, 0, -9);
            $diasemana_numero = date('w', strtotime($data));
            $endWeek = $diasemana[$diasemana_numero];
            $endHour = substr($saida_sem_barra,  -8);
            $endHour = substr($endHour,  0,-3);
            $saida = array($endWeek,$endHour);
            //print_r($saida);



            //INSTANCIANDO PARA OBTER AS INFORMAÇÕES PARA CADASTRAR
            $crudLocal = new LocalCrud();
            $local = $crudLocal->getLocal($idlocal);
            $idlocal = $local->id_local;
            $crudReserva = new ReservaCrud();
            $reserva = new Reserva($cor,$entrada_sem_barra,$saida_sem_barra,$idlocal,$iduser);
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Reserva cadastrada com sucesso
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $crudReserva->insereReserva($reserva);
            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Todos os campos devem ser preenchidos
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
        }
        break;

    case 'editar':

        $idlocal = $_POST['idlocal'];
        @session_start();
        $_SESSION['id'] = $_POST['iduser'];
        $iduser = $_SESSION['id'];

        $idreserva = $_POST['id'];
        $cor = $_POST['cor'];
        $entrada = $_POST['entrada'];
        $saida = $_POST['saida'];


        if (!empty($cor) AND !empty($entrada) AND !empty($saida)){
            //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
            $data = explode(" ", $entrada);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $entrada_sem_barra = $data_sem_barra . " " . $hora;

            $data = explode(" ", $saida);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $saida_sem_barra = $data_sem_barra . " " . $hora;

            $date  = new DateTime($entrada_sem_barra);
            $date2 = new DateTime($saida_sem_barra);

            //SE A DATA DE ENTRADA VIER DEPOIS DA DATA DE SAIDA, RETORNA DANDO ERRO
            $diferenca = ($date->diff($date2));
            if ($diferenca->invert != 0){
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Datas incorretas!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }


            //INSTANCIANDO PARA OBTER AS INFORMAÇÕES PARA CADASTRAR
            $crudReserva = new ReservaCrud();
            $reserva_editar = $crudReserva->getReserva($idreserva);
            $iduser_reserva = $reserva_editar->getIdUser();

            $crudLocal = new LocalCrud();
            $local = $crudLocal->getLocal($idlocal);
            $idlocal = $local->id_local;
            $iduserlocal = $local->id_usuario;

            $crudUsuario = new UsuarioCrud();
            $user = $crudUsuario->getUsuarioId($iduser);
            $tipuser = $user->getTipuser();

            if ($iduser == $iduser_reserva OR $iduser == $iduserlocal OR $tipuser == 'admin'){
                $crudReserva = new ReservaCrud();
                $reserva = new Reserva($cor,$entrada_sem_barra,$saida_sem_barra,$idlocal,$iduser,$idreserva);
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Alterações feitas com sucesso
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                $crudReserva->updateReserva($reserva);
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
            }else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Só é possível editar suas próprias reservas!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
            }
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Todos os campos devem ser preenchidos
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
        }
        break;

    case 'excluir':

        $idlocal = $_POST['idlocal'];
        @session_start();
        $_SESSION['id'] = $_POST['iduser'];
        $iduser = $_SESSION['id'];
        $idreserva = $_POST['id'];

        $crudReserva = new ReservaCrud();
        $reserva_editar = $crudReserva->getReserva($idreserva);
        $iduser_reserva = $reserva_editar->getIdUser();

        $crudLocal = new LocalCrud();
        $local = $crudLocal->getLocal($idlocal);
        $idlocal = $local->id_local;
        $iduserlocal = $local->id_usuario;

        $crudUsuario = new UsuarioCrud();
        $user = $crudUsuario->getUsuarioId($iduser);
        $tipuser = $user->getTipuser();

        if ($iduser == $iduser_reserva OR $iduser == $iduserlocal OR $tipuser == 'admin'){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Reserva excluida com sucesso
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            $crudReserva->deleteReserva($idreserva);
            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Só é possível excluir suas próprias reservas!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
        }
        break;
}


?>