/*
    Descripción: Se usa para mostrar una animacion 
    en cada boton tipo submit despues de dar clic
*/


function spiner() {
    return `
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
    `
}

/**
 * 
 * Convierte los geopoligonos a json para 
 * mostrar la figura en el mapa
 * 
 */

function GeoPolygonToJson(poligono) {
    var _coord_str = poligono.replace("MULTIPOLYGON(((", "").replace(")))", "");
    _coord_str = _coord_str.replace(/ /g, "*\"lat\":");
    _coord_str = _coord_str.replace(/,/g, "} + {  \"lng\":");
    _coord_str = "{\"lng\":" + _coord_str.replace(/\*/g, ",") + "}";
    console.log(_coord_str);
    var arr = [];
    var arr_temp = _coord_str.split("+");
    for (i = 0; i < arr_temp.length; i++) {
        console.log("elemento :" + arr_temp[i]);
        arr.push(JSON.parse(arr_temp[i]));
    }

    return arr;
}

/**
 * 
 * Obtiene la extension de un archivo
 * 
 */

function get_extension(name) {


    var texto = name;
    var longitud = texto.length;
    var extension = '';

    while (longitud >= 0) {

        if (texto.charAt(longitud) != '.') {
            extension += texto.charAt(longitud);
        } else {
            extension = extension.split('').reverse().join('');
            break;
        }

        longitud--;
    }

    return extension;
}
