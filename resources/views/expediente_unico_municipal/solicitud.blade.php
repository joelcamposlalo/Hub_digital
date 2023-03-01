@extends('base')

@section('title', 'Solicitud')

@section('aside')
    {{ menu_ciudadano('') }}
@endsection

@section('notification')
    {{ get_notificaciones() }}
@endsection

@section('container')
    <h1 class="text-muted font m-0 bold c-primary-color">
        Expediente Único Municipal  @isset($id_captura)
        @endisset
    </h1>
    <small class="font text-muted mb-5">Folio de trámite: {{ $folio }} </small>

    <input name="id_etapa" id="id_etapa" type="hidden" value="@if (isset($id_etapa)) {{ $id_etapa }} @endif">

    <div class="row mt-5 etapas_info">
        <div class="col-md-9">
            <div class="etapas d-flex justify-content-center align-items-center">
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa border @if ($id_etapa == 60) process @else active @endif d-flex justify-content-center align-items-center">
                        @if ($id_etapa != 60 && $id_etapa != 71)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa != 60) text-white @else text-muted @endif">1</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
                </div>
                <div class="@if ($id_etapa != 60) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"class="d-flex flex-column justify-content-center align-items-center">
                    <div class="etapa @if ($id_etapa == 62 || $id_etapa == 85) active text-white @elseif($id_etapa == 61 || $id_etapa == 62|| $id_etapa == 71) process @endif  border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 62 || $id_etapa == 85)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 62 || $id_etapa == 85) text-white @else text-muted @endif ">2</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Adjuntar requisitos</small>
                </div>
                <div class="@if ($id_etapa == 64 || $id_etapa == 85) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 64) active @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 64)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 64) text-white @else text-muted @endif">3</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Carta responsiva</small>
                </div>
                <div class="@if ($id_etapa == 64) line @else line_off @endif"></div>
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 64) active @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 64)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 64) text-white @else text-muted @endif">4</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Terminado</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Muestra la observacion cuando se regresa al ciudadano en movil-->
    @if ($id_etapa == 71)
        <div class="card mt-3 d-block d-sm-none">
            <div class="card-header">
                <small>Observaciones del revisor</small> <br>
                <span class="badge badge-pill badge-warning">{{ $notificacion->created_at }}</span>
            </div>
            <div class="card-body">
                <small>{!! $notificacion->descripcion !!}</small>
            </div>
        </div>
    @endif
    @if($id_etapa == 85)
    <div class="row descarga ocultar">
        <div class="col-md-9 mt-4" id="top-5">
            <div class="card  shadow-sm card_5 rounded border-none">
                <div class="card-header">
                    <small>Solicitud en cotejo</small>
                </div>
                <div class="card-body">
    
                    <!-- Alert -->
                    <div class="alert alert-success " role="alert">
                        <strong class="f-14">Su solicitud se encuentra en cotejo, debe descargar la carta responsiva para presentarse a cotejo cuando se le notifique</strong>
                    </div>
    
                    <div class="row">
    
                        <div class="col-md-6 mt-2">
                            <a href="#!" class="aqui">Descargar carta responsiva</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row position-relative">
       
        <div class="col-md-3 mt-4 position-absolute" style="right: 0;">
            <!-- Aqui va un mapa -->
            <div class="border rounded mapa1" id="map"></div>

            <!-- Muestra la observacion cuando se regresa al ciudadano -->
            @if ($id_etapa == 71)
                <div class="card mt-3 d-none d-md-block d-lg-block d-xl-block">
                    <div class="card-header">
                        <small>Observaciones del revisor</small> <br>
                        <span class="badge badge-pill badge-warning">{{ $notificacion->created_at }}</span>
                    </div>
                    <div class="card-body">
                        <small>{!! $notificacion->descripcion !!}</small>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 mt-4" id="top-4">
            <div class="card  shadow-sm card_4 rounded border-none">
                <div class="card-header">
                    <small>Documentación Legal</small>
                </div>
                <div class="card-body">
                    <form id="form_4" action="{{ url('expediente_unico_municipal/ingresa_tramite') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                            <table class="w-100">
                                @foreach ($files['terminados'] as $file)
                                    <tr class="w-100 predio">
                                        <td class="f-14">
                                            @if ($file->extension == 'pdf')
                                                <a href="{{ Storage::disk('s3')->url('public/' . session('id_usuario')) }}/{{ $file->archivo }}"
                                                    target="_blank">
                                                    <img class="icono"
                                                        src="{{ asset('media/flaticon/archivos/pdf.svg') }}"
                                                        width="50px" alt="{{ $file->nombre }}">
                                                </a>
                                            @elseif ($file->extension == 'jpg' or $file->extension == 'jpeg')
                                                <a href="{{ Storage::disk('s3')->url('public/' . session('id_usuario')) }}/{{ $file->archivo }}"
                                                    data-lightbox="roadtrip">
                                                    <img class="icono"
                                                        src="{{ asset('media/flaticon/archivos/jpg.svg') }}"
                                                        width="50px" alt="{{ $file->nombre }}">
                                                </a>
                                            @else
                                                <a href="{{ Storage::disk('s3')->url('public/' . session('id_usuario')) }}/{{ $file->archivo }}"
                                                    data-lightbox="roadtrip">
                                                    <img class="icono"
                                                        src="{{ asset('media/flaticon/archivos/png.svg') }}"
                                                        width="50px" alt="{{ $file->nombre }}">
                                                </a>
                                            @endif
                                        </td>

                                        <td class="f-12 font archivo">{{ $file->descripcion_larga }} <br>

                                            @if ($file->obligatorio == 1)
                                                <small class="f-10 font text-danger error">Este archivo es
                                                    obligatorio</small>
                                            @else
                                                <small class="f-10 font text-success success">Este archivo es
                                                    opcional</small>
                                            @endif

                                        </td>
                                        <td class="f-12 font filesize">Extensión: {{ $file->extension }}</td>
                                        <td class="f-12 p-0"></td>
                                        <td class="f-14 acciones">

                                            <?php

                                            if (!in_array($file->id_documento, $files['validados'])) {
                                            ?>
                                            <label for="{{ $file->nombre }}" class="ab-btn-effect bold font btn-file">
                                                <small class="font bold f-10 progreso">Actualizar</small>
                                                <input class="file" id="{{ $file->nombre }}" type="file"
                                                    name="file_{{ $file->id_documento }}"
                                                    data-archivo="{{ $file->nombre }}" value="{{ $file->nombre }}"
                                                    data-cat-archivo="{{ $file->id_cat_archivo }}"
                                                    data-update="{{ $file->id_archivo }}" data-upload="0"
                                                    data-required="{{ $file->obligatorio }}">
                                            </label>
                                            <?php
                                            } else {
                                            ?>
                                            <label for="{{ $file->nombre }}" class="ab-btn-effect bold font btn-file"
                                                style="background-color:#75cfb8 !important">
                                                <small class="font bold f-10 text-white success">VALIDADO</small>
                                            </label>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($files['pendientes'] as $key => $file)
                                    <tr class="w-100 predio">
                                        <td class="f-14">
                                            <a class="enlace_box" href="#!">
                                                <img class="icono" style="transform: translateX(10px);"
                                                    src="{{ asset('media/flaticon/archivos/upload.svg') }}"
                                                    width="38px" alt="{{ $file->nombre }}">
                                            </a>
                                        </td>
                                        <td class="f-12 font archivo">{{ $file->descripcion_larga }} <br>
                                            @if ($file->obligatorio == 1)
                                                <small class="f-10 font text-danger error">Este archivo es
                                                    obligatorio</small>
                                            @else
                                                <small class="f-10 font text-success success">Este archivo es
                                                    opcional</small>
                                            @endif
                                        </td>
                                        <td class="f-12 font filesize">Tamaño: 0 bytes</td>
                                        <td class="f-12 p-0"></td>
                                        <td class="f-14 acciones">
                                            <label for="file_{{ $key }}"
                                                class="ab-btn-effect bold font btn-file">
                                                <small class="font bold f-10 progreso">Subir Archivo</small>
                                                <input class="file" id="file_{{ $key }}" type="file"
                                                    name="file_{{ $file->id_documento }}" data-upload="0"
                                                    data-required="{{ $file->obligatorio }}">
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>


                        <input name="id_captura" id="id_captura_frm4" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}" required>
                        <input name="id_solicitud" id="id_solicitud_frm4" type="hidden" value="{{ $folio }}">
                        <input name="id_etapa" id="id_etapa" type="hidden"
                            value="@if (isset($id_etapa)) {{ $id_etapa }} @endif">
                        <div class="row mt-4">
                            <div class="col-md-12 mt-2 text-right">
                                <button class="ab-btn b-primary-color btn-form4" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
        var map;
        var n = 0;

        //Valida si esta en la versión mobile 

        if (is_mobile()) {
            $('.mapa1').remove();
        } else {
            $('.mapa2').remove();
        }

        $(document).ready(function() {



            @if (isset($id_etapa) && $id_etapa == 60)


                //$('.card_1 .card-body').slideDown('slow');
                //$('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 61)
                //$('.card_1 .card-body').slideUp('fast');
                //$('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 62)
                //$('.card_1 .card-body').slideUp('fast');
                //$('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideDown('slow');
            @endif

            @if (isset($id_etapa) && $id_etapa == 63)
                //$('.card_1 .card-body').slideUp('fast');
                //$('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 64)
               // $('.card_predios').fadeOut();
                $('.progreso').fadeOut();
                $('.descarga').removeClass('ocultar');
                //$('.card_1 .card-body').slideUp('fast');
                //$('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 71)
                //$('.card_1 .card-body').slideUp('fast');
               // $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 85)
                $('.continuar').fadeOut();
                $('.btn-guardar').fadeOut();
                $('.btn-form3').fadeOut();
                $('.btn-buscar').fadeOut();
                $('.ab-btn').fadeOut();
                $('.descarga').fadeIn();
                $('.carta').fadeIn();

                //$('.card_predios').fadeOut();
                $('.progreso').fadeOut();

                //$('.card_1 .card-body').slideDown('slow');
               $('.card_3 .card-body').slideDown('slow');
                //$('.card_2 .card-body').slideDown('slow');
                $('.card_4 .card-body').slideDown('slow');
                $('form').prop('disabled', true);
            @endif


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
             * Inicializamos la validación de 
             * los formularios
             * 
             */

           
            $('#form_3').parsley(); 

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
                //$('.card_1 .card-body').slideUp('slow');
                $('.card_3 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-2').position().top
                    }, 500);
                }, 500);

                e.preventDefault();

            });

           
            /**
             * 
             * Completando la tercera parte
             * 
             */
           

           


            $('.aqui').click(function() {
                var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                    "Sábado");
                var f = new Date();
                var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] +
                    " de " + f.getFullYear()
                var id_captura = $('#id_captura').val();
                var url = '{{ url('dictamen_trazos_usos/carta') }}'
                var ruta = url + '/' + fecha + '/' + id_captura;
                
                window.open(ruta, '_blank');


            });

            $('#form_4').submit(function(e) {

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
                    message: 'El formato no es válido, recuerda que solo es posible subir en formato jpg, png, jpeg, pdf, dwg',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }

        });


        function limpia_predio() {
            $('.nombre').val('');
            $('.apellido_1').val('');
            $('.apellido_2').val('');
            $('.domicilio').val("{{ session('domicilio') }}");
            $('.telefono').val("{{ session('telefono') }}");
            $('.correo').val('');
                  
        }



        function limpia_form() {
            $('.nombre').val('');
            $('.apellido_1').val('');
            $('.apellido_2').val('');
            $('.domicilio').val("{{ session('domicilio') }}");
            $('.telefono').val("{{ session('telefono') }}");
            $('.correo').val('');
               
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

     
        function is_mobile() {

            if (typeof(window.orientation) != 'undefined') {
                return true;
            } else {
                return false;
            }

        }
    </script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
    </script>

@endsection
