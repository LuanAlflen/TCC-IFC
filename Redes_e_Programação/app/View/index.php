<!doctype html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .ip{
            width: 1.5%;
        }
        h4{
            margin-bottom: 0%;
        }
    </style>
    <script>
        $("#botao").click(function(){
            $.post("../ControlerIP.php?acao=resposta", {
                primeiroip: $("#primeiroip").val(),
                segundoip: $("#segundoip").val(),
                terceiroip: $("#terceiroip").val(),
                quartoip: $("#quartoip").val(),
                mascara: $("#mascara").val()
            }, function(result){
                $("#resposta").html(result);
            });
        });

    </script>

</head>
<body>

        <h4>IP</h4>
        <input class="ip" type="text" name="primeiroip" id="primeiro" placeholder="###">.
        <input class="ip" type="text" name="segundoip" id="segundo" placeholder="###">.
        <input class="ip" type="text" name="terceiroip" id="terceiro" placeholder="###">.
        <input class="ip" type="text" name="quartoip" id="quarto" placeholder="###"> /
        <input class="ip" type="text" name="mascara" id="decimal" placeholder="##">
        <input type="button" id="botao">

        <div id="resposta">

        </div>


</body>
</html>