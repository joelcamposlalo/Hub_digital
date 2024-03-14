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
        Trámite web de rectificación de domicilio o ubicación
        @isset($id_captura)
        @endisset
    </h1>
    <div class="font text-center ">Folio de trámite: {{ $folio }}</div>

    <div class="row mt-5 etapas_info">
        <div class="col">
            <div class="etapas d-flex justify-content-center align-items-center">
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa border @if ($id_etapa == 182) process @else active @endif d-flex justify-content-center align-items-center">
                        @if ($id_etapa != 182 && $id_etapa != 182)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small class="font f-15 bold @if ($id_etapa != 182) @else text-muted @endif">1</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
                </div>
                <div class="@if ($id_etapa != 182) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 183 || $id_etapa == 183) active text-white @elseif($id_etapa == 66 || $id_etapa == 67 || $id_etapa == 72) process @endif  border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 183 || $id_etapa == 183)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 183 || $id_etapa == 183) text-white @else text-muted @endif ">2</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos del Solicitante</small>
                </div>
                <div class="@if ($id_etapa == 183 || $id_etapa == 183) line @else line_off @endif"></div>
                <div style="width: 60px; transform: translateY(7px);"
                    class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 183) active @elseif($id_etapa == 183) process @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 183)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 183) text-white @else text-muted @endif">3</small>
                    </div>
                    <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos Para Verificación</small>
                </div>
                <div class="@if ($id_etapa == 183) line @else line_off @endif"></div>
                <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                    <div
                        class="etapa  @if ($id_etapa == 184) active @endif border d-flex justify-content-center align-items-center">
                        @if ($id_etapa == 184)
                            <div class="success d-flex justify-content-center align-items-center">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </div>
                        @endif
                        <small
                            class="font f-15 bold @if ($id_etapa == 184) text-white @else text-muted @endif">4</small>
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
                                <label for="apellido_1"><small>Primer Apellido </small></label>
                                <input name="apellido_1" id="apellido_1" value="{{ isset($apellido_1) ? $apellido_1 : '' }}"
                                    class="ab-form background-color rounded border capitalize apellido_1" type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="apellido_2"><small>Segundo Apellido</small></label>
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
                                    value="{{ isset($correo_propietario) ? $correo_propietario : '' }}"
                                    class="ab-form background-color rounded border correo_propietario" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="domicilio_p"><small>Domicilio en recibo Predial</small></label>
                                <input name="domicilio_p" id="domicilio_p"
                                    value="{{ isset($domicilio_p) ? $domicilio_p : '' }}"
                                    class="ab-form background-color rounded border domicilio_p" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="domicilio_n"><small>Domicilio de notificaciones</small></label>
                                <input name="domicilio_n" id="domicilio_n"
                                    value="{{ isset($domicilio_n) ? $domicilio_n : '' }}"
                                    class="ab-form background-color rounded border capitalize domicilio_n" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="colonia"><small>Colonia</small></label>
                                <input name="colonia" id="colonia" value="{{ isset($colonia) ? $colonia : '' }}"
                                    class="ab-form background-color rounded border capitalize colonia" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="entreCalle_1"><small>Entre Calle 1</small></label>
                                <input name="entreCalle_1" id="entreCalle_1"
                                    value="{{ isset($entreCalle_1) ? $entreCalle_1 : '' }}"
                                    class="ab-form background-color rounded border capitalize entreCalle_1"
                                    type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="entreCalle_2"><small>Entre Calle 2</small></label>
                                <input name="entreCalle_2" id="entreCalle_2"
                                    value="{{ isset($entreCalle_2) ? $entreCalle_2 : '' }}"
                                    class="ab-form background-color rounded border capitalize entreCalle_2"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="numInt"><small>Número Exterior</small></label>
                                <input name="numInt" id="numInt" value="{{ isset($numInt) ? $numInt : '' }}"
                                    class="ab-form background-color rounded border capitalize numInt" type="text">
                            </div>
                            <div class="col mt-2">
                                <label for="numExt"><small>Número Interior</small></label>
                                <input name="numExt" id="numExt" value="{{ isset($numExt) ? $numExt : '' }}"
                                    class="ab-form background-color rounded border capitalize numExt" type="text"
                                    data-parsley-validate="" data-parsley-required="false">
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
                                <input name="id_etapa" id="id_etapa" type="hidden"
                                    value="{{ isset($id_etapa) ? $id_etapa : '' }}">
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
        <div class="col mt-4" id="top_2">
            <div class="card  shadow-sm card_2 rounded border-none">
                <div class="card-header">
                    <small>Datos para la rectificación</small>
                </div>
                <div class="card-body">
                    <form id=form_2>
                        <input name="id_captura" id="id_captura_2" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="numero_cuenta"><small>Número de cuenta Predial</small></label>
                                <input name="numero_cuenta" id="numero_cuenta"
                                    value="{{ isset($numero_cuenta) ? $numero_cuenta : '' }}"
                                    class="ab-form background-color rounded border capitalize numero_cuenta"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="nombre_cuenta"><small>Nombre completo en cuenta Predial</small></label>
                                <input name="nombre_cuenta" id="nombre_cuenta"
                                    value="{{ isset($nombre_cuenta) ? $nombre_cuenta : '' }}"
                                    class="ab-form background-color rounded border capitalize nombre_cuenta"
                                    type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <label for="tipo_rectificacion"><small>Tipo de rectificación</small></label>
                                <select name="tipo_rectificacion" id="tipo_rectificacion"
                                    class="ab-form background-color rounded border tipo_rectificacion">
                                    <option value="Rectificación de notificación">Rectificación de notificación</option>
                                    <option value="Rectificación de ubicación">Rectificación de ubicación</option>
                                </select>
                            </div>
                        </div>
                        <div class="row campo-especifico_1" id="r_nombre">
                            <div class="col mt-2">
                                <label for="rc_nombre"><small>Nombre correcto</small></label>
                                <input name="rc_nombre" id="rc_nombre" value="{{ isset($rc_nombre) ? $rc_nombre : '' }}"
                                    class="ab-form background-color rounded border capitalize rc_nombre" type="text">
                            </div>
                        </div>
                        <div class="row campo-especifico_2" id="r_notificacion">
                            <div class="col mt-2">
                                <label for="rc_notificacion"><small>Domicilio correcto para notificaciones</small></label>
                                <input name="rc_notificacion" id="rc_notificacion"
                                    value="{{ isset($rc_notificacion) ? $rc_notificacion : '' }}"
                                    class="ab-form background-color rounded border capitalize rc_notificacion"
                                    type="text">
                            </div>
                        </div>
                        <div class="row campo-especifico_3" id="r_ubicacion">
                            <div class="col mt-2">
                                <label for="rc_ubicacion"><small>Ubicación correcta</small></label>
                                <input name="rc_ubicacion" id="rc_ubicacion"
                                    value="{{ isset($rc_ubicacion) ? $rc_ubicacion : '' }}"
                                    class="ab-form background-color rounded border capitalize rc_ubicacion"
                                    type="text">
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
                                <button class="ab-btn b-primary-color  " id="btn_inserta_2"
                                    type="submit">Continuar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col mt-4" id="top_3">
            <div class="card  shadow-sm card_3 rounded border-none">
                <div class="card-header">
                    <small>Archivos requeridos</small>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show mt-4 notas" role="alert">
                        <h6 class="font">
                            Nota: Debes de adjuntar todos los archivos obligatorios.
                        </h6>

                    </div>
                    <form id="form_4" action="{{ url('rectificacion/ingresa_tramite') }}" method="POST"
                        enctype="multipart/form-data" data-parsley-validate>
                        <input name="id_captura" id="id_captura_3" type="hidden"
                            value="{{ isset($id_captura) ? $id_captura : '' }}">
                        @csrf
                        <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                            <table class="w-100">

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
                                                <small class="font bold f-10 progreso">Actualizar</small>
                                                <input class="file" id="file_{{ $key }}" type="file"
                                                    name="file_{{ $file->id_documento }}" data-upload="0"
                                                    data-required="{{ $file->obligatorio }}">
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div id="error-message" class="text-danger" style="display:none;">Debes subir un documento</div>

                        <input name="id_solicitud" id="id_solicitud_frm4" type="hidden" value="{{ $folio }}">
                        <input name="id_etapa" id="id_etapa" type="hidden"
                            value="@if (isset($id_etapa)) {{ $id_etapa }} @endif">
                        <div class="row mt-4">
                            <div class="col-md-12 mt-2 text-right">
                                <button data-back=".card_2 .card-body" type="button"
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
    <style>
        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
            background-color: #1E636D !important;
            /* Cambia el color del botón de cerrar */
        }

        div:where(.swal2-icon).swal2-warning {
            border-color: #1e636d !important;
            color: #1e636d !important;
        }
    </style>

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

            @if (isset($id_etapa) && $id_etapa == 182)
                $('.card_1 .card-body').slideDown('slow');
                $('.card_2 .card-body').slideUp('fast');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
            @endif

            @if (isset($id_etapa) && $id_etapa == 183)
                $('.card_1 .card-body').slideUp('fast');
                $('.card_2 .card-body').slideDown('slow');
                $('.card_3 .card-body').slideUp('fast');
                $('.card_4 .card-body').slideUp('fast');
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

            $('#form_1').parsley();
            $('#form_2').parsley();
            $('#form_3').parsley();
            $('#form_4').parsley();

            $('#form_1').submit(async function(e) {
                e.preventDefault();

                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top_2').position().top
                    }, 500);
                }, 500);
            });

            $('#form_1').submit(async function(e) {

                $('.btn_inserta').prop('enabled', true);

                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var nombre = $('.nombre').val();
                var apellido_1 = $('.apellido_1').val();
                var apellido_2 = $('.apellido_2').val();
                var telefono = $('.telefono').val();
                var correo_propietario = $('.correo_propietario').val();
                var domicilio_p = $('.domicilio_p').val();
                var domicilio_n = $('.domicilio_n').val();
                var colonia = $('.colonia').val();
                var entreCalle_1 = $('.entreCalle_1').val();
                var entreCalle_2 = $('.entreCalle_2').val();
                var numInt = $('.numInt').val();
                var numExt = $('.numExt').val();
                var id_etapa = $('id_etapa').val();

                if (id_solicitud > 0) {

                    var formdata = new FormData();

                    formdata.append('id_solicitud', id_solicitud);
                    formdata.append('nombre', nombre);
                    formdata.append('apellido_1', apellido_1);
                    formdata.append('apellido_2', apellido_2);
                    formdata.append('telefono', telefono);
                    formdata.append('correo_propietario', correo_propietario);
                    formdata.append('domicilio_p', domicilio_p);
                    formdata.append('domicilio_n', domicilio_n);
                    formdata.append('colonia', colonia);
                    formdata.append('entreCalle_1', entreCalle_1);
                    formdata.append('entreCalle_2', entreCalle_2);
                    formdata.append('numInt', numInt);
                    formdata.append('numExt', numExt);
                    formdata.append('id_etapa', id_etapa);


                    if ($('#id_captura').val() == "") {

                        var res = await axios.post(
                            '{{ url('rectificacion/ingresa_solicitud') }}',
                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {

                                $('#id_captura').val(response.data);
                                $('#id_captura_2').val(response.data);
                                $('#id_captura_3').val(response.data);
                                $('#id_captura_frm4').val(response.data);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideDown('slow');
                                $('.card_3 .card-body').slideUp('slow');
                                $('.btn-form4').prop('disabled', false);
                                iziToast.show({
                                    message: 'Se registró la información correctamente, puedes continuar llenando la otra información',
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
                        var res = await axios.post(
                            '{{ url('rectificacion/actualiza_solicitud') }}',

                            formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }).then(function(response) {

                            if (parseInt(response.data) > 0) {

                                $('#id_captura_frm4').val(response.data);
                                $('.btn-form4').prop('disabled', false);
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideDown('fast');
                                $('.card_3 .card-body').slideUp('slow');
                                iziToast.show({
                                    message: 'Se actualizo la información correctamente, si lo requieres puedes ingresar tus datos restantes',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });

                            } else {
                                $('.card_1 .card-body').slideUp('slow');
                                $('.card_2 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideUp('slow');

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
                        scrollTop: $('#top_3').position().top
                    }, 500);
                }, 500);
            });

            $('#form_2').submit(async function(e) {
                $('#btn_inserta_2').prop('enable', true);
                e.preventDefault();

                var id_solicitud = "{{ $folio }}";
                var numero_cuenta = $('.numero_cuenta').val();
                var nombre_cuenta = $('.nombre_cuenta').val();
                var tipo_rectificacion = $('.tipo_rectificacion').val();
                var rc_notificacion = $('.rc_notificacion').val();
                var rc_ubicacion = $('.rc_ubicacion').val();

                if ($('#id_captura').val() !== "") {
                    var formdata = new FormData();

                    formdata.append('numero_cuenta', numero_cuenta);
                    formdata.append('nombre_cuenta', nombre_cuenta);
                    formdata.append('tipo_rectificacion', tipo_rectificacion);
                    formdata.append('rc_notificacion', rc_notificacion);
                    formdata.append('rc_ubicacion', rc_ubicacion);
                    formdata.append('id_solicitud', id_solicitud);
                    formdata.append('id_captura', $('#id_captura').val());

                    var res = await axios.post(
                        '{{ url('rectificacion_2/actualiza_solicitud_2') }}',
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
                            $('.card_3 .card-body').slideDown('fast');
                            iziToast.show({
                                message: 'Se actualizó la información correctamente, si lo requieres puedes ingresar tus archivos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });
                        } else {
                            $('.card_1 .card-body').slideUp('slow');
                            $('.card_2 .card-body').slideUp('slow');
                            $('.card_3 .card-body').slideDown('fast');
                            iziToast.show({
                                message: 'Ocurrió un error al tratar de actualizar la información, por favor intenta más tarde',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });
                        }
                    });
                } else {
                    iziToast.show({
                        title: 'Ups ☹️',
                        message: 'Se produjo un error al registrar la solicitud',
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

        $('#form_4').submit(function(e) {
            let archivosFaltantes = archivosRequeridosSubidos();

            // Si todos los archivos requeridos (obligatorios) han sido subidos, permite avanzar
            if (archivosFaltantes === 0) {
                return true;
            } else {
                // Faltan documentos requeridos, pero si son opcionales, permite avanzar
                $('.file').each(function() {
                    if ($(this).attr('data-required') == 1 && $(this).attr('data-upload') != 1) {
                        // Si un archivo requerido no ha sido subido y no es opcional, muestra un SweetAlert y detiene el envío del formulario
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: `Falta subir los archivos obligatorios`,
                            customClass: {
                                closeConfirm: 'btn-close-custom-color'
                            }
                        });
                        e.preventDefault();
                        return false;
                    }
                });
            }
        });



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



        function fileIsRequired() {

            var countFileRequired = 0;

            $('.file').each(function(i, item) {

                if ($(this).attr('data-5') == 0 && $(this).attr('data-required') ==
                    1) {
                    countFileRequired += 1;
                }
            });
            return countFileRequired;
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


        function archivosRequeridosSubidos() {
            let archivosFaltantes = 0;


            $('.file').each(function() {
                if ($(this).attr('data-required') == 1 && $(this).attr('data-upload') != 1) {
                    archivosFaltantes++;
                }
            });

            return archivosFaltantes;
        }

        $('#form_3').submit(function(e) {
            if (archivosRequeridosSubidos() === 0) {

                return true;
            } else {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: `Faltan ${archivosRequeridosSubidos()} documentos requeridos por subir.`,
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                return false;
            }
        });


        function archivosRequeridosSubidos() {
            let archivosFaltantes = 0;
            $('.file').each(function() {
                if ($(this).attr('data-required') == 1 && $(this).attr('data-upload') != 1) {
                    archivosFaltantes++;
                }
            });

            return archivosFaltantes;
        }
    </script>

    <script>
        $(document).ready(function() {
            // Hide all specific fields initially
            $(".campo-especifico_1, .campo-especifico_2, .campo-especifico_3").hide();

            // Show the specific field based on the initially selected option
            showHideFields();

            // Handle change event of the dropdown
            $("#tipo_rectificacion").change(function() {
                // Hide all specific fields
                $(".campo-especifico_1, .campo-especifico_2, .campo-especifico_3").hide();

                // Show the specific field based on the selected option
                showHideFields();
            });

            // Handle form submission
            $("#form_2").submit(function(event) {
                // Clear fields based on the selected option
                clearFields();

                // Continue with form submission
                // ...

                // Prevent the default form submission
                event.preventDefault();
            });

            function showHideFields() {
                var selectedOption = $("#tipo_rectificacion").val();

                if (selectedOption == "Rectificación de nombre") {
                    $(".campo-especifico_1").show();
                } else if (selectedOption == "Rectificación de notificación") {
                    $(".campo-especifico_2").show();
                } else if (selectedOption == "Rectificación de ubicación") {
                    $(".campo-especifico_3").show();
                }
            }

            function clearFields() {
                var selectedOption = $("#tipo_rectificacion").val();

                if (selectedOption !== "Rectificación de nombre") {
                    $("#rc_nombre").val("");
                }

                if (selectedOption !== "Rectificación de notificación") {
                    $("#rc_notificacion").val("");
                }

                if (selectedOption !== "Rectificación de ubicación") {
                    $("#rc_ubicacion").val("");
                }
            }
        });
    </script>



@endsection
