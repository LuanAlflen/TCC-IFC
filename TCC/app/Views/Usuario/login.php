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
            if(isset($_SESSION['erro'])){
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
            ?>
            <?php
            if (@$_GET['erro'] == 'naologado'){
                echo "<script>alert('Para acessar esta página é preciso estar logado!')</script>";
            }
            ?>
            <div class="btn__form">
                <input class="btn__submit" type="reset" value="Limpar">
                <input class="btn__reset" type="submit" name="gravar" value="Login">
            </div>
            <br>
            <div class="error-text" style="color: white">
                <a href="?acao=visitante" style="text-decoration: none">Entrar como visitante</a>
            </div>
            <div class="error-text" style="color: white; margin-top: 3px;">
                <a href="?acao=cadastrar" style="text-decoration: none">Não é cadastrado? Cadastre-se</a>
            </div>
        </form>
	</div>
	
</body>
</html>