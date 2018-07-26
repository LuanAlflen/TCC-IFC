<?php

@session_start();
if (!isset($_SESSION['id']) OR empty($_SESSION['id'])){
    header("Location: ControlerUsuario.php?acao=login&erro=naologado");
}
?>