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
                        mostrarCard("card_2", "card_3");
                        $("#btn_regresar_card3").show();
                        instance.hide({ transitionOut: "fadeOut" }, toast, "button");
                    }
                ]
            ]
        });
    });

    $("#btn_regresar").click(function() {
        mostrarCard("card_2", "card_1");
    });
});
