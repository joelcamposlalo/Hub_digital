$(document).ready(function() {
    // ==== Funciones auxiliares ====
    function fillFields(predio) {
        $("#nombre").val(predio.persona_nombre || "");
        $("#apellido_1").val(predio.persona_apepaterno || "");
        $("#apellido_2").val(predio.persona_apematerno || "");
        $("#domicilio").val(predio.ubicacion || "");
        $("#no_oficial").val("");
        $("#interior").val(predio.numint || "");
        $("#entrecalle1").val(predio.entrecalle1 || "");
        $("#entrecalle2").val(predio.entrecalle2 || "");
        $("#colonia").val(predio.catcol_nombre || "");
        $("#manzana").val(predio.manzana || "");
        $("#lote").val(predio.lote || "");
        $("#telefono").val("");
        $("#correo").val("");
    }

    function mostrarCard(origen, destino) {
        $(`.${origen} .card-body`).slideUp("slow", function() {
            $(`.${destino} .card-body`).slideDown("slow");
            $("html, body").animate(
                { scrollTop: $(`#top_${destino.split("_")[1]}`).offset().top },
                500
            );
        });
    }

    function actualizarDropdownCategorias() {
        const selected = $(".categoria_check:checked")
            .map(function() {
                return $(this).val();
            })
            .get();

        const labels = $(".categoria_check:checked")
            .map(function() {
                return $(this)
                    .closest("label")
                    .text()
                    .trim();
            })
            .get();

        $("#dropdownCategoria").text(
            labels.length > 0 ? labels.join(", ") : "Seleccionar categorías"
        );

        $("#mantenimiento_section").toggle(selected.includes("mantenimiento"));
        $("#anuncio_section").toggle(selected.includes("anuncio"));
        $("#otro_section").toggle(selected.includes("otro"));

        const dropdownElement = document.getElementById("dropdownCategoria");
        const dropdownInstance =
            bootstrap.Dropdown.getInstance(dropdownElement) ||
            new bootstrap.Dropdown(dropdownElement);
        dropdownInstance.hide();
    }

    function consultarPredial(cuenta) {
        $.ajax({
            url: rutaConsultaPredial,
            method: "POST",
            data: {
                _token: csrfToken,
                cuenta
            },
            dataType: "json",
            beforeSend: function() {
                $("#btn_inserta")
                    .prop("disabled", true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Buscando...');
            },
            success: function(respuestaPredial) {
                $("#btn_inserta")
                    .prop("disabled", false)
                    .html("Consulta Cuenta");

                if (respuestaPredial.length > 0) {
                    const predio = respuestaPredial[0];
                    fillFields(predio);

                    iziToast.success({
                        message:
                            "Predio encontrado: " +
                            (predio.catcalle_nombre || "Sin calle"),
                        closeOnEscape: true
                    });

                    mostrarCard("card_1", "card_2");

                    $(".editable").prop("disabled", true);
                    $("#btn_editar_campos").show();
                } else {
                    iziToast.warning({
                        title: "Ups",
                        message: "No se encontró el predio",
                        backgroundColor: "#ff9b93"
                    });
                }
            },
            error: function() {
                $("#btn_inserta")
                    .prop("disabled", false)
                    .html("Consulta Cuenta");
                iziToast.error({
                    title: "Error",
                    message:
                        "No se pudo consultar el predio. Intenta de nuevo.",
                    backgroundColor: "#ff9b93"
                });
            }
        });
    }

    // ==== Eventos principales ====

    // Deshabilitar campos inicialmente
    $(".editable").prop("disabled", true);

    $("#btn_editar_campos").click(function() {
        $(".editable").prop("disabled", false);
        $("#btn_inserta_2").prop("disabled", false);
        iziToast.info({
            message: "Ahora puedes editar los campos.",
            position: "topRight"
        });
    });

    $("#form_1").submit(function(e) {
        e.preventDefault();
        const cuenta = $("#cuenta")
            .val()
            .trim();
        const cuentaValida = cuenta.length === 10 || cuenta.length === 31;

        if (!cuentaValida) {
            iziToast.show({
                title: "⚠️",
                message:
                    "Debes ingresar una cuenta de 10 dígitos o una CURT de 31 dígitos.",
                backgroundColor: "#ff9b93"
            });
            return;
        }

        Swal.fire({
            title: "¿Deseas hacer una consulta con esta cuenta?",
            text: `Cuenta o CURT: ${cuenta}`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí, consultar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#1E636D",
            cancelButtonColor: "#d33"
        }).then(result => {
            if (result.isConfirmed) {
                consultarPredial(cuenta);
            }
        });
    });

    $("#continuar_sin_consulta").click(function() {
        mostrarCard("card_1", "card_2");
        $(".editable").prop("disabled", false);
        $("#btn_inserta_2").prop("disabled", false);
        $("#btn_editar_campos").hide();
    });

    $("#btn_regresar").click(function() {
        mostrarCard("card_2", "card_1");
        $(".editable").prop("disabled", true);
        $("#btn_editar_campos").hide();
    });

    $("#form_2").submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: "¿Confirmas que los datos son correctos?",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Sí, continuar",
            cancelButtonText: "Revisar",
            confirmButtonColor: "#1E636D",
            cancelButtonColor: "#d33"
        }).then(result => {
            if (result.isConfirmed) {
                mostrarCard("card_2", "card_3");
                $("#btn_regresar_card3").show();

                // Limpiar selección previa
                $(
                    "#mantenimiento_section, #anuncio_section, #otro_section"
                ).hide();
                $(".categoria_trigger").removeClass("active");

                // Activar "mantenimiento" por default
                $(
                    ".categoria_trigger[data-categoria='mantenimiento']"
                ).addClass("active");
                $("#mantenimiento_section").slideDown();
            }
        });
    });
    $(".categoria_trigger").on("click", function() {
        const categoria = $(this).data("categoria");

        // Remover "activo" de todos
        $(".categoria_trigger").removeClass("active");

        // Poner "activo" al clickeado
        $(this).addClass("active");

        // Mostrar la sección correspondiente
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

    // ==== Otros eventos ====
    $(".categoria_check").on("change", actualizarDropdownCategorias);

    $("#pintura_fachada").change(function() {
        $("#pintura_fachada_inputs").slideToggle(this.checked);
    });

    $("#toldo_check").change(function() {
        $("#dimensiones_toldo").slideToggle(this.checked);
    });

    $("#plaza_comercial").on("change", function() {
        $("#nombre_plaza_group").toggle(this.value === "si");
    });



});
