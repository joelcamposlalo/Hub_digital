@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted text-center font m-0 bold c-primary-color">Trámite para capacitación @isset($id_captura)@endisset</h1>
<br>
<p class="font text-center text-muted mb-5">Folio de trámite: {{$folio}}</p>
<div class="text-center">
    <p>Por medio de este medio solicitarás una capacitación para incendios y primeros auxilios</p>
    <p>Llena los siguientes campos y sigue los pasos a seguir</p>
</div>

<div class="d-flex justify-content-center etapas_info">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border @if($id_etapa == 169) process @else active @endif d-flex justify-content-center align-items-center">
                    @if($id_etapa != 169 && $id_etapa != 169)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa != 169) @else text-muted @endif">1</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
            </div>
            <div class="@if($id_etapa != 170) line @else line_off @endif"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 170 || $id_etapa == 170) active text-white @elseif($id_etapa == 170) process @endif  border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 170 || $id_etapa == 170)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 170 || $id_etapa == 170) text-white @else text-muted @endif ">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Participantes</small>
            </div>
            <div class="@if($id_etapa == 171) line @else line_off @endif"></div>
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 171) active @endif border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 171)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 171) text-white @else text-muted @endif">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Terminado</small>
            </div>
        </div>
    </div>
</div>
<br><br>

<div class="row position-relative">
    <div class="col" id="top-2">

        <div class="card  shadow-sm card_1 rounded border-none">

            <div class="card-header">
                <small>Datos del solicitante</small>
            </div>
            <div class="card-body">
                <form id=form_2 method="post">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="nombre"><small>Nombre</small></label>
                            <input name="nombre" id="nombre" value="{{((isset($nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" required>
                        </div>
                        <div class="col mt-2">
                            <label for="apellido"><small>Apellidos</small></label>
                            <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="email"><small>Correo Electrónico</small></label>
                            <input name="email" id="email" value="{{((isset($email))?$numero:'')}}" class="ab-form background-color rounded border email" type="email" data-parsley-type="email" required>
                        </div>
                        <div class="col mt-2">
                            <label for="telefono"><small>Teléfono</small></label>
                            <input name="telefono" id="telefono" value="{{((isset($telefono))?$interior:'')}}" class="ab-form background-color rounded border capitalize telefono" type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="colonia"><small>Colonia</small></label>
                            <input name="colonia" id="colonia" value="{{((isset($colonia))?$fraccionamiento:'')}}" class="ab-form background-color rounded border capitalize fraccionamiento" type="text" required>
                        </div>
                        <div class="col mt-2">
                            <label for="municipio"><small>Municipio</small></label>
                            <input name="municipio" id="municipio" value="{{((isset($municipio))?$condominio:'')}}" class="ab-form background-color rounded border capitalize condominio" type="text" required>
                        </div>
                        <div class="col mt-2">
                            <label for="domicilio"><small>Domicilio</small></label>
                            <input name="domicilio" id="domicilio" value="{{((isset($domicilio))?$condominio:'')}}" class="ab-form background-color rounded border capitalize condominio" type="text" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle_1"><small>Entre la calle</small></label>
                            <input name="calle_1" id="calle_1" value="{{((isset($calle_1))?$calle_1:'')}}" class="ab-form background-color rounded border capitalize calle_1" type="text" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle_2"><small>Y la calle</small></label>
                            <input name="calle_2" id="calle_2" value="{{((isset($calle_2))?$calle_2:'')}}" class="ab-form background-color rounded border capitalize calle_2" type="text" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="razon"><small>Razón social</small></label>
                            <input name="razon" id="razon" value="{{((isset($razon))?$calle_1:'')}}" class="ab-form background-color rounded border capitalize calle_1" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="giro"><small>Giro comercial</small></label>
                            <input name="giro" id="giro" value="{{((isset($giro))?$calle_2:'')}}" class="ab-form background-color rounded border capitalize calle_2" type="text">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                            <input name="origen" type="hidden" value='solicitud'>
                            <button class="ab-btn b-primary-color continuar" type="submit">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col" id="top-4">
        <div class="card  shadow-sm card_4 rounded border-none">
            <div class="card-header">
                <small>Participantes</small>
            </div>
            <div class="card-body">
              <h6>Agrega a todos los participantes que seran capacitados</h6>
              <form id=form_2 method="post">
                <div class="row">
                    <div class="col">
                        <p>Participante 1</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" required>
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 2</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 3</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 4</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 5</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 6</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 7</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 8</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 9</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Participante 10</p>
                    </div>
                    <div class="col mt-2">
                        <label for="Nombre"><small>Nombre</small></label>
                        <input name="Nombre" id="Nombre" value="{{((isset($Nombre))?$calle:'')}}" class="ab-form background-color rounded border capitalize nombre" type="text" >
                    </div>
                    <div class="col mt-2">
                        <label for="apellido"><small>Apellidos</small></label>
                        <input name="apellido" id="apellido" value="{{((isset($apellido))?$calle:'')}}" class="ab-form background-color rounded border capitalize apellido" type="text" >
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 mt-2 text-right">
                        <button data-back=".card_2 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                        <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                        <input name="origen" type="hidden" value='solicitud'>
                        <button class="ab-btn b-primary-color continuar" type="submit">Continuar</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 mt-2 text-right">
                        <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                        <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                        <input name="origen" type="hidden" value='solicitud'>
                        <button class="ab-btn b-primary-color continuar" type="submit">Continuar</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>

<p id="parrafo"></p>
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/trabajos_menores/solicitud.css')}}">
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
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

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        $('.card_4 .card-body').slideUp('fast');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('slow');
        $('.card_3 .card-body').slideDown('fast');
        @endif


        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideUp('fast');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        $('.card_4 .card-body').slideDown('slow');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideDown('fast');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        $('.card_4 .card-body').slideUp('fast');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_predios').fadeOut();
        $('.progreso').fadeOut();
        $('.descarga').removeClass('ocultar');
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        $('.card_4 .card-body').slideUp('fast');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideUp('fast');
        @endif

        @if(isset($id_etapa) && $id_etapa == 171)
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
            $('.card_2 .card-body').slideDown('slow');

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

        // $('#form_2').submit(async function(e) {
        //     e.preventDefault();

        //     $('.card_1 .card-body').slideUp('slow');
        //     $('.card_3 .card-body').slideDown('slow');

        //     setTimeout(() => {
        //         $('html, body').animate({
        //             scrollTop: $('#top-3').position().top
        //         }, 500);
        //     }, 500);
        // });

        /**
         *
         * Completando la tercera parte
         *
         */

        $('#form_2').submit(async function(e) {

            $('.btn-guardar').prop('disabled', true);

            e.preventDefault();

            var id_solicitud = "{{$folio}}";
            var cuenta = $('.cuenta').val();
            var calle = $('.calle').val();
            var numero = $('.numero').val();
            var interior = $('.interior').val();
            var fraccionamiento = $('.fraccionamiento').val();
            var manzana = $('.manzana').val();
            var lote = $('.lote').val();
            var condominio = $('.condominio').val();

            var calle_1 = $('.calle_1').val();
            var calle_2 = $('.calle_2').val();
            var nombre = $('.nombre').val();
            var apellido_p = $('.apellido_1').val();
            var apellido_m = $('.apellido_2').val();
            var domicilio = $('.domicilio').val();
            var telefono = $('.telefono').val();
            var correo_propietario = $('.correo_propietario').val();
            var correo = $('#correo').val();
            var id_etapa = $('#id_etapa').val();
            var tipo_tramite = $('.tipo_tramite').val();
            $('.btn-form3').html('Guardar');
            if (id_solicitud > 0) {
                console.log(tipo_tramite);
                //formdata.append('id_solicitud', id_solicitud);
                var formdata = new FormData();
                formdata.append('cuenta', cuenta);
                formdata.append('calle', calle);
                formdata.append('numero', numero);
                formdata.append('interior', interior);
                formdata.append('fraccionamiento', fraccionamiento);
                formdata.append('manzana', manzana);
                formdata.append('lote', lote);
                formdata.append('condominio', condominio);
                formdata.append('calle_1', calle_1);
                formdata.append('calle_2', calle_2);
                formdata.append('nombre', nombre);
                formdata.append('apellido_p', apellido_p);
                formdata.append('apellido_m', apellido_m);
                formdata.append('domicilio', domicilio);
                formdata.append('telefono', telefono);
                formdata.append('correo_propietario', correo_propietario);
                formdata.append('correo', correo);
                formdata.append('tipo_tramite', tipo_tramite);
                //formdata.append('id_etapa', id_etapa);
                formdata.append('id_solicitud', id_solicitud);
                if (id_etapa == 0) {
                    formdata.append('etapa', 1);
                } else {
                    formdata.append('etapa', id_etapa);
                }

                if ($('#id_captura').val() != "") {
                    //console.log(formdata);
                    var res = await axios.post('{{url("bombero_uno/ingresa_solicitud/")}}',
                        formdata, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {

                        if (parseInt(response.data) > 0) {
                            //console.log(response.data);
                            $('#id_captura').val(response.data);
                            $('#id_captura_frm4').val(response.data);

                            $('.card_3 .card-body').slideUp('slow');
                            $('.card_4 .card-body').slideDown('slow');
                            $('.btn-form3').prop('disabled', false);
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

                    var res = await axios.post('{{url("bombero_uno/actualiza_solicitud")}}',
                        formdata, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {

                        if (parseInt(response.data) > 0) {

                            $('#id_captura_frm4').val(response.data);
                            $('.btn-form3').prop('disabled', false);
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
                $('.btn-form3').html('Guardar');
                return false;
            }
        });

        /*
        $('.btn-form3').click(function() {

            if ($('.file').val() == '') {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes cargar todos los archivos requeridos',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

            }

        });
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
            var url = '{{url("dictamen_finca_antigua/carta")}}'
            var ruta = url + '/' + fecha + '/' + id_captura;

            window.open(ruta, '_blank');
        });

        $('#form_2').submit(function(e) {

            if (fileIsRequired() == 0) {
                $('.btn-form3').html(spiner());
                $('.btn-form3').prop('disabled', true);
                return true;
            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: `${fileIsRequired() > 1 ? `${fileIsRequired()} Archivos requeridos faltantes` : `${fileIsRequired()} Archivo requerido faltante`}. Debes cargar todos los archivos`,
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                $('.btn-form3').text('Guardar');
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
        $('.domicilio').val("{{session('domicilio')}}");
        $('.telefono').val("{{session('telefono')}}");
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
        $('.domicilio').val("{{session('domicilio')}}");
        $('.telefono').val("{{session('telefono')}}");
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
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection
