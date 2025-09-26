$(document).ready(function() {
    $("#form_2").submit(function(e) {
        e.preventDefault();

        if (
            !$(this)
                .parsley()
                .isValid()
        ) {
            iziToast.warning({
                title: "Campos incompletos",
                message:
                    "Por favor, llena todos los campos requeridos antes de continuar.",
                backgroundColor: "#ff9b93"
            });
            return;
        }

        const payload = {};
        $(this)
            .serializeArray()
            .forEach(function(item) {
                payload[item.name] = item.value;
            });
      
        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: "once",
            title: "Confirmar datos",
            message: "¿Confirmas que los datos son correctos?",
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
                        postDaiuPaso(rutasDaiu.guardarVerificacion, payload)
                            .done(function() {
                                iziToast.success({
                                    title: "Datos guardados",
                                    message: "La información del solicitante se actualizó correctamente.",
                                    position: "topRight",
                                    timeout: 3000
                                });
                                mostrarCard("card_2", "card_3");
                                $("#btn_regresar_card3").show();
                                instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                            })
                            .fail(function(xhr) {
                                const mensaje =
                                    xhr?.responseJSON?.message ||
                                    "No fue posible guardar la información. Intenta nuevamente.";
                                iziToast.error({
                                    title: "Error",
                                    message: mensaje,
                                    backgroundColor: "#ff9b93"
                                });
                            });
                    }
                ]
            ]
        });
    });

    $("#btn_regresar").click(function() {
        mostrarCard("card_2", "card_1");
    });
});
