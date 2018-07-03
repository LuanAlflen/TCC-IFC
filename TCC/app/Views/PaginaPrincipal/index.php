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
        /////////////////////////////FILTRO DAS CATEGORIAS/////////////////////////////////////////
        $(document).ready(function (){
            //JA DEIXA TODAS SELECIONADAS
            $("#abas ul li").addClass("selecionado");

            $("#abas ul li").click(function () {
                $(this).toggleClass("selecionado");

                var esportes = $(this).parent();
                var selecionados = $(esportes).find(".selecionado");


                var classes = '';
                for (i=0; i<selecionados.length; i++){
                    var liAtual = selecionados[i];
                    if ($(liAtual).hasClass("selecionado")){
                        classes += "."+$(liAtual).attr("id");
                        if (i !=(selecionados.length - 1)){
                            classes += ",";
                        }
                    }
                }
                alert(classes);

                $(".local").hide();
                $(classes).show();
            });
            

        });


        /////////////////// ESTADOS E MUNICIPIOS SENDO PREENCHIDO VIA API////////////////////////////

        $(function(){

            $('#estados').change(function(){
                if( $(this).val() ) {
                    $(".local").hide();
                    var id_estado = $(this).val();
                    $("."+id_estado).fadeToggle();

                    $('#municipios').hide();

                    $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$(this).val()+'/municipios', function(j){
                        var options = '<option value="0">Selecione...</option>';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' +
                                j[i].id + '">' +
                                j[i].nome + '</option>';
                        }
                        $('#municipios').html(options).show();
                    });


                } else {
                    $('#municipios').html(
                        '<option value="0">-- Selecione um estado --</option>'
                    );
                }



            });
            $('#municipios').change(function() {
                if ($(this).val()) {
                    $(".local").hide();
                    var id_municipio = $(this).val();
                    $("." + id_municipio).toggle();
                }
            });
        })
    </script>

</head>

<body>
<!-- CASO USUARIO NÃO POSSUI QUADRA E CLIQUE MINHA QUADRAS EXIBE A MENSAGEM DE ERRO-->
<?php
if (@$_GET['erro'] == 1){?>
    <?php echo "<script>alert('Você não possui locais cadastrados!')</script>"; ?>
<?php } ?>
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
            <div class="list-group" id="localizacao">

                <div id="localizacao">
                    <p>Estados:</p>
                    <!--            Aqui começa a localizacao(Estados e municipios)-->
                    <?php
                    $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados'; // marcas

                    $data = file_get_contents($url); // put the contents of the file into a variable
                    $estados = json_decode($data); // decode the JSON feed
                    echo '<select name="estados" class="select" id="estados" >';
                    echo '<option selected value="0">Selecione...</option>';

                    foreach ($estados as $estado) {
                        echo '<option value="'.$estado->id.'">'.$estado->nome.'</option>';
                    }
                    echo '</select>';
                    ?>
                    <p>Municipios:</p>

                    <select name="municipios" class="select" id="municipios">
                        <option value="0">Selecione...</option>
                    </select>
                </div>

            </div>
        </div>

        <div id="teste">

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
                        <?php
                            if ($resultado == 0){
                                echo "<p>Este local não existe!</p>";
                            }else {
                                ?>
                                <?php foreach ($locais as $local): ?>
                                    <div class="local <?= $local->id_categoria ?> <?= $local->id_estado ?> <?= $local->id_municipio ?>">
                                        <div class="col-sm-4 col-lg-4 col-md-4">
                                            <div class="thumbnail">

                                                <div class="img-embrulho">
                                                    <img src="../../assets/img/Local/<?= $local->foto ?>" alt="">
                                                </div>

                                                <div class="caption" style="margin-bottom: 4%;">
                                                    <h4>
                                                        <?= $local->nome ?>
                                                        <a class="btn btn-primary pull-right"
                                                           href="ControlerLocal.php?acao=show&idlocal=<?= $local->id_local ?>&iduser=<?= $_SESSION['id'] ?>">Ver
                                                            +</a>
                                                    </h4>
                                                    <p>
                                                        <b>Categoria: </b> <?php
                                                        $idcat = $local->id_categoria;
                                                        $crudCat = new CategoriaCrud();
                                                        $categoria = $crudCat->getCategoria($idcat);
                                                        echo $categoria->nome;
                                                        ?>.<br>
                                                        <b>Estado:</b> <?php $id = $local->id_estado;
                                                        $estado = getEstado($id);
                                                        echo $estado->nome;
                                                        ?><br>
                                                        <?php
                                                        $id = $local->id_municipio;
                                                        $municipio = getMunicipio($id);

                                                        ?>
                                                        <b>Cidade:</b> <?= $municipio->nome ?><br>
                                                        <b>Endereço: </b><?= $local->endereco ?> <?= $local->numero ?>
                                                    </p>
                                                </div>
                                                <!--<div class="ratings" style="margin-bottom: 4%;">
                                                    <p>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="glyphicon glyphicon-star"></span>
                                                        <span class="pull-right">Avaliações</span>
                                                    </p>

                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                    </div>
            </div>
            <div id="paninacao"style="text-align: center;">
                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
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
              <?php $id = $_SESSION['id']; ?>
                    <br><p> Você esta logado com <?php echo "id = $id."; ?></p>
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
