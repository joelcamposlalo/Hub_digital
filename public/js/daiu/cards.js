window.mostrarCard = function(origen, destino) {
    $(`.${origen} .card-body`).slideUp("slow", function() {
        $(`.${destino} .card-body`).slideDown("slow");
    });
};
