
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Formulario</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script type="text/javascript" src="../../assets/js/jquery.min.js"></script>

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/timepicker.min.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.businessHours.min.js"></script>
    <script type="text/javascript" src="../../assets/js/cadastroLocal.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/jquery.businessHours.css">

</head>
<body>
	<div class="container">
		<div class="form__top">
			<h2>Cadastro  <span>Local</span></h2>
		</div>		
		<form class="form__reg"  method="post"  action="?acao=cadastrar" enctype="multipart/form-data">
            <div class="etapa1">
            <input class="input" value="<?= $_GET['id'] ?>" type="hidden" name="iduser" placeholder="Id_user" required>
            <input class="input" type="file"  name="foto">
			<input class="input" type="text"  name="nome"     placeholder="Nome"     required>
            <input class="input" type="email" name="email"    placeholder="Email"    required>
            <input class="input" type="number"  name="telefone" placeholder="Telefone" required>
            <br><textarea rows="5" cols="40" maxlength="500" name="descricao" placeholder="Descrição..."></textarea>
            <p>Categoria:</p>
            <select name="categoria" class="select">
                <option value="0">Selecione...</option>
            <?php foreach ($categorias as $categoria):?>
                <option><?= $categoria->nome ?></option>
            <?php endforeach ?>
            </select>
            </div>

            <div class="etapa2">
            <p>Estados:</p>
<!--            Aqui começa o endereco(Estados, municipios, endereço e numero)-->
            <?php
            $url = 'http://localhost/3info1/TCC/app/Controlers/ControlerEstado.php'; // marcas

            $data = file_get_contents($url); // put the contents of the file into a variable
            $estados = json_decode($data); // decode the JSON feed
            echo '<select name="estados" class="select" id="estados" >';
            echo '<option selected value="0">Selecione...</option>';

            foreach ($estados as $estado) {

                echo '<option value="'.$estado->id.'">'.$estado->nome.'</option>';

            }

            echo '</select>';
            ?>
            <p>Municipios:</p>

                <select name="municipios" class="select" id="municipios">
                    <option value="0">Selecione...</option>
                </select>

            <p>Endereco:</p>

                <input id="endereco" class="input" type="text"  name="endereco" placeholder="Endereço" required>
                <input id="numero" class="input" type="text"  name="numero" placeholder="Nº">

            </div>
            <br>
            <p style="text-align: center">Horário de Funcionamento:</p>
            <div id="container" class="container">
                <div>
                    <div id="businessHoursContainer3"></div>
                    <input id="businessHoursOutput1" name="horario" type="hidden">
                </div>
            </div>
            <p>*Verde: Funcionando</p>
            <p>*Vermelho: Fechado</p>
            <p>Inicio: <i class="fa fa-sun-o"></i></p>
            <p>Fim: <i class="fa fa-moon-o"></i></p>
            <?php
            if (@$_GET['erro'] == 1){?>
                <div class="error-text" style="color: red">Todos os campos devem ser preenchidos!</div>
            <?php } ?>
            <div class="btn__form">
            	<input class="btn__submit" type="reset" value="Limpar">
            	<input class="btn__reset" type="submit" name="gravar" value="Salvar" id="enviar">
            </div>
		</form>
	</div>
    <script>

        (function() {

            var b3 = $("#businessHoursContainer3");
            var businessHoursManagerBootstrap = b3.businessHours({
                weekdays: ['Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
                postInit:function(){},
                dayTmpl: '<div class="dayContainer" style="width: 80px; margin-top: 5%">' +
                '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +
                '<div class="weekday" style="color: white"></div>' +
                '<div class="operationDayTimeContainer">' +
                '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="form-control time-mask mini-time operationTimeFrom" id="quantidadeHoras" value=""/></div>' +
                '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="form-control time-mask mini-time operationTimeTill" value=""/></div>' +
                '</div></div>'
            });

            $("#enviar")  .click(function() {
                $("#businessHoursOutput1").val(JSON.stringify(businessHoursManagerBootstrap.serialize()));
                //alert(JSON.stringify(businessHoursManagerBootstrap.serialize()));
            });

        })();

    </script>

	
</body>
</html>