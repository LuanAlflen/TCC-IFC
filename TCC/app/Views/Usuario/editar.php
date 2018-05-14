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
			<h2>Formulario <span>Cadastro</span></h2>
		</div>


		<form class="form__reg"  method="post"   action="?acao=editar&id=<?= $usuario->getId(); ?>" >
			<!--<input class="input" type="file"                     placeholder=""         required> ////////////////////////////////////////////////////////////////////////-->
			<input class="input" value="<?= $usuario->getNome() ?>" type="text"     name="nome"  required>
			<input class="input" value="<?= $usuario->getLogin() ?>" type="text"     name="login"    required>
			<input class="input" value="<?= $usuario->getSenha() ?>" type="password" name="senha"  required>
            <input class="input" value="<?= $usuario->getEmail() ?>" type="email"    name="email"   required>
            <input class="input" value="<?= $usuario->getTelefone() ?>" type="text"     name="telefone">
			<input class="input" value="<?= $usuario->getCpf() ?>" type="text"     name="cpf"      required>
            <input class="input" value="<?= $usuario->getEndereco() ?>" type="text"     name="endereco" required>
            <input class="input" value="<?= $usuario->getTipuser() ?>" type="hidden"     name="tipuser" required>
            <div class="btn__form">
				<input class="btn__reset" type="reset" value="Limpar">
			 	<input class="btn__submit" type="submit" name="gravar" value="Salvar" >
            </div>
		</form>
	</div>

</body>
</html>