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
    <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/bootstrap.css" rel="stylesheet">


    <!-- site de custumização do bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../../assets/css/shop-homepage.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../assets/css/style.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

</head>

<body>
<?php include_once "../Menu.html";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Filtros</p>

                    <div class="list-group">
                    <a href="#" class="list-group-item">Data</a>
                    <a href="#" class="list-group-item">Esporte</a>
                    <a href="#" class="list-group-item">Localização</a>
                    <a href="#" class="list-group-item">Prêmio</a>
                    <a href="#" class="list-group-item">Mais...</a>
                    </div>
            </div>



            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <!-- Só esta aceitando imagens 800x3001, não adapta -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="../../../assets/img/eventos01.jpg" alt="img1">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="../../../assets/img/eventos02.jpg" alt="img2">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="../../../assets/img/eventos03.jpg" alt="img3">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">

                            <div class="img-embrulho">
                                <img src="../../../assets/img/evento2.jpg" alt="">
                            </div>

                            <div class="caption">
                                <h4><a href="#">Evento da Joaquina</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../PgEvQuadra';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 23/12/2022 <br>
                                    <b>Local:</b> Rua dos Andantes 65, Jardim Jarivatuba, Campinas, SP.<br>
                                    <b>Prêmio:</b> 1º Lugar: Bola Oficial </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="img-embrulho">
                                <img src="../../../assets/img/evento4.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4><a href="#">Torneio da Univirçosa</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../PgEvQuadra';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 12/11/2017 <br>
                                    <b>Local:</b> Rua Águas do Sul 15, Cabotiá, Criciuma, SC.<br>
                                    <b>Prêmio:</b> 1º Lugar: Cumpom de desconto nas Lojas  </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="img-embrulho">
                                <img src="../../../assets/img/evento3.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4><a href="#">Campeonato Municipal</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../Local/show.php';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 03/12/2017 <br>
                                    <b>Local:</b> Av. Getúlio Vargas 264, Centro, Brejiuna, MG.<br>
                                    <b>Prêmio:</b> 1º Lugar: 500 Reais </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="img-embrulho">
                                <img src="../../../assets/img/eventos02.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4><a href="#">Copa Rural</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../Local/show.php';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 23/12/2022 <br>
                                    <b>Local:</b> Avenida 7 de Setembro, 32, Centro, Imbituva, PR.<br>
                                    <b>Prêmio:</b> 1º Lugar: 500 reais </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="img-embrulho">
                                <img src="../../../assets/img/eventos03.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4><a href="#">Copa Show de bola</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../Local/show.php';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 03/01/2018 <br>
                                    <b>Local:</b> Rua Juliano Almeida, Tapetinga, São Cristovão Santana, SE.<br>
                                    <b>Prêmio:</b> 1º Lugar: Vale de 200 R$ no supermercado Vivian </p>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="img-embrulho">
                                <img src="../../../assets/img/evento5.jpg" alt="">
                            </div>
                            <div class="caption">
                                <h4><a href="#">Copa Show de bola</a>
                                    <button class="btn btn-primary pull-right" onclick="window.location.href='../Local/show.php';">Ver</button>
                                </h4>
                                <p><b>Data:</b> 03/01/2018 <br>
                                    <b>Local:</b> Rua Arantes, Centro, Curitibanos, SC.<br>
                                    <b>Prêmio:</b> 1º Lugar: 1 Mil reais </p>
                            </div>
s
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12" style="margin-left: 25%">
                    <br><p>Instituto Federal Catarinense - Campus Araquari, 2info1 - Luan Alflen e Bryan Matheus Krüger</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../../../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../assets/js/bootstrap.min.js"></script>


</body>



</html>
