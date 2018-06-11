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

            ///////////////////AQUI COMEÇA O CARRO 1////////////////////////////

            $('#estados').change(function(){
                if( $(this).val() ) {
                    $('#municipios').hide();

                    //http://localhost/tcc/app/controllers/controladorTab.php?marca=$(this).val()

                    $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$(this).val()+'.json', function(j){
                        var options = '<option value="">Selecione...</option>';
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' +
                                j[i].id + '">' +
                                j[i].nome + '</option>';
                        }
                        $('#municipios').html(options).show();
                    });
                } else {
                    $('#municipios').html(
                        '<option value="">-- Selecione um estado --</option>'
                    );
                }
            });

            // $('#municipios').change(function(){
            //     if( $(this).val() ) {
            //         $.getJSON(
            //             'https://servicodados.ibge.gov.br/api/v1/localidades/municipios'+$('#estados').val()+'/'+$(this).val()+'.json', function(j){
            //                 var options = '<option value="">Selecione...</option>';
            //                 for (var i = 0; i < j.length; i++) {
            //                     options += '<option value="' +
            //                         j[i].id + '">' +
            //                         j[i].nome + '</option>';
            //                 }
            //                 $('.carregando').hide();
            //             });
            //     } else {
            //         $('#carregando').html(
            //             '<option value="">-- Selecione um municipio --</option>'
            //         );
            //     }
            // });

            //DIVIDINDO O FORMULARIO EM DOIS

            $("#anterior").hide();
            $(".etapa2").hide();
            $(".btn__form").hide();

            $('#proximo').click(function () {
                $(".etapa1").hide();
                $(".etapa2").fadeIn();
                $("#proximo").hide();
                $("#anterior").show();
                $(".btn__form").fadeIn();

            });

            $('#anterior').click(function () {
                $(".etapa1").fadeIn();
                $(".etapa2").hide();
                $("#proximo").show();
                $("#anterior").hide();
                $(".btn__form").hide();
            })


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
<!--            Aqui começa o endereco(Estados e municipios)-->
            <?php
            $url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados'; // marcas

            //http://fipeapi.appspot.com/api/1/carros/veiculos/21.json // veiculos da marca 21

            $data = file_get_contents($url); // put the contents of the file into a variable
            $estados = json_decode($data); // decode the JSON feed
            echo '<select name="estados" class="select" id="estados" >';
            echo '<option selected>Selecione...</option>';

            foreach ($estados as $estado) {

                echo '<option value="'.$estado->id.'">'.$estado->nome.'</option>';

            }

            echo '</select>';
            ?>
            <p>Municipios:</p>

                <select name="municipios" class="select" id="municipios">
                    <option>Selecione...</option>
                </select>

            <p>Endereco:</p>

                <input id="endereco" class="input" type="text"  name="endereco" placeholder="Endereço" required>
                <input id="numero" class="input" type="text"  name="numero" placeholder="Nº" required>

            </div>

            <i id="proximo" class="fa fa-arrow-circle-right" style="font-size:36px; color: yellow; margin-left:90%;  "></i>
            <i id="anterior" class="fa fa-arrow-circle-left" style="font-size:36px; color: yellow;"></i>
            <div class="btn__form">
            	<input class="btn__submit" type="reset" value="Limpar">
            	<input class="btn__reset" type="submit" name="gravar" value="Salvar">  >
            </div>


		</form>
	</div>
	
</body>
</html>