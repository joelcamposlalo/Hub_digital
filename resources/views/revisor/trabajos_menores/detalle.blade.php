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
                            <label for=""><small>Cuenta predial </small></label>
                            <input name="cuenta" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['cuenta']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>CURT </small></label>
                            <input name="curt" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['curt']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Calle</small></label>
                            <input name="calle" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['calle']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Número</small></label>
                            <input name="numero" class="ab-form background-color rounded border capitalize" readonly type="text" value="@if($ciudadano['datos']['numero'] != 0 && $ciudadano['datos']['numero'] != null){{$ciudadano['datos']['numero']}}@endif">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Número interior</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['interior']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Fraccionamiento / Colonia</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['fraccionamiento']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Manzana</small></label>
                            <input name="manzana" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['manzana']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Lote</small></label>
                            <input name="lote" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['lote']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Condominio</small></label>
                            <input name="condominio" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['condominio']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Unidad privativa</small></label>
                            <input name="privativa" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['privativa']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Entre la calle</small></label>
                            <input name="calle1" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['calle_1']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Y la calle</small></label>
                            <input name="calle2" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['calle_2']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Giro de construcción</small></label>
                            <input name="giro" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['giro']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>No. dictamen de uso de suelo</small></label>
                            <input name="suelo" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['suelo']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>No. alineamiento</small></label>
                            <input name="alineamiento" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['alineamiento']}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Nombre o Razón Social</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['nombre']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Primer apellido</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['apellido_p']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Segundo apellido</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['apellido_m']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Domicilo</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['domicilio']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Telefono</small></label>
                            <input class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['telefono']}}">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ff8585;" data-toggle="modal" data-target="#modal-rechazar">Rechazar</button>
                    <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ffd66b;" data-toggle="modal" data-target="#modal-regresar">Regresar</button>
                    <button class="ab-btn text-decoration-none text-white bold f-12 font btn-continuar" style="background-color: #91d18b;">Continuar</button>
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
                                    <a href="{{asset('storage')}}/{{$archivo->id_usuario}}/{{$archivo->archivo}}" class="f-10 font text-center" download="">Descargar</a>
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
                        <strong class="f-11">Nota</strong> <small class="f-11">Para cancelar, es necesario que escriba el porqué la solicitud no puede continuar</small>
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

<!-- Modal regresar  -->
<div class="modal fade" id="modal-regresar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Regresar solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-regresar" action="{{url('solicitud/regresar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota</strong> <small class="f-11">Para regresar, es necesario que escriba el porqué la solicitud no puede avanzar</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <textarea class="w-100 background-color rounded border p-2 txt-regresar font f-15" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="6">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->folio}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="logo" value="{{$ciudadano['solicitud']->logo}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-regresar ocultar" style="background-color: #ffd66b;">Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal rechazar  -->

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

        $('.txt-regresar').keyup(function() {
            var texto = $(this).val();

            if (texto.length > 0) {
                $('.btn-regresar').fadeIn('slow');
            } else {
                $('.btn-regresar').fadeOut('fast');
            }
        });


        $('#form-rechazar').submit(function() {
            $('.btn-rechazar').prop('disabled', true);
            $('.btn-rechazar').html(spiner());
        });


        $('#form-regresar').submit(function() {
            $('.btn-regresar').prop('disabled', true);
            $('.btn-regresar').html(spiner());
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
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection