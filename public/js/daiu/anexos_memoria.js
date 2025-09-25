$(document).ready(function() {
    $("#btn_regresar_card6").on("click", function(e) {
        e.preventDefault();
        mostrarCard("card_6", "card_5");
    });

    $("#form_6").on("submit", function(e) {
        e.preventDefault();

        const anexosSeleccionados =
            $("input[name='anexos[]']:checked").map(function() {
                return $(this)
                    .closest(".anexos-check")
                    .find("label")
                    .text()
                    .trim();
            }).get();

        const resumen = [
            anexosSeleccionados.length
                ? `Anexos seleccionados: ${anexosSeleccionados.join(", ")}`
                : "Sin anexos seleccionados",
            $("#memoria_descriptiva").val().trim()
                ? "Memoria descriptiva capturada"
                : "Sin memoria descriptiva",
            $("#numero_color").val().trim() ||
            $("#tipo_letra").val().trim() ||
            $("#dim_altura").val().trim() ||
            $("#dim_ancho").val().trim() ||
            $("#dim_fondo").val().trim()
                ? "Dimensiones registradas"
                : "Sin dimensiones de fachada"
        ].join("\n");

        Swal.fire({
            icon: "success",
            title: "Información guardada",
            text: resumen,
            confirmButtonText: "Aceptar",
            customClass: {
                confirmButton: "ab-btn b-primary-color"
            }
        }).then(() => {
            mostrarCard("card_6", "card_7");
        });
    });
});
