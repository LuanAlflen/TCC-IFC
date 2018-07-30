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
                <td><a href="ControlerAdmin.php?acao=editarUsuario&id=<?=$usuario->id?>&idAdm=<?= $_SESSION['id'] ?>">Editar</a> |
                    <a href="ControlerAdmin.php?acao=excluirUsuario&id=<?=$usuario->id?>&idAdm=<?= $_SESSION['id'] ?>">Remover</a>

                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<div id="divlocais" style="display: none;">
    <?php
    if (!isset($locais)){
        echo "<h4 style='text-align: center'>Não existe locais</h4>";
        die;
    }
    ?>
    <table class="table table-bordered" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Endereco</th>
            <th>Telefone</th>
            <th>Descricao</th>
            <th>Estado</th>
            <th>Municipio</th>
            <th>Dono</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($locais as $local): ?>
            <tr>
                <?php
                $idestado = $local->id_estado;
                $estado = getEstado($idestado);

                $idmunicipio = $local->id_municipio;
                $municipio = getMunicipio($idmunicipio);

                $iduser = $local->id_usuario;
                $crud = new UsuarioCrud();
                $user = $crud->getUsuarioId($iduser);
                ?>
                <th><?= $local->id_local?> </th>
                <td><?= $local->nome ?> </td>
                <td><?= $local->email?> </td>
                <td><?= $local->endereco ?> <?= $local->numero ?></td>
                <td><?= $local->telefone?> </td>
                <td><?= $local->descricao ?> </td>
                <td><?= $estado->nome ?> </td>
                <td><?= $municipio->nome ?> </td>
                <td><?= $user->getNome()?> </td>
                <td>
                    <a href="ControlerLocal.php?acao=show&iduser=<?=$_SESSION['id']?>&idlocal=<?= $local->id_local ?>">Ver</a> |
                    <a href="ControlerAdmin.php?acao=editarLocal&idAdm=<?=$usuario->id?>&idlocal=<?= $local->id_local ?>">Editar</a> |
                    <a href="ControlerAdmin.php?acao=excluirLocal&idAdm=<?=$usuario->id?>&idlocal=<?= $local->id_local ?>">Remover</a>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</div>