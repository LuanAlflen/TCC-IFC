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


		<form class="form__reg"  method="post"   action="?acao=cadastrar" enctype="multipart/form-data">
			<input class="input" type="file"     name="foto"     required>
			<input class="input" type="text"     name="nome"     placeholder="Nome"     required>
			<input class="input" type="text"     name="login"    placeholder="Login"     required>
			<input class="input" type="password" name="senha"    placeholder="Senha"    required>
            <input class="input" type="email"    name="email"    placeholder="Email"    required>
            <input class="input" type="text"     name="telefone" placeholder="Telefone">
			<input class="input" type="text"     name="cpf"      placeholder="CPF"      required>
            <input class="input" type="text"     name="endereco" placeholder="Endereço" required>
            <input class="input" type="hidden"   name="tipuser" required>
			<?php
            if (@$_GET['erro'] == 1){?>
			<div class="error-text" style="color: red">Este login ja existe, tente novamente.</div>
			<?php } ?>
            <div class="btn__form">
				<input class="btn__reset" type="reset" value="Limpar">
			 	<input class="btn__submit" type="submit" name="gravar" value="Salvar" >
            </div>
		</form>
	</div>
	
</body>
</html>