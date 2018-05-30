<?php foreach($locais as $local): ?>


    <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">

            <div class="img-embrulho">
                <img src="../../assets/img/320x320.jpeg" alt="">
            </div>

            <div class="caption">
                <h4>
                    <?= $local->nome?>
                    <button class="btn btn-primary pull-right" href="#">Ver +</button>
                </h4>
                <p><b>Categoria: </b> <?= $local->categoria ?>.<br>
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
<?php endforeach; ?>