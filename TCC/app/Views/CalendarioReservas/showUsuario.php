<p class="lead">Minhas quadras</p>
<table class="table table-bordered" >
    <thead>
    <tr>
        <th>Nome</th>
        <th>Cor</th>
        <th>Entrada</th>
        <th>Local</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($reservas as $reserva):?>
        <?php
        $nomeCor = $reserva->cor;
        $nomeCor = getNomeCor($nomeCor);
        $idlocal = $reserva->id_local;
        $crudLocal = new LocalCrud();
        $local = $crudLocal->getLocal($idlocal);
        $nomeLocal = $local->getNome();
        ?>
        <tr>
            <td><?= $reserva->nome ?> </td>
            <td><?= $nomeCor ?> </td>
            <td><?= $reserva->entrada?> </td>
            <td><a href="ControlerLocal.php?acao=show&idlocal=<?= $reserva->id_local ?>&iduser=<?= $_SESSION['id'] ?>" style="color: black"><?= $nomeLocal?> </a></td>
        </tr>


    <?php endforeach; ?>

    </tbody>
</table>
<script src="../../assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/js/bootstrap.min.js"></script>