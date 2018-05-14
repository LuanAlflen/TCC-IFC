<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Formulario</title>
</head>
<body>

<div class="container">
    <div class="form__top">
        <h2>Editar  <span>Local</span></h2>
    </div>
    <form class="form__reg"  method="post"  action="?acao=editar&id=<?= $local->id_local ?>">
        <!--<input class="input" type="file" placeholder="" required>-->
        <input value="<?= $local->nome ?>" class="input" type="text" name="nome" required >
        <input value="<?= $local->email ?>" class="input" type="email" name="email" required>
        <input value="<?= $local->endereco ?>" class="input" type="text" name="endereco" required>
        <input value="<?= $local->telefone ?>" class="input" type="text" name="telefone" required>
        <textarea rows="5" cols="40" maxlength="500" name="descricao"><?= $local->descricao ?></textarea>
        <select name="categoria" class="form-control"">
        <option><?php if ($local->categoria == "Futebol"){echo "Futebol";} ?></option>
        <option><?php if ($local->categoria == "Volei"){echo "Volei";} ?></option>
        <option><?php if ($local->categoria == "Basquete"){echo "Basquete";} ?></option>
        </select>
        <input class="input" value="<?= $local->id_usuario ?>" type="hidden" name="iduser" placeholder="Id_user" required>
        <div class="btn__form">
            <input class="btn__submit" type="reset" value="Limpar">
            <input class="btn__reset" type="submit" name="gravar" value="Salvar">  >
        </div>


    </form>
</div>

</body>
</html>