$(document).ready(function() {
    $("#btn_editar_campos").click(function() {
        $(".editable").prop("disabled", false);
        $("#btn_inserta_2").prop("disabled", false);
        iziToast.info({
            message: "Ahora puedes editar los campos.",
            position: "topRight"
        });
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
            }
        });
    });

    $("#btn_regresar").click(function() {
        mostrarCard("card_2", "card_1");
        $(".editable").prop("disabled", true);
        $("#btn_editar_campos").hide();
    });
});
