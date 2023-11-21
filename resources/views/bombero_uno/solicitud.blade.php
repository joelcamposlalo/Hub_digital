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
                        <input name="id_captura" id="id_captura" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="materia_de"><small>Tipo de Capacitación</small></label>
                                <select name="materia_de" id="materia_de"
                                    class="ab-form background-color rounded border materia_de">
                                    <option value="Control y Combate de Incendios y Primeros Auxilios">Control y Combate de
                                        Incendios y Primeros Auxilios</option>
                                    <option value="Formación de Brigadas">Formación de Brigadas</option>
                                    <option value="PC Contigo">PC Contigo</option>
                                </select>
                            </div>
                        </div>
                        <div id="pc_contigo" style="display: none;">
                            <div class="row">
                                <div class="col mt-2">
                                    <label for="selector_pc"><small>Tipo de Capacitación de Pc contigo</small></label>
                                    <select name="selector1" id="selector1" class="ab-form background-color rounded border">
                                        <option value="Puertas abiertas">Puertas abiertas</option>
                                        <option value="CER (Comunidades Escolares Resilientes)">CER (Comunidades Escolares Resilientes)</option>
                                        <option value="Comités Vecinales de Protección Civil">Comités Vecinales de Protección Civil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="razonSocial" id="razonSocial"><small>Razón Social</small></label>
                                <input name="razonSocial" id="razonSocial"
                                    value="{{ isset($razonSocial) ? $razonSocial : '' }}"
                                    class="ab-form background-color rounded border capitalize razonSocial" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="giro_comercio" id="giro_comercio"><small>Giro Comercial</small></label>
                                <input name="giro_comercio" id="giro_comercio"
                                    value="{{ isset($giro_comercio) ? $giro_comercio : '' }}"
                                    class="ab-form background-color rounded border capitalize giro_comercio"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="nombre"><small>Nombre(s)</small></label>
                                <input name="nombre" id="nombre" value="{{ isset($nombre) ? $nombre : '' }}"
                                    class="ab-form background-color rounded border capitalize nombre" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="apellido_uno"><small>Primer Apellido</small></label>
                                <input name="apellido_uno" id="apellido_uno" value="{{ isset($apellido_uno) ? $apellido_uno : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_uno" type="text" required>
                            </div>
                            <div class="col mt-2">
                                <label for="apellido_dos"><small>Segundo Apellido</small></label>
                                <input name="apellido_dos" id="apellido_dos" value="{{ isset($apellido_dos) ? $apellido_dos : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_dos" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="telefono"><small>Teléfono</small></label>
                                <input name="telefono" id="telefono" value="{{ isset($telefono) ? $telefono : '' }}"
                                    class="ab-form background-color rounded border capitalize telefono" type="tel" data-parsley-length="[10, 10]" required >
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="correo_propietario"><small>Correo Electrónico</small></label>
                                <input name="correo_propietario" id="correo_propietario" data-parsley-type="email"
                                    value="{{ isset($emailPropietario) ? $emailPropietario : '' }}"
                                    class="ab-form background-color rounded border correo_propietario" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="row responsive_numero">
                            <div class="col-10 mt-2 domicilio_div ">
                                <label for="domicilio"><small>Domicilio</small></label>
                                <input name="domicilio" id="domicilio" value="{{ isset($domicilio) ? $domicilio : '' }}"
                                    class="ab-form background-color rounded border capitalize domicilio" type="text"
                                    required>
                            </div>
                            <div class="numero_div col-2 mt-2 ">
                                <label for="numero"><small>Número</small></label>
                                <input name="numero" id="numero" value="{{ isset($numero) ? $numero : '' }}"
                                    class="ab-form background-color rounded border capitalize numero" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="row responsive_numero">
                            <div class="col mt-2 ">
                                <label for="colonia "><small>Colonia</small></label>
                                <input name="colonia" id="colonia" value="{{ isset($colonia) ? $colonia : '' }}"
                                    class="ab-form background-color rounded border capitalize colonia" type="text" required>
                            </div>
                            <div class="col mt-2 domicilio_div">
                                <label for="municipio"><small>Municipio</small></label>
                                <input name="municipio" id="municipio" value="{{ isset($municipio) ? $municipio : '' }}"
                                    class="ab-form background-color rounded border capitalize municipio" type="text" required>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12 mt-2 text-right">
                                <button data-back=".card_1 .card-body" type="button" style="display: none;"
                                    class="ab-btn btn-cancel btn-regresar">Regresar</button>
                                <input name="poligono" id="poligono" class="poligono" type="hidden"
                                    value="{{ isset($poligono) ? $poligono : '' }}">
                                <input name="origen" type="hidden" value='solicitud'>
                                <input name="id_captura" id="id_captura_frm4" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}" required>
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
                    <small>Participantes (Maximo 10 participantes) </p></small>
                    <p>
                </div>
                <div class="card-body">
                    <form id="form_4" method="POST" action="/bombero_uno/guardar">
                        @csrf
                        <div class="responsive w-100" style="width: 100%; overflow-x: auto;">

                            <input name="id_solicitud" id="id_solicitud" type="hidden"
                                value="{{ $folio }}">
                            <input name="id_etapa" id="id_etapa" type="hidden"
                                value="@if (isset($id_etapa)) {{ $id_etapa }} @endif">
                            <div class="container">
                                <div class='row container-fluid ' id="participantes-container">
                                    <div class='col'>
                                        <div class='form-group'>
                                            <label>Nombre Completo de Participante</label>
                                            <input type='text' class='form-control participante capitalize' name='participantes1'
                                                required>
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
                                    <input name="id_captura" id="id_captura_guardar" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
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

        .new-participante{
            flex-direction: column;
            margin-top: 1rem;
        }

        .button-add-participantes{
            margin-top: 1rem;
        }

    @media (max-width: 768px) {
        .responsive_numero {
            flex-direction: column;
        }
        .domicilio_div{
            width: 100%;
            max-width: none;
        }
        .numero_div {
            width: 100%;
            max-width: none;
        }

        .remove-participante{
            margin-bottom: 1rem;
            width: 100%;
        }
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

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })


            $('#nav .menu').click(function() {
                $('.menu-mobile').addClass('open');
            });

            $('.menu-mobile .close').click(function() {
                $('.menu-mobile').removeClass('open');
            });


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

            $('#form_2').parsley();
            $('#form_4').parsley();

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



            $('#form_2').submit(async function(e) {

                $('.btn-guardar').prop('disabled', true);

                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var materia_de = $('.materia_de').val();
                var selector_pc = $('.selector_pc').val();
                var nombre = $('.nombre').val();
                var apellido_uno = $('.apellido_uno').val();
                var apellido_dos = $('.apellido_dos').val();
                var telefono = $('.telefono').val();
                var correo_propietario = $('.correo_propietario').val();
                var domicilio = $('.domicilio').val();
                var numero = $('.numero').val();
                var colonia = $('.colonia').val();
                var municipio = $('.municipio').val();
                var giro_comercio = $('.giro_comercio').val();
                var razonSocial = $('.razonSocial').val();
                var id_etapa = $('#id_etapa').val();



                $('.btn_inserta').html('Guardar');

                if (id_solicitud > 0) {

                    var formdata = new FormData();

                    formdata.append('materia_de', materia_de);
                    formdata.append('selector_pc', selector_pc);
                    formdata.append('nombre', nombre);
                    formdata.append('apellido_uno', apellido_uno);
                    formdata.append('apellido_dos', apellido_dos);
                    formdata.append('telefono', telefono);
                    formdata.append('correo', correo_propietario);
                    formdata.append('domicilio', domicilio);
                    formdata.append('numero', numero);
                    formdata.append('colonia', colonia);
                    formdata.append('municipio', municipio);
                    formdata.append('giro_comercio', giro_comercio);
                    formdata.append('razonSocial', razonSocial);
                    formdata.append('id_solicitud', id_solicitud);

                    if (id_etapa == 0) {
                        formdata.append('etapa', 1);
                    } else {
                        formdata.append('etapa', id_etapa);
                    }

                    if ($('#id_captura').val() == '') {
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
                                $('#id_captura_guardar').val(response.data);
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
                        formdata.append('id_captura', $('#id_captura').val());
                        console.log("en el else")
                        var res = await axios.post(
                            '{{ url('bombero_uno/actualiza_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {
                                console.log(response.data);
                                $('#id_captura_frm4').val(response.data);
                                $('.btn-form4').prop('disabled', false);
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_4 .card-body').slideDown('slow');
                                iziToast.show({
                                    message: 'Se actualizo la información correctamente, puedes agregar a tus participantes',
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

                    document.getElementById("contador").value = x;

                    var newRow = $(
                        "<div class='new-participante row container-fluid d-flex align-items-center'><div class='col'><div class='form-group'><label>Nombre Completo de Participante</label><input type='text' class='form-control participante capitalize' name='participantes" +
                        x +
                        "'required></div></div><div class='col'><button class='btn btn-danger remove-participante'>Eliminar</button></div></div>"
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tipoCapacitacionSelector = document.getElementById('materia_de');
        var pc_contigo = document.getElementById('pc_contigo');

        tipoCapacitacionSelector.addEventListener('change', function () {
            if (tipoCapacitacionSelector.value === 'PC Contigo') {
                pc_contigo.style.display = 'block';
            } else {
                pc_contigo.style.display = 'none';
            }
        });
    });
</script>


@endsection
