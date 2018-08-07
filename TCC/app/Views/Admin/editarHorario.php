<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Formulario</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

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
        <h2><span>Horario de Funcionamento</span></h2>
    </div>
    <form class="form__reg"  method="post"  action="?acao=editarHorario&idlocal=<?= $_GET['idlocal']?>" enctype="multipart/form-data">
            <div id="container" class="container">
            <div>
                <div id="businessHoursContainer3"></div>
                <input id="businessHoursOutput1" name="horario" type="hidden">
                <input value="<?= $_GET['iduser']?>"  class="input" type="hidden" name="iduser" placeholder="Id_user" required>
            </div>
        </div>
        <div class="btn__form">
            <input class="btn__submit" type="reset" value="Limpar">
            <input class="btn__reset" type="submit" id="enviar" name="gravar" value="Salvar">
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
            '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-sun-o"></i></span><input type="text"  name="startTime" class="mini-time form-control operationTimeFrom" value="06:00"/></div>' +
            '<div class="operationTime input-group"><span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value="07:00"/></div>' +
            '</div></div>'
        });

        $("#enviar")  .click(function() {
            $("#businessHoursOutput1").val(JSON.stringify(businessHoursManagerBootstrap.serialize()));
            // alert(JSON.stringify(businessHoursManagerBootstrap.serialize()));
        });

    })();
</script>

</body>
</html>