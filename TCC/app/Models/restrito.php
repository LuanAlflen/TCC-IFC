<?php

@session_start();
if (!isset($_SESSION['id']) OR empty($_SESSION['id'])){
    $_SESSION['erro'] = "<script>alert('Para acessar esta página é preciso estar logado!')</script>";
    header("Location: ControlerUsuario.php?acao=login");
}
?>