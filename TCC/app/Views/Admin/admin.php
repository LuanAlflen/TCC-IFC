<div id="divusuarios">
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
                <th><?= $usuario->id?> </th>
                <td><?= $usuario->nome ?> </td>
                <td><?= $usuario->login ?> </td>
                <td><?= $usuario->senha ?> </td>
                <td><?= $usuario->telefone ?> </td>
                <td><?= $usuario->email?> </td>
                <td><?= $usuario->cpf ?> </td>
                <td><?= $usuario->tipuser?> </td>
                <td><a href="ControlerUsuario.php?acao=editar&id=<?=$usuario->id?>">Editar</a> |
                    <a href="ControlerUsuario.php?acao=excluir&id=<?=$usuario->id?>">Remover</a>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<div id="divlocais">
    <table class="table table-bordered" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Endereco</th>
            <th>Numero</th>
            <th>Telefone</th>
            <th>Descricao</th>
            <th>Dono</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($locais as $local): ?>
            <tr>
                <th><?= $local->id_local?> </th>
                <td><?= $local->nome ?> </td>
                <td><?= $local->email?> </td>
                <td><?= $local->endereco?> </td>
                <td><?= $local->numero ?> </td>
                <td><?= $local->telefone?> </td>
                <td><?= $local->descricao ?> </td>
                <td><?= $local->id_usuario?> </td>
                <td><a href="ControlerLocal.php?acao=editar&iduser=<?=$usuario->id?>&idlocal=<?= $local->id_local ?>">Editar</a> |
                    <a href="ControlerLocal.php?acao=excluir&iduser=<?=$usuario->id?>&idlocal=<?= $local->id_local ?>">Remover</a>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
</div>