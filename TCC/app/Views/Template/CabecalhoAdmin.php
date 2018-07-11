<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCC- Luan e Bryan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">


    <!-- site de custumização do bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/abas.css">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $(function() {
            $("#divlocais").hide();

            $('#usuarios').click(function () {
                $("#divlocais").hide();
                $("#divusuarios").fadeIn();
            });

            $('#locais').click(function () {
                $("#divusuarios").hide();
                $("#divlocais").fadeIn();
            })
        });
    </script>


</head>

<body>
<?php
$iduserlogado = $_SESSION['id'];
$crudUser = new UsuarioCrud();
$user = $crudUser->getUsuarioId($iduserlogado);
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" style="font-size: 20px" href="ControlerLocal.php?iduser=<?= $_GET['id'] ?>">ALPE</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a id="usuarios">Usuarios</a>
                </li>
                <li>
                    <a id="locais">Locais</a>
                </li>
            </ul>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>