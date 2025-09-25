$(document).ready(function() {
    $("#form_2").submit(function(e) {
        e.preventDefault();

        if (
            !$(this)
                .parsley()
                .isValid()
        ) {
            Swal.fire({
                icon: "warning",
                title: "Campos incompletos",
                text:
                    "Por favor, llena todos los campos requeridos antes de continuar.",
                confirmButtonColor: "#1E636D"
            });
            return;
        }

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
            }
        });
    });

    $("#btn_regresar").click(function() {
        mostrarCard("card_2", "card_1");
    });
});
