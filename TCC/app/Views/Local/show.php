<?php
if (@$_GET['erro'] == 'naologado'){?>
    <?php echo "<script>alert('É preciso estar logado para comentar!')</script>"; ?>
<?php } ?>
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
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <script>
        <?php
        $id = $local->id_estado;
        $estado = getEstado($id);

        $id = $local->id_municipio;
        $municipio = getMunicipio($id);
        ?>

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 16});
            var geocoder = new google.maps.Geocoder;
            var estado = "<?= $estado->sigla ?>";
            var municipio = "<?= $municipio->nome ?>";
            var endereco = "<?= $local->endereco ?>";
            var numero = "<?= $local->numero ?>";
            geocoder.geocode({'address': endereco + ' ' + numero + ' ' + municipio + ' ' + estado}, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    window.alert('Não foi encontrado nenhum endereço com: '+ endereco + ' ' + numero +  ', ' + municipio + ' ' + estado);
                }
            });

        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMLgYYvxAQASsjllKV-AF8nC-3HeKjxNs&callback=initMap">
    </script>
</head>
<body>
    <div class="container">
                <div class="col-md-12">
                 <div class="thumb">

                     <div id="exemplo" class="col-md-3">
                         <p class="lead"><?= $local->getNome();?></p>
                         <div style="text-align: center">
                         <img src="../../assets/img/Local/<?= $local->foto ?>" height="160" width="260">
                         </div>
                         <br>
                         <p style="text-align: center"><?= $local->getDescricao();?></p>
                         <div style="text-align: center">
                            <br><a id="reservarQuadra" class="btn btn-success" href="ControlerReservas.php?acao=show&idlocal=<?= $local->id_local?>">Reservar</a>
                         </div>
                         </div>
                     </div>
                 <div class="col-md-4">
                    <p class="lead">Informações</p>
                         <div class="list-group">
                             <a class="list-group-item"><b>Estado: </b><?= $estado->nome ?></a>
                             <a class="list-group-item"><b>Cidade: </b><?= $municipio->nome ?></a>
                             <a class="list-group-item"><b>Endereço: </b> <?= $local->endereco ?> <?= $local->numero ?></a>
                         </div>
                    <p class="lead">Contato</p>
                    <div class="list-group">
                        <a class="list-group-item"><b>Email: </b> <?= $local->getEmail();?></a>
                        <a class="list-group-item"><b>Telefone: </b><?= $local->getTelefone();?></a>

                    </div>

                </div>

                    <div class="col-md-4">

                        <div id="map"></div>

                    </div>
            </div>

        <h2>Comentarios</h2>

        <!-- ////////////////////FAZER UM FOREACH EXIBINDO TODOS OS COMENTARIOS DESSE LOCAL//////////////////////////// -->
            <br>
        <?php

        $resultado = $crudLocal->existeComentarios($idlocal);

        if ($resultado == 0){
            echo "<p>Este local não possui comentarios.</p>";
        }else {
            $crudComentario = new ComentarioCrud();
            $comentarios = $crudComentario->getComentariosLocal($idlocal);

            foreach ($comentarios as $comentario):
                ?>
                <div class="<?= $comentario->id_usuario ?>" style="border-top: 2px solid #000; margin-bottom: 2%">
                    <p style="float: left; margin-top: 2%" >
                        <i class="fa fa-user-circle" aria-hidden="true"></i> <b><?php $iduser = $comentario->id_usuario;
                            $crud = new UsuarioCrud();
                            $usuario = $crud->getUsuarioId($iduser);
                            $nome = $usuario->getNome();
                            echo $nome; ?></b></p>
                    <br>
                    <p style="margin-top: 2%">
                        <?= $comentario->texto ?>
                        <a style="color: red; text-decoration: none; margin-left: 1%" id="excluir" href="ControlerComentario.php?acao=excluir&idcomentario=<?= $comentario->id_comentario; ?>&idlocal=<?= $_GET['idlocal'] ?>"class="fa fa-trash"></a>
                    </p>
                </div>
            <?php
            endforeach;
        }
        ?>
        <?php
        if(isset($_SESSION['erro'])){
            echo $_SESSION['erro'];
            unset($_SESSION['erro']);
        }
        ?>
            <form method="post" action="ControlerComentario.php?acao=cadastrar">
                <input type="text" name="texto" placeholder="Digite seu comentario">
                <input type="hidden" name="idlocal" value="<?= $local->id_local; ?>">
                <button type="submit" class="bnt btn-success">Comentar</button>
            </form>

    <!-- Icones -->
    <script src="https://use.fontawesome.com/6114c79283.js"></script>
    <!-- jQuery -->
    <script src="../../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>

</html>






































<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCC- Luan e Bryan</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">


    <!-- site de custumização do bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <script src="../../assets/js/cabecalho.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->


</head>

<body>
<?php
$iduserlogado = $_SESSION['id'];
$crudUser = new UsuarioCrud();
$user = $crudUser->getUsuarioId($iduserlogado);
if (empty($user->getId())){
    header("Location: ControlerUsuario.php?acao=login&erro=naologado");
}
?>
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
            <a class="" href="ControlerLocal.php">

                <img src="../../assets/img/logo.png" id="logotipe">

            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <!--                <li>-->
                <!--                    <a href="#">Favoritos</a>-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <a href="#">Em destaque</a>-->
                <!--                </li>-->
                <li class="dropdown pull-right">
                    <a style="color: yellow" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <!-- ícone do user --><?= $user->getNome() ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="ControlerUsuario.php?acao=contato">Contato</a></li>
                        <?php
                        $tipuser = $user->getTipuser();
                        if($tipuser == 'visitante') {
                            echo "<li><a href=\"ControlerUsuario.php?acao=cadastrar\">Cadastrar</a></li>";
                        }
                        ?>
                        <?php
                        if ($tipuser == 'admin'){
                            echo "<li><a href=\"ControlerAdmin.php\">Área do admin</a></li>";
                        }elseif ($tipuser == 'visitante'){
                            echo "<li role='separator' class='divider'></li>";
                            echo "<li><a href=\"ControlerUsuario.php?acao=login\">Entrar</a></li>";
                        }else{
                            echo "<li><a href=\"ControlerUsuario.php?acao=show\">Minhas quadras</a></li>";
                        }
                        ?>
                        <?php
                        if($tipuser != 'visitante'){ ?>
                            <li><a href="ControlerReservas.php?acao=showUsuario">Minhas reservas</a></li>
                            <li><a href="ControlerLocal.php?acao=cadastrar">Cadastrar quadra</a></li>
                            <li><a href="ControlerUsuario.php?acao=editar">Editar</a></li>
                            <li><a href="ControlerUsuario.php?acao=excluir">Excluir conta</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="ControlerUsuario.php?acao=logout">Sair</a></li>
                        <?php } ?>
                    </ul>
                    <?php
                    if (@$_GET['acao'] != 'show' OR @$_GET['acao'] != 'showUsuario'){
                        ?>
                        <div class="navbar-form pull-right">
                            <form action="?pesquisar=pesquisar" method="get">
                                <input type="text" class="form-control" placeholder="Buscar" name="pesquisa">
                                <button type="submit" class="btn btn-default">Pesquisar</button>
                            </form>
                        </div>
                    <?php } ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
