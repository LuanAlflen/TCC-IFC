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

                    $.getJSON('http://localhost/3info1/TCC/app/Controlers/ControlerMunicipio.php?id='+$(this).val(), function(j){
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
        <h2>Editar  <span>Local</span></h2>
    </div>
    <form class="form__reg"  method="post"  action="?acao=editarLocal&idlocal=<?= $local->id_local ?>&idAdm=<?= $_GET['idAdm'] ?>" enctype="multipart/form-data">
        <div class="etapa1">
            <input value="<?= $local->id_usuario ?>"  class="input" type="hidden" name="iduser" placeholder="Id_user" required>
            <input value="<?= $local->foto?>"         class="input" type="file"  name="foto">
            <input value="<?= $local->nome ?>"        class="input" type="text" name="nome" required >
            <input value="<?= $local->email ?>"       class="input" type="email" name="email" required>
            <input value="<?= $local->telefone ?>"    class="input" type="text" name="telefone" required>
            <br><textarea rows="5" cols="40" maxlength="500" name="descricao"><?= $local->descricao ?></textarea>
            <p>Categoria:</p>
            <select name="categoria" class="select">
                <option value="0">Selecione...</option>
                <?php foreach ($categorias as $categoria):?>

                    <option value="<?= $categoria->id_categoria ?>" <?php if($nomeCat == $categoria->nome) echo"selected"; ?> ><?= $categoria->nome ?></option>

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

            foreach ($estados as $estado) {
                ?>

                <option value="<?= $estado->id ?>" <?php if($idEstado == $estado->id) echo "selected"; ?>><?= $estado->nome?></option>

                <?php
            }

            echo '</select>';
            ?>
            <p>Municipios:</p>

            <select name="municipios" class="select" id="municipios">
                <option selected value="<?= $local->id_municipio?>">
                    <?php
                    $id = $local->id_municipio;
                    $municipio = getMunicipio($id);
                    echo $municipio->nome;
                                                                    ?>
                </option>
            </select>

            <p>Endereco:</p>

            <input value="<?= $local->endereco ?>"  id="endereco" class="input" type="text" name="endereco" required>
            <input value="<?= $local->numero ?>"  id="numero" class="input" type="text" name="numero" required>


        </div>
        <?php
        if (@$_GET['erro'] == 1){?>
            <div class="error-text" style="color: red">Todos os campos devem ser preenchidos!</div>
        <?php } ?>
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