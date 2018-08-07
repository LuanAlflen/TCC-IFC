
/////////////////////////////FILTROS/////////////////////////////////////////


///////EXIBI OS NOVE PRIMEIRO O RESTO DA .hide()
$(document).ready(function () {
    $(".semLocais").hide();

    $("#locais > div").each(function(index, value){
        if (index > 8){
            $(value).hide();
        }
    });
});



function filtra(){
    $(".paginacao").hide();
    var classTexto = '';
    var texto = $('#texto').val();
    var classEstado = '';
    var estado = $("#estados").val();
    var classMunicipios = '';
    var municipios = $("#municipios").val();

    if (texto != ''){
        classTexto = "."+texto;
    }

    if (estado != 0){
        classEstado = "."+estado;
    }

    if (municipios != 0){
        classMunicipios = "."+municipios;
    }
    $(".local").hide();


    var esportes = $("#categorias");
    var selecionados = $(esportes).find(".selecionado");

    var classes = '';
    for (i=0; i<selecionados.length; i++){
        var liAtual = selecionados[i];
        if ($(liAtual).hasClass("selecionado")){
            classes += "."+$(liAtual).attr("id") + classEstado + classMunicipios + classTexto ;
            if (i !=(selecionados.length - 1)){
                classes += ",";
            }
        }
    }

    $(classes).show();
    $("#locais > div").each(function(index, value){
        if (index > 17){
            $(value).hide();
        }
    });
    if ($(".local").is(":visible") == false){
        $(".semLocais").show();
    }else{
        $(".semLocais").hide();
    }

}

$(document).ready(function (){
    //JA DEIXA TODAS SELECIONADAS
    $("#abas ul li").addClass("selecionado");

    $("#abas ul li").click(function () {
        $("#abas ul li").removeClass("selecionado");
        $(this).toggleClass("selecionado");
        filtra();

    });

});


/////////////////// ESTADOS E MUNICIPIOS SENDO PREENCHIDO VIA API////////////////////////////

$(function(){

    $('#estados').change(function(){
        if( $(this).val() ) {
            $(".local").hide();
            var id_estado = $(this).val();
            $("."+id_estado).fadeToggle();

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
            filtra();
        } else {


            $('#municipios').html(
                '<option value="0">-- Selecione um estado --</option>'
            );
            filtra();
        }



    });
    $('#municipios').change(function() {
        if ($(this).val()) {
            $(".local").hide();
            var id_municipio = $(this).val();
            $("." + id_municipio).toggle();
            filtra();
        }
    });
});
