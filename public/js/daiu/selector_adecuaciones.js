$(document).ready(function() {
    $(".categoria_trigger").on("click", function() {
        const categoria = $(this).data("categoria");

        $(".categoria_trigger").removeClass("active");
        $(this).addClass("active");

        $("#mantenimiento_section, #anuncio_section, #otro_section").slideUp();

        if (categoria === "mantenimiento") {
            $("#mantenimiento_section").slideDown();
        } else if (categoria === "anuncio") {
            $("#anuncio_section").slideDown();
        } else if (categoria === "otro") {
            $("#otro_section").slideDown();
        }
    });

    $("#btn_regresar_card3").click(function() {
        mostrarCard("card_3", "card_2");
    });

    $(".categoria_check").on("change", function() {
        actualizarDropdownCategorias();
    });

    $("#pintura_fachada").change(function() {
        $("#pintura_fachada_inputs").slideToggle(this.checked);
    });

    $("#toldo_check").change(function() {
        $("#dimensiones_toldo").slideToggle(this.checked);
    });

    // Al hacer clic en "Continuar", abrir la card de información del inmueble
    $("#btn_inserta_3").click(function(e) {
        e.preventDefault(); // Evitar el comportamiento por defecto del formulario
        mostrarCard("card_3", "card_4"); // Mostrar la card de información del inmueble
    });
});
