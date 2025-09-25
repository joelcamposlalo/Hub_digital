let map, view, marker, searchWidget, searchExpandControl;
let isMarkerDragging = false;
let skipNextSearchComplete = false;
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
                setupSearchWidget();
                setupMapEvents();
                setupUIButtons();
            })
            .catch(function(error) {
                console.error("Error al cargar MapView:", error);
                iziToast.error({
                    title: "Error",
                    message: "No se pudo inicializar el mapa. Recarga la página e inténtalo nuevamente.",
                    backgroundColor: "#ff9b93"
                });
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
            searchExpandControl = new Expand({
                view: view,
                content: searchWidget,
                expandIconClass: "esri-icon-search",
                expandTooltip: "Buscar dirección",
                expanded: false
            });

            view.ui.add(searchExpandControl, "top-right");

            searchWidget.on("search-complete", function(event) {
                handleSearchResults(event);
            });

            searchWidget.on("select-result", function(event) {
                if (event.result?.feature?.geometry) {
                    skipNextSearchComplete = true;
                    focusOnGeometry(event.result.feature.geometry, 18);
                }
            });
        }

        function setupMapEvents() {
            view.on("click", function(event) {
                const coords = event.mapPoint;
                placeMarker(coords);
                updateCoordinatesDisplay(coords);
            });

            view.on("pointer-down", function(event) {
                if (!marker) return;

                view.hitTest(event).then(function(response) {
                    const hitMarker = response.results.some(result => result.graphic === marker);

                    if (hitMarker) {
                        isMarkerDragging = true;
                        view.container.style.cursor = "grabbing";
                        event.stopPropagation();
                    }
                });
            });

            view.on("pointer-move", function(event) {
                if (!isMarkerDragging) return;

                event.stopPropagation();
                const point = view.toMap({ x: event.x, y: event.y });
                if (point && marker) {
                    marker.geometry = point;
                    updateCoordinatesDisplay(point);
                }
            });

            view.on("pointer-up", function(event) {
                if (!isMarkerDragging) return;

                event.stopPropagation();
                const point = view.toMap({ x: event.x, y: event.y });
                if (point && marker) {
                    marker.geometry = point;
                    updateCoordinatesDisplay(point);
                }

                isMarkerDragging = false;
                view.container.style.cursor = "default";
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

                const point =
                    coords.type === "point"
                        ? coords
                        : new Point({
                              longitude: coords.longitude ?? coords.x,
                              latitude: coords.latitude ?? coords.y,
                              spatialReference: coords.spatialReference || { wkid: 4326 }
                          });

                if (marker) {
                    marker.geometry = point;
                } else {
                    marker = new Graphic({
                        geometry: point,
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

                if (view?.container) {
                    view.container.style.cursor = "grab";
                }

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
                    latitude: DEFAULT_CENTER[1],
                    spatialReference: { wkid: 4326 }
                });

                placeMarker(defaultPoint, { zoom: DEFAULT_ZOOM });
                updateCoordinatesDisplay(defaultPoint);
            };
        }

        function focusOnGeometry(geometry, zoomLevel = 16) {
            if (!geometry) return;

            const point =
                geometry.type === "point"
                    ? geometry
                    : new Point({
                          longitude: geometry.longitude ?? geometry.x,
                          latitude: geometry.latitude ?? geometry.y,
                          spatialReference: geometry.spatialReference || { wkid: 4326 }
                      });

            placeMarker(point, { zoom: zoomLevel });
            updateCoordinatesDisplay(point);

            if (searchExpandControl) {
                searchExpandControl.expanded = false;
            }
        }

        function handleSearchResults(event) {
            if (skipNextSearchComplete) {
                skipNextSearchComplete = false;
                return;
            }

            if (
                !event.results ||
                event.results.length === 0 ||
                !event.results[0].results ||
                event.results[0].results.length === 0
            ) {
                iziToast.warning({
                    title: "Sin resultados",
                    message:
                        "No se encontró la dirección. Intenta con términos más específicos.",
                    backgroundColor: "#ffd66b"
                });
                return;
            }

            const result = event.results[0].results[0];
            if (!result?.feature?.geometry) {
                iziToast.error({
                    title: "Sin ubicación",
                    message: "No se pudo obtener la ubicación de los resultados.",
                    backgroundColor: "#ff9b93"
                });
                return;
            }

            focusOnGeometry(result.feature.geometry, 18);
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
                        iziToast.error({
                            title: "Error",
                            message:
                                "No fue posible cargar el mapa. Recarga la página e inténtalo nuevamente.",
                            backgroundColor: "#ff9b93"
                        });
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
            iziToast.warning({
                title: "Selecciona una ubicación",
                message:
                    "Coloca un punto en el mapa haciendo clic o utiliza la búsqueda para posicionarte.",
                backgroundColor: "#ffd66b"
            });
            return;
        }

        const lat = coords.latitude?.toFixed(6) || coords.y?.toFixed(6);
        const lng = coords.longitude?.toFixed(6) || coords.x?.toFixed(6);

        iziToast.success({
            title: "Croquis guardado",
            message: `Latitud: ${lat}, Longitud: ${lng}`,
            position: "topRight",
            timeout: 3500
        });

        setTimeout(function() {
            mostrarCard("card_5", "card_6");
        }, 400);
    });

    $("#btn_regresar_card5").click(function(e) {
        e.preventDefault();
        mostrarCard("card_5", "card_4");
    });

    $("#btn_limpiar_mapa").click(function(e) {
        e.preventDefault();
        if (window.clearMap) {
            window.clearMap();
        } else {
            iziToast.info({
                title: "Cargando mapa",
                message:
                    "El mapa aún se está inicializando. Espera un momento e intenta nuevamente.",
                position: "topRight"
            });
        }
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
