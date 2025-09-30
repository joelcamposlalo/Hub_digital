$(document).ready(function() {
    $("#btn_inserta_4").click(function(e) {
        e.preventDefault();

        const payload = {};
        $("#form_4")
            .serializeArray()
            .forEach(function(item) {
                payload[item.name] = item.value;
            });

        postDaiuPaso(rutasDaiu.guardarInmueble, payload)
            .done(function() {
                iziToast.success({
                    title: "Inmueble guardado",
                    message: "Los datos del inmueble se registraron correctamente.",
                    position: "topRight",
                    timeout: 3000
                });

                if (typeof window.mostrarCroquisCard === "function") {
                    window.mostrarCroquisCard();
                } else {
                    mostrarCard("card_4", "card_5");
                }
            })
            .fail(function(xhr) {
                const mensaje =
                    xhr?.responseJSON?.message ||
                    "No fue posible guardar la información del inmueble. Intenta nuevamente.";
                iziToast.error({
                    title: "Error",
                    message: mensaje,
                    backgroundColor: "#ff9b93"
                });
            });
    });

    $("#btn_regresar_card4").click(function(e) {
        e.preventDefault();
        mostrarCard("card_4", "card_3");
    });
});
