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

    <link rel="stylesheet" href="../../assets/css/style.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-size: 20px" href="#">ALPE</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">Favoritos</a>
                </li>
                <li>
                    <a href="#">Em destaque</a>
                </li>
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <!-- ícone do user --> <i class="fa fa-user-o" aria-hidden="true"></i>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ControlerUsuario.php?acao=contato">Contato</a></li>
                        <li><a href="ControlerUsuario.php?acao=show&id=<?php    $crud = new LocalCrud();
                                                                                $local = $crud->getLocal($idlocal);
                                                                                $iduser = $local->id_usuario;
                                                                                echo $iduser;?>">Minhas quadras</a></li>
                        <li><a href="ControlerLocal.php?acao=editar&idlocal=<?= $idlocal ?>">Editar</a></li>
                        <li><a href="ControlerLocal.php?acao=excluir&idlocal=<?= $idlocal ?>">Excluir quadra</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="ControlerUsuario.php?acao=logout">Sair</a></li>
                    </ul>
                    <form class="navbar-form pull-right">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar">
                        </div>
                        <button type="submit" class="btn btn-default">Pesquisar</button>
                    </form>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>