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
			<h2> <span>Login</span></h2>
		</div>		
		<form class="form__reg" method="post" action="?acao=login">
			<input class="input" type="text"     name="login"  placeholder="&#128100;  Login" required>
            <input class="input" type="password" name="senha" placeholder="&#9993;  Senha"  required>
            <?php
            if (@$_GET['erro'] == 1){?>
                <div class="error-text" style="color: red">Login incorreto. Por favor tente novamente</div>
            <?php } ?>
            <?php
            if (@$_GET['erro'] == 2){?>
                <div class="error-text" style="color: red">É preciso estar logado para acessar esta pagina!</div>
            <?php } ?>
            <?php
            if (@$_GET['erro'] == 3){?>
                <div class="error-text" style="color: red">Por favor, confirme suas alterações</div>
            <?php } ?>
            <?php
            if (@$_GET['erro'] == 4){?>
            <div class="error-text" style="color: red">Você não possui locais cadastrados! (Erro temporario, mandar pra pagina principal dnv, não para o formulario.) </div>
            <?php } ?>
            <div class="btn__form">
            	<input class="btn__submit" type="reset" value="Limpar">
            	<input class="btn__reset" type="submit" name="gravar" value="Login">
            </div>
		</form>
	</div>
	
</body>
</html>