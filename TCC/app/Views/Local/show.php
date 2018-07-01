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
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 16});
            var geocoder = new google.maps.Geocoder;
            var endereco = "<?= $local->endereco ?>";
            var numero = "<?= $local->numero ?>";
            geocoder.geocode({'address': endereco+numero}, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    window.alert('Geocode was not successful for the following reason: ' +
                        status);
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
                         <div class="img-embrulho">
                             <img src="../../assets/img/Local/<?= $local->foto ?>" height="320" width="320">
                         </div>
                         <br>
                         <p><?= $local->getDescricao();?></p>
                            <br><button id="reservarQuadra" class="btn btn-success">Reservar</button>
                         </div>
                     </div>
                 <div class="col-md-4">
                    <p class="lead">Informações</p>
                         <div class="list-group">
                             <a class="list-group-item"><b>Estado: </b><?php $id = $local->id_estado;
                                                                             $estado = getEstado($id);
                                                                             echo $estado->nome ?></a>
                             <a class="list-group-item"><b>Cidade: </b><?php $id = $local->id_municipio;
                                                                             $municipio = getMunicipio($id);
                                                                             echo $municipio->nome ?></a>
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

        <h2>Avaliações</h2>

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
                    <p style="float: left"><i class="fa fa-user-circle"
                                              aria-hidden="true"></i><b><?php $iduser = $comentario->id_usuario;
                            $crud = new UsuarioCrud();
                            $usuario = $crud->getUsuarioId($iduser);
                            $nome = $usuario->getNome();
                            echo $nome; ?></b></p>
                    <br>
                    <p>
                        <?= $comentario->texto ?>
                        <a id="excluir"href="ControlerComentario.php?acao=excluir&idcomentario=<?= $comentario->id_comentario; ?>&idusercomentario=<?= $comentario->id_usuario ?>&iduserlogado=<?= $_GET['iduser'] ?>&idlocal=<?= $_GET['idlocal'] ?>"class="fa fa-trash"></a>
                    </p>
                    <?php
                    if (@$_GET['erro'] == 1){?>
                        <div class="error-text" style="color: red">Só é possivel excluir seus prórios comentarios</div>
                    <?php } ?>
                </div>
            <?php
            endforeach;
        }
        ?>

            <form method="post" action="ControlerComentario.php?acao=cadastrar">
                <input type="text" name="texto" placeholder="Digite seu comentario">
                <input type="hidden" name="iduser" value="<?= $_GET['iduser']; ?>">
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
