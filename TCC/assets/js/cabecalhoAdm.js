
$(function() {
    $("#divlocais").hide();

    $('#usuarios').click(function () {
        $("#divlocais").hide();
        $("#divusuarios").fadeIn();
    });

    $('#locais').click(function () {
        $("#divusuarios").hide();
        $("#divlocais").fadeIn();
    })
});
