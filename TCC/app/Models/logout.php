<?php

    session_start();
    session_destroy();

    header("Location: ../Views/Formularios/login.php");