@extends('base')

@section('title', 'Solicitud')

@section('aside')
    {{ menu_ciudadano('') }}
@endsection

@section('notification')
    {{ get_notificaciones() }}
@endsection

@section('container')
    <h1 class="text-muted text-center font m-0 bold c-primary-color">
        Solicitud de Capacitación @isset($id_captura)
        @endisset
    </h1>
    <p class="font text-muted text-center mb-5">Folio de trámite: {{ $folio }}</p>
    <div class="row mt-5 etapas_info">
        <div class="col">
            <div class="etapas d-flex justify-content-center align-items-center">
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa border @if ($id_etapa == 170) process @else active @endif d-flex justify-content-center align-items-center">
                        @if ($id_etapa != 170 && $id_etapa != 170)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small class="font f-15 bold @if ($id_etapa != 170) @else text-muted @endif">1</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
                </div>
                <div class="@if ($id_etapa != 170) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 170 || $id_etapa == 170) active text-white @elseif($id_etapa == 170) process @endif  border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 170 || $id_etapa == 170)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 170 || $id_etapa == 170) text-white @else text-muted @endif ">2</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Participantes</small>
                </div>
                <div class="@if ($id_etapa == 170 || $id_etapa == 170) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 171) active @elseif($id_etapa == 171) process @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 171)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 171) text-white @else text-muted @endif">3</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Terminado</small>
                </div>
            </div>

        </div>
    </div>

    <div class="row position-relative">
        <div class="col mt-4" id="top-2">
            <div class="card  shadow-sm card_1 rounded border-none">
                <div class="card-header">
                    <small>Datos del solicitante</small>
                </div>
                <div class="card-body">
                    <form id=form_2 method="post">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="calle"><small></small></label>
                                <select name="materia_de" id="materia_de"
                                    class="ab-form background-color rounded border materia_de" required>
                                    <option value="incendios">Incendio y Primeros Auxilios</option>
                                    <option value="primeros">Formación de Brigadas</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="nombre"><small>Nombre o Razon Social</small></label>
                                <input name="nombre" id="nombre" value="{{ isset($nombre) ? $nombre : '' }}"
                                    class="ab-form background-color rounded border nombre" type="text" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="apellido_1"><small>Primer Apellido</small></label>
                                <input name="apellido_1" id="apellido_1" value="{{ isset($apellido_1) ? $apellido_1 : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_1" type="text">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="apellido_2"><small>Segundo Apellido</small></label>
                                <input name="apellido_2" id="apellido_2" value="{{ isset($apellido_2) ? $apellido_2 : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_2" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="telefono"><small>Teléfono</small></label>
                                <input name="telefono" id="telefono" value="{{ isset($telefono) ? $telefono : '' }}"
                                    class="ab-form background-color rounded border capitalize telefono" type="tel">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="correo_propietario"><small>Correo Electrónico</small></label>
                                <input name="correo_propietario" id="correo_propietario"
                                    value="{{ isset($emailPropietario) ? $emailPropietario : '' }}"
                                    class="ab-form background-color rounded border correo_propietario"
                                    type="text">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="domicilio"><small>Domicilio</small></label>
                                <input name="domicilio" id="domicilio" value="{{ isset($domicilio) ? $domicilio : '' }}"
                                    class="ab-form background-color rounded border capitalize domicilio" type="text"
                                    required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="colonia"><small>Colonia</small></label>
                                <input name="colonia" id="colonia" value="{{ isset($colonia) ? $colonia : '' }}"
                                    class="ab-form background-color rounded border capitalize colonia" type="text">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="municipio"><small>Municipio</small></label>
                                <input name="municipio" id="municipio" value="{{ isset($municipio) ? $municipio : '' }}"
                                    class="ab-form background-color rounded border capitalize municipio" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="giro_comercio"><small>Giro Comercial</small></label>
                                <input name="giro_comercio" id="giro_comercio"
                                    value="{{ isset($giro_comercio) ? $giro_comercio : '' }}"
                                    class="ab-form background-color rounded border capitalize giro_comercio"
                                    type="text" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 mt-2 text-right">
                                <button data-back=".card_1 .card-body" type="button"
                                    class="ab-btn btn-cancel btn-regresar">Regresar</button>
                                <input name="poligono" id="poligono" class="poligono" type="hidden"
                                    value="{{ isset($poligono) ? $poligono : '' }}">
                                <input name="origen" type="hidden" value='solicitud'>
                                <button class="ab-btn b-primary-color continuar btn_inserta" id="btn_inserta"
                                    type="submit">Continuar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mt-4" id="top-4">
            <div class="card  shadow-sm card_4 rounded border-none">
                <div class="card-header">
                    <small>Participantes</small>
                </div>
                <div class="card-body">

                    <form id="form_4" method="POST" action="/bombero_uno/guardar">
                        @csrf
                        <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                            <input name="id_captura" id="id_captura_frm4" type="hidden"
                                value="{{ isset($id_captura) ? $id_captura : '' }}" required>
                            <input name="id_solicitud" id="id_solicitud_frm4" type="hidden"
                                value="{{ $folio }}">
                            <input name="id_etapa" id="id_etapa" type="hidden"
                                value="@if (isset($id_etapa)) {{ $id_etapa }} @endif">
                            <div class="container">
                                <div class='row container-fluid ' id="participantes-container">
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label>Nombre Completo de Participante</label>
                                            <input type='text' class='form-control participante'
                                                name='participantes1' required>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col button-add-participantes'>
                                        <button type="button" class="btn btn-primary" id="more">Agregar más participantes</button>
                                    </div>
                                    <input id="contador" type="hidden" name="contador" value="1">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 mt-2 text-right">
                                    <button data-back=".card_1 .card-body" type="button"
                                        class="ab-btn btn-cancel btn-regresar">Regresar</button>
                                    <button class="ab-btn b-primary-color btn-form4" type="submit">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .button-add-participantes {
            margin-left: 1rem;
        }

    </style>

@endsection

@section('menu_mobile')
    {{ menu_mobil_ciudadano('') }}
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/trabajos_menores/solicitud.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/lightbox/dist/css/lightbox.min.css') }}">
@endsection

@section('js')
    @parent
    <script src="{{ asset('vendors/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendors/parsley/es.js') }}"></script>
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="{{ asset('vendors/lightbox/dist/js/lightbox.min.js') }}"></script>
    <script>
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        $('.card_4 .card-body').slideUp('fast');

        var map;
        var n = 0;

        //Valida si esta en la versión mobile
        //Valida si esta en la versión mobile
        if (is_mobile()) {
            $('.mapa1').remove();
        } else {
            $('.mapa2').remove();
        }

        $(document).ready(function() {

            @if (isset($id_etapa) && $id_etapa == 65)
                $('.card_1 .card-body').slideDown('slow');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 66)
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 67)
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideDown('slow');
            @endif

            @if (isset($id_etapa) && $id_etapa == 68)
                $('.card_1 .card-body').slideDown('fast');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 69)
                $('.card_predios').fadeOut();
                $('.progreso').fadeOut();
                $('.descarga').removeClass('ocultar');
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 72)
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 86)
                $('.continuar').fadeOut();
                $('.btn-guardar').fadeOut();
                $('.btn-form3').fadeOut();
                $('.btn-buscar').fadeOut();
                $('.ab-btn').fadeOut();
                $('.descarga').fadeIn();
                $('.carta').fadeIn();

                $('.card_predios').fadeOut();
                $('.progreso').fadeOut();

                $('.card_1 .card-body').slideDown('slow');
                $('.card_3 .card-body').slideDown('slow');
                $('.card_2 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideDown('slow');
                $('form').prop('disabled', true);
            @endif

            /**
                lightbox
             */

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })

            /**
             * Menu de optiones
             *
             */

            $('#nav .menu').click(function() {
                $('.menu-mobile').addClass('open');
            });

            $('.menu-mobile .close').click(function() {
                $('.menu-mobile').removeClass('open');
            });

            /**
             *
             * Paginado de prediales
             *
             */

            $('.anterior').click(function() {
                n = n - 5;
                var ultimo = parseInt($('#ultimo').val());

                if (n == 0) {
                    $('.antLi').addClass('disabled');
                }

                if (n < ultimo) {
                    $('.sigLi').removeClass('disabled');
                }

                get_predios(n);
            });

            $('.siguiente').click(function() {
                n = n + 5;
                var ultimo = parseInt($('#ultimo').val());

                if (n == ultimo - 5) {
                    $('.sigLi').addClass('disabled');
                }

                if (n > 0) {
                    $('.antLi').removeClass('disabled');
                }

                get_predios(n);

            });

            /**
             *
             * Inicializamos la validación de
             * los formularios
             *
             */

            $('#form_2').parsley();
            $('#form_4').parsley();


            /**
             *
             * Completando la primera parte
             *
             */


            $('.agregar').click(function(e) {

                if ($('#id_captura').val() == "") {
                    limpia_predio();
                }

                //$('.continuar').fadeOut('fast');
                $('.card_1 .card-body').slideUp('slow');


                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-2').position().top
                    }, 500);
                }, 500);

                e.preventDefault();

            });

            /**
             *
             * Completando la segunda parte
             *
             */

            $('#form_2').submit(async function(e) {
                e.preventDefault();

                $('.card_1 .card-body').slideUp('slow');
                $('.card_4 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-4').position().top
                    }, 500);
                }, 500);
            });

            /**
             *
             * Completando la tercera parte
             *
             */

            $('#form_2').submit(async function(e) {

                $('.btn-guardar').prop('disabled', true);

                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var materia_de = $('.materia_de').val();
                var nombre = $('.nombre').val();
                var apellido_p = $('.apellido_1').val();
                var apellido_m = $('.apellido_2').val();
                var telefono = $('.telefono').val();
                var correo_propietario = $('.correo_propietario').val();
                var domicilio = $('.domicilio').val();
                var colonia = $('.colonia').val();
                var municipio = $('.municipio').val();
                var giro_comercio = $('.giro_comercio').val();
                var id_etapa = $('#id_etapa').val();

                $('.btn_inserta').html('Guardar');

                if (id_solicitud > 0) {
                    //console.log(tipo_tramite);
                    //formdata.append('id_solicitud', id_solicitud);
                    var formdata = new FormData();

                    formdata.append('materia_de', materia_de);
                    formdata.append('nombre', nombre);
                    formdata.append('apellido_p', apellido_p);
                    formdata.append('apellido_m', apellido_m);
                    formdata.append('telefono', telefono);
                    formdata.append('correo', correo_propietario);
                    formdata.append('domicilio', domicilio);
                    formdata.append('colonia', colonia);
                    formdata.append('municipio', municipio);
                    formdata.append('giro_comercio', giro_comercio);
                    //formdata.append('id_etapa', id_etapa);
                    formdata.append('id_solicitud', id_solicitud);

                    if (id_etapa == 0) {
                        formdata.append('etapa', 1);
                    } else {
                        formdata.append('etapa', id_etapa);
                    }

                    if ($('#id_captura').val() != "") {
                        console.log(materia_de);
                        var res = await axios.post(
                            '{{ url('bombero_uno/ingresa_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {
                                //console.log(response.data);
                                $('#id_captura').val(response.data);
                                $('#id_captura_frm4').val(response.data);
                                $('.card_4 .card-body').slideDown('slow');
                                $('.btn-form4').prop('disabled', false);
                                iziToast.show({
                                    message: 'Se registró la información correctamente, puedes agregar a tus participantes',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });
                            } else {
                                $('.card_4 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideDown('slow');

                                iziToast.show({
                                    message: 'Ocurrió un error al tratar de registrar la información, por favor intenta más tarde',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });
                            }
                        });

                    } else {
                        //alert("MODIFICANDO SOLICITUD CON id captura  " + $('#id_captura').val());

                        formdata.append('id_captura', $('#id_captura').val());

                        var res = await axios.post(
                            '{{ url('Capacitaciones_Proteccion_Civil/actualiza_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {

                                $('#id_captura_frm4').val(response.data);
                                $('.btn-form4').prop('disabled', false);
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_4 .card-body').slideDown('slow');
                                iziToast.show({
                                    message: 'Se actualizo la información correctamente, si lo requieres puedes ingresar tus archivos',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });

                            } else {
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_4 .card-body').slideDown('slow');

                                iziToast.show({
                                    message: 'Ocurrió un error al tratar de actualizar la información, por favor intenta más tarde',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });
                            }
                        });

                    }

                } else {
                    iziToast.show({
                        title: 'Ups ☹️',
                        message: 'Se produjo un error al registra la solicitud',
                        backgroundColor: '#ff9b93',
                        closeOnEscape: true
                    });
                    $('.card_4 .card-body').slideUp('slow');
                    $('.card_3 .card-body').slideDown('slow');
                    //    $('.btn-form4').html('Guardar');
                    return false;
                }
            });


            $('.aqui').click(function() {

                var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                    "Sábado");
                var f = new Date();
                var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] +
                    " de " + f.getFullYear()
                var id_captura = $('#id_captura').val();
                var url = '{{ url('dictamen_finca_antigua/carta') }}'
                var ruta = url + '/' + fecha + '/' + id_captura;

                window.open(ruta, '_blank');
            });

            $('#form_5').submit(function(e) {

                if (fileIsRequired() == 0) {
                    $('.btn-form4').html(spiner());
                    $('.btn-form4').prop('disabled', true);
                    return true;
                } else {
                    iziToast.show({
                        title: 'Ups ☹️',
                        message: `${fileIsRequired() > 1 ? `${fileIsRequired()} Archivos requeridos faltantes` : `${fileIsRequired()} Archivo requerido faltante`}. Debes cargar todos los archivos`,
                        backgroundColor: '#ff9b93',
                        closeOnEscape: true
                    });
                    $('.btn-form4').text('Guardar');
                    return false;
                }

            });

            $('.btn-regresar').click(function() {

                $('.btn-guardar').prop('disabled', false);

                let atras = $(this).attr('data-back');

                $(atras).slideDown('slow');
                $(this).parents('.card-body').slideUp('slow');
                $('html, body').animate({
                    scrollTop: $(atras).siblings('.card-header').offset().top
                }, 500);

            });
        });

        /**
         *
         * Paginado de prediales
         *
         */

        function agregar_poligono(geopolygon) {
            if (geopolygon != null) {

                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 18
                });

                var arr = GeoPolygonToJson(geopolygon);

                const poligono = new google.maps.Polygon({
                    path: arr,
                    strokeColor: "#a8dda8",
                    strokeOpacity: 1,
                    strokeWeight: 2,
                    fillColor: "#a8dda8",
                    fillOpacity: 0.3,
                });

                map.setCenter(arr[1]);
                poligono.setMap(map);

            } else {
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 18
                });

                var arr = [];

                const poligono = new google.maps.Polygon({
                    path: arr,
                    strokeColor: "#a8dda8",
                    strokeOpacity: 1,
                    strokeWeight: 2,
                    fillColor: "#a8dda8",
                    fillOpacity: 0.3,
                });
                map.setCenter(arr[1]);
                poligono.setMap(map);

            }
        }


        /**
         * Subir archivos
         */


        $('.file').change(function() {

            var file = event.target.files[0];
            var name = $(this).attr('data-archivo');
            var id_solicitud = "{{ $folio }}";
            var me = $(this);
            var total = 0;
            if (id_solicitud <= 0) {
                alert('Intenta crear la solicitud nuevamente');
                return;
            }

            if (get_extension(file.name) == 'jpg' || get_extension(file.name) == 'jpeg' || get_extension(file
                    .name) == 'png' || get_extension(file.name) == 'pdf' || get_extension(file.name) == 'PDF' ||
                get_extension(file.name) == 'PNG' || get_extension(file.name) == 'JPG' || get_extension(file
                    .name) == 'JPEG' || get_extension(file.name) == 'dwg' || get_extension(file.name) == 'DWG') {

                me.attr('data-upload', '1');
                me.siblings('.progreso').text("Actualizar");
                me.parents('.acciones').siblings('td').find('.icono').attr('src',
                    `{{ asset('media/flaticon/archivos/${get_extension(file.name)}.svg') }}`);
                me.parents('.acciones').siblings('td').find('.icono').parents('.enlace_box').attr('href', '#!')
                me.parents('.acciones').siblings('td').find('.icono').attr('width', `50px`);
                me.parents('.acciones').siblings('.filesize').text(`Tamaño: ${file.size} bytes`);
                me.parents('.acciones').siblings('.archivo').find('br').remove();
                me.parents('.acciones').siblings('.archivo').find('.error').remove();
                me.parents('.acciones').siblings('td').find('.icono').css('transform', `translateX(0)`);

                iziToast.show({
                    message: 'Se subió el archivo correctamente',
                    backgroundColor: '#2fd099',
                    closeOnEscape: true
                });

            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'El formato no es válido, recuerda que solo es posible subir en formato jpg, png, jpeg, pdf',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }

        });


        function limpia_predio() {
            $('.calle').val('');
            $('.numero').val('');
            $('.interior').val('');
            $('.fraccionamiento').val('');
            $('.manzana').val('');
            $('.cuenta').val('');
            $('.lote').val('');
            $('.condominio').val('');

            $('.calle_1').val('');
            $('.calle_2').val('');

            $('.dictamen').val('');
            $('.alineamiento').val('');
            $('.alineamiento').val('');
            $('.id_captura').val('');
            $('.nombre').val('');
            $('.apellido_1').val('');
            $('.apellido_2').val('');
            $('.domicilio').val("{{ session('domicilio') }}");
            $('.telefono').val("{{ session('telefono') }}");
            $('.correo').val('');

            $('.suelo').val('');
            //agregar_poligono(null);
        }


        function limpia_form() {
            $('.calle').val('');
            $('.numero').val('');
            $('.interior').val('');
            $('.fraccionamiento').val('');
            $('.manzana').val('');
            $('.lote').val('');
            $('.condominio').val('');
            $('.calle_1').val('');
            $('.calle_2').val('');

            $('.dictamen').val('');
            $('.alineamiento').val('');
            $('.id_captura').val('');
            $('.nombre').val('');
            $('.apellido_1').val('');
            $('.apellido_2').val('');
            $('.domicilio').val("{{ session('domicilio') }}");
            $('.telefono').val("{{ session('telefono') }}");
            $('.correo').val('');

            $('.suelo').val('');
            //agregar_poligono(null);
        }


        /**
         *
         * Total de archivos requeridos
         * faltantes
         *
         */

        function fileIsRequired() {

            var countFileRequired = 0;

            $('.file').each(function(i, item) {

                if ($(this).attr('data-upload') == 0 && $(this).attr('data-required') == 1) {
                    countFileRequired += 1;
                }

            });

            return countFileRequired;

        }


        function initMap() {


            var markers = [];

            map = new google.maps.Map(document.getElementById("map"), { //Carga el mapa
                center: {
                    lat: 20.6785454,
                    lng: -103.4275859
                },
                zoom: 14,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: true,
                rotateControl: false,
                fullscreenControl: false
            });

        }

        function descarga_solicitud(element) {
            $('#ref_sol').attr('href', '{{ env('SOLICITUD_MORD') }}' + '=' + $('#id_captura').val());
        }

        function is_mobile() {

            if (typeof(window.orientation) != 'undefined') {
                return true;
            } else {
                return false;
            }

        }


        $(document).ready(function() {
            var max_fields = 10;
            var wrapper1 = $("#participantes-container");
            var x = 1;

            document.getElementById("contador").value = x;

            $('#more').on('click', function(e) {
                e.preventDefault();

                if (x < max_fields) {
                    x++;
                    console.log(x)
                    document.getElementById("contador").value = x;

                    var newRow = $(
                        "<div class='new-participante row container-fluid d-flex align-items-center'><div class='col'><div class='form-group'><label>Nombre Completo de Participante</label><input type='text' class='form-control participante' name='participantes" +
                        x +
                        "'required></div></div><div class='col-md-1'><button class='btn btn-danger remove-participante'>Eliminar</button></div></div>"
                    );

                    $(wrapper1).append(newRow);
                } else {
                    alert('Limite de participantes alcanzado');
                }
            });

            $(wrapper1).on('click', '.remove-participante', function(e) {
                e.preventDefault();
                $(this).closest('.row').remove();
                x--;
                document.getElementById("contador").value = x;
            });
        });
    </script>
@endsection
