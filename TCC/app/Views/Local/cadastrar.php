<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Formulario</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        //ao carregar a pagina, fica sempre pronto pra executar
        $(function(){

            /////////////////// FORMULARIO ESTADOS SENDO PREENCHIDO VIA API////////////////////////////

            $('#estados').change(function(){
                if( $(this).val() ) {
                    $('#municipios').hide();
                    var url = 'http://localhost/3info1/TCC/app/Controlers/ControlerMunicipio.php?id='+$(this).val();
                    $.getJSON(url, function(j){
                        var options = '<option value="0">Selecione...</option>';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' +
                                j[i].id + '">' +
                                j[i].nome + '</option>';
                        }
                        $('#municipios').html(options).show();
                    });
                } else {
                    $('#municipios').html(
                        '<option value="0">-- Selecione um estado --</option>'
                    );
                }
            });




        })

    </script>
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
            <input class="input" type="text"  name="telefone" placeholder="Telefone" required>
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
            <?php
            if (@$_GET['erro'] == 1){?>
            <div class="error-text" style="color: red">Todos os campos devem ser preenchidos!</div>
            <?php } ?>

            <div class="btn__form">
            	<input class="btn__submit" type="reset" value="Limpar">
            	<input class="btn__reset" type="submit" name="gravar" value="Salvar">  >
            </div>


		</form>
	</div>
	
</body>
</html>