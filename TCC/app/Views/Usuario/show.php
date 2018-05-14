<table class="table table-bordered" >
    <thead>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>IdUser</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($locais as $local): ?>
        <tr>
            <th><?= $local->id_local ?> </th>
            <td><?= $local->nome ?> </td>
            <td><?= $local->email?> </td>
            <td><?= $local->endereco ?> </td>
            <td><?= $local->descricao ?> </td>
            <td><?= $local->categoria ?> </td>
            <td><?= $local->id_usuario ?> </td>
            <td><a href="ControlerLocal.php?acao=show&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Ver</a> |
                <a href="ControlerLocal.php?acao=editar&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Editar</a> |
                <a href="ControlerLocal.php?acao=excluir&idlocal=<?=$local->id_local?>&iduser=<?=  $local->id_usuario ?>">Remover</a>

            </td>
        </tr>


    <?php endforeach; ?>

    </tbody>
</table>