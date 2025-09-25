// Función para mostrar y ocultar cards
function mostrarCard(origen, destino) {
    $(`.${origen} .card-body`).slideUp("slow", function() {
        $(`.${destino} .card-body`).slideDown("slow");
    });
}

// Función para consultar la cuenta predial
function consultarPredial(cuenta) {
    $.ajax({
        url: rutaConsultaPredial, // Ruta definida en el template Blade
        method: "POST",
        data: {
            _token: csrfToken, // Token CSRF definido en el template Blade
            cuenta: cuenta
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
                message: "No se pudo consultar el predio. Intenta de nuevo.",
                backgroundColor: "#ff9b93"
            });
        }
    });
}

// Función para llenar los campos con los datos del predio
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

// Eventos principales
$(document).ready(function() {
    // Manejo del formulario de consulta
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

    // Manejo del botón "Continuar sin consultar"
    $("#continuar_sin_consulta").click(function() {
        mostrarCard("card_1", "card_2");
    });
});
