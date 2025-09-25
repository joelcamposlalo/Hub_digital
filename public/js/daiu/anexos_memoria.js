$(document).ready(function() {
    $("#btn_regresar_card6").on("click", function(e) {
        e.preventDefault();
        mostrarCard("card_6", "card_5");
    });

    $("#form_6").on("submit", function(e) {
        e.preventDefault();

        const resumen = [
            $("#memoria_descriptiva").val().trim()
                ? "Memoria descriptiva capturada"
                : "Sin memoria descriptiva",
            $("#numero_color").val().trim() ||
            $("#tipo_letra").val().trim() ||
            $("#dim_altura").val().trim() ||
            $("#dim_ancho").val().trim() ||
            $("#dim_fondo").val().trim()
                ? "Dimensiones registradas"
                : "Sin dimensiones de fachada"
        ].join("<br>");

        iziToast.success({
            title: "Información guardada",
            message: resumen,
            position: "topRight",
            timeout: 4000
        });

        mostrarCard("card_6", "card_7");
    });
});
