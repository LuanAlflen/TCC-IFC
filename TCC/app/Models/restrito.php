<?php

    @session_start();
    if (isset($_SESSION['login'])){

    }else{
        echo "session login não existe, impedido por restrito.php";
        //header("Location: ../Views/Formularios/login.php?erro=2");
    }
    ?>