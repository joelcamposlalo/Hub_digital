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
        Solicitud De Verificación Tecnica De Riesgos @isset($id_captura)
        @endisset
    </h1>
    <div class="font text-center ">Folio de trámite: {{ $folio }}</div>

    <div class="row mt-5 etapas_info">
        <div class="col">
            <div class="etapas d-flex justify-content-center align-items-center">
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa border @if ($id_etapa == 65) process @else active @endif d-flex justify-content-center align-items-center">
                        @if ($id_etapa != 65 && $id_etapa != 72)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small class="font f-15 bold @if ($id_etapa != 65) @else text-muted @endif">1</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
                </div>
                <div class="@if ($id_etapa != 65) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 67 || $id_etapa == 86) active text-white @elseif($id_etapa == 66 || $id_etapa == 67 || $id_etapa == 72) process @endif  border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 67 || $id_etapa == 86)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 67 || $id_etapa == 86) text-white @else text-muted @endif ">2</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos del Solicitante</small>
                </div>
                <div class="@if ($id_etapa == 69 || $id_etapa == 86) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 69) active @elseif($id_etapa == 18) process @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 69)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 69) text-white @else text-muted @endif">3</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos Para Verificación</small>
                </div>
                <div class="@if ($id_etapa == 69) line @else line_off @endif"></div>
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 69) active @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 69)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 69) text-white @else text-muted @endif">4</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Fotografías Adjuntas</small>
                </div>
            </div>
        </div>
    </div>


    <div class="row position-relative">
        <div class="col mt-4" id="top_1">
            <div class="card  shadow-sm card_1 rounded border-none">
                <div class="card-header">
                    <small>Datos del solicitante</small>
                </div>
                <div class="card-body">
                    <form id=form_1 method="post">
                        <input name="id_captura" id="id_captura" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
                        <div class="row">
                            <div class="col mt-2">
                                <label for="nombre"><small>Nombre(s)</small></label>
                                <input name="nombre" id="nombre" value="{{ isset($nombre) ? $nombre : '' }}"
                                    class="ab-form background-color rounded border capitalize nombre" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="apellido_1"><small>Apellido Paterno</small></label>
                                <input name="apellido_1" id="apellido_1" value="{{ isset($apellido_1) ? $apellido_1 : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_1" type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="apellido_2"><small>Apellido Materno</small></label>
                                <input name="apellido_2" id="apellido_2" value="{{ isset($apellido_2) ? $apellido_2 : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_2" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="telefono"><small>Teléfono</small></label>
                                <input name="telefono" id="telefono" value="{{ isset($telefono) ? $telefono : '' }}"
                                    class="ab-form background-color rounded border capitalize telefono" type="tel"
                                    data-parsley-length="[10, 10]">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="correo_propietario"><small>Correo Electrónico</small></label>
                                <input name="correo_propietario" id="correo_propietario" data-parsley-type="email"
                                    value="{{ isset($emailPropietario) ? $emailPropietario : '' }}"
                                    class="ab-form background-color rounded border correo_propietario" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="personaJ"><small>Regímen Fiscal</small></label>
                                <select name="personaJ" id="personaJ"
                                    class="ab-form background-color rounded border personaJ">
                                    <option value="Persona Fisica">Persona Física</option>
                                    <option value="Persona Moral">Persona Moral</option>
                                </select>
                            </div>
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
                                <label for="razonSocial" id="razonSocial"><small>Razón Social</small></label>
                                <input name="razonSocial" id="razonSocial"
                                    value="{{ isset($razonSocial) ? $razonSocial : '' }}"
                                    class="ab-form background-color rounded border capitalize razonSocial" type="text">
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
                                    value="{{ isset($id_captura) ? $id_captura : '' }}">
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
        <div class="col mt-4" id="top-2">
            <div class="card  shadow-sm card_2 rounded border-none">
                <div class="card-header">
                    <small>Datos para la Verificación</small>
                </div>
                <div class="card-body">
                    <form id=form_2>
                        <input name="id_captura" id="id_captura" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-10 mt-2">
                                <label for="domicilio"><small>Domicilio</small></label>
                                <input name="domicilio" id="domicilio" value="{{ isset($domicilio) ? $domicilio : '' }}"
                                    class="ab-form background-color rounded border capitalize domicilio" type="text">
                            </div>
                            <div class="col-2 mt-2">
                                <label for="numero"><small>Número</small></label>
                                <input name="numero" id="numero" value="{{ isset($numero) ? $numero : '' }}"
                                    class="ab-form background-color rounded border capitalize numero" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="colonia"><small>Entre Calle 1</small></label>
                                <input name="colonia" id="colonia" value="{{ isset($colonia) ? $colonia : '' }}"
                                    class="ab-form background-color rounded border capitalize colonia" type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="municipio"><small>Entre Calle 2</small></label>
                                <input name="municipio" id="municipio" value="{{ isset($municipio) ? $municipio : '' }}"
                                    class="ab-form background-color rounded border capitalize municipio" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="colonia"><small>Colonia</small></label>
                                <input name="colonia" id="colonia" value="{{ isset($colonia) ? $colonia : '' }}"
                                    class="ab-form background-color rounded border capitalize colonia" type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="municipio"><small>Municipio</small></label>
                                <input name="municipio" id="municipio" value="{{ isset($municipio) ? $municipio : '' }}"
                                    class="ab-form background-color rounded border capitalize municipio" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="problematica"><small>Descripción</small></label>
                                <input name="problematica" id="problematica"
                                    value="{{ isset($problematica) ? $problematica : '' }}"
                                    class="ab-form background-color rounded border capitalize problematica"
                                    type="text-area" placeholder="DESCRIPCIÓN BREVE DE SU SITUACIÓN:">
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
                                    value="{{ isset($id_captura) ? $id_captura : '' }}">
                                <button data-back=".card_1 .card-body" type="button"
                                    class="ab-btn btn-cancel btn-regresar">Regresar</button>
                                <button class="ab-btn b-primary-color  " id="" type="submit">Continuar</button>
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
                    <small>Archivos requeridos</small>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show mt-4 notas" role="alert">
                        <h6 class="font">
                            Nota: Debes de adjuntar todos los archivos obligatorios, descarga la solicitud
                            <a href="javascript:;" id="ref_sol" onclick="descarga_solicitud(this);"
                                target="_blank">aquí</a>
                        </h6>
                        <h6 class="font">
                            Descarga ejemplo del plano
                            <a href="{{ url('dictamen_finca_antigua/descargarPlano') }}" target="_blank">aquí</a>
                        </h6>
                    </div>
                    <form id="form_4" action="{{ url('dictamen_finca_antigua/ingresa_tramite') }}" method="POST"
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
                                            @if (!in_array($file->id_documento, $files['validados']))
                                                @if ($file->obligatorio == 1)
                                                    <small class="f-10 font text-danger error">Este archivo es
                                                        obligatorio</small>
                                                @else
                                                    <small class="f-10 font text-success success">Este archivo es
                                                        opcional</small>
                                                @endif
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
                                <button data-back=".card_3 .card-body" type="button"
                                    class="ab-btn btn-cancel btn-regresar">Regresar</button>
                                <button class="ab-btn b-primary-color btn-form4" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="btnFloat" data-toggle="modal" data-target="#modal-map"><i class="fas fa-map-marker-alt text-white"></i>
    </div>

    <p id="parrafo"></p>
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



        $(document).ready(function() {

            @if (isset($id_etapa) && $id_etapa == 178)
                $('.card_1 .card-body').slideDown('slow');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 179)
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideDown('slow');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif



            //animacion
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })

            /**
             * Menu de optiones en movil
             *
             */

            $('#nav .menu').click(function() {
                $('.menu-mobile').addClass('open');
            });

            $('.menu-mobile .close').click(function() {
                $('.menu-mobile').removeClass('open');
            });

            //Parsley de validacionn en el form

            $('#form_1').parsley();
            $('#form_2').parsley();
            $('#form_3').parsley();



            //funcion para agregar campos si es persona moral
            $(document).ready(function() {
                // Initially hide the fields and labels
                $("#giro_comercio, #razonSocial, #label_giro_comercio, #label_razonSocial").hide();

                // Listen for changes in the select input
                $("#personaJ").change(function() {
                    var selectedOption = $(this).val();

                    // Check the selected value and show/hide fields and labels accordingly
                    if (selectedOption === "Persona Fisica") {
                        $("#giro_comercio, #razonSocial, #label_giro_comercio, #label_razonSocial")
                            .hide();
                    } else if (selectedOption === "Persona Moral") {
                        $("#giro_comercio, #razonSocial, #label_giro_comercio, #label_razonSocial")
                            .show();
                    }
                });
            });

            $('#form_1').submit(async function(e) {
                e.preventDefault();

                $('.card_1 .card-body').slideUp('slow');
                $('.card_3 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-3').position().top
                    }, 500);
                }, 500);
            });

            $('#form_1').submit(async function(e) {

                $('.btn_inserta').prop('disabled', true);

                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var nombre = $('.nombre').val();
                var apellido_1 = $('.apellido_1').val();
                var apellido_2 = $('.apellido_2').val();
                var telefono = $('.telefono').val();
                var correo_propietario = $('.correo_propietario').val();
                var giro_comercio = $('.giro_comercio').val();
                var razonSocial = $('.razonSocial').val();
                var tipo_tramite = $('.tipo_tramite').val();



                //$('.btn-form4').html('Guardar');
                if (id_solicitud > 0) {


                    var formdata = new FormData();
                    //Comienza Formulario #1 Datos ciudadano
                    formdata.append('nombre', nombre);
                    formdata.append('telefono', telefono);
                    formdata.append('apellido_1', apellido_1);
                    formdata.append('apellido_2', apellido_2);
                    formdata.append('correo', correo_propietario);
                    formdata.append('giro_comercio', giro_comercio);
                    formdata.append('razonSocial', razonSocial);
                    //Termina Formulario #1 Datos ciudadano

                    //formdata.append('id_etapa', id_etapa);
                    formdata.append('id_solicitud', id_solicitud);

                    // if (id_etapa == 0) {
                    //     formdata.append('etapa', 1);
                    // } else {
                    //     formdata.append('etapa', id_etapa);
                    // }

                    if ($('#id_captura').val() == "") {

                        var res = await axios.post('{{ url('verificacion_tecnica_riesgos/ingresa_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {
                                //console.log(response.data);
                                $('#id_captura').val(response.data);
                                $('#id_captura_frm4').val(response.data);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideDown('slow');
                                $('.card_3 .card-body').slideUp('slow');
                                $('.btn-form4').prop('disabled', false);
                                iziToast.show({
                                    message: 'Se registró la información correctamente, puedes ingresar tus archivos',
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


                        var res = await axios.post('{{ url('verificacion_tecnica_riesgos/actualiza_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {

                                $('#id_captura_frm4').val(response.data);
                                $('.btn-form4').prop('disabled', false);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideUp('slow');
                                $('.card_4 .card-body').slideDown('slow');
                                iziToast.show({
                                    message: 'Se actualizo la información correctamente, si lo requieres puedes ingresar tus archivos',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });

                            } else {
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideUp('slow');
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
                    $('.card_1 .card-body').slideUp('slow');
                    $('.card_2 .card-body').slideUp('slow');
                    $('.card_3 .card-body').slideDown('slow');
                    $('.btn-form4').html('Guardar');
                    return false;
                }
            });



            $('#form_2').submit(async function(e) {
                e.preventDefault();

                $('.card_1 .card-body').slideUp('slow');
                $('.card_3 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-3').position().top
                    }, 500);
                }, 500);
            });

            $('#form_2').submit(async function(e) {

                $('.btn_inserta').prop('disabled', true);

                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var nombre = $('.nombre').val();
                var apellido_1 = $('.apellido_1').val();
                var apellido_2 = $('.apellido_2').val();
                var telefono = $('.telefono').val();
                var correo_propietario = $('.correo_propietario').val();

                var giro_comercio = $('.giro_comercio').val();
                var razonSocial = $('.razonSocial').val();
                var tipo_tramite = $('.tipo_tramite').val();



                //$('.btn-form4').html('Guardar');
                if (id_solicitud > 0) {


                    var formdata = new FormData();
                    //Comienza Formulario #1 Datos ciudadano
                    formdata.append('nombre', nombre);
                    formdata.append('apellido_1', apellido_1);
                    formdata.append('apellido_2', apellido_2);
                    formdata.append('telefono', telefono);
                    formdata.append('correo', correo_propietario);
                    formdata.append('giro_comercio', giro_comercio);
                    formdata.append('razonSocial', razonSocial);
                    //Termina Formulario #1 Datos ciudadano

                    //formdata.append('id_etapa', id_etapa);
                    formdata.append('id_solicitud', id_solicitud);

                    // if (id_etapa == 0) {
                    //     formdata.append('etapa', 1);
                    // } else {
                    //     formdata.append('etapa', id_etapa);
                    // }

                    if ($('#id_captura').val() == "") {

                        var res = await axios.post('{{ url('verificacion_tecnica_riesgos/ingresa_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {
                                //console.log(response.data);
                                $('#id_captura').val(response.data);
                                $('#id_captura_frm4').val(response.data);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideDown('slow');
                                $('.card_3 .card-body').slideUp('slow');
                                $('.btn-form4').prop('disabled', false);
                                iziToast.show({
                                    message: 'Se registró la información correctamente, puedes ingresar tus archivos',
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


                        var res = await axios.post('{{ url('manejo_arbolada/actualiza_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {

                                $('#id_captura_frm4').val(response.data);
                                $('.btn-form4').prop('disabled', false);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideUp('slow');
                                $('.card_4 .card-body').slideDown('slow');
                                iziToast.show({
                                    message: 'Se actualizo la información correctamente, si lo requieres puedes ingresar tus archivos',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });

                            } else {
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideUp('slow');
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
                    $('.card_1 .card-body').slideUp('slow');
                    $('.card_2 .card-body').slideUp('slow');
                    $('.card_3 .card-body').slideDown('slow');
                    $('.btn-form4').html('Guardar');
                    return false;
                }
            });





            $('.aqui').click(function() {

                var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo",
                    "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                var diasSemana = new Array("Domingo", "Lunes", "Martes",
                    "Miércoles", "Jueves", "Viernes",
                    "Sábado");
                var f = new Date();
                var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " +
                    meses[f.getMonth()] +
                    " de " + f.getFullYear()
                var id_captura = $('#id_captura').val();
                var url = '{{ url('dictamen_finca_antigua/carta') }}'
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
                    scrollTop: $(atras).siblings('.card-header').offset()
                        .top
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

            if (get_extension(file.name) == 'jpg' || get_extension(file.name) ==
                'jpeg' || get_extension(file
                    .name) == 'png' || get_extension(file.name) == 'pdf' ||
                get_extension(file.name) == 'PDF' ||
                get_extension(file.name) == 'PNG' || get_extension(file.name) ==
                'JPG' || get_extension(file
                    .name) == 'JPEG' || get_extension(file.name) == 'dwg' ||
                get_extension(file.name) == 'DWG') {

                me.attr('data-upload', '1');
                me.siblings('.progreso').text("Actualizar");
                me.parents('.acciones').siblings('td').find('.icono').attr('src',
                    `{{ asset('media/flaticon/archivos/${get_extension(file.name)}.svg') }}`
                );
                me.parents('.acciones').siblings('td').find('.icono').parents(
                    '.enlace_box').attr('href', '#!')
                me.parents('.acciones').siblings('td').find('.icono').attr('width',
                    `50px`);
                me.parents('.acciones').siblings('.filesize').text(
                    `Tamaño: ${file.size} bytes`);
                me.parents('.acciones').siblings('.archivo').find('br').remove();
                me.parents('.acciones').siblings('.archivo').find('.error').remove();
                me.parents('.acciones').siblings('td').find('.icono').css('transform',
                    `translateX(0)`);

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

                if ($(this).attr('data-upload') == 0 && $(this).attr('data-required') ==
                    1) {
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
            $('#ref_sol').attr('href', '{{ env('SOLICITUD_MORD') }}' + '=' + $('#id_captura')
                .val());
        }

        function is_mobile() {

            if (typeof(window.orientation) != 'undefined') {
                return true;
            } else {
                return false;
            }

        }
    </script>

@endsection
