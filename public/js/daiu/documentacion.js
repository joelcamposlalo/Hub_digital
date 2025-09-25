$(document).ready(function() {
    $("#btn_regresar_card7").on("click", function(e) {
        e.preventDefault();
        mostrarCard("card_7", "card_6");
    });

    $("#form_7").on("submit", function(e) {
        e.preventDefault();

        const archivos = $(this)
            .find("input[type='file']")
            .map(function() {
                const files = $(this)[0].files;
                return files && files.length ? files[0].name : null;
            })
            .get()
            .filter(Boolean);

        const mensaje = archivos.length

            ? `Archivos seleccionados:<br><strong>${archivos.join(", ")}</strong>`
            : "Aún no se han seleccionado archivos.";

        iziToast.info({
            title: "Documentación en maqueta",
            message: `${mensaje}<br>La carga final se habilitará próximamente.`,
            position: "topRight",
            timeout: 5000,
            closeOnClick: true

        });
    });
});
