<p class="lead">Minhas quadras</p>
<table class="table table-bordered" >
    <thead>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Telefone</th>
        <th>Descrição</th>
        <th>Id estado</th>
        <th>Id municipio</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($locais as $local): ?>
        <tr>
            <th><?= $local->id_local ?> </th>
            <td><?= $local->nome ?> </td>
            <td><?= $local->email?> </td>
            <td><?= $local->endereco ?> <?= $local->numero ?> </td>
            <td><?= $local->telefone ?> </td>
            <td><?= $local->descricao ?> </td>
            <td><?= $local->id_estado ?> </td>
            <td><?= $local->id_municipio ?> </td>
            <td><?php
                $idcat = $local->id_categoria;
                $crudCat   = new CategoriaCrud();
                $categoria = $crudCat->getCategoria($idcat);
                echo $categoria->nome;
                ?>
            </td>
            <td><a href="ControlerLocal.php?acao=show&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Ver</a> |
                <a href="ControlerLocal.php?acao=editar&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Editar</a> |
                <a href="ControlerLocal.php?acao=excluir&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Remover</a>

            </td>
        </tr>


    <?php endforeach; ?>

    </tbody>
</table>
<script src="../../assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/js/bootstrap.min.js"></script>