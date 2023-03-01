@extends('base')

@section('title', 'Detalle')

@section('aside')
{{menu_revisor('detalles')}}
@endsection


@section('notification')
{{get_notificaciones()}}
@endsection


@section('container')
<div class="container position-relative" style="padding: 0 !important">
    <div class="d-flex align-items-center">
        <a href="{{url('revisor/solicitudes')}}" style="padding: 13px 0 0 0 !important">
            <button class="back b-primary-color mr-3" style="color: white">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="text-muted font m-0 bold c-primary-color">Detalles de la solicitud</h1>
    </div>
</div>
<small class="font text-muted mb-5">Revisa la información correctamente</small>

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

<!-- Alert -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    @foreach ($errors->all() as $error)
    <small class="block block capitalize">{{ $error }}</small> <br>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- End alert -->

<div id="section">
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <div class="detalle-profile-img">
                        @if($ciudadano['solicitud']->perfil != '')
                        <img src="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario) }}/perfil.jpg" alt="perfil">
                        @else
                        <img src="{{asset('media/flaticon/avatar.svg')}}" alt="avatar">
                        @endif
                    </div>
                    <div class="ml-3 d-flex flex-column">
                        <small class="font c-negro"><b>{{$ciudadano['solicitud']->correo}}</b></small>
                        <small class="font text-muted f-10">{{$ciudadano['solicitud']->created_at}}</small>
                    </div>
                </div>
                <div class="card-body">
                    <span class="badge badge-pill badge-warning f-10 mb-2">Folio: {{$ciudadano['solicitud']->folio}}</span>
                    <h6 class="font bold f-15">Información de la solicitud</h6>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small>Contribuyente</small></label>
                            <input name="nombre" class="ab-form background-color rounded border nombre" readonly type="text" value="{{$ciudadano['datos']['nombre']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="giro_principal"><small>Giro principal</small></label>
                            <input name="giro_principal" class="ab-form background-color rounded border giro_principal" readonly type="text" value="{{$ciudadano['datos']['giro_principal']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="domicilio"><small>Domicilio</small></label>
                            <input name="domicilio" class="ab-form background-color rounded border capitalize domicilio" readonly type="text" value="{{$ciudadano['datos']['domicilio']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="tipo_permiso"><small>Tipo de permiso</small></label>
                            <input name="tipo_permiso" id="tipo_permiso" class="ab-form background-color rounded border capitalize tipo_permiso" readonly type="text" value="{{$ciudadano['datos']['tipo_permiso']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="tipo_musica"><small>Tipo de música</small></label>
                            <input name="tipo_musica" class="ab-form background-color rounded border capitalize tipo_musica" readonly type="text" value="{{$ciudadano['datos']['tipo_musica']}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="horas"><small>Número de horas</small></label>
                            <input name="horas" class="ab-form background-color rounded border capitalize horas" readonly type="text" value="{{$ciudadano['datos']['horas']}}">
                        </div>
                    </div>

                    
                </div>
                <div class="card-footer text-right">
                    <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ff8585;" data-toggle="modal" data-target="#modal-rechazar">Rechazar</button>
                    <button class="ab-btn text-decoration-none text-white bold f-12 font btn-continuar" style="background-color: #91d18b;">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="map" style="width: 100%; height: 300px;"></div>
                <hr class="mt-4 mb-2">
                <h6 class="font bold f-15">Archivos</h6>
                <div class="row">
                    @foreach($ciudadano['archivos'] as $archivo)
                    <div class="col-md-6 pl-2 pr-2">
                        <div class="card mt-3" data-toggle="tooltip" data-placement="top" title="{{$archivo->nombre}}">
                            <div class="card-body pt-2 pb-2 d-flex justify-content-center flex-column align-items-center">
                                @if($archivo->extension == 'jpeg' or $archivo->extension == 'jpg')
                                <a href="{{asset('storage')}}/{{$archivo->id_usuario}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                    <img class="pointer" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="40px" alt="formato">
                                </a>
                                @elseif($archivo->extension == 'png')
                                <a href="{{asset('storage')}}/{{$archivo->id_usuario}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                    <img class="pointer" src="{{asset('media/flaticon/archivos/png.svg')}}" width="40px" alt="formato">
                                </a>
                                @else
                                <a href="{{asset('storage')}}/{{$archivo->id_usuario}}/{{$archivo->archivo}}" target="_blank">
                                    <img class="pointer" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="40px" alt="formato">
                                </a>
                                @endif
                                <small class="text-center mt-1 mb-1 bold font f-10 text-truncate" style="width: 50px; text-overflow: ellipsis;">{{$archivo->nombre}}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal rechazar  -->
<div class="modal fade" id="modal-rechazar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Rechazar solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-rechazar" action="{{url('solicitud/rechazar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11"> Para cancelar, es necesario que escriba el porqué la solicitud no puede continuar</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <textarea class="w-100 background-color rounded border p-2 txt-rechazar font f-15" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="{{$ciudadano['solicitud']->id_etapa}}">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->folio}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="logo" value="{{$ciudadano['solicitud']->logo}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-rechazar ocultar" style="background-color: #ff8585;">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('menu_mobile')
{{menu_mobil_revisor('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/loading/loading-bar.min.js')}}"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script>
    let map;

    $(document).ready(function() {

        var url = '{{url()->current()}}';

        $('[data-toggle="tooltip"]').tooltip()

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('.txt-rechazar').keyup(function() {
            var texto = $(this).val();

            if (texto.length > 0) {
                $('.btn-rechazar').fadeIn('slow');
            } else {
                $('.btn-rechazar').fadeOut('fast');
            }
        });


        $('#form-rechazar').submit(function() {
            $('.btn-rechazar').prop('disabled', true);
            $('.btn-rechazar').html(spiner());
        });


        $('.btn-continuar').click(function() {

            var id_solicitud = "{{$ciudadano['solicitud']->folio}}";

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: `${id_solicitud}`,
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Desea continuar con la solicitud?',
                position: 'center',
                backgroundColor: '#91d18b',
                buttons: [
                    ['<button class="btn-cerrar"><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                    [`<button class="continuar" data-id="${id_solicitud}">Si, continuar</button>`, async function(instance, toast) {

                        $('.btn-cerrar').hide();
                        $('.continuar').prop('disabled', true);
                        $('.continuar').html(spiner());


                        const formData = new FormData();
                        formData.append("id_etapa", "5");
                        formData.append("id_tramite", "{{$ciudadano['solicitud']->id_tramite}}");
                        formData.append("id_usuario", "{{$ciudadano['solicitud']->id_usuario}}");
                        formData.append("id_solicitud", "{{$ciudadano['solicitud']->folio}}");
                        formData.append("correo", "{{$ciudadano['solicitud']->correo}}");
                        formData.append("logo", "{{$ciudadano['solicitud']->logo}}");
                        formData.append("id_coordinacion", "{{$ciudadano['solicitud']->id_coordinacion}}");
                        formData.append("estatus", "autorizado");


                        var response = await axios.post('{{url("solicitud/continuar")}}', formData, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {
                            console.log(response);
                        }).then(function(response) {

                            window.location.href = '{{url("revisor/solicitudes")}}';

                        }).catch(function(error) {
                            console.log(error);
                        });

                    }, true]
                ]
            });
        })

    });

    function initMap() {

        var cuenta = "{{$ciudadano['datos']['cuenta']}}"
        var curt = "{{$ciudadano['datos']['curt']}}"

        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 20.6689584,
                lng: -103.4111619
            },
            zoom: 13,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false
        });


        (cuenta != '' ? consulta_cuenta(cuenta.trim()) : consulta_cuenta(curt.trim()));

    }


    function consulta_cuenta(cuenta) {


        $.ajax({
            url: "{{url('catastro/get_by_cuenta')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cuenta": cuenta
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                console.log(response);

                try {
                    if (typeof(response.msg) != 'undefined') {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: response.msg,
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                    } else {


                        (response[0].coordenadas != null ? map.setZoom(19) : null);

                        var arr = GeoPolygonToJson(response[0].coordenadas);

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

                } catch (error) {
                    console.log(error);
                }
            },
            error: function(error) {
                try {
                    iziToast.show({
                        title: 'Error',
                        message: 'Ocurrió un problema al tratar de obtener el predio, revisa tu conexión',
                        backgroundColor: '#ff9b93',
                        closeOnEscape: true
                    });
                } catch (error) {
                    console.log(error);
                }

            }
        });
    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFfTN8foLoOUQvRGBJPGVHHbo9PYoDY84&callback=initMap">
</script>
@endsection