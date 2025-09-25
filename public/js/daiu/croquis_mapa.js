let map, view, marker, searchWidget;
const DEFAULT_CENTER = [-103.3918, 20.7236]; // Zapopan
const DEFAULT_ZOOM = 15;
const MARKER_COLOR = "#1e636d";
const MARKER_OUTLINE = "#000000";

function initMap() {
    require([
        "esri/Map",
        "esri/views/MapView",
        "esri/widgets/Search",
        "esri/Graphic",
        "esri/core/reactiveUtils",
        "esri/widgets/Expand",
        "esri/geometry/Point"
    ], function(Map, MapView, Search, Graphic, reactiveUtils, Expand, Point) {
        map = new Map({
            basemap: "streets-navigation-vector"
        });

        view = new MapView({
            container: "map",
            map: map,
            center: DEFAULT_CENTER,
            zoom: DEFAULT_ZOOM
        });

        view.when()
            .then(function() {
                console.log("MapView está listo y completamente cargado");

                setupSearchWidget();
                setupMapEvents();
                setupUIButtons();
            })
            .catch(function(error) {
                console.error("Error al cargar MapView:", error);
                alert("Error al cargar el mapa. Por favor recarga la página.");
            });

        // Configurar el widget de búsqueda
        function setupSearchWidget() {
            searchWidget = new Search({
                view: view,
                placeholder: "Buscar dirección...",
                popupEnabled: false,
                includeDefaultSources: true
            });

            // Crear un widget expandible para la búsqueda
            const searchExpand = new Expand({
                view: view,
                content: searchWidget,
                expandIconClass: "esri-icon-search",
                expandTooltip: "Buscar dirección",
                expanded: false
            });

            view.ui.add(searchExpand, "top-right");

            searchWidget.on("search-complete", function(event) {
                handleSearchResults(event);
            });
        }

        function setupMapEvents() {
            view.on("click", function(event) {
                const coords = event.mapPoint;
                console.log("Click en:", coords);
                placeMarker(coords);
                updateCoordinatesDisplay(coords);
            });

            reactiveUtils.watch(
                () => view.stationary,
                isStationary => {
                    if (isStationary && marker) {
                        updateCoordinatesDisplay(marker.geometry);
                    }
                }
            );
        }

        function setupUIButtons() {
            window.placeMarker = function(coords, options = {}) {
                if (!coords) return;

                if (marker) {
                    marker.geometry = coords;
                } else {
                    marker = new Graphic({
                        geometry: coords,
                        symbol: {
                            type: "simple-marker",
                            color: MARKER_COLOR,
                            outline: {
                                color: MARKER_OUTLINE,
                                width: 1
                            }
                        }
                    });
                    view.graphics.add(marker);
                }

                // Crear un objeto Point válido (en caso de que no lo sea ya)
                const point =
                    coords.type === "point"
                        ? coords
                        : new Point({
                              longitude: coords.longitude ?? coords.x,
                              latitude: coords.latitude ?? coords.y
                          });

                const zoomLevel = options.zoom ?? 16;

                view.goTo({
                    target: point,
                    zoom: zoomLevel
                }).catch(function(error) {
                    if (error.name !== "view:goto-interrupted") {
                        console.warn("Error real en animación goTo:", error);
                        view.center = [point.longitude, point.latitude];
                        view.zoom = zoomLevel;
                    }
                });

                updateCoordinatesDisplay(coords);
            };

            window.getMarkerCoords = function() {
                return marker ? marker.geometry : null;
            };

            window.clearMap = function() {
                const defaultPoint = new Point({
                    longitude: DEFAULT_CENTER[0],
                    latitude: DEFAULT_CENTER[1]
                });

                placeMarker(defaultPoint, { zoom: DEFAULT_ZOOM });
                updateCoordinatesDisplay(defaultPoint);
            };
        }

        function handleSearchResults(event) {
            if (
                !event.results ||
                event.results.length === 0 ||
                !event.results[0].results ||
                event.results[0].results.length === 0
            ) {
                alert(
                    "No se encontró la dirección. Intenta con términos más específicos."
                );
                return;
            }

            const result = event.results[0].results[0];
            if (!result?.feature?.geometry) {
                alert("No se pudo obtener la ubicación de los resultados.");
                return;
            }

            const geometry = result.feature.geometry;
            console.log("Coordenadas encontradas:", geometry);

            const point =
                geometry.type === "point"
                    ? geometry
                    : new Point({
                          longitude: geometry.longitude ?? geometry.x,
                          latitude: geometry.latitude ?? geometry.y
                      });

            placeMarker(point, { zoom: 18 });
            updateCoordinatesDisplay(point);
        }

        function updateCoordinatesDisplay(coords) {
            const display = document.getElementById("coordinates-display");
            if (coords && display) {
                const lat = coords.latitude?.toFixed(6) || coords.y?.toFixed(6);
                const lng =
                    coords.longitude?.toFixed(6) || coords.x?.toFixed(6);
                display.textContent = `Latitud: ${lat}, Longitud: ${lng}`;
            }
        }
    });
}

$(document).ready(function() {
    $("#btn_inserta_4").click(function(e) {
        e.preventDefault();
        mostrarCard("card_4", "card_5");

        $("#map").css({
            display: "flex",
            height: "400px"
        });

        if (!map || !view) {
            if (!window.require) {
                loadArcGISScript()
                    .then(initMap)
                    .catch(function(error) {
                        console.error("Error al cargar ArcGIS API:", error);
                        alert(
                            "Error al cargar el mapa. Por favor recarga la página."
                        );
                    });
            } else {
                initMap();
            }
        } else {
            setTimeout(() => {
                view.goTo({
                    center: DEFAULT_CENTER,
                    zoom: DEFAULT_ZOOM
                }).catch(function(error) {
                    console.warn("Error al centrar mapa:", error);
                });
            }, 100);
        }
    });

       $("#btn_guardar_mapa").click(function(e) {
        e.preventDefault();
        const coords = window.getMarkerCoords();

        if (!coords) {
            Swal.fire({
                icon: "warning",
                title: "Selecciona una ubicación",
                text:
                    "Por favor, coloca un punto en el mapa haciendo clic o utilizando la búsqueda.",
                confirmButtonColor: "#1E636D"
            });
            return;
        }

        const lat = coords.latitude?.toFixed(6) || coords.y?.toFixed(6);
        const lng = coords.longitude?.toFixed(6) || coords.x?.toFixed(6);

        Swal.fire({
            icon: "success",
            title: "Croquis guardado",
            text: `Latitud: ${lat}, Longitud: ${lng}`,
            confirmButtonText: "Continuar",
            confirmButtonColor: "#1E636D"
        }).then(() => {
            mostrarCard("card_5", "card_6");
        });
    });

    // 👉 Versión nueva de codex
    $("#btn_regresar_card5").click(function(e) {
        e.preventDefault();
        mostrarCard("card_5", "card_4");
    });

    $("#btn_limpiar_mapa").click(function(e) {
        e.preventDefault();
        if (window.clearMap) {
            window.clearMap();
        } else {
            alert(
                "El mapa no está listo aún. Espera un momento e intenta de nuevo."
            );
        }
    });

    $("#btn_inserta_5").on("click", function(e) {
        e.preventDefault();
        mostrarCard("card_5", "card_6");
    });

    function loadArcGISScript() {
        return new Promise(function(resolve, reject) {
            const script = document.createElement("script");
            script.src = "https://js.arcgis.com/4.25/";
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }
});
