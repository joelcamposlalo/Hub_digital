const DAIU_CAPTURA_SELECTOR = "input.daiu-id-captura";

function leerCapturaDesdeInputs() {
    let captura = null;

    document.querySelectorAll(DAIU_CAPTURA_SELECTOR).forEach(function(input) {
        if (captura) {
            return;
        }

        const valor = (input.value || "").trim();
        if (valor !== "") {
            captura = valor;
        }
    });

    return captura;
}

function sincronizarCapturaInputs(idCaptura) {
    const valor = idCaptura ? String(idCaptura) : "";
    window.daiuCapturaId = valor !== "" ? valor : null;

    document.querySelectorAll(DAIU_CAPTURA_SELECTOR).forEach(function(input) {
        input.value = valor;
    });
}

if (typeof window.daiuCapturaId === "undefined" || window.daiuCapturaId === null) {
    window.daiuCapturaId = leerCapturaDesdeInputs();
}

window.sincronizarCapturaInputs = sincronizarCapturaInputs;

if (!window.postDaiuPaso) {
    window.postDaiuPaso = function(url, payload = {}) {
        if (!url) {
            return $.Deferred().reject().promise();
        }

        const data = Object.assign(
            {
                _token: csrfToken,
                id_solicitud: idSolicitud
            },
            payload || {}
        );

        if (
            !Object.prototype.hasOwnProperty.call(data, "id_captura") ||
            data.id_captura === null ||
            data.id_captura === "" ||
            typeof data.id_captura === "undefined"
        ) {
            const capturaActual = window.daiuCapturaId || leerCapturaDesdeInputs();
            if (capturaActual) {
                data.id_captura = capturaActual;
            }
        }

        const request = $.ajax({
            url: url,
            method: "POST",
            data: data,
            dataType: "json"
        });

        request.done(function(respuesta) {
            if (respuesta && Object.prototype.hasOwnProperty.call(respuesta, "id_captura")) {
                sincronizarCapturaInputs(respuesta.id_captura);
            }
        });

        return request;
    };
}

if (!window.updateStepProgress) {
    window.updateStepProgress = function(activeStep) {
        const steps = document.querySelectorAll(".step-item");
        steps.forEach(stepElement => {
            const stepNumber = parseInt(stepElement.dataset.step, 10);
            const isCurrent = stepNumber === activeStep;
            const isComplete = stepNumber <= activeStep;

            stepElement.classList.toggle("is-current", isCurrent);
            stepElement.classList.toggle("is-complete", isComplete);
        });

        const connectors = document.querySelectorAll(".step-line");
        connectors.forEach(line => {
            const lineStep = parseInt(line.dataset.stepLine, 10);
            line.classList.toggle("is-complete", lineStep < activeStep);
        });
    };
}

if (!window.mostrarCard) {
    window.mostrarCard = function(origen, destino) {
        const $origenBody = $(`.${origen} .card-body`);
        const $destinoBody = $(`.${destino} .card-body`);
        const stepSegment = destino.split("_")[1];
        const destinoIndex = parseInt(stepSegment, 10);

        const revealDestino = function() {
            if ($destinoBody.length) {
                $destinoBody.slideDown("slow");
            }

            if (!Number.isNaN(destinoIndex)) {
                window.updateStepProgress(destinoIndex);
            }

            const $target = $(`#top_${stepSegment}`);
            if ($target.length) {
                $("html, body").animate({ scrollTop: $target.offset().top }, 500);
            }
        };

        if ($origenBody.length && $origenBody.is(":visible")) {
            $origenBody.slideUp("slow", revealDestino);
        } else {
            revealDestino();
        }
    };
}

function guardarConsulta(cuenta) {
    return postDaiuPaso(rutasDaiu.guardarConsulta, { cuenta });
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
                guardarConsulta(cuenta)
                    .done(function() {
                        iziToast.success({
                            message:
                                "Predio encontrado: " +
                                (predio.catcalle_nombre || "Sin calle"),
                            closeOnEscape: true
                        });

                guardarConsulta(cuenta)
                    .done(function() {
                        iziToast.success({
                            message:
                                "Predio encontrado: " +
                                (predio.catcalle_nombre || "Sin calle"),
                            closeOnEscape: true
                        });

                        mostrarCard("card_1", "card_2");
                    })
                    .fail(function(xhr) {
                        const mensaje =
                            xhr?.responseJSON?.message ||
                            "No fue posible guardar la cuenta consultada.";
                        iziToast.error({
                            title: "Error", 
                            message: mensaje,
                            backgroundColor: "#ff9b93"
                        });
                    });
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

        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: "once",
            title: "Confirmar consulta",
            message: `¿Deseas consultar la cuenta?<br><strong>${cuenta}</strong>`,
            position: "center",
            buttons: [
                [
                    '<button class="btn btn-link text-muted">Cancelar</button>',
                    function(instance, toast) {
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    },
                    true
                ],
                [
                    '<button class="btn btn-primary">Sí, consultar</button>',
                    function(instance, toast) {
                        consultarPredial(cuenta);
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    }
                ]
            ]
        });
    });

    // Manejo del botón "Continuar sin consultar"
    $("#continuar_sin_consulta").click(function() {
        const cuenta = $("#cuenta")
            .val()
            .trim();

        if (cuenta.length === 0) {
            mostrarCard("card_1", "card_2");
            return;
        }

        if (cuenta.length !== 10 && cuenta.length !== 31) {
            iziToast.warning({
                title: "Formato incorrecto",
                message:
                    "Ingresa una cuenta de 10 dígitos o una CURT de 31 dígitos para guardarla.",
                backgroundColor: "#ffd66b"
            });
            return;
        }

        guardarConsulta(cuenta)
            .done(function() {
                iziToast.success({
                    title: "Cuenta registrada",
                    message: "La referencia catastral se guardó correctamente.",
                    position: "topRight",
                    timeout: 2500
                });
                mostrarCard("card_1", "card_2");
            })
            .fail(function(xhr) {
                const mensaje =
                    xhr?.responseJSON?.message ||
                    "No fue posible guardar la cuenta. Intenta nuevamente.";
                iziToast.error({
                    title: "Error",
                    message: mensaje,
                    backgroundColor: "#ff9b93"
                });
            });
    });

    window.updateStepProgress(1);
});
