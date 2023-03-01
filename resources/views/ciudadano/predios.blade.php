@extends('base')

@section('title', 'Mis predios')

@section('aside')
{{menu_ciudadano('predios')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Mis predios</h1>
<small class="font text-muted mb-5">Agrega tus predios. Podrás ver el estatus de pago de cada uno.</small>
<div id="section">
    @if($predios != '[]')
    <div class="row">
        <div class="col mt-4 d-flex justify-content-end align-items-center">
            <a id=nuevo href="{{url('predio/form/agregar')}}"><button class="ab-btn b-primary-color text-white">Nuevo predio</button></a>
        </div>
    </div>
    @else
    <p class="font text-center text-muted f-14 mt-5">No hay predios para mostrar <a href="{{url('predio/form/agregar')}}">Agregar predio</a></p>
    @endif
    <div class="row">
        @foreach($predios as $predio)
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body p-0 position-relative">
                    <div data-curt="{{$predio->curt}}" id="{{$predio->id_predio}}" style="width: 100%; height: 200px;"></div>
                    <div class="w-100 p-3 brother">

                        <span class="badge badge-pill position-absolute p-2 mt-3 f-10 font c-negro" style="top: 0; background-color: #e97171;"></span>

                        <small class="font"><b>Cuenta: {{$predio->cuenta_predial}}</b></small><br>
                        <small class="font"><b>CURT: {{$predio->curt}}</b></small>
                        <div class="mt-2 ocultar">
                            <small class="c-negro">Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
                        </div>
                        <div class="mt-2 d-flex justify-content-end align-items-center">
                            <div class="enlace pointer btn-delete" data-toggle="tooltip" data-placement="top" title="Eliminar predio" data-id="{{$predio->id_predio}}">
                                <a href="#" aria-label="Eliminar el predio con CURT {{$predio->curt}}">
                                    <i class="fas fa-trash c-negro"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/ciudadano/tramites.css')}}">
<link rel="stylesheet" href="{{asset('vendors/loading/loading-bar.min.css')}}">
<link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
@parent
<script src="{{asset('vendors/loading/loading-bar.min.js')}}"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>
<script>
    var map;



    $(document).ready(function() {

        var url = '{{url()->current()}}';


        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('[data-toggle="tooltip"]').tooltip();

        /*
         * 
         * Tutorial
         * 
         */

        $('#tutorial').click(function() {


            introJs().setOptions({
                showProgress: true,
                showBullets: false,
                "nextLabel": 'Siguiente',
                "prevLabel": 'Atras',
                "doneLabel": 'Terminar',
                steps: [{
                        title: '<small class="bold"> 🏡 Mis prediales </small>',
                        intro: "<small> Puedes revisar el estatus de tus predios. </small>",
                    }, {
                        element: document.querySelector('#nuevo'),
                        title: '<small class="bold"> 📝 Agrega tus prediales </small>',
                        intro: "<small> Solo necesitas la cuenta predial o CURT. </small>",
                        position: 'left',
                        disableInteraction: true
                    },

                ]
            }).start();
        });

        /* 
         *
         *Eliminar predio 
         * 
         */
        $('.btn-delete').click(async function() {
            var id_predio = $(this).attr('data-id');

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Deseas eliminar el predio?',
                position: 'center',
                backgroundColor: '#ff9b93',
                buttons: [
                    ['<button><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                    [`<button class="delete" data-id="${id_predio}">Si, eliminar</button>`, async function(instance, toast) {

                        var response = await axios.post('{{url("predios/deleted")}}', {
                            "_token": "{{ csrf_token() }}",
                            'id_predio': id_predio
                        }).then(function(response) {
                            console.log(response);
                        });

                        window.location.href = '{{url()->current()}}';

                    }, true]
                ]
            });

        });

    });



    function initMap() {

        $('.loading').fadeIn();

        var zapopan = {
            lat: 20.721395,
            lng: -103.391745
        };

        @foreach($predios as $predio)

        map = new google.maps.Map(document.getElementById("{{$predio->id_predio}}"), { //Carga el mapa
            center: zapopan,
            zoom: 14,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false
        });

        if ('{{$predio->poligono}}' != '' && '{{$predio->poligono}}' != null) {

            var arr = GeoPolygonToJson('{{$predio->poligono}}');

            var poligono = new google.maps.Polygon({
                path: arr,
                strokeColor: "#a8dda8",
                strokeOpacity: 1,
                strokeWeight: 2,
                fillColor: "#a8dda8",
                fillOpacity: 0.3,
            });

            poligono.setMap(map);
            map.setZoom(18);
            map.setCenter(arr[1]);
        } else {
            map.setZoom(14);
            map.setCenter(zapopan);

        }


        var curt = $('#{{$predio->id_predio}}').attr('data-curt'); //Obtiene la CURT del predio
        consulta_adeudo(curt, $('#{{$predio->id_predio}}'));


        @endforeach

        $('.loading').fadeOut();

    }

    function consulta_adeudo(curt, me) {

        me.siblings('.brother').find('.badge').text('Cargando...');

        $.ajax({
            url: "{{url('catastro/get_adeudo_cuenta')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cuenta": curt
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                //$('#response').val(response);
                var adeudo = '';

                (response == 0 ? adeudo = 'Adeudo' : adeudo = '');

                me.siblings('.brother').find('.badge').text(adeudo);

                if (response == 0) {
                    me.siblings('.brother').find('.ocultar').fadeIn();
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