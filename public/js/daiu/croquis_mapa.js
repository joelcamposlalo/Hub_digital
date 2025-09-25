let view, marker, searchWidget;

const DEFAULT_CENTER = [-103.3918, 20.7236]; // Zapopan
const DEFAULT_ZOOM = 15;
const MARKER_COLOR = "#1e636d";
const MARKER_OUTLINE = "#000000";

require([
    "esri/Map",
    "esri/views/MapView",
    "esri/widgets/Search",
    "esri/Graphic",
    "esri/geometry/Point"
], function(Map, MapView, Search, Graphic, Point) {
    // Crear mapa y vista
    const map = new Map({
        basemap: "streets-navigation-vector"
    });

    view = new MapView({
        container: "map",
        map: map,
        center: DEFAULT_CENTER,
        zoom: DEFAULT_ZOOM
    });

    // Widget de búsqueda
    searchWidget = new Search({
        view: view,
        popupEnabled: false,
        placeholder: "Buscar dirección..."
    });
    view.ui.add(searchWidget, "top-right");

    // Función para colocar marcador
    function placeMarker(point) {
        if (!marker) {
            marker = new Graphic({
                geometry: point,
                symbol: {
                    type: "simple-marker",
                    color: MARKER_COLOR,
                    outline: { color: MARKER_OUTLINE, width: 1 }
                }
            });
            view.graphics.add(marker);
        } else {
            marker.geometry = point;
        }

        // Mostrar coordenadas
        const lat = point.latitude.toFixed(6);
        const lng = point.longitude.toFixed(6);
        document.getElementById(
            "coordinates-display"
        ).textContent = `Latitud: ${lat}, Longitud: ${lng}`;
    }

    // Click en mapa → coloca marcador
    view.on("click", function(event) {
        const point = new Point({
            longitude: event.mapPoint.longitude,
            latitude: event.mapPoint.latitude,
            spatialReference: { wkid: 4326 }
        });
        placeMarker(point);
    });

    // Resultado de búsqueda → coloca marcador
    searchWidget.on("select-result", function(event) {
        if (event.result.feature.geometry) {
            placeMarker(event.result.feature.geometry);
        }
    });

    // Botón guardar
    $("#btn_guardar_mapa").click(function(e) {
        e.preventDefault();
        if (!marker) {
            iziToast.warning({
                title: "Selecciona una ubicación",
                message:
                    "Haz clic en el mapa o usa la búsqueda para elegir el punto.",
                backgroundColor: "#ffd66b"
            });
            return;
        }

        const lat = marker.geometry.latitude.toFixed(6);
        const lng = marker.geometry.longitude.toFixed(6);

        postDaiuPaso(rutasDaiu.guardarCroquis, {
            latitud: lat,
            longitud: lng
        })
            .done(function() {
                iziToast.success({
                    title: "Croquis guardado",
                    message: `Latitud: ${lat}, Longitud: ${lng}`,
                    position: "topRight",
                    timeout: 3000
                });
                mostrarCard("card_5", "card_6");
            })
            .fail(function(xhr) {
                const mensaje =
                    xhr?.responseJSON?.message ||
                    "No fue posible guardar la ubicación seleccionada.";
                iziToast.error({
                    title: "Error",
                    message: mensaje,
                    backgroundColor: "#ff9b93"
                });
            });
    });

    // Botón regresar
    $("#btn_regresar_card5").click(function(e) {
        e.preventDefault();
        mostrarCard("card_5", "card_4");
    });

    // Botón limpiar mapa
    $("#btn_limpiar_mapa").click(function(e) {
        e.preventDefault();
        marker = null;
        view.graphics.removeAll();
        document.getElementById("coordinates-display").textContent = "";
        view.goTo({ center: DEFAULT_CENTER, zoom: DEFAULT_ZOOM });
    });
});
