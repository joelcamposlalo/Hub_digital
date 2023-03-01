@extends('base')

@section('title', 'Mi Expediente')

@section('aside')
{{menu_ciudadano('expediente')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Mi expediente </h1>
<small class="font text-muted mb-5">Completa tu información para agilizar el proceso de tus trámites. </small>
<div id="section">
    <div class="row">
        <div class="col-md-8 mt-4">

            <!-- Alert -->
            @if(Session::has('alert'))
            <div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3" role="alert">
                <small>{{session('alert.msg')}}</small>
                <!-- @if(Session::has('alert.link'))<a href="#"><small>Activar cuenta</small></a>@endif -->
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- End alert -->

            <form id="datos" action="{{url('ciudadano/post')}}" method="post">
                @csrf
                <div id="drive-datos-personales" class="card shadow-sm">
                    <div class="card-header">
                        <small>Datos personales</small>
                    </div>
                    <div class="card-body">
                        @if(session('tipo_persona') == "fisica")
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="nombre_ciudadano"><small>Nombre</small></label>
                                <input name="nombre" id="nombre_ciudadano" class="ab-form background-color rounded border capitalize" type="text" value="{{$usuario->nombre}}" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="primer_apellido_ciudadano"><small>Primer Apellido</small></label>
                                <input name="primer_apellido" id="primer_apellido_ciudadano" class="ab-form background-color rounded border capitalize" type="text" value="{{$usuario->primer_apellido}}" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="segundo_apellido_ciudadano"><small>Segundo Apellido</small></label>
                                <input name="segundo_apellido" id="segundo_apellido_ciudadano" class="ab-form background-color rounded border capitalize" type="text" value="{{$usuario->segundo_apellido}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="curp_ciudadano"><small>CURP</small></label>
                                <input name="curp" id="curp_ciudadano" class="ab-form background-color rounded border uppercase" type="text" data-parsley-minlength="18" maxlength="18" data-parsley-pattern="[a-zA-Z0-9]*" value="{{$usuario->curp}}" required>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rfc_ciudadano"><small>RFC</small></label>
                                <input name="rfc" id="rfc_ciudadano" class="ab-form background-color rounded border" type="text" style="text-transform: uppercase" data-parsley-minlength="13" maxlength="13" data-parsley-pattern="[a-zA-Z0-9]*" value="{{$usuario->rfc}}">
                            </div>
                        </div>
                        @endif
                        @if(session('tipo_persona') == "moral")
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="razon_social_empresa"><small>Razón Social</small></label>
                                <input name="razon_social" id="razon_social_empresa" class="ab-form background-color rounded border" type="text" value="{{$usuario->razon_social}}" required>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rfc_empresa"><small>RFC</small></label>
                                <input name="rfc" id="rfc_empresa" class="ab-form background-color rounded border" type="text" style="text-transform: uppercase" data-parsley-minlength="12" maxlength="13" data-parsley-pattern="[a-zA-Z0-9]*" value="{{$usuario->rfc}}" require>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="telefono_usuario"><small>Teléfono</small></label>
                                <input name="telefono" id="telefono_usuario" class="ab-form background-color rounded border" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" value="{{$usuario->telefono}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <a href="" class="f-11" data-toggle="modal" data-target="#modal-cambia-contrasena">Cambiar contraseña</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="drive-domicilio" class="card shadow-sm mt-5">
                    <div class="card-header">
                        <small>Domicilio</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="calle_usuario"><small>Calle</small></label>
                                <input name="calle" id="calle_usuario" class="ab-form background-color rounded border capitalize calle" type="text" value="{{$usuario->calle}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-2">
                                <label for="no_exterior_usuario"><small>No. Exterior</small></label>
                                <input name="no_exterior" id="no_exterior_usuario" class="ab-form background-color rounded border numext" type="text" data-parsley-type="number" value="{{$usuario->no_exterior}}">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="letra_exterior_usuario"><small>Letra</small></label>
                                <input name="letra_exterior" id="letra_exterior_usuario" class="ab-form background-color rounded border uppercase" type="text" maxlength="1" data-parsley-pattern="[a-zA-Z]*" value="{{$usuario->letra_exterior}}">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="no_interior_usuario"><small>No. Interior</small></label>
                                <input name="no_interior" id="no_interior_usuario" class="ab-form background-color rounded border" type="text" data-parsley-type="number" value="{{$usuario->no_interior}}">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="letra_interior_usuario"><small>Letra</small></label>
                                <input name="letra_interior" id="letra_interior_usuario" class="ab-form background-color rounded border uppercase" type="text" maxlength="1" data-parsley-pattern="[a-zA-Z]*" value="{{$usuario->letra_interior}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="colonia_usuario"><small>Colonia</small></label>
                                <input name="colonia" id="colonia_usuario" class="ab-form background-color rounded border capitalize" type="text" value="{{$usuario->colonia}}" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="municipio_usuario"><small>Municipio</small></label>
                                <input name="municipio" id="municipio_usuario" class="ab-form background-color rounded border municipio capitalize" type="text" value="{{$usuario->municipio}}" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="cp_usuario"><small>C.P</small></label>
                                <input name="cp" id="cp_usuario" class="ab-form background-color rounded border cp" type="text" data-parsley-type="number" data-parsley-minlength="5" maxlength="5" value="{{$usuario->cp}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="drive-domicilio" class="card shadow-sm mt-5">
                    <div class="card-header">
                        <small>Notificaciones</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong class="f-11">Nota:</strong> <small class="f-11">Se enviarán los correos a la dirección: {{session('correo')}}.</small>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <small class="d-block mt-4">
                                    <label class="switch">
                                        <input name="contactar" id="contactar" type="checkbox" @if((session('contactar'))==1) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    <label for="" class="ml-2 font pointer">Deseo recibir información de interés para el ciudadano por parte del Municipio de Zapopan, Jalisco. </label>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-right">
                        <input name="latitud" class="latitud" type="hidden" value="{{$usuario->latitud}}">
                        <input name="longitud" class="longitud" type="hidden" value="{{$usuario->longitud}}">
                        <button type="submit" class="ab-btn b-primary-color guardar btn-info">Guardar</button>
                    </div>
                </div>
            </form>
            <h5 class="mt-4 font">Mis archivos</h5>
            <div id="drive-archivos" class="row">
                @foreach($files['terminados'] as $file)
                <div class="col-md-3 pl-2 pr-2">
                    <div style="height: 150px;" class="card mt-3 position-relative" data-toggle="tooltip" data-placement="top" title="{{$file->nombre}}">
                        <div class="btn-close font text-muted position-absolute pointer p-2 btn-delete" data-name="{{$file->name}}" data-id="{{$file->id_archivo}}" style="right: 0; margin-right: 5px;">x</div>
                        <div class="card-body d-flex justify-content-center flex-column align-items-center">
                            @if($file->extension == 'jpg' || $file->extension == 'jpeg')
                            <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->name}}" data-lightbox="roadtrip">
                                <img class="pointer" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="60px" alt="documento en formato jpg o jpeg">
                            </a>
                            @elseif($file->extension == 'docx')
                            <img class="pointer" src="{{asset('media/flaticon/archivos/word.svg')}}" width="60px" alt="formato">
                            @elseif($file->extension == 'pdf' || $file->extension == 'PDF')
                            <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->name}}" target="_blank">
                                <img class="pointer" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="60px" alt="docuemento en formato pdf">
                            </a>
                            @else
                            <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->name}}" data-lightbox="roadtrip">
                                <img class="pointer" src="{{asset('media/flaticon/archivos/png.svg')}}" width="60px" alt="documento en formato png">
                            </a>
                            @endif
                            <small class="text-center mt-2 mb-2 bold text-truncate truncate">{{$file->nombre_archivo}}</small>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($files['pendientes'] != [])
                <div class="col-md-3 pl-2 pr-2">
                    <div style="height: 150px;" class="card mt-3 pointer" data-toggle="modal" data-target="#modal-uploads">
                        <div style="border:none !important;" class="card-body d-flex justify-content-center flex-column align-items-center">
                            <img class="pointer" src="{{asset('media/flaticon/archivos/upload.svg')}}" width="48px" alt="cargar documento">
                            <span class="badge badge-pill badge-warning mt-3">Subir archivo</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-4 mt-4">
            <div id="drive-mapa" class="card shadow-sm sticky-top" style="top: 33px !important;">
                <div class="card-header">
                    <small>Mi ubicación</small>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">El sistema calcula automáticamente las coordenadas con base en tu dirección.</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="map" style="width: 100%; height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal uploads file -->
    <!-- Modal -->
    <div class="modal fade" id="modal-uploads" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font bold">Subir documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="archivos" action="{{url('ciudadano/post_file')}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong class="f-11">Nota</strong> <small class="f-11">Selecciona el tipo de archivo y procede a subirlo, recuerda que los formatos válidos son: JPG, JPEG PNG, PDF</small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <select class="ab-form background-color w-50 rounded" name="name">
                            @foreach($files['pendientes'] as $file)
                            <option value="{{$file->id_cat_archivo}}">{{$file->nombre}}</option>
                            @endforeach
                        </select>
                        <label class="container-file mt-4 background-color rounded pointer" for="file">
                            <small class="font f-11">Click para seleccionar archivo del dispositivo</small>
                            <input type="file" name="file" id="file" accept="image/png, image/jpeg, .pdf, .docx" required>
                        </label>
                        <small class="ab-error text-danger"></small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="ab-btn b-primary-color btn-archivo">Guardar archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal cambia contraseña -->
    <!-- Modal -->
    <div class="modal fade" id="modal-cambia-contrasena" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="cambia_contrasena" action="{{url('cuenta/cambiar_contrasena')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="contrasena_actual"><small>Contraseña actual</small></label>
                                <input name="cactual" id="contrasena_actual" class="ab-form background-color rounded border " type="password" data-parsley-minlength="8" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="contrasena_nueva"><small>Contraseña nueva</small></label>
                                <input name="ncontrasena" id="contrasena_nueva" class="ab-form background-color rounded border" type="password" data-parsley-minlength="8" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="confirmar_contrasena"><small>Confirmar contraseña</small></label>
                                <input name="ccontraseña" id="confirmar_contrasena" class="ab-form background-color rounded border" type="password" data-parsley-minlength="8" data-parsley-equalto="#contrasena_nueva" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="ab-btn b-primary-color guardar btn-contra">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script>
    $(document).ready(function() {


        $('[data-toggle="tooltip"]').tooltip()

        tippy('#expediente-tooltip', {
            content: '<small class="font f-10"> Ver tutorial</small>',
            animation: 'scale',
            allowHTML: true,
        });

        var primera_vista = "{{session('primera_vista')}}";


        /**
         * 
         * Driver js
         * 
         */

        function tutorial() {

            introJs().setOptions({
                showProgress: true,
                showBullets: false,
                "nextLabel": 'Siguiente',
                "prevLabel": 'Atras',
                "doneLabel": 'Terminar',
                steps: [{
                        title: '<small class="bold"> 🥳 ¡Bienvenido a VDigital! </small>',
                        intro: '<small> Para comenzar, un pequeño tour. No nos tomará mucho tiempo. </small>'
                    },
                    {
                        element: document.querySelector('#drive-datos-personales'),
                        title: '<small class="bold"> 📰 Mis datos personales </small>',
                        intro: "<small> Es importante completar toda la información que se te solicita. </small>",
                        position: 'right',
                        disableInteraction: true
                    },
                    {
                        element: document.querySelector('#drive-domicilio'),
                        title: '<small class="bold"> 📍 Mi ubicación </small>',
                        intro: "<small> Ingresa los datos de tu domicilio actual.</small>",
                        position: 'right',
                        disableInteraction: true
                    },
                    {
                        element: document.querySelector('#drive-mapa'),
                        title: '<small class="bold"> 🗺️ Mapa de ubicación </small>',
                        intro: "<small> Cuando ingreses la información de tu domicilio, aparecerá un marcador rojo señalándolo. Si por alguna razon no coincide, arrastra el marcador a la posición correcta en el mapa.</small>",
                        position: 'left',
                        disableInteraction: true
                    },
                    {
                        element: document.querySelector('#drive-archivos'),
                        title: '<small class="bold">📤 Mis archivos </small>',
                        intro: "<small>Adjunta los archivos solicitados en los formatos jpg, png, jpeg o pdf. </small>",
                        position: 'right',
                        disableInteraction: true
                    }, {
                        element: document.querySelector('.profile-img'),
                        title: '<small class="bold"> 😎 Mi foto de perfil </small>',
                        intro: "<small> No es obligatorio, pero estaría padre que tuvieras una foto de perfil. </small>",
                        position: 'right',
                        disableInteraction: true
                    },
                    {
                        element: document.querySelector('#salir'),
                        title: '<small class="bold"> 🏃 Cerrar mi sesión </small>',
                        intro: "<small> Cierra tu sesión cuando lo necesites. </small>",
                        position: 'left',
                        disableInteraction: true
                    }, {
                        element: document.querySelector('#tutorial'),
                        title: '<small class="bold"> 👣 Tutorial </small>',
                        intro: "<small> Puedes volver a consultar esta ayuda, con un click aquí nos vemos. </small>",
                        position: 'left',
                        disableInteraction: true
                    },
                    {
                        title: '<small class="bold"> 👏 ¡Terminamos! </small>',
                        intro: '<small> Ahora ingresa tus datos y guárdalos para habilitar las opciones. </small>'
                    }
                ]
            }).start();

        }

        /*
         * 
         * Pone el tutorial automaticamnte en base a si el usuario es nuevo
         * 
         */
        if (primera_vista == 0) {

            tutorial();

        }

        /*
         * 
         * Pone el tutorial si el usuario lo necesita
         * 
         */

        $('#tutorial').click(function() {

            tutorial();

        });

        /**
         * 
         * Menu lateral
         * 
         */

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        /**
         * Validacion formularios 
         */

        $('#datos').parsley();
        $('#cambia_contrasena').parsley();

        $('#file').change(function(e) {

            var $file = $(this)[0].files[0];

            $('.container-file small').text($file.name);
            $('.ab-error').fadeOut();

        });

        $('#archivos').submit(function() {

            var texto = $('.container-file small').text();


            if (texto == 'Click para seleccionar archivo del dispositivo') {
                $('.ab-error').fadeIn('slow');
                $('.ab-error').text('Debes seleccionar un archivo antes de guardar');
                $()
                return false;
            } else {

                if (get_extension(texto) != 'jpg' && get_extension(texto) != 'jpeg' && get_extension(texto) != 'png' && get_extension(texto) != 'pdf' && get_extension(texto) != 'PDF') {
                    $('.ab-error').fadeIn('slow');
                    $('.ab-error').text('El formato debe ser válido, verifica e intenta nuevamente');
                    return false;
                } else {
                    $('.btn-archivo').prop('disabled', true);
                    $('.btn-archivo').html(spiner());
                }

            }

        });

        $('#datos').submit(function() {
            $('.btn-info').prop('disabled', true);
            $('.btn-info').html(spiner());
        });


        $('#cambia_contrasena').submit(function() {
            $('.btn-contra').prop('disabled', true);
            $('.btn-contra').html(spiner());
        });


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


        /**
         * Eliminar archivos
         */

        $('.btn-delete').click(async function() {
            var id_archivo = $(this).attr('data-id');
            var name = $(this).attr('data-name');

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Desea eliminar el archivo?',
                position: 'center',
                backgroundColor: '#ff9b93',
                buttons: [
                    ['<button class="cerrar"><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                    [`<button class="delete">Si, eliminar</button>`, async function(instance, toast) {


                        $('.cerrar').hide();
                        $('.delete').prop('disabled', true);
                        $('.delete').html(spiner());

                        var response = await axios.post('{{url("ciudadano/delete_file")}}', {
                            "_token": "{{ csrf_token() }}",
                            'id_archivo': id_archivo,
                            'name': name,
                        }).then(function(response) {
                            console.log(response);

                            window.location.href = '{{url()->current()}}';

                        }).catch(function(error) {
                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'Ocurrió un problema al tratar de eliminar el archivo',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });
                        });

                    }, true]
                ]
            });

        });


    });

    var marker

    function initMap() {

        if ('{{$usuario->latitud}}' != '') {
            var coordenadas = {
                lat: parseFloat('{{$usuario->latitud}}'),
                lng: parseFloat('{{$usuario->longitud}}')
            }
        } else {
            var coordenadas = {
                lat: 20.6785454,
                lng: -103.4275859
            }
        }

        var markers = [];

        map = new google.maps.Map(document.getElementById("map"), { //Carga el mapa
            center: coordenadas,
            zoom: 14,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: true,
            rotateControl: false,
            fullscreenControl: false
        });

        marker = new google.maps.Marker({
            position: coordenadas,
            draggable: true
        });

        markers.push(marker);

        marker.setMap(map);

        google.maps.event.addListener(marker, 'dragend', function(event) {
            $('.latitud').val(event.latLng.lat());
            $('.longitud').val(event.latLng.lng());
        });


        const geocoder = new google.maps.Geocoder(); //Creamos la instancia de geocoder


        $('.cp').blur(function() {

            var calle = $('.calle').val();
            var numext = $('.numext').val();
            var municipio = $('.municipio').val();

            var address = `${calle} #${numext} ${municipio}`;

            geocodeAddress(geocoder, map, address); // Ubica en base a la direccion las coordenadas en el mapa        

        });




        function geocodeAddress(geocoder, resultsMap, address) {

            geocoder.geocode({
                address: address
            }, (results, status) => {
                if (status === "OK") {

                    resultsMap.setCenter(results[0].geometry.location); //Centra el mapa en las coordenadas obtenidas   
                    $('.latitud').val(results[0].geometry.location.lat());
                    $('.longitud').val(results[0].geometry.location.lng());

                    cleanMarkers(); //Limpia todos los marcadores para posicionar el nuevo

                    marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map,
                        draggable: true
                    });

                    markers.push(marker);

                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        $('.latitud').val(event.latLng.lat());
                        $('.longitud').val(event.latLng.lng());
                    });

                } else {
                    //alert("No se encontró la dirección especificada " + status);
                    $('#buscar').prop('disabled', false); //Habilita el boton
                    $('#buscar').text('Buscar'); //Quita el loading
                }
            });
        }

        function cleanMarkers() {

            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }

            markers = [];

        }


    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection