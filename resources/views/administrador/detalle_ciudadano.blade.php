@extends('base_admin')

@section('title', 'Detalle')

@section('menu')
{{menu_administrador('ciudadanos')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container position-relative" style="padding: 0 20px;">
    <div class="d-flex align-items-center">
        <a href="{{url()->previous()}}">
            <button class="back bg-warning mr-3">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="font bold ">Detalle</h1>
    </div>
    <section class="mt-4">
        <div class="card shadow-sm">
            <div class="card-body p-0 card-detalle">
                <div class="left p-5">
                    <div class="header d-flex align-items-center mb-3">
                        <div class="circle-small">
                            @if(Storage::disk('s3')->exists('public/'.$ciudadano['datos']->id_usuario.'/perfil.jpg'))
                            <img src="{{ Storage::disk('s3')->url('public/'.$ciudadano['datos']->id_usuario) }}/{{$ciudadano['datos']->perfil}}" alt="avatar">
                            @else
                            <img src="{{asset('media/flaticon/avatar.svg')}}" alt="avatar">
                            @endif
                        </div>
                        <div>
                            <h6 class="font bold ml-3 mb-0">@if($ciudadano['datos']->razon_social == '') {{$ciudadano['datos']->nombre}} {{$ciudadano['datos']->primer_apellido}} {{$ciudadano['datos']->segundo_apellido}} @else {{$ciudadano['datos']->razon_social}} @endif </h6>
                            <p class="font f-10 ml-3 mb-0 text-muted">Tel: {{$ciudadano['datos']->telefono}}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 mt-3">
                            @if($ciudadano['datos']->razon_social == '')
                            <label><small>Nombre</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{Str::ucfirst($ciudadano['datos']->nombre) }} {{Str::ucfirst($ciudadano['datos']->primer_apellido)}} {{Str::ucfirst($ciudadano['datos']->segundo_apellido)}}">
                            @else
                            <label for="nombre font"><small>Razón social</small></label>
                            <input type="text" id="nombre" class="ab-form background-color font" readonly value="{{Str::ucfirst($ciudadano['datos']->razon_social) }}">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @if($ciudadano['datos']->rfc != '')
                        <div class="col-md-6 mt-3">
                            <label><small>RFC</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{Str::ucfirst($ciudadano['datos']->rfc) }}">
                        </div>
                        @endif
                        @if($ciudadano['datos']->curp != '')
                        <div class="col-md-6 mt-3">
                            <label><small>CURP</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->curp}}">
                        </div>
                        @endif
                        <div class="col-md-6 mt-3">
                            <label><small>Teléfono</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{Str::ucfirst($ciudadano['datos']->telefono) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label><small>Calle</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->calle}}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label><small>Número exterior y letra</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->no_exterior}} {{$ciudadano['datos']->letra_exterior}}">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label><small>Número interior y letra</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->no_interior}} {{$ciudadano['datos']->letra_interior}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label><small>Colonia</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->colonia}}">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label><small>Municipio</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->municipio}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label><small>Código postal</small></label>
                            <input type="text" class="ab-form background-color font" readonly value="{{$ciudadano['datos']->cp}}">
                        </div>
                    </div>
                    @if($ciudadano['predios'] != '[]')
                    <div class="row mt-5 mb-3">
                        <div class="col">
                            <h4 class="font bold">Predios</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                                <table class="w-100">
                                    @foreach($ciudadano['predios'] as $predio)
                                    <tr class="w-100 predio">
                                        <td class="f-12 font data-cuenta">CURT: {{$predio->curt}}</td>
                                        @if($predio->cuenta_predial != '')<td class="f-12 font">Cuenta: {{$predio->cuenta_predial}}</td>@endif
                                        <!--<td class="f-12"><span class="badge badge-pill badge-success">Pagado</span></td>-->
                                        <td class="f-12 acciones">
                                            <button type="button" class="ab-btn-effect bold font f-10 btn-detalle" data-cuenta="{{$predio->curt}}">Ver detalle</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="right p-4" style="background-color: #ebebeb; box-sizing: border-box;">
                    <div id="map" style="width: 100%; height: 250px;"></div>
                    @if($ciudadano['archivos'] != '[]')
                    <hr class="mt-4 mb-3">
                    <h6 class="font bold f-15 c-negro">Archivos</h6>
                    <div class="row">
                        @foreach($ciudadano['archivos'] as $archivo)
                        <div class="col-md-6 pl-2 pr-2">
                            <div class="card mt-3" data-toggle="tooltip" data-placement="top" title="{{$archivo->nombre}}">
                                <div class="card-body pt-2 pb-2 d-flex justify-content-center flex-column align-items-center">
                                    @if($archivo->extension == 'jpeg' or $archivo->extension == 'jpg')
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['datos']->id_usuario)}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @elseif($archivo->extension == 'png')
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['datos']->id_usuario)}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/png.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @else
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['datos']->id_usuario)}}/{{$archivo->archivo}}" target="_blank">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @endif
                                    <small class="text-center mt-1 mb-1 bold font f-10 text-truncate" style="width: 50px; text-overflow: ellipsis;">{{$archivo->nombre}}</small>
                                    <!--<a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['datos']->id_usuario)}}/{{$archivo->archivo}}" class="f-10 font text-center" download="">Descargar</a>-->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="mt-5 text-center font f-12">No hay archivos para mostrar</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal detalle de predio -->
<div class="modal fade" id="modal-predio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Detalle del predio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col mt-3">
                        <div id="map2" style="width: 100%; height: 150px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3">
                        <label for=""><small>Cuenta</small></label>
                        <input type="text" class="ab-form background-color rounded cuenta">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for=""><small>Colonia</small></label>
                        <input type="text" class="ab-form background-color rounded colonia">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for=""><small>Calle</small></label>
                        <input type="text" class="ab-form background-color rounded calle">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for=""><small>Número exterior</small></label>
                        <input type="text" class="ab-form background-color rounded numext">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for=""><small>Número interior</small></label>
                        <input type="text" class="ab-form background-color rounded numint">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/trabajos_menores/solicitud.css')}}">
<link rel="stylesheet" href="{{asset('css/administrador/ciudadano.css')}}">
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';


        $('.btn-detalle').click(function() {

            var cuenta = $(this).attr('data-cuenta');

            consulta_cuenta(cuenta);

        });

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

                    $('.cuenta').val(response[0].precuentapredial);
                    $('.colonia').val(response[0].catcol_nombre);
                    $('.calle').val(response[0].catcalle_nombre);
                    $('.numext').val(response[0].prenoext);
                    $('.numint').val(response[0].numint);
                    agregar_poligono(response[0].coordenadas);
                    $('#modal-predio').modal('show');

                },
                error: function(error) {
                    iziToast.show({
                        title: 'Ups ☹️',
                        message: 'Ocurrió un problema al tratar de obtener el polígono',
                        backgroundColor: '#ff9b93',
                        closeOnEscape: true
                    });
                }
            });
        }


        function agregar_poligono(geopolygon) {


            if (typeof(poligono) != 'undefined') {
                poligono.setMap(null);
            }

            if (geopolygon != null) {

                var arr = GeoPolygonToJson(geopolygon);

                poligono = new google.maps.Polygon({
                    path: arr,
                    strokeColor: "#a8dda8",
                    strokeOpacity: 1,
                    strokeWeight: 2,
                    fillColor: "#a8dda8",
                    fillOpacity: 0.3,
                });

                map2.setCenter(arr[1]);
                poligono.setMap(map2);

            }
        }


    });


    let map;
    let map2;

    function initMap() {

        var latitud = '{{$ciudadano["datos"]->latitud}}';
        var longitud = '{{$ciudadano["datos"]->longitud}}'


        if (latitud.length != 0) {
            var coordenadas = {
                lat: parseFloat(latitud),
                lng: parseFloat(longitud)
            };
        } else {
            var coordenadas = {
                lat: 20.6829193,
                lng: -103.4740215
            };
        }


        map = new google.maps.Map(document.getElementById("map"), {
            center: coordenadas,
            zoom: 14,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            rotateControl: false,
            fullscreenControl: false
        });

        map2 = new google.maps.Map(document.getElementById("map2"), { //Carga el mapa
            center: {
                lat: 20.6785454,
                lng: -103.4275859
            },
            zoom: 18,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: true,
            rotateControl: false,
            fullscreenControl: false
        });

        if (latitud.length != 0) {
            var marker = new google.maps.Marker({
                position: coordenadas
            });

            marker.setMap(map);
        }


    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection