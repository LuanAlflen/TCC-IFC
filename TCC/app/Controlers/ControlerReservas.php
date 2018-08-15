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
function getNomeCor($id){
    if ($id == '#FFD700'){
        $nome = 'Amarelo';
        return $nome;
    }elseif($id == '#0071c5'){
        $nome = 'Azul Turquesa';
        return $nome;
    }elseif($id == '#FF4500'){
        $nome = 'Laranja';
        return $nome;
    }elseif($id == '#8B4513'){
        $nome = 'Marrom';
        return $nome;
    }elseif($id == '#1C1C1C'){
        $nome = 'Preto';
        return $nome;
    }elseif($id == '#436EEE'){
        $nome = 'Royal Blue';
        return $nome;
    }elseif($id == '#A020F0'){
        $nome = 'Roxo';
        return $nome;
    }elseif($id == '#40E0D0'){
        $nome = 'Turquesa';
        return $nome;
    }elseif($id == '#228B22'){
        $nome = 'Verde';
        return $nome;
    }else{
        $nome = 'Vermelho';
        return $nome;
    }
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
        $resultado1 = $crud->existeReservasLocal($idlocal);
        if ($resultado1 != 0){
            date_default_timezone_set('America/Sao_Paulo');
            $atual= date('Y-m-d H:i:s');
            $reservasLocal = $crud->getReservasLocal($idlocal);
            foreach ($reservasLocal as $reserva){
                $entrada = $reserva->entrada;
                $entrada = new DateTime($entrada);
                $entrada->modify('-30 minutes');
                $entrada = $entrada->format('Y-m-d H:i:s');
                if (strtotime($atual) > strtotime($entrada)){
                    $crud->deleteReserva($reserva->id);
//                    echo "<br>";
//                    echo "<br>";
//                    echo "<br>";
//                    echo "exclui reserva com id: ".$reserva->id;
//                    echo "<br>";
                }
            }
        }
        @session_start();
        if (!isset($_SESSION['id']) OR empty($_SESSION['id']) OR $_SESSION['id'] == 1){
            header("Location: ControlerUsuario.php?acao=login&erro=naologado");
        }
        $crudUsuario = new UsuarioCrud();
        $userlogado = $crudUsuario->getUsuarioId($iduser);
        include "../Views/Template/CabecalhoUsuario.php";
        include "../Views/CalendarioReservas/index.php";
        include "../Views/Template/Rodape.php";
        break;

    case 'showUsuario':

        $iduser = $_GET['iduser'];
        session_start();
        $_SESSION['id'] = $iduser;
        $crudReserva = new ReservaCrud();
        @$reservas = $crudReserva->getReservasUsuario($iduser);
        if (!isset($reservas)){
            header("Location: ControlerLocal.php?iduser=$iduser&pagina=0&erro=semReservas");
        }
        include "../Views/Template/CabecalhoUsuario.php";
        include "../Views/CalendarioReservas/showUsuario.php";
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
        if (!empty($cor) AND !empty($entrada)){
            //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
            $data = explode(" ", $entrada);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $entrada_sem_barra = $data_sem_barra . " " . $hora;
            $date  = new DateTime($entrada_sem_barra);
            //DEFININDO ENTRADA EM UM ARRAY(WEEK,HORA);
            $diasemana = array('dom','seg','ter','qua','qui','sex','sab');
            $data = substr($entrada_sem_barra, 0, -9);
            $diasemana_numero = date('w', strtotime($data));
            $startWeek = $diasemana[$diasemana_numero];
            $startHour = substr($entrada_sem_barra,  -8);
            $startHour = substr($startHour,  0,-3);
            $entrada = array($startWeek,$startHour);
            ////////////////////////////////////////HORARIO DO DIA DA SEMANA DE AACORDO COM A RESERVA///////////////////////////////////////////////////////////////
            $crudHorario = new Horario_FuncionamentoCrud();
            $horario = $crudHorario->getHorarioLocalArray($idlocal);
            $diaSemanaEntrada = $entrada[0];
            $horaEntradaDaSemana = $horario[$diaSemanaEntrada];
            $horaSaidaDaSemana = $horario[$diaSemanaEntrada.'1'];
            $data = $startHour.":00";
            $nova_data=date('Y-m-d H:i:s', strtotime($data));
            $de = date('Y-m-d H:i:s', strtotime($horaEntradaDaSemana));
            $ate = date('Y-m-d H:i:s', strtotime($horaSaidaDaSemana));
            $ate_30min = new DateTime($ate);
            $ate_30min->modify('-30 minutes');
            $ate_30min = $ate_30min->format('Y-m-d H:i:s');
            $hora_reserva = substr($nova_data,  -8);
            $hora_reserva = substr($hora_reserva,  0,-3);
            $hora_inicio = substr($de,  -8);
            $hora_inicio= substr($hora_inicio,  0,-3);
            $hora_fim = substr($ate,  -8);
            $hora_fim = substr($hora_fim,  0,-3);
            $hora_fim = new DateTime($hora_fim);
            $hora_fim->modify('-1 hour');
            $hora_fim = $hora_fim->format('H:i:s');
            /////////////////////////////////////SE O LOCAL NÃO ATENDER AO HORARIO ESCOLHIDO, RETORNA ERRO////////////////////////////////////
            echo "data reserva: ".$hora_reserva;
            echo "<br>";
            echo "de : ".$hora_inicio;
            echo "<br>";
            echo "ate : ".$hora_fim;
            echo "<br>";
            if(strtotime($hora_reserva) < strtotime($hora_inicio)) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O local não atende a esse horário!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }elseif (strtotime($hora_reserva) > strtotime($hora_fim)){
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O local não atende a esse horário!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }
            ////////////////////////////////VERIFICA SE A DATA ESCOLHIDA JA PASSOU//////////////////////////////////////////////////////////////////
            date_default_timezone_set('America/Sao_Paulo');
            $atual= date('Y-m-d H:i:s');
            $data_atual = substr($atual, 0, 10);
            $data_reserva = substr($entrada_sem_barra, 0, 10);
            $hora_atual = substr($atual, 11);
            $hora_reserva = substr($entrada_sem_barra, 11);
            if(strtotime($data_reserva) < strtotime($data_atual)) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A data escolhida ja passou!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }elseif (strtotime($data_reserva) == strtotime($data_atual)){
                if(strtotime($hora_reserva) <= strtotime($hora_atual)){
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A data escolhida ja passou!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                    die;
                }
            }
            ////////////////////////////VERIFICA SE NAO EXISTE RESERVAS NO MESMO HORARIO QUE A RESERVA ESCOLHIDA /////////////////////////////////////////
            $crudReserva = new ReservaCrud();
            $resultado1 = $crudReserva->existeReservasLocal($idlocal);
            if ($resultado1 != 0) {
                $reservasLocal = $crudReserva->getReservasLocal($idlocal);
                foreach ($reservasLocal as $reserva) {
                    $entrada = $reserva->entrada;
                    $saida = new DateTime($entrada);
                    $saida->modify('+1 hour');
                    $saida = $saida->format('Y-m-d H:i:s');
                    $data_inicio = substr($entrada, 0, 10);
                    $hora_inicio = substr($entrada, 11);
                    $hora_fim = new DateTime($hora_inicio);
                    $hora_fim->modify('+1 hour');
                    $hora_fim = $hora_fim->format('H:i:s');
                    $hora_antes = new DateTime($hora_inicio);
                    $hora_antes->modify('-1 hour');
                    $hora_antes = $hora_antes->format('H:i:s');
                    if (strtotime($data_reserva) == strtotime($data_inicio)){
                        if (strtotime($hora_reserva) >= strtotime($hora_inicio) AND strtotime($hora_reserva) < strtotime($hora_fim)){
                            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Já existe uma reserva neste horário!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                            die;
                        }elseif (strtotime($hora_reserva) > strtotime($hora_antes) AND strtotime($hora_reserva) <= strtotime($hora_inicio)){
                            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Já existe uma reserva neste horário!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                            header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                            die;
                        }
                    }
                }
            }
            //INSTANCIANDO PARA OBTER AS INFORMAÇÕES PARA CADASTRAR
            $crudUsuario = new UsuarioCrud();
            $user = $crudUsuario->getUsuarioId($iduser);
            if (isset($_POST['nome'])){
                $nome = $_POST['nome'];
            }else{
                $nome = $user->getNome();
            }
            $crudLocal = new LocalCrud();
            $local = $crudLocal->getLocal($idlocal);
            $idlocal = $local->id_local;
            $reserva = new Reserva($nome,$cor,$entrada_sem_barra,$idlocal,$iduser);
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
        if (!empty($cor) AND !empty($entrada)){
            //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
            $data = explode(" ", $entrada);
            list($date, $hora) = $data;
            $data_sem_barra = array_reverse(explode("/", $date));
            $data_sem_barra = implode("-", $data_sem_barra);
            $entrada_sem_barra = $data_sem_barra . " " . $hora;
            $date  = new DateTime($entrada_sem_barra);
            //DEFININDO ENTRADA EM UM ARRAY(WEEK,HORA);
            $diasemana = array('dom','seg','ter','qua','qui','sex','sab');
            $data = substr($entrada_sem_barra, 0, -9);
            $diasemana_numero = date('w', strtotime($data));
            $startWeek = $diasemana[$diasemana_numero];
            $startHour = substr($entrada_sem_barra,  -8);
            $startHour = substr($startHour,  0,-3);
            $entrada = array($startWeek,$startHour);
            ////////////////////////////////////////HORARIO DO DIA DA SEMANA DE AACORDO COM A RESERVA///////////////////////////////////////////////////////////////
            $crudHorario = new Horario_FuncionamentoCrud();
            $horario = $crudHorario->getHorarioLocalArray($idlocal);
            $diaSemanaEntrada = $entrada[0];
            $horaEntradaDaSemana = $horario[$diaSemanaEntrada];
            $horaSaidaDaSemana = $horario[$diaSemanaEntrada.'1'];
            $data = $startHour.":00";
            $nova_data=date('Y-m-d H:i:s', strtotime($data));
            $de = date('Y-m-d H:i:s', strtotime($horaEntradaDaSemana));
            $ate = date('Y-m-d H:i:s', strtotime($horaSaidaDaSemana));
            $ate_30min = new DateTime($ate);
            $ate_30min->modify('-30 minutes');
            $ate_30min = $ate_30min->format('Y-m-d H:i:s');
            $hora_reserva = substr($nova_data,  -8);
            $hora_reserva = substr($hora_reserva,  0,-3);
            $hora_inicio = substr($de,  -8);
            $hora_inicio= substr($hora_inicio,  0,-3);
            $hora_fim = substr($ate,  -8);
            $hora_fim = substr($hora_fim,  0,-3);
            $hora_fim = new DateTime($hora_fim);
            $hora_fim->modify('-1 hour');
            $hora_fim = $hora_fim->format('H:i:s');
            /////////////////////////////////////SE O LOCAL NÃO ATENDER AO HORARIO ESCOLHIDO, RETORNA ERRO////////////////////////////////////
            if(strtotime($hora_reserva) < strtotime($hora_inicio)) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O local não atende a esse horário!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }elseif (strtotime($hora_reserva) > strtotime($hora_fim)){
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>O local não atende a esse horário!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }
            ////////////////////////////////VERIFICA SE A DATA ESCOLHIDA JA PASSOU//////////////////////////////////////////////////////////////////
            date_default_timezone_set('America/Sao_Paulo');
            $atual= date('Y-m-d H:i:s');
            $data_atual = substr($atual, 0, 10);
            $data_reserva = substr($entrada_sem_barra, 0, 10);
            $hora_atual = substr($atual, 11);
            $hora_reserva = substr($entrada_sem_barra, 11);
            if(strtotime($data_reserva) < strtotime($data_atual)) {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A data escolhida ja passou!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                die;
            }elseif (strtotime($data_reserva) == strtotime($data_atual)){
                if(strtotime($hora_reserva) <= strtotime($hora_atual)){
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>A data escolhida ja passou!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                    die;
                }
            }
            ////////////////////////////VERIFICA SE NAO EXISTE RESERVAS NO MESMO HORARIO QUE A RESERVA ESCOLHIDA /////////////////////////////////////////
            $crudReserva = new ReservaCrud();
            $resultado1 = $crudReserva->existeReservasLocal($idlocal);
            if ($resultado1 != 0) {
                $reservasLocal = $crudReserva->getReservasLocal($idlocal);
                foreach ($reservasLocal as $reserva) {
                    if ($idreserva != $reserva->id) {
                        $entrada = $reserva->entrada;
                        $saida = new DateTime($entrada);
                        $saida->modify('+1 hour');
                        $saida = $saida->format('Y-m-d H:i:s');
                        $data_inicio = substr($entrada, 0, 10);
                        $hora_inicio = substr($entrada, 11);
                        $hora_fim = new DateTime($hora_inicio);
                        $hora_fim->modify('+1 hour');
                        $hora_fim = $hora_fim->format('H:i:s');
                        $hora_antes = new DateTime($hora_inicio);
                        $hora_antes->modify('-1 hour');
                        $hora_antes = $hora_antes->format('H:i:s');
                        if (strtotime($data_reserva) == strtotime($data_inicio)) {
                            if (strtotime($hora_reserva) >= strtotime($hora_inicio) AND strtotime($hora_reserva) < strtotime($hora_fim)) {
                                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Já existe uma reserva neste horário!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                                die;
                            } elseif (strtotime($hora_reserva) > strtotime($hora_antes) AND strtotime($hora_reserva) <= strtotime($hora_inicio)) {
                                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Já existe uma reserva neste horário!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                                header("Location: ControlerReservas.php?acao=show&idlocal=$idlocal&iduser=$iduser");
                                die;
                            }
                        }
                    }
                }
            }
            //INSTANCIANDO PARA OBTER AS INFORMAÇÕES PARA EDITAR
            $crudUsuario = new UsuarioCrud();
            $userlogado = $crudUsuario->getUsuarioId($iduser);
            if (isset($_POST['nome'])){
                $nome = $_POST['nome'];
            }else{
                $nome = $userlogado->getNome();
            }

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
                $reserva = new Reserva($nome,$cor,$entrada_sem_barra,$idlocal,$iduser,$idreserva);
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