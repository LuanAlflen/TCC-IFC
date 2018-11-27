<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Formulario</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="../../assets/js/cadastroLocal.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/timepicker.min.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.businessHours.min.js"></script>
    <script type="text/javascript" src="../../assets/js/cadastroLocal.js"></script>
    <link rel="stylesheet" type="text/css" href="../../assets/css/jquery.businessHours.css">

    <script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/jquery.mask.min.js"></script>

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
        <h2>Editar  <span>Local</span></h2>
    </div>
    <form class="form__reg"  method="post"  action="ControlerAdmin.php?acao=editarLocal&idlocal=<?= $local->id_local ?>" enctype="multipart/form-data">
        <div class="etapa1">
            <input value="<?= $local->foto?>"         class="input" type="file"  name="foto">
            <input value="<?= $local->nome ?>"        class="input" type="text" name="nome" required >
            <input value="<?= $local->email ?>"       class="input" type="email" name="email" required>
            <input value="<?= $local->telefone ?>"    class="input" type="text" name="telefone" id="celular" required>
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
        <br>
        <div class="btn__form">
            <input class="btn__submit" type="reset" value="Limpar">
            <input class="btn__reset" type="submit" name="gravar" id="enviar" value="Salvar">
        </div>
        <div style="color: white">
            <a href="?acao=editarHorario&idlocal=<?= $local->id_local ?>&iduser=<?= $_GET['idAdm']?>" style="text-decoration: none; color: white;">Editar horário de fucionamento</a>
        </div>
    </form>
</div>

</body>
</html>