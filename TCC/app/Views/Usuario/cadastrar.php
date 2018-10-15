<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../assets/css/main.css">

	<title>Formulario</title>
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">


    <!-- site de custumização do bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/abas.css">

<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.mask.min.js"></script>
    <script>
        function apenasNumeros(string)
        {
            var numsStr = string.replace(/[^0-9]/g,'');
            return parseInt(numsStr);
        }

        function TestaCPF() {
            $(".erroCPF").hide();

            var strCPF = $("#cpf").val();
            var strCPF = apenasNumeros(strCPF);
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


        var m_strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var m_strLowerCase = "abcdefghijklmnopqrstuvwxyz";
        var m_strNumber = "0123456789";
        var m_strCharacters = "!@#$%^&*?_~";

        //Check password


        function checkPassword()
        {
            var strPassword = $('#txtSenha').val();
            // Reset combination count
            var nScore = 0;

            // Password length
            // -- Less than 4 characters
            if (strPassword.length < 5)
            {
                nScore += 6;
            }
            // -- 5 to 7 characters
            else if (strPassword.length > 4 && strPassword.length < 8)
            {
                nScore += 12;
            }
            // -- 8 or more
            else if (strPassword.length > 7)
            {
                nScore += 28;
            }

            // Letters
            var nUpperCount = countContain(strPassword, m_strUpperCase);
            var nLowerCount = countContain(strPassword, m_strLowerCase);
            var nLowerUpperCount = nUpperCount + nLowerCount;
            // -- Letters are all lower case
            if (nUpperCount == 0 && nLowerCount != 0)
            {
                nScore += 12;
            }
            // -- Letters are upper case and lower case
            else if (nUpperCount != 0 && nLowerCount != 0)
            {
                nScore += 22;
            }

            // Numbers
            var nNumberCount = countContain(strPassword, m_strNumber);
            // -- 1 number
            if (nNumberCount == 1)
            {
                nScore += 12;
            }
            // -- 3 or more numbers
            if (nNumberCount >= 3)
            {
                nScore += 22;
            }

            // Characters
            var nCharacterCount = countContain(strPassword, m_strCharacters);
            // -- 1 character
            if (nCharacterCount == 1)
            {
                nScore += 12;
            }
            // -- More than 1 character
            if (nCharacterCount > 1)
            {
                nScore += 28;
            }

            // Bonus
            // -- Letters and numbers
            if (nNumberCount != 0 && nLowerUpperCount != 0)
            {
                nScore += 2;
            }
            // -- Letters, numbers, and characters
            if (nNumberCount != 0 && nLowerUpperCount != 0 && nCharacterCount != 0)
            {
                nScore += 4;
            }
            // -- Mixed case letters, numbers, and characters
            if (nNumberCount != 0 && nUpperCount != 0 && nLowerCount != 0 && nCharacterCount != 0)
            {
                nScore += 6;
            }


            // alert(nScore);
            return nScore;
        }

        /*if (nScore >= 90)
            {
                var strText = "Very Secure";
                var strColor = "#0ca908";
            }
            // -- Secure
            else if (nScore >= 80)
            {
                var strText = "Secure";
                vstrColor = "#7ff67c";
            }
            // -- Very Strong
            else
            */
        // alert(nScore);

        function runPassword(strFieldID)
        {
            // Check password
            var strPassword = $('#txtSenha').val();
            var nScore = checkPassword();
            // alert(strPassword.length);
            // Get controls
            // alert(nScore);
            // var ctlBar = document.getElementById(strFieldID + "_bar");
            // var ctlText = document.getElementById(strFieldID + "_text");
            // if (!ctlBar || !ctlText)
            //     return;

            // Set new width
            // ctlBar.style.width = (nScore*1.25>100)?100:nScore*1.25 + "%";
            // Color and text
            // -- Very Secure
            if (nScore >= 80)
            {
                var strText = "Muito Forte";
                var strColor = "#008000";
            }
            // -- Strong
            else if (nScore >= 60)
            {
                var strText = "Forte";
                var strColor = "#006000";
            }
            // -- Average
            else if (nScore >= 40)
            {
                var strText = "Mediana";
                var strColor = "#e3cb00";
            }
            // -- Weak
            else if (nScore >= 20)
            {
                var strText = "Fraca";
                var strColor = "#Fe3d1a";
            }
            // -- Very Weak
            else
            {
                var strText = "Péssima";
                var strColor = "#e71a1a";
            }

            $("#progress-bar").css("width", nScore+ '%');
            $("#progress-bar").css("background-color", strColor);
            $("#progress-bar").text(strText)


            // if(strPassword.length == 0)
            // {
            //     ctlBar.style.backgroundColor = "";
            //     ctlText.innerHTML =  "";
            // }
            // else
            // {
            //     ctlBar.style.backgroundColor = strColor;
            //     ctlText.innerHTML =  strText;
            // }
        }

        // Checks a string for a list of characters
        function countContain(strPassword, strCheck)
        {
            // Declare variables
            var nCount = 0;

            for (i = 0; i < strPassword.length; i++)
            {
                if (strCheck.indexOf(strPassword.charAt(i)) > -1)
                {
                    nCount++;
                }
            }
            return nCount;
        }


    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpf").mask("000.000.000-00")
            $("#telefone").mask("(00) 0000-0000")

            $("#celular").mask("(00) 0000-00009")

            $("#celular").blur(function(event){
                if ($(this).val().length == 15){
                    $("#celular").mask("(00) 00000-0009")
                }else{
                    $("#celular").mask("(00) 0000-00009")
                }
            })
        })
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
			<input class="input" type="password" name="senha"    placeholder="Senha"   id="txtSenha" onKeyPress="runPassword()" required>
            <div class="progress" style="width: 350px; margin-bottom: -0.1%; text-align: center">
                <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="color: black; text-align: center">

                </div>
            </div>
<!--            <progress max="100" value="0" id="strength" style="width: 200px"></progress>-->
            <input class="input" type="email"    name="email"    placeholder="Email"    required>
            <input class="input" type="text"     name="telefone" id="celular" placeholder="Telefone ou celular">
			<input id="cpf" class="input" type="text"     name="cpf"      placeholder="CPF"      required>
            <div class="erroCPF" style="color: red">Informe um CPF válido</div>
            <input class="input" type="hidden"   name="tipuser" required>
            <?php
            if(isset($_SESSION['erro'])){
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
            ?>
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