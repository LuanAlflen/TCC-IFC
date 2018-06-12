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
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
    <div class="container">
                <div class="col-md-12">
                 <div class="thumb">

                     <div id="exemplo" class="col-md-3">
                         <p class="lead"><?= $local->getNome();?></p>
                         <div class="img-embrulho">
                             <img src="#" height="320" width="320">
                         </div>
                         <br>
                         <p><?= $local->getDescricao();?></p>
                            <br><button id="reservarQuadra" class="btn btn-success">Reservar</button>
                         </div>
                     </div>
                 <div class="col-md-4">
                    <p class="lead">Informações</p>
                         <div class="list-group">
                             <a class="list-group-item"><b>Estado: </b><?= $local->id_estado ?></a>
                             <a class="list-group-item"><b>Cidade: </b><?= $local->id_municipio ?></a>
                             <a class="list-group-item"><b>Endereço: </b> <?= $local->endereco ?> <?= $local->numero ?></a>
                         </div>
                    <p class="lead">Contato</p>
                    <div class="list-group">
                        <a class="list-group-item"><b>Email: </b> <?= $local->getEmail();?></a>
                        <a class="list-group-item"><b>Telefone: </b><?= $local->getTelefone();?></a>

                    </div>

                </div>

                    <div class="col-md-4">

                        <img href="#" src="#" height="400" width="400">

                    </div>
            </div>

        <p class="lead">Avaliações</p>

        <div class="ratings">
            <p>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
           (12 avaliações)</p>

        </div>

            <br>
            <i style="float: left" class="fa fa-user-circle" aria-hidden="true"></i>
            <p style="float: left"><b>João:</b></p>
            <br><p>Gostei muito da quadra!  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>

            <i style="float: left" class="fa fa-user-circle" aria-hidden="true"></i>
            <p style="float: left"><b>Pedro:</b></p>
            <br><p>Quadra boa, mas a falta de estacionamento atrapalha!  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>

            <form>
                <input type="text"  placeholder="Digite seu comentario">
                <button type="submit" class="btn-success">Comentar</button>
            </form>
            <br>
        <div class="col-md-3">

            <a href="../PgEventos"> <img id="imgeventos" src="../../assets/img/eventos.png" style="margin-left: 35%;" href="">
            </a>
        </div>
    <!-- Icones -->
    <script src="https://use.fontawesome.com/6114c79283.js"></script>
    <!-- jQuery -->
    <script src="../../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>


</body>



</html>
