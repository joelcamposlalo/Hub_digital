@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Permisos tiempos extraordinarios</h1>
<small class="font text-muted mb-5 f-15">Folio de trámite: {{$folio}}</small>
<div class="row mt-5">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border active d-flex justify-content-center align-items-center">
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="45_3 bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="font f-16 bold text-white">1</small>
                </div>
                <small class="font c-carbon f-11 text-center">Carta responsiva</small>
            </div>
            <div class="line"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="46_1 etapa @if($id_etapa != 45) active @else process  @endif border d-flex justify-content-center align-items-center">
                    <div class="46_2 @if($id_etapa != 45) success @endif d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="46_3 bi bi-check2 bold text-white @if($id_etapa != 45) @else ocultar @endif" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="46_4 font f-16 bold @if($id_etapa != 45)  text-white @else text-muted @endif">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-13 text-center">Solicitud</small>
            </div>
            <div class="47 @if($id_etapa == 47 || $id_etapa == 48 || $id_etapa == 49) line @else line_off @endif"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="47_1 etapa @if($id_etapa == 48 || $id_etapa == 49) active @elseif($id_etapa == 47) process @endif border d-flex justify-content-center align-items-center">
                    <div class="47_2 @if($id_etapa == 48 || $id_etapa == 49) success @endif d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="47_3 bi bi-check2 bold text-white @if($id_etapa != 48 && $id_etapa != 49) ocultar @endif" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="47_4 font f-16 bold @if($id_etapa == 48 || $id_etapa == 49) text-white @else text-muted @endif">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-12 text-center">Orden de Pago</small>
            </div>
            <div class="@if($id_etapa == 49) line @else line_off @endif"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa @if($id_etapa == 49) active @endif border d-flex justify-content-center align-items-center">
                    <div class="49_2 @if($id_etapa == 49) success @endif d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="47_3 bi bi-check2 bold text-white @if($id_etapa != 49) ocultar @endif" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="font f-16 bold @if($id_etapa == 49) text-white @else text-muted @endif">4</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-13 text-center">Permiso</small>
            </div>
        </div>
    </div>
</div>

<div class="row descarga ocultar">
    <div class="col-md-9 mt-4" id="top-5">
        <div class="card  shadow-sm rounded border-none">
            <div class="card-header">
                <small>Descarga</small>
            </div>
            <div class="card-body">
                <!-- Alert -->
                <div class="alert alert-success " role="alert">
                    <strong class="f-14">¡Descárga tu permiso!</strong>
                </div>
                <div class="col-md-12 mt-2">
                    @if(isset($id_permiso))
                    <a href="{{route('permiso', $id_permiso)}}" target="_blank">
                        <button type="button" class="ab-btn b-primary-color">Descargar <i class="fas fa-file-download ml-2"></i></button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row position-relative carta">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_1 rounded border-none">
            <div class="card-header" id="card_header_1">
                <small>Datos de licencia</small>
            </div>
            <div class="card-body">
                <form id="form_1" action="">


                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-13">Nota:</strong><small class="f-13"> Si realizas el trámite del permiso deberás pagarlo 72 hrs. antes de la fecha de inicio del mismo.</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="no_licencia"><small>Número de licencia</small></label>
                            <input name="no_licencia" id="no_licencia" value="{{((isset($TxtNoLicencia))?$TxtNoLicencia:'')}}" class="ab-form background-color rounded border no_licencia" type="text" data-parsley-type="number" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-right">
                            <button type="button" class="ab-btn b-primary-color btn-buscar">Buscar licencia</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small>Contribuyente</small></label>
                            <input name="nombre" id="nombre" value="{{((isset($nombre))?$nombre:'')}}" class="ab-form background-color rounded border nombre" type="text" readonly required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="giro_principal"><small>Giro principal</small></label>
                            <input name="giro_principal" id="giro_principal" value="{{((isset($giro_principal))?$giro_principal:'')}}" class="ab-form background-color rounded border giro_principal" type="text" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="domicilio"><small>Domicilio</small></label>
                            <input name="domicilio" id="domicilio" value="{{((isset($domicilio))?$domicilio:'')}}" class="ab-form background-color rounded border domicilio" type="text" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-4 text-right">
                            <button class="ab-btn b-primary-color continuar btn_continuar">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row position-relative carta">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_2 rounded border-none">
            <div class="card-header" id='card_header_2'>
                <small>Datos del permiso</small>
            </div>
            <div class="card-body">
                <form id="form_2" method="post">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-13">Restricción:</strong> <small class="f-13 restriccion">
                            <nav></nav>
                        </small>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-13">Nota:</strong> <small class="f-13 nota_licencia">
                            <nav></nav>
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2 tipo @if(!isset($Per)) ocultar @endif">
                            <label for="permiso"><small>Tipo de permiso</small></label>
                            @if(isset($Per))
                            <input id="permiso_nombre" type="text" name="permiso_nombre" value="{{((isset($Per_nombre))?$Per_nombre:'')}}" class="ab-form background-color rounded border permiso_nombre" readonly>
                            <input id="permiso" type="hidden" name="permiso" value="{{((isset($Per))?$Per:'')}}" class="ab-form background-color rounded border permiso" readonly>
                            @else
                            <select name="permiso" id="permiso" class="ab-form background-color rounded border permiso" required>
                                <option value="">Selecciona una opción</option>
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="fechas"><small>Día(s) donde requieres el permiso extendido</small></label>
                            <div class="input-group flatpickr">
                                <input id="fecha" type="text" name="fechas" value="{{((isset($fechas))?$fechas:'')}}" class="ab-form form-control background-color rounded border fechas" placeholder="Click para mostrar el calendario" data-input required>
                                <span id="calendario" class="input-group-text input-button" style="font-size: 1.5rem; cursor: pointer" data-toggle><i class="fas fa-calendar-alt"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input type="hidden" name="etapa" id="etapa" value="46">
                            <input type="hidden" name="id_usuario" id="id_usuario" value="{{session('id_usuario')}}">
                            <input type="hidden" name="id_solicitud" id="id_solicitud" value="{{$folio}}">
                            <input type="hidden" name="idgiro" id="idgiro" value="{{((isset($idgiro))?$idgiro:'')}}">
                            <input type="hidden" name="tipo_permiso" id="tipo_permiso" value="">
                            <input type="hidden" name="sub_permiso" id="sub_permiso" value="{{((isset($SubPer))?$SubPer:'')}}">
                            <input type="hidden" name="horas" id="horas" value="{{((isset($horas))?$horas:'')}}">
                            <input type="hidden" name="correo" id="correo" value="{{session('correo')}}">
                            <input type="hidden" name="telefono" id="telefono" value="{{session('telefono')}}">
                            <input type="hidden" name="fecha_sol" id="fecha_sol" value="{{((isset($fechaSol))?$fechaSol:'')}}">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color btn-form2" id="btn-form2" type="submit">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row position-relative carta-iframe">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_3 rounded border-none">
            <div class="card-header" id="card_header_3">
                <small>Orden de Pago</small>
            </div>
            <div class="card-body">
                <iframe id="inlineFrameExample" name="inlineFrameExample" title="Inline Frame Example" width="100%" height="1100" src=""></iframe>
            </div>
        </div>
    </div>
</div>


@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/trabajos_menores/solicitud.css')}}">
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {

        @if(isset($id_etapa) && ($id_etapa == 45))
        $('.btn_continuar').fadeOut();
        $('.card_2 .card-body').slideUp('fast');
        $('.carta-iframe .card-body').slideUp('fast');
        @endif
        @if(isset($id_etapa) && ($id_etapa == 47))
        $('.btn_continuar').fadeOut();
        $('.card_1 .card-body').slideUp('fast');
        $('.card_2 .card-body').slideUp('fast');
        consulta();
        @endif
        @if(isset($id_etapa) && ($id_etapa == 48))
        window.location.replace('{{url("ciudadano/tramites")}}');
        @endif

        @if(isset($id_etapa) && ($id_etapa == 49))
        $('.descarga').removeClass('ocultar');
        $('.card_1 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.carta-iframe').fadeOut();
        $('form').prop('disabled', true);
        $('input').prop('readonly', true);
        $('.btn-buscar').fadeOut();
        $('.btn_continuar').fadeOut();
        $('.btn-regresar').fadeOut();
        $('.btn-form2').fadeOut();
        notas($('#idgiro').val());
        console.log($('#idgiro').val());
        @endif

        /**
         * 
         * Tooltip
         * 
         */

        tippy('#cuenta-tooltip', {
            content: '<small class="font f-10"> Recuerda que son 10 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
        });


        /** 
         * Menu de optiones
         * 
         */
        $(".flatpickr").flatpickr({
            minDate: "today",
            mode: "multiple",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {

            },
            wrap: true,
        });

        function cuentaDias() {
            const fechasArray = $(".fechas").val().split(',');

            if (fechasArray.length > 2) {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Solo puedes seleccionar hasta 31 días',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

                $(".flatpickr").flatpickr({
                    enable: []
                });

            } else {
                $(".flatpickr").flatpickr({
                    disable: []
                });
            }
        }


        /**
         * 
         * Tooltip
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
        @if(!isset($id_captura))
        $('#form_1').parsley();
        $('#form_2').parsley();
        $('#form_3').parsley();
        @endif

        /**
         * 
         * Completando la primera parte
         * 
         */

        $('#form_1').submit(function(e) {
            e.preventDefault();

            $('.card_1 .card-body').slideUp('slow');
            $('.card_2 .card-body').slideDown('slow');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#card_header_2').position().top
                }, 500);
            }, 500);

        });

        $('.permiso').change(function() {
            console.log($('#permiso option:selected').text());

        });
        $('#form_2').submit(async function(e) {

            e.preventDefault();

            $('.btn-form2').prop('disabled', true);
            $('.btn-form2').html(spiner());

            const fecha = new Date();

            var formdata = new FormData();

            //formdata.append('Dias2', fecha.getDate());
            formdata.append('TxtNoLicencia', $('.no_licencia').val());
            formdata.append('nombre', $('.nombre').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase()));
            formdata.append('giro_principal', $('.giro_principal').val());
            formdata.append('domicilio', $('.domicilio').val());
            formdata.append('fechas', $('#fecha').val());
            formdata.append('id_solicitud', $('#id_solicitud').val());
            formdata.append('checkbox', $('#fecha').val());
            formdata.append('Per', $('.permiso').val());
            formdata.append('SubPer', $('#sub_permiso').val());
            formdata.append('Per_nombre', $('#permiso option:selected').text());
            formdata.append('horas', $('#horas').val());
            formdata.append('correo', $('#correo').val());
            formdata.append('telefono', $('#telefono').val());
            formdata.append('fechaSol', $('#fecha_sol').val());
            formdata.append('etapa', $('#etapa').val());
            formdata.append('idgiro', $('#idgiro').val());


            var response = await axios.post('{{url("horas_extras/ingresa_solitud")}}', formdata, {
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            }).then(function(response) {
                console.log(response);
                console.log(response.data);
                if (response.data == "1") {
                    iziToast.show({
                        message: 'Se registró la información correctamente',
                        backgroundColor: '#2fd099',
                        closeOnEscape: true
                    });

                    var formElement = document.createElement("form");
                    document.body.appendChild(formElement);

                    var element1 = document.createElement("input");
                    element1.name = "TxtNoLicencia";
                    element1.type = "hidden";
                    element1.value = $('.no_licencia').val();
                    formElement.appendChild(element1);

                    var element2 = document.createElement("input");
                    element2.name = "NumDias";
                    element2.type = "hidden";
                    element2.value = "";
                    formElement.appendChild(element2);

                    var element3 = document.createElement("input");
                    element3.name = "UWeb";
                    element3.type = "hidden";
                    element3.value = "";
                    formElement.appendChild(element3);

                    formElement.append("<input name='_token' value='{{ csrf_token() }}' type='hidden'>");

                    var element4 = document.createElement("input");
                    element4.name = "nombre";
                    element4.type = "hidden";
                    element4.value = $('.nombre').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase());
                    formElement.appendChild(element4);

                    var element5 = document.createElement("input");
                    element5.name = "giro_principal";
                    element5.type = "hidden";
                    element5.value = $('.giro_principal').val();
                    formElement.appendChild(element5);

                    var element6 = document.createElement("input");
                    element6.name = "fechas";
                    element6.type = "hidden";
                    element6.value = $('#fecha').val();
                    formElement.appendChild(element6);

                    var element7 = document.createElement("input");
                    element7.name = "id_etapa";
                    element7.type = "hidden";
                    element7.value = $('#id_etapa').val();
                    formElement.appendChild(element7);

                    var element8 = document.createElement("input");
                    element8.name = "id_solicitud";
                    element8.type = "hidden";
                    element8.value = $('#id_solicitud').val();
                    formElement.appendChild(element8);

                    var element9 = document.createElement("input");
                    element9.name = "Per";
                    element9.type = "hidden";
                    element9.value = $('.permiso').val();
                    formElement.appendChild(element9);

                    var element10 = document.createElement("input");
                    element10.name = "checkbox";
                    element10.type = "hidden";
                    element10.value = $('#fecha').val();
                    formElement.appendChild(element10);

                    var element11 = document.createElement("input");
                    element11.name = "SubPer";
                    element11.type = "hidden";
                    element11.value = $('#sub_permiso').val();
                    formElement.appendChild(element11);

                    var element12 = document.createElement("input");
                    element12.name = "horas";
                    element12.type = "hidden";
                    element12.value = $('#horas').val();
                    formElement.appendChild(element12);

                    var element13 = document.createElement("input");
                    element13.name = "correo";
                    element13.type = "hidden";
                    element13.value = $('#correo').val();
                    formElement.appendChild(element13);

                    var element14 = document.createElement("input");
                    element14.name = "telefono";
                    element14.type = "hidden";
                    element14.value = $('#telefono').val();
                    formElement.appendChild(element14);

                    var element15 = document.createElement("input");
                    element15.name = "id_usuario";
                    element15.type = "hidden";
                    element15.value = $('#id_usuario').val();
                    formElement.appendChild(element15);

                    
                    var element16 = document.createElement("input");
                    element16.name = "correo_vdigital";
                    element16.type = "hidden";
                    element16.value = "{{session('correo')}}";
                    formElement.appendChild(element16);

                    
                    $('.card_2 .card-body').slideUp('slow');
                    $('.carta-iframe .card-body').slideDown('fast');
                    $('.46_1').removeClass('process');
                    $('.46_1').addClass('active');
                    $('.46_2').addClass('success');
                    $('.46_3').removeClass('ocultar');
                    $('.46_4').removeClass('text-muted');
                    $('.46_4').addClass('text_white');
                    $('.47').removeClass('line_off');
                    $('.47').addClass('line');
                    $('.47_1').addClass('process');


                    setTimeout(() => {
                        $('html, body').animate({
                            scrollTop: $('#card_header_3').position().top
                        }, 500);
                    }, 500);

                    var request = new XMLHttpRequest();
                    formElement.method = "get";
                    formElement.action = '{{url("horas_extras/orden")}}';
                    //formElement.action = 'https://portal.zapopan.gob.mx/pyl/permisos2020test/Orden244.asp';

                    formElement.target = "inlineFrameExample";
                    formElement.submit();
                }



            }).catch(function(error) {
                console.log(error);
                iziToast.show({
                    message: 'Ocurrió un error al tratar de registrar la información, por favor intenta más tarde',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                $('.btn-form2').prop('disabled', false);
                $('.btn-form2').html('Continuar');
            });
        });


        $('.btn-regresar').click(function() {

            let atras = $(this).attr('data-back');

            $(atras).slideDown('slow');
            $(this).parents('.card-body').slideUp('slow');
            $('html, body').animate({
                scrollTop: $(atras).siblings('.card-header').offset().top
            }, 500);

        });

        $('.no_licencia').change(function() {
            $('.btn_continuar').fadeOut();
            $('.nombre-hidden').val('');
            $('.domicilio-hidden').val('');
            $('.nombre').val('');
            $('.domicilio').val('');
            $('.giro_principal').val('');
            $('.idgiro').val('');
        });


        $('.btn-buscar').click(function() {

            $('.btn-buscar').prop('disabled', true);
            $('.btn-buscar').html(spiner());
            no_licencia = $('.no_licencia').val();

            console.log(no_licencia);

            $.ajax({
                url: "{{url('horas_extras/get_datos_licencia')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "licencia": no_licencia
                },
                type: 'post',
                dataType: "json",
                success: function(response) {

                    try {

                        if (typeof(response.msg) != 'undefined') {
                            iziToast.show({
                                title: 'Upsi ☹️',
                                message: response.msg,
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });
                            $('.giro_principal').val(response.Giro);

                        } else {
                            $('.giro_principal').val(response[0].Giro);
                            $('#idgiro').val(response[0].idgiro);


                            validaciones(response[0].idgiro, response[0].NombreContribuyente, response[0].DomicilioNegocio)

                        }

                        $('.btn-buscar').prop('disabled', false);
                        $('.btn-buscar').text("Buscar licencia");

                    } catch (error) {
                        console.log(error);
                    }
                },
                error: function(error) {
                    try {

                        iziToast.show({
                            title: 'Error',
                            message: 'Ocurrió un problema al tratar de obtener la información de tu Licencia, revisa tu conexión',
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                    } catch (error) {
                        console.log(error);
                    }
                    $('.btn-buscar').prop('disabled', false);
                    $('.btn-buscar').text("Buscar licencia");

                }
            });

        });

        function validaciones(idgiro, nombre, domicilio) {

            $.ajax({
                url: "{{url('horas_extras/get_permisos_giro')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_giro": idgiro
                },
                type: 'post',
                dataType: "json",
                success: function(response) {

                    try {

                        $('.permiso').empty();
                        $('.permiso244').empty();
                        if (typeof(response.msg) != 'undefined') {

                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'Su tipo de giro no puede trámitar horas extras, consulta con la Dirección de Padrón y Licencias',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true,
                                position: 'center',
                                timeout: false,
                            });
                            $('.restriccion').text('');
                            $('.nota_licencia').text('');
                            $('.btn_continuar').fadeOut();
                        } else {

                            iziToast.show({
                                title: '¡Excelente!, continuemos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });

                            console.log(response);

                            $('.restriccion').html(response['permisos'][0].restricciones);
                            $('.nota_licencia').html(response['permisos'][0].nota);
                            $('.btn_continuar').fadeIn();
                            $('.nombre').val(nombre);
                            $('.domicilio').val(domicilio);
                            $('#sub_permiso').val(response['permisos'][0].tipo_permiso);
                            $('.tipo').removeClass('ocultar');

                            if (response['horas'][0] != undefined) {
                                $('#horas').val(response['horas'][0].Horas);
                                $('.permiso').append(plantillaPermisos(response['permisos'][0].horas_extra, response['permisos'][0].musica, response['horas'][0].Horas));
                            } else {
                                $('#horas').val('');
                                $('.permiso').append(plantillaPermisos(response['permisos'][0].horas_extra, response['permisos'][0].musica, null));
                            }



                        }

                    } catch (error) {
                        console.log(error);
                    }
                },
                error: function(error) {
                    try {

                        iziToast.show({
                            title: 'Error',
                            message: 'Ocurrió un problema al tratar de obtener la información, por favor consulta más tarde.',
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                    } catch (error) {
                        console.log(error);
                    }
                    $('.btn-buscar').prop('disabled', false);
                    $('.btn-buscar').text("Buscar licencia");

                }
            });
        }

        const plantillaPermisos = (horas_extra, musica, horas) => {

            return `
            <option value="">Selecciona una opción</option> 
            ` + ((horas_extra == 1) ? '<option value="10">' + horas + ' horas extra</option>' : '') + ` 
            ` + ((musica == 1) ? '<option value="22">Solo música</option>' : '');
        }

        function consulta() {
            var formElement = document.createElement("form");
            document.body.appendChild(formElement);

            var element1 = document.createElement("input");
            element1.name = "TxtNoLicencia";
            element1.type = "hidden";
            element1.value = $('.no_licencia').val();
            formElement.appendChild(element1);

            var element2 = document.createElement("input");
            element2.name = "NumDias";
            element2.type = "hidden";
            element2.value = "";
            formElement.appendChild(element2);

            var element3 = document.createElement("input");
            element3.name = "UWeb";
            element3.type = "hidden";
            element3.value = "";
            formElement.appendChild(element3);

            formElement.append("<input name='_token' value='{{ csrf_token() }}' type='hidden'>");

            var element4 = document.createElement("input");
            element4.name = "nombre";
            element4.type = "hidden";
            element4.value = $('.nombre').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase());
            formElement.appendChild(element4);

            var element5 = document.createElement("input");
            element5.name = "giro_principal";
            element5.type = "hidden";
            element5.value = $('.giro_principal').val();
            formElement.appendChild(element5);

            var element6 = document.createElement("input");
            element6.name = "fechas";
            element6.type = "hidden";
            element6.value = $('#fecha').val();
            formElement.appendChild(element6);

            var element7 = document.createElement("input");
            element7.name = "id_etapa";
            element7.type = "hidden";
            element7.value = $('#id_etapa').val();
            formElement.appendChild(element7);

            var element8 = document.createElement("input");
            element8.name = "id_solicitud";
            element8.type = "hidden";
            element8.value = $('#id_solicitud').val();
            formElement.appendChild(element8);

            var element9 = document.createElement("input");
            element9.name = "Per";
            element9.type = "hidden";
            element9.value = $('.permiso').val();
            formElement.appendChild(element9);

            var element10 = document.createElement("input");
            element10.name = "checkbox";
            element10.type = "hidden";
            element10.value = $('#fecha').val();
            formElement.appendChild(element10);

            var element11 = document.createElement("input");
            element11.name = "SubPer";
            element11.type = "hidden";
            element11.value = $('#sub_permiso').val();
            formElement.appendChild(element11);

            var element12 = document.createElement("input");
            element12.name = "horas";
            element12.type = "hidden";
            element12.value = $('#horas').val();
            formElement.appendChild(element12);

            var element13 = document.createElement("input");
            element13.name = "correo";
            element13.type = "hidden";
            element13.value = $('#correo').val();
            formElement.appendChild(element13);

            var element14 = document.createElement("input");
            element14.name = "telefono";
            element14.type = "hidden";
            element14.value = $('#telefono').val();
            formElement.appendChild(element14);

            var element15 = document.createElement("input");
            element15.name = "fechaSol";
            element15.type = "hidden";
            element15.value = $('#fecha_sol').val();
            formElement.appendChild(element15);

            var element16 = document.createElement("input");
            element16.name = "id_usuario";
            element16.type = "hidden";
            element16.value = $('#id_usuario').val();
            formElement.appendChild(element16);

            var request = new XMLHttpRequest();
            formElement.method = "get";
            formElement.action = '{{url("horas_extras/orden")}}';
            //formElement.action = 'https://portal.zapopan.gob.mx/pyl/permisos2020test/ConsultaOrden244.asp';

            formElement.target = "inlineFrameExample";
            formElement.submit();
        }

        function notas(idgiro) {

            $.ajax({
                url: "{{url('horas_extras/get_permisos_giro')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_giro": idgiro
                },
                type: 'post',
                dataType: "json",
                success: function(response) {

                    console.log(response);
                    $('.restriccion').html(response['permisos'][0].restricciones);
                    $('.nota_licencia').html(response['permisos'][0].nota);
                }
            })
        }

    });
</script>
</script>
@endsection