$(document).ready(function() {
    function actualizarDropdownCategorias() {
        const selectedValues = $(".categoria_check:checked")
            .map(function() {
                return $(this).val();
            })
            .get();

        const selectedLabels = $(".categoria_check:checked")
            .map(function() {
                return $(this)
                    .closest(".form-check")
                    .find(".form-check-label")
                    .text()
                    .trim();
            })
            .get();

        $("#dropdownCategoria").text(
            selectedLabels.length ? selectedLabels.join(", ") : "Seleccionar categorías"
        );

        $("#mantenimiento_section").toggle(selectedValues.includes("mantenimiento"));
        $("#anuncio_section").toggle(selectedValues.includes("anuncio"));
        $("#otro_section").toggle(selectedValues.includes("otro"));

        const dropdownElement = document.getElementById("dropdownCategoria");
        if (dropdownElement) {
            const dropdownInstance =
                bootstrap.Dropdown.getInstance(dropdownElement) ||
                new bootstrap.Dropdown(dropdownElement);
            dropdownInstance.hide();
        }
    }

    window.actualizarDropdownCategorias = actualizarDropdownCategorias;

    $("#btn_regresar").on("click", function() {
        mostrarCard("card_2", "card_1");
    });

    $("#form_2").on("submit", function(e) {
        e.preventDefault();

        const formulario = $(this);
        if (!formulario.parsley().isValid()) {
            iziToast.warning({
                title: "Campos incompletos",
                message: "Por favor completa la información solicitada antes de continuar.",
                backgroundColor: "#ff9b93"
            });
            return;
        }

        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: "once",
            title: "Confirmar datos",
            message: "¿Confirmas que los datos del solicitante son correctos?",
            position: "center",
            buttons: [
                [
                    '<button class="btn btn-link text-muted">Revisar</button>',
                    function(instance, toast) {
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    },
                    true
                ],
                [
                    '<button class="btn btn-primary">Sí, continuar</button>',
                    function(instance, toast) {
                        mostrarCard("card_2", "card_3");
                        $("#btn_regresar_card3").show();

                        $("#mantenimiento_section, #anuncio_section, #otro_section").hide();
                        $(".categoria_trigger").removeClass("active");
                        $(".categoria_trigger[data-categoria='mantenimiento']").addClass("active");
                        $("#mantenimiento_section").slideDown();

                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    }
                ]
            ]
        });
    });

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

    $("#btn_regresar_card3").on("click", function() {
        mostrarCard("card_3", "card_2");
    });

    $(".categoria_check").on("change", actualizarDropdownCategorias);

    $("#pintura_fachada").on("change", function() {
        $("#pintura_fachada_inputs").slideToggle(this.checked);
    });

    $("#toldo_check").on("change", function() {
        $("#dimensiones_toldo").slideToggle(this.checked);
    });

    $("#plaza_comercial").on("change", function() {
        $("#nombre_plaza_group").toggle(this.value === "si");
    });
});
