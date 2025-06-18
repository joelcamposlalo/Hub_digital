$(document).ready(function() {
    $("#btn_inserta_4").click(function(e) {
        e.preventDefault();
        mostrarCard("card_4", "card_5");
    });

    $("#btn_regresar_card4").click(function(e) {
        e.preventDefault();
        mostrarCard("card_4", "card_3");
    });
});
