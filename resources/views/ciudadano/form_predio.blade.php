@extends('base')

@section('title', 'Agregar predio')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<div class="container position-relative" style="padding: 0 !important">
    <div class="d-flex align-items-center">
        <a href="{{url('ciudadano/predios')}}" style="padding: 13px 0 0 0 !important" aria-label="Regresar a mis predios">
            <button class="back b-primary-color mr-3" style="color: white" aria-hidden="true">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="text-muted font m-0 bold c-primary-color">Agregar predio</h1>
    </div>
</div>
<small class="font text-muted mb-5 f-15">Es importante que revises la información del predio, si se encuentran los datos mal, por favor acude <br> a la Dirección de Catastro para regularizar el predio</small>
<div id="section">
    <div class="row">
        <div class="col-md-8 mt-4">

            <!-- Alert -->
            @if(Session::has('alert'))
            <div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3" role="alert">
                <small>{{session('alert.msg')}}</small>
                <!-- @if(Session::has('alert.link'))<a href="#"><small>Activar cuenta</small></a>@endif -->
                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- End alert -->

            <form id="datos" action="{{url('predios/post')}}" method="post">
                @csrf
                <div class="card shadow-sm">
                    <div class="card-header">
                        <small>Datos del predio</small>
                    </div>
                    <div class="card-body">

                        <!-- Alert -->

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong class="f-14">Nota:</strong> <small class="f-14">Escribe la cuenta o en su defecto la CURT</small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Alert -->

                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="cuenta"><small>Cuenta predial <i id="cuenta-tooltip" class="fas fa-question-circle pointer text-info"></i></small></label>
                                <input name="cuenta" id="cuenta" class="ab-form background-color rounded border capitalize cuenta" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" autocomplete="off">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="curt"><small>CURT <i id="curt-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                                <input name="curt" id="curt" class="ab-form background-color rounded border capitalize curt" type="text" data-parsley-type="number" data-parsley-minlength="31" maxlength="31" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-right">
                                <button type="button" class="ab-btn b-primary-color btn-buscar">Buscar predio</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for="calle"><small>Calle</small></label>
                                <input name="calle" id="calle" class="ab-form background-color rounded border capitalize calle" type="text" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-2">
                                <label for="no_exterior"><small>Número exterior</small></label>
                                <input name="numero" id="no_exterior" class="ab-form background-color rounded border capitalize numero" type="text" readonly>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="letra_exterior"><small>Letra exterior</small></label>
                                <input name="letraE" id="letra_exterior" class="ab-form background-color rounded border capitalize letraE" type="text" readonly>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="no_interior"><small>Número interior</small></label>
                                <input name="interior" id="no_interior" class="ab-form background-color rounded border capitalize interior" type="text" readonly>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="letra_interior"><small>Letra interior</small></label>
                                <input name="letraI" id="letra_interior" class="ab-form background-color rounded border capitalize letraI" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="colonia"><small>Fraccionamiento/Colonia</small></label>
                                <input name="colonia" id="colonia" class="ab-form background-color rounded border capitalize colonia" type="text" readonly>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="manzana"><small>Manzana</small></label>
                                <input name="manzana" id="manzana" class="ab-form background-color rounded border capitalize manzana" type="text" readonly>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="lote"><small>Lote</small></label>
                                <input name="lote" id="lote" class="ab-form background-color rounded border capitalize lote" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="condominio"><small>Condominio</small></label>
                                <input name="condominio" id="condominio" class="ab-form background-color rounded border capitalize condominio" type="text" readonly>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="privativa"><small>Unidad privativa</small></label>
                                <input name="privativa" id="privativa" class="ab-form background-color rounded border capitalize privativa" type="text" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="calle1"><small>Entre la Calle</small></label>
                                <input name="calle1" id="calle1" class="ab-form background-color rounded border capitalize calle_1" type="text" readonly>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="calle2"><small>Y la calle</small></label>
                                <input name="calle2" id="calle2" class="ab-form background-color rounded border capitalize calle_2" type="text" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col text-right">
                        <input name="poligono" class="poligono" type="hidden">
                        <input name="origen" type="hidden" value="predio">
                        <button type="submit" class="ab-btn b-primary-color btn-guardar">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4 mt-4">
            <div id="drive-mapa" class="card shadow-sm sticky-top" style="top: 33px !important;">
                <div class="card-header">
                    <small>Ubicación del predio</small>
                </div>
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 200px;"></div>
                </div>
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
@endsection

@section('js')
@parent
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="{{asset('js/frontend.js')}}"></script>

<script>
    //Variables globales
    var map;

    $(document).ready(function() {

        tippy('#cuenta-tooltip', {
            content: '<small class="font f-13"> Recuerda que son 10 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
        });

        tippy('#curt-tooltip', {
            content: '<small class="font f-13"> Recuerda que son 31 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
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


        $('#datos').submit(function() {
            $('.btn-info').prop('disabled', true);
            $('.btn-info').html(spiner());
        });

        /** 
            Elimina la cuenta anterior para buscar la nueva  
        */

        $('.curt').change(function() {
            $('.cuenta').val('');
        });

        $('.cuenta').change(function() {
            $('.curt').val('');
        });


        /**
            Buscar predio
         */


        $('.btn-buscar').click(function() {

            $(this).prop('disabled', true);
            $(this).html(spiner());

            var cuenta = $('.cuenta').val();
            var curt = $('.curt').val();

            if (cuenta != '') {

                try {
                    consulta_cuenta(cuenta);
                } catch (error) {
                    console.log(error);
                }

            } else if (curt != '') {

                try {
                    consulta_cuenta(curt);
                } catch (error) {
                    console.log(error);
                }

            } else {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes introducir una cuenta predial o CURT para poder continuar',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar predio");

            }

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

                    try {

                        if (typeof(response.msg) != 'undefined') {
                            iziToast.show({
                                title: 'Ups ☹️',
                                message: response.msg,
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });
                        } else {

                            if (response[0].estatus_predio == 'A') {

                                iziToast.show({
                                    title: '¡Excelente!',
                                    message: 'Se encontró la cuenta',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });


                                $('.calle').val(response[0].catcalle_nombre);
                                $('.colonia').val(response[0].catcol_nombre);
                                $('.numero').val(response[0].prenoext);
                                $('.interior').val(((response[0].numext_interior != null) ? response[0].numext_interior : "") + ((response[0].numint != null) ? ' ' + response[0].numint : '') + ((response[0].letraext != null) ? ' ' + response[0].letraext : ''));
                                $('.manzana').val(response[0].manzana);
                                $('.cuenta').val(response[0].precuentapredialant);
                                $('.curt').val(response[0].precuentapredial);
                                $('.lote').val(response[0].lote);
                                $('.condominio').val(response[0].edificio);
                                $('.privativa').val(response[0].unidad);
                                $('.poligono').val(response[0].coordenadas);
                                agregar_poligono(response[0].coordenadas);
                                $('.btn-guardar').fadeIn('slow');

                            } else {

                                iziToast.show({
                                    title: 'Ups ☹️',
                                    message: 'La cuenta no puede ser utilizada, consulta con la Dirección de Catastro',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });


                            }


                        }

                    } catch (error) {
                        console.log(error);
                    }

                    $('.btn-buscar').prop('disabled', false);
                    $('.btn-buscar').text("Buscar predio");


                },
                error: function(error) {

                    $('.btn-buscar').prop('disabled', false);
                    $('.btn-buscar').text("Buscar predio");

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


        function agregar_poligono(geopolygon) {

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
        }



    });

    function initMap() {


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
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection