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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/abas.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>
        //FILTRO DAS CATEGORIAS
        $(document).ready(function (){
            //JA DEIXA TODAS SELECIONADAS
            $("#abas ul li").addClass("selecionado");
            $("#abas ul li").click(function () {
                $(this).toggleClass("selecionado");
                //$(".conteudo").toggle();
                var meuId = $(this).attr("id");
                //COMPARA O ID DAS CATEGORIAS COM A CLASSE DOS LOCAIS
                $("."+meuId).fadeToggle();
            });
        });
    </script>

</head>

<body>
<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">



        <div class="col-md-3">
            <p class="lead">Categorias</p>
                <div class="list-group" id="abas">
                    <ul>
                        <?php foreach ($categorias as $categoria):?>

                            <li class="list-group-item" id="<?= $categoria->id_categoria ?>"><?= $categoria->nome ?></li>

                        <?php endforeach ?>
                    </ul>
                </div>
            <p class="lead">Localização</p>
            <p>Fazer os selects de acordo com o banco e mostrar os locais de acordo com selecionado</p>
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
                                <img class="slide-image" src="../../assets/img/eventos01.jpg" alt="img1">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="../../assets/img/eventos02.jpg" alt="img2">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="../../assets/img/eventos03.jpg" alt="img3">
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
                    <div id="conteudos">
                        <?php foreach($locais as $local): ?>
                            <div class="<?= $local->id_categoria ?>">
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">

                                        <div class="img-embrulho">
                                            <img src="../../assets/img/320x320.jpeg" alt="">
                                        </div>

                                        <div class="caption">
                                            <h4>
                                                <?= $local->nome?>
                                                <a class="btn btn-primary pull-right" href="ControlerLocal.php?acao=show&idlocal=<?= $local->id_local ?>">Ver +</a>
                                            </h4>
                                            <p><b>Categoria: </b> <?php
                                                $idcat = $local->id_categoria;
                                                $crudCat   = new CategoriaCrud();
                                                $categoria = $crudCat->getCategoria($idcat);
                                                echo $categoria->nome;
                                                ?>.<br>
                                                <b>Cidade:</b> Cupuaçu.<br>
                                                <b>Bairro:</b> Horizonte.<br>
                                                <b>Endereço: </b><?= $local->endereco?></p>
                                        </div>
                                        <div class="ratings">
                                            <p class="pull-right">15 avaliações</p>
                                            <p>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
            </div>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <h4>Cadastre a sua quadra!</h4>
                    <p>Para o cadastro d sua quadra é precisa que você tenha informações validas como, CNPJ e endereço do local</p>
                    <a class="btn btn-primary" href="ControlerLocal.php?acao=cadastrar&id=<?= $_SESSION['id'] ?>">Cadastrar</a>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<div class="col-md-12">

    <a href="PgEventos"> <img id="imgeventos" src="../../assets/img/eventos.png" style="margin-left: 35%;" href="https://www.youtube.com/">
    </a>
</div>

<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12" style="margin-left: 25%">
              <?php
                    $id = $_SESSION['id'];
                    $nome = $_SESSION['nome'];
                    $login = $_SESSION['login'];
                    $senha = $_SESSION['senha'];
                    $telefone = $_SESSION['telefone'];
                    $email = $_SESSION['email'];
                    $cpf = $_SESSION['cpf'];
                    $tipuser = $_SESSION['tipuser'];
                    ?>
                    <br><p> Você esta logado com <?php echo "
                    id = $id, 
                    nome = $nome,
                    login = $login,
                    senha = $senha,
                    telefone = $telefone,                 
                    email = $email,
                    cpf = $cpf,
                    tipuser = $tipuser. 
                    "; ?></p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="../../assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/js/bootstrap.min.js"></script>


</body>



</html>
