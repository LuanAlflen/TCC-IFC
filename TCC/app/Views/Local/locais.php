<?php foreach ($locais as $local): ?>
    <div id="<?= $local->nome ?>" class="local <?= $local->id_categoria ?> <?= $local->id_estado ?> <?= $local->id_municipio ?>">
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">

                <img src="../../assets/img/Local/<?= $local->foto ?>" style="width: 260px; height: 160px">

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
                        <?php
                        $id = $local->id_estado;
                        $estado = getEstado($id);
                        ?>
                        <b>Estado:</b> <?= $estado->nome;
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