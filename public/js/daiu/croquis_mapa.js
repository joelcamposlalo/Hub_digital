let map;
let marker;

const DEFAULT_CENTER = [-103.3918, 20.7236]; // Zapopan
const MAPBOX_TOKEN =
    "pk.eyJ1Ijoiam9lbGNhbXBvc2xhbG8iLCJhIjoiY21hMnFzZ2czMnRsYTJqcHdlM21vbzFrNSJ9.tDX4hUtXX-IHUxtujEctuA";

mapboxgl.accessToken = MAPBOX_TOKEN;

// --- Inicializa el mapa
function initMap() {
    map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v12",
        center: DEFAULT_CENTER,
        zoom: 13
    });

    addGeocoderControl();
    map.on("click", handleMapClick);
}

// --- Añade el buscador
function addGeocoderControl() {
    const geocoder = new MapboxGeocoder({
        accessToken: MAPBOX_TOKEN,
        mapboxgl,
        placeholder: "Buscar dirección...",
        bbox: [-118.5996, 14.3895, -86.8123, 32.7187] // Limita búsqueda a México
    });

    map.addControl(geocoder);

    geocoder.on("result", e => {
        const place = e.result;
        const coords = place.geometry.coordinates;

        if (!isInZapopan(place.context)) {
            alert("Solo se permiten ubicaciones dentro de Zapopan, Jalisco.");
            return;
        }

        map.setCenter(coords);
        placeMarker(coords);
    });
}

// --- Valida si un lugar pertenece a Zapopan
function isInZapopan(context) {
    return context?.some(
        ctx =>
            ctx.id.includes("place") &&
            ctx.text.toLowerCase().includes("zapopan")
    );
}

// --- Maneja clics en el mapa
function handleMapClick(e) {
    const coords = [e.lngLat.lng, e.lngLat.lat];

    // Validación básica por coordenadas (puedes mejorar con reverse geocoding si quieres)
    const [lng, lat] = coords;
    const dentroDeZapopan =
        lng >= -103.5 && lng <= -103.25 && lat >= 20.6 && lat <= 20.8;

    if (!dentroDeZapopan) {
        alert("Solo se permiten ubicaciones dentro de Zapopan, Jalisco.");
        return;
    }

    placeMarker(coords);
}

// --- Coloca o mueve el marcador
function placeMarker(coords) {
    if (marker) {
        marker.setLngLat(coords);
    } else {
        marker = new mapboxgl.Marker({ color: "#1e636d", draggable: true })
            .setLngLat(coords)
            .addTo(map);

        marker.on("dragend", () => {
            const { lng, lat } = marker.getLngLat();
            console.log("Nueva posición:", lng, lat);
        });
    }
}

// --- Busca y geolocaliza una dirección ingresada
function geocodeAddress(direccion) {
    const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(
        direccion
    )}.json?access_token=${MAPBOX_TOKEN}`;

    $.getJSON(url, function(data) {
        if (data.features && data.features.length > 0) {
            const result = data.features[0];
            const coords = result.geometry.coordinates;

            if (!isInZapopan(result.context)) {
                alert(
                    "Solo se permiten ubicaciones dentro de Zapopan, Jalisco."
                );
                return;
            }

            map.setCenter(coords);
            placeMarker(coords);
        } else {
            alert("No se pudo encontrar la dirección.");
        }
    });
}

$(document).ready(function() {
    $("#btn_inserta_4").click(function(e) {
        e.preventDefault();
        mostrarCard("card_4", "card_5");

        $("#map").css("display", "block");

        if (!map) {
            initMap();
        }

        setTimeout(() => {
            map.resize();
        }, 300);

        const domicilio = $("#domicilio")
            .val()
            .trim();
        if (!domicilio) {
            alert("Por favor, ingresa un domicilio antes de continuar.");
            return;
        }

        geocodeAddress(domicilio);
    });

    $("#btn_guardar_mapa").click(function() {
        if (marker) {
            const { lng, lat } = marker.getLngLat();
            alert(`Ubicación guardada: Longitud ${lng}, Latitud ${lat}`);
        } else {
            alert("Por favor, selecciona una ubicación en el mapa.");
        }
    });
});
