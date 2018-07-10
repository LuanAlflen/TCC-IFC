<p class="lead">Minhas quadras</p>
<table class="table table-bordered" >
    <thead>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Login</th>
        <th>Senha</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Tipo Usuario</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <th><?= $usuario->id_usuario?> </th>
            <td><?= $usuario->nome ?> </td>
            <td><?= $usuario->login ?> </td>
            <td><?= $usuario->senha ?> </td>
            <td><?= $usuario->telefone ?> </td>
            <td><?= $usuario->email?> </td>
            <td><?= $usuario->cpf ?> </td>
            <td><?= $usuario->tipuser?> </td>
            <td><?php
                $idcat = $local->id_categoria;
                $crudCat   = new CategoriaCrud();
                $categoria = $crudCat->getCategoria($idcat);
                echo $categoria->nome;
                ?>
            </td>
            <td><a href="ControlerAdm.php?acao=editar&iduser=<?=$usuario->id_usuario?>">Editar</a> |
                <a href="ControlerAdm.php?acao=excluir&iduser=<?=$usuario->id_usuario?>">Remover</a>

            </td>
        </tr>


    <?php endforeach; ?>

    </tbody>
</table>