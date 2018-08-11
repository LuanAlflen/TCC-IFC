<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../assets/css/main.css">

	<title>Formulario</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        function TestaCPF() {
            $(".erroCPF").hide();

            var strCPF = $("#cpf").val();
            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000"){
                $(".erroCPF").show();
                return false;
            }

            for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) {
                $(".erroCPF").show();
                return false;
            }

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) {
                $(".erroCPF").show();
                return false;
            }
            return true;
        }

        $(document).ready(function (){
            $(".erroCPF").hide();
            
        });
    </script>

</head>
<body>




<div class="container">
		<div class="form__top">
			<h2>Formulario <span>Cadastro</span></h2>
		</div>


		<form class="form__reg"  method="post"   action="?acao=cadastrar" enctype="multipart/form-data" onsubmit="return TestaCPF();">
			<input class="input" type="text"     name="nome"     placeholder="Nome"     required>
			<input class="input" type="text"     name="login"    placeholder="Login"     required>
			<input class="input" type="password" name="senha"    placeholder="Senha"    required>
            <input class="input" type="email"    name="email"    placeholder="Email"    required>
            <input class="input" type="number"     name="telefone" placeholder="Telefone">
			<input id="cpf" class="input" type="number"     name="cpf"      placeholder="CPF"      required>
            <div class="erroCPF" style="color: red">Informe um CPF válido</div>
            <input class="input" type="hidden"   name="tipuser" required>
            <?php
            if (@$_GET['erro'] == 1){?>
                <div class="error-text" style="color: red">Este login ja existe, tente novamente.</div>
            <?php } ?>
            <?php
            if (@$_GET['erro'] == 'existeCPF'){?>
                <div class="error-text" style="color: red">CPF ja cadastrado, tente novamente.</div>
            <?php } ?>
            <div class="btn__form">
				<input class="btn__reset" type="reset" value="Limpar">
			 	<input class="btn__submit" type="submit" name="gravar" value="Salvar" >
            </div>
		</form>
    <div class="error-text" style="color: white">
        <a href="?acao=login" style="text-decoration: none">Já possui cadastro? Logue-se</a>
    </div>
	</div>
	
</body>
</html>