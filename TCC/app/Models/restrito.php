<?php

    @session_start();
    if (isset($_SESSION['id']) OR !empty($_SESSION['id'])){

    }else{
        header("Location: ControlerUsuario.php?erro=1");
        //header("Location: ../Views/Formularios/login.php?erro=2");
    }
    ?>