@extends('base_admin')

@section('title', 'Predios')

@section('menu')
{{menu_administrador('predios')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container position-relative" style="padding: 0 20px;">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center container-search">
            <h1 class="font bold">Predios</h1>
            <input type="text" name="" class="ab-form rounded border search" placeholder="Cuenta predial" maxlength="31" autocomplete="off">
        </div>
    </div>
    <section>
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="row mb-4 containerPredios">
                </div>
                <p class="font text-left ver more"><a href="#!" class="text-decoration-none font f-13">Ver más</a></p>
            </div>
        </div>
    </section>
    <p class="font text-center text-muted f-14 mt-4 ocultar">No hay registros para mostrar</p>
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
                        <div id="map" style="width: 100%; height: 150px;"></div>
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
<link rel="stylesheet" href="{{asset('css/administrador/predios.css')}}">
@endsection

@section('js')
@parent

<script>
    $(document).ready(function() {

        var total = 6;
        var next_page_url = `{{url('')}}/predios/get_all_users?page=1`;
        var activo = false;
        var map = null;
        const poligono = null;

        $('.card').hover(function() {
            $(this).addClass('shadow');
        }, function() {
            $(this).removeClass('shadow');
        });


        $('.more').click(function() {

            if (activo) {
                get_predios(next_page_url);
            }

        });


        $('.search').keyup(function(e) {

            if (e.keyCode == 13) {
                next_page_url = `{{url('')}}/predios/get_all_users?page=1`;
                $('.containerPredios').empty();
                get_predios(next_page_url);
            }

        });


        const get_predios = (url) => {

            $('.ver').show();
            $('.ver a').text('Cargando...');
            $('.ocultar').hide();
            activo = false;

            axios.post(url, {
                total: total,
                curt: $('.search').val().trim()
            }).then(function(response) {

                ($('.search').val().trim() == '' ? $('.ver a').text('Ver más') : $('.ver').hide());

                if ($('.search').val().trim() == '') {

                    if (Object.keys(response.data.data).length > 0) {

                        if (response.data.next_page_url != null) {
                            next_page_url = response.data.next_page_url;
                        } else {
                            $('.ver').hide();
                        }

                        response.data.data.forEach(element => {
                            $('.containerPredios').append(plantilla(element.id_usuario, element.id_predio, element.razon_social,
                                element.nombre, element.primer_apellido, element.segundo_apellido,
                                element.telefono, element.curt, element.perfil));
                        });

                        activo = true;

                    } else {
                        $('.ver').hide();
                        $('.ocultar').show();
                        $('.containerPredios').empty();
                    }

                } else {

                    $('.containerPredios').empty();

                    if (Object.keys(response.data).length > 0) {
                        $('.containerPredios').empty();

                        response.data.forEach(element => {
                            $('.containerPredios').append(plantilla(element.id_usuario, element.id_predio, element.razon_social,
                                element.nombre, element.primer_apellido, element.segundo_apellido,
                                element.telefono, element.curt, element.perfil));
                        });
                    } else {
                        $('.ver').hide();
                        $('.ocultar').show();
                        $('.containerPredios').empty();
                    }
                }


                $('.detalle').click(function() {

                    var cuenta = $(this).attr('data-cuenta');

                    consulta_cuenta(cuenta);

                });



            }).catch(function(error) {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Ocurrió un problema al tratar de obtener la información',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            });
        }

        get_predios(next_page_url);

        const plantilla = (id_usuario, id_predio, razon_social, nombre, apellidoP, apellidoM, telefono, curt, perfil) => {


            //Nombre o razón social
            var nombreCompleto = '';

            if (razon_social == '') {
                nombreCompleto = `${nombre} ${apellidoP} ${apellidoM}`;
            } else {
                nombreCompleto = razon_social;
            }

            if (perfil != null && perfil != '') {
                perfil = `{{Storage::disk('s3')->url('public') }}/${id_usuario}/${perfil}`;
            } else {
                perfil = "{{asset('media/flaticon/avatar.svg')}}";
            }

            return `
            <div class="col-md-6 col-sm-6 col-l-4 mt-3">
                <a href="#!" class="text-decoration-none">
                    <div class="card card-ciudadano">
                        <div class="card-header d-flex align-items-center">
                            <div class="circle-small">
                            <img src="${perfil}" alt="avatar">
                            </div>
                            <div>
                                <a href="{{url('administrador/detalle/${id_usuario}')}}" class="text-decoration-none" target="_blank">                             
                                    <h6 class="font bold f-12 ml-3 mb-0">${nombreCompleto}</h6>
                                </a>
                                <p class="font f-10 ml-3 mb-0 text-muted">Tel: ${telefono}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="font bold text-decoration-none text-center f-15">${curt}</h5>
                            <small data-cuenta="${curt}" class="badge bg-warning text-dark f-10 p-2 pointer detalle">  <i class="fas fa-eye"></i> Ver detalle</small>
                        </div>
                    </div>
                </a>
            </div>
            `;
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


    });


    function initMap() {

        var markers = [];

        map = new google.maps.Map(document.getElementById("map"), { //Carga el mapa
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

            map.setCenter(arr[1]);
            poligono.setMap(map);

        }
    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection