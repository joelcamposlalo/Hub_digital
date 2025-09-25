$(document).ready(function() {
    $("#btn_regresar_card7").on("click", function(e) {
        e.preventDefault();
        mostrarCard("card_7", "card_6");
    });

    $("#form_7").on("submit", function(e) {
        e.preventDefault();
        const payload = {};
        const archivos = [];

        $(this)
            .find("input[type='file']")
            .each(function(index) {
                const files = $(this)[0].files;
                const nombre = files && files.length ? files[0].name : "";
                payload[`documento_${index}`] = nombre;
                if (nombre) {
                    archivos.push(nombre);
                }
            });
        const mensaje = archivos.length
            ? `Archivos seleccionados:<br><strong>${archivos.join(", ")}</strong>`
            : "Aún no se han seleccionado archivos.";

        postDaiuPaso(rutasDaiu.guardarDocumentacion, payload)
            .done(function() {
                iziToast.info({
                    title: "Documentación en maqueta",
                    message: `${mensaje}<br>La carga final se habilitará próximamente.`,
                    position: "topRight",
                    timeout: 5000,
                    closeOnClick: true
                });
            })
            .fail(function(xhr) {
                const mensajeError =
                    xhr?.responseJSON?.message ||
                    "No fue posible registrar la documentación.";
                iziToast.error({
                    title: "Error",
                    message: mensajeError,
                    backgroundColor: "#ff9b93"
                });
            });
    });
});
