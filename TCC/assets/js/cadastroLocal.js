$(function() {

    /////////////////// FORMULARIO ESTADOS SENDO PREENCHIDO VIA API////////////////////////////

    $('#estados').change(function () {
        if ($(this).val()) {
            $('#municipios').hide();
            var url = 'http://localhost/3info1/TCC/app/Controlers/ControlerMunicipio.php?id=' + $(this).val();
            $.getJSON(url, function (j) {
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
});