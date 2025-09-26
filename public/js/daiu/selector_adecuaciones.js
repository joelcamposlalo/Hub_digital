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

        const safeTrim = function(selector) {
            const value = $(selector).val();
            return typeof value === "string" ? value.trim() : "";
        };
        const payload = {
            mantenimiento: $("input[name='mantenimiento[]']:checked")
                .map(function() {
                    return $(this).val();
                })
                .get(),
            anuncio: $("input[name='anuncio[]']:checked")
                .map(function() {
                    return $(this).val();
                })
                .get(),
            otro: $("input[name='otro[]']:checked")
                .map(function() {
                    return $(this).val();
                })
                .get(),
            gama: safeTrim("#gama"),
            molduras: safeTrim("#molduras"),
            macizo: safeTrim("#macizo"),
            marca_pintura: safeTrim("#marca_pintura"),
            otro_mantenimiento: safeTrim("#otro_mantenimiento"),
            dimensiones_toldo: safeTrim("#dimensiones_toldo"),
            otro_otro: safeTrim("#otro_otro")
        };

        postDaiuPaso(rutasDaiu.guardarAdecuaciones, payload)
            .done(function() {
                iziToast.success({
                    title: "Adecuaciones guardadas",
                    message: "Tus selecciones se registraron correctamente.",
                    position: "topRight",
                    timeout: 3000
                });
                mostrarCard("card_3", "card_4"); // Mostrar la card de información del inmueble
            })
            .fail(function(xhr) {
                const mensaje =
                    xhr?.responseJSON?.message ||
                    "No fue posible guardar las adecuaciones. Intenta nuevamente.";
                iziToast.error({
                    title: "Error",
                    message: mensaje,
                    backgroundColor: "#ff9b93"
                });
            });
    });
});
