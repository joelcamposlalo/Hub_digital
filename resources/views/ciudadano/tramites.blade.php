@extends('base')

@section('title', 'Mis trámites')

@section('aside')
{{menu_ciudadano('tramites')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Mis trámites</h1>
<small class="font text-muted mb-5 f-15">En esta sección encontrarás la información de cada uno de tus trámites.</small>

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

<div id="section">

    @if($solicitudes != '[]')

    <div class="row">
        <div id="buscar" class="col-md-6 mt-4">
            <input type="text" class="ab-form border rounded" name="search" id="search" autocomplete="off" placeholder="Buscar registro">
        </div>
        <div id="nuevo" class="col mt-4 d-flex justify-content-end align-items-center">
            <a href="{{url('ciudadano/nuevo_tramite')}}"><button class="ab-btn b-primary-color text-white">Nuevo trámite</button></a>
        </div>
    </div>
    <div class="row mt-4">
        <div id="clasificar" class="col-md-6">
            <button id="todos" class="f-14 ab-btn-small active mt-2" style="border-radius: 30px !important;">Todos</button>
            <button id="pendientes" class="f-14 ab-btn-small mt-2" style="border-radius: 30px !important;">Pendientes</button>
            <button id="revision" class="f-14 ab-btn-small mt-2" style="border-radius: 30px !important;">En revision</button>
            <button id="terminados" class="f-14 ab-btn-small mt-2" style="border-radius: 30px !important;">Terminados</button>
            <button id="cancelados" class="f-14 ab-btn-small mt-2" style="border-radius: 30px !important;">Cancelados</button>
        </div>
    </div>
    @endif
    <p class="font text-center text-muted f-15 mt-5 ocultar no-tramites">No hay solicitudes para mostrar <a href="{{url('ciudadano/nuevo_tramite')}}">Nuevo trámite</a></p>
    @if($solicitudes != '[]')
    <div class="responsive" style="width: 100%; overflow-x: auto;">
        <table class="mt-3">
            <tr>
                <th class="text-muted f-15">Folio</th>
                <th class="text-muted f-15">Folio dependencia</th>
                <th class="text-muted f-15">Trámite</th>
                <th class="text-muted f-15">Estatus</th>
                <th class="text-muted f-15">Progreso</th>
                <th class="text-muted f-15">Acciones</th>
            </tr>
            <tbody class="table-body">
                @foreach($solicitudes as $solicitud)
                <tr class="{{Str::of($solicitud->estatus)->replace(' ', '')}} tramites ">
                    <td class="f-15">{{$solicitud->id_solicitud}}</td>
                    <td class="f-15">
                        @if($solicitud->id_captura != null && $solicitud->id_tramite == 3)
                        <small class="font mb-5">{{$solicitud->id_captura}}</small>
                        @endif
                        @if($solicitud->id_captura!=null && ($solicitud->id_tramite==1||$solicitud->id_tramite==2||$solicitud->id_tramite==4||$solicitud->id_tramite==5||$solicitud->id_tramite==6||$solicitud->id_tramite==7||$solicitud->id_tramite==10||$solicitud->id_tramite==14||$solicitud->id_tramite==8||$solicitud->id_tramite==11||$solicitud->id_tramite==12||$solicitud->id_tramite==15))
                        <small class="font mb-5">
                            {{$solicitud->id_captura}}</small>
                        @endif
                    </td>
                    <td class="f-15">{{$solicitud->tramite}}</td>
                    <td class="f-15"><span class="badge badge-pill mt-2 mayuscula" style=" background-color: @if($solicitud->estatus === 'autorizado') #28a745 @elseif($solicitud->estatus === 'pendiente' || $solicitud->estatus === 'en revision') #ffc107 @else #fa9579 @endif">{{$solicitud->estatus}}</span></td>
                    <td class="f-15">
                        <div class="ldBar label-center" data-preset="fan" data-value="{{$solicitud->porcentaje}}" data-stroke="@if($solicitud->porcentaje >= 50) #28a745 @else #fa9579 @endif "></div>
                    </td>
                    <td class="f-15 acciones">
                        <a href="#!" data-toggle="tooltip" data-placement="top" title="Ver detalles" style="text-decoration: none" aria-label="Ver detalles">
                            <div class="enlace pointer btn-detalles" data-toggle="modal" data-target="#modal-detalles" data-id="{{$solicitud->id_solicitud}}">
                                <i class="fas fa-eye c-negro"></i>
                            </div>
                        </a>
                        @if($solicitud->paso == 0)
                        <div class="enlace pointer ml-2 btn-delete" data-toggle="tooltip" data-placement="top" title="Eliminar trámite" data-id="{{$solicitud->id_solicitud}}">
                            <a href="#" aria-label="Eliminar trámite">
                                <i class="fas fa-trash c-negro"></i>
                            </a>
                        </div>
                        @endif
                    </td>
                    <td>
                        @if($solicitud->estatus === 'pendiente'||$solicitud->estatus === 'autorizado'||$solicitud->id_etapa==18 || $solicitud->id_etapa==85)
                        <div class="justify-content-center align-items-center ml-2" style=" display: inline-flex !important">
                            <a href="{{url('solicitudes/consulta_solicitudes')}}/{{$solicitud->id_solicitud}}"><button class="ab-btn b-primary-color text-white">Continuar</button></a>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="font text-center text-muted f-15 mt-5">No hay solicitudes para mostrar <a href="{{url('ciudadano/nuevo_tramite')}}">Nuevo trámite</a></p>
    @endif


    <!-- Modal detalles de solicitud -->
    <!-- Modal -->
    <div class="modal fade" id="modal-detalles" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de solicitud </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="detalles">
                        <small id="folio" class="font text-muted f-14 ml-1"></small>
                        <tr>
                            <div id="linea" class="position-absolute rounded"></div>
                            <th>Dirección</th>
                            <td id="direccion"></td>
                        </tr>
                        <tr>
                            <div id="linea2" class="position-absolute rounded"></div>
                            <th>Inicio de trámite</th>
                            <td id="inicio"></td>
                        </tr>
                        <tr>
                            <div id="linea3" class="position-absolute rounded"></div>
                            <th>Última modificación</th>
                            <td id="modificacion"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->


    <!-- Modal calificación -->
    <!-- Modal -->
    <div class="modal fade" id="modal-calificacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="font bold"> Hola @if(session('razon_social') != '') {{session('razon_social')}} @else {{session('nombre')}} @endif <br> <small class="font f-14">Nos da gusto que hayas concluido tu primer trámite. Es para nosotros muy importante tu calificación y comentario para seguir mejorando</small> </h5>
                </div>

                <div class="modal-body d-flex flex-column justify-content-center align-items-center p-4">
                    <img src="{{asset('media/drawkit/flat/PNG/Reviews.png')}}" width="100px" alt="Imagen de calificación">
                    <div class="my-rating mt-4"></div>
                    <textarea class="mt-2 w-100 background-color rounded border p-2 txt-comentario font f-16 mt-4" name="descripcion" rows="5" placeholder="¿Que te pareció el servicio?" style="outline: none !important;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel btn-omitir" data-dismiss="modal">Omitir</button>
                    <button type="button" class="ab-btn b-primary-color btn-calificar">Calificar</button>
                </div>
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
<link rel="stylesheet" href="{{asset('css/ciudadano/tramites.css')}}">
<link rel="stylesheet" href="{{asset('vendors/loading/loading-bar.min.css')}}">
<link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/rating/rating.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/loading/loading-bar.min.js')}}"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>
<script src="{{asset('vendors/rating/rating.js')}}"></script>
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';
        var filtro = '';
        var filtro_2 = '';
        var text = '';
        var folio = '';



        if ('{{$count_calificacion}}' == 0 && "{{count($solicitudes)}}" == 1) {
            $('#modal-calificacion').modal('show');
        }

        $(".my-rating").starRating({
            disableAfterRate: false,
            starSize: 25,
            totalStars: 5,
            strokeColor: '#ffc107',
            ratedColors: ['#ffc107', '#ffc107', '#ffc107', '#ffc107', '#ffc107'],
            hoverColor: '#ffc107',
            initialRating: 5,
            starShape: 'rounded',
            useGradient: false,
            useFullStars: true,
            callback: function(currentRating, $el) {}
        });

        $('.btn-omitir').click(function() {

            axios.post('{{url("ciudadano/calificar")}}', {
                'comentario': '',
                'calificacion': 0
            }).then((response) => {
                iziToast.show({
                    message: '👍 Gracias por apoyarnos',
                    backgroundColor: '#2fd099',
                    closeOnEscape: true
                });
            })

            $('#modal-calificacion').modal('hide');

        });

        $('.btn-calificar').click(function() {
            var calificacion = $('.my-rating').starRating('getRating');
            var comentario = $('.txt-comentario').val();

            axios.post('{{url("ciudadano/calificar")}}', {
                'comentario': comentario,
                'calificacion': Number(calificacion)
            }).then((response) => {
                iziToast.show({
                    message: '👍 Gracias por tu calificación',
                    backgroundColor: '#2fd099',
                    closeOnEscape: true
                });
            })

            $('#modal-calificacion').modal('hide');
        });

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('[data-toggle="tooltip"]').tooltip()


        const eliminar = () => {
            $('.btn-delete').click(async function() {
                var id_solicitud = $(this).attr('data-id');

                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: `${id_solicitud}`,
                    zindex: 999,
                    title: '{{session("nombre")}}',
                    message: '¿Deseas eliminar la solicitud?',
                    position: 'center',
                    backgroundColor: '#ff9b93',
                    buttons: [
                        ['<button><b>No, cerrar<b></button>', function(instance, toast) {

                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');

                        }],
                        [`<button class="delete" data-id="${id_solicitud}">Si, eliminar</button>`, async function(instance, toast) {

                            var response = await axios.post('{{url("solicitud/deleted")}}', {
                                "_token": "{{ csrf_token() }}",
                                'id_solicitud': id_solicitud
                            }).then(function(response) {
                                console.log(response);
                            });

                            window.location.href = '{{url()->current()}}';

                        }, true]
                    ]
                });

            });

        }

        eliminar();


        $('#tutorial').click(function() {


            introJs().setOptions({
                showProgress: true,
                showBullets: false,
                "nextLabel": 'Siguiente',
                "prevLabel": 'Atras',
                "doneLabel": 'Terminar',
                steps: [{
                        element: document.querySelector('#buscar'),
                        title: '<small class="bold"> 🔎 Busca </small>',
                        intro: "<small> Puedes encontrar rápido tu támite. </small>",
                        position: 'right',
                        disableInteraction: true
                    }, {
                        element: document.querySelector('#clasificar'),
                        title: '<small class="bold"> 👀 Clasifica </small>',
                        intro: "<small> Ve tus támites según su estatus. </small>",
                        position: 'right',
                        disableInteraction: true
                    }, {
                        element: document.querySelector('#notificacion'),
                        title: '<small class="bold"> 🔔 Mis notificaciónes </small>',
                        intro: "<small> La campanita te mantendrá informado. ¡No olvides revisarla!. </small>",
                        position: 'left',
                        disableInteraction: true
                    },

                ]
            }).start();
        });

        /*
         *
         * Filtra las solicitudes
         *
         */

        $('#todos').click(function() {

            $('#clasificar button').removeClass('active');
            $(this).addClass('active');

            $('.tramites').fadeIn();

            filtro = '';
            filtro_2 = '';

            get_all();

        });

        $('#pendientes').click(function() {

            $('#clasificar button').removeClass('active');
            $(this).addClass('active');

            $('.tramites').fadeOut();
            $('.pendiente').fadeIn();

            filtro = 'pendiente';
            filtro_2 = '';

            get_all();


        });

        $('#revision').click(function() {

            $('#clasificar button').removeClass('active');
            $(this).addClass('active');

            $('.tramites').fadeOut();
            $('.enrevision').fadeIn();

            filtro = 'en revision';
            filtro_2 = '';

            get_all();

        });

        $('#terminados').click(function() {

            $('#clasificar button').removeClass('active');
            $(this).addClass('active');

            $('.tramites').fadeOut();
            $('.autorizado').fadeIn();
            $('.noautorizado').fadeIn();

            filtro = 'autorizado';
            filtro_2 = 'no autorizado';

            get_all();

        });

        $('#cancelados').click(function() {

            $('#clasificar button').removeClass('active');
            $(this).addClass('active');

            $('.tramites').fadeOut();
            $('.cancelado').fadeIn();

            filtro = 'cancelado';
            filtro_2 = '';

            get_all();

        });

        /*
         *
         * Detalles de la solicitud
         *  
         */

        const detalles = () => {
            $('.btn-detalles').click(async function() {
                var id_solicitud = $(this).attr('data-id');

                axios.post('{{url("solicitud/detalles")}}', {
                    "_token": "{{ csrf_token() }}",
                    'id_solicitud': id_solicitud
                }).then(function(response) {

                    if (response != '') {

                        console.log(response.data);

                        response.data.forEach(detalle => {
                            $('#direccion').text(detalle.coordinacion);
                            $('#inicio').text(detalle.created_at);
                            $('#modificacion').text(detalle.update_at);
                            $('#folio').text('Folio: ' + detalle.id_solicitud);

                            if (detalle.estatus == 'cancelado' || detalle.estatus == 'no autorizado') {

                                document.getElementById("linea").style.backgroundColor = "#fa9579";
                                document.getElementById("linea2").style.backgroundColor = "#fa9579";
                                document.getElementById("linea3").style.backgroundColor = "#fa9579";

                            } else if (detalle.estatus == 'pendiente' || detalle.estatus == 'en revision') {
                                document.getElementById("linea").style.backgroundColor = "#ffc107";
                                document.getElementById("linea2").style.backgroundColor = "#ffc107";
                                document.getElementById("linea3").style.backgroundColor = "#ffc107";

                            } else {
                                document.getElementById("linea").style.backgroundColor = "#28a745";
                                document.getElementById("linea2").style.backgroundColor = "#28a745";
                                document.getElementById("linea3").style.backgroundColor = "#28a745";
                            }

                        });

                    }
                }).catch(function(error) {
                    console.log(error);
                });

            });

        }

        detalles();

        $('#search').keyup(function() {
            text = $(this).val();
            get_all();
        });



        const get_all = () => {

            axios.post('{{url("solicitud/get_all")}}', {
                _token: "{{ csrf_token() }}",
                search: text,
                filtro: filtro,
                filtro_2: filtro_2
            }).then(function(response) {


                //console.log(typeof(response));
                let total = Object.keys(response.data).length;

                if (total > 0) {

                    $('.tramites').remove();
                    $('.responsive').show();
                    $('.no-tramites').hide();

                    // console.log(response.data);                    

                    response.data.forEach(element => {
                        $('.table-body').append(plantilla(element.id_solicitud, element.tramite, element.estatus, element.porcentaje, element.paso, element.id_captura, element.id_tramite));
                        var bar = new ldBar(`.element_${element.id_solicitud}`);
                        bar.set(element.porcentaje);
                    });

                    detalles();
                    eliminar();

                    $('[data-toggle="tooltip"]').tooltip()

                } else {


                    $('.tramites').empty();
                    $('.responsive').hide();
                    $('.no-tramites').show();

                }

            }).catch(function(error) {
                console.log(error);
            });

        }


        const plantilla = (id_solicitud, tramite, estatus, porcentaje, paso, id_captura, id_tramite) => {

            return `
                    <tr class="${estatus.replace(' ', '')} tramites">                    
                    <td class="f-15">${id_solicitud}                                                                                                                         </td>
                    <td class="f-15">
                    ` + ((id_captura != null && id_tramite == 3) ? '<small class="font mb-5">' + id_captura + '</small>' : '') + `
                        ` + ((id_captura != null && (id_tramite == 1 || id_tramite == 2 || id_tramite == 4 || id_tramite == 5 || id_tramite == 6 ||
                id_tramite == 7 || id_tramite == 11)) ? '<small class="font mb-5">' + id_captura + '</small>' : '') + `
                    </td>
                        <td class="f-15">${tramite}</td>
                        <td class="f-15"><span class="badge badge-pill mt-2 mayuscula" style="background-color: ` + ((estatus == 'autorizado') ? '#28a745' : ((estatus == 'pendiente' || estatus == 'en revision') ? '#ffc107' : '#fa9579')) + `
                    ">${estatus}</span></td>
                        <td class="f-15">
                            <div class="ldBar label-center element_${id_solicitud}" data-preset="fan" data-value="${porcentaje}" data-stroke=" ` + ((porcentaje >= 50) ? '#28a745' : '#fa9579') + ` "></div>
                        </td>
                        <td class="f-15 acciones">
                            <a href="#!" data-toggle="tooltip" data-placement="top" title="Ver detalles" style="text-decoration: none" aria-label="Ver detalles">
                                <div class="enlace pointer btn-detalles" data-toggle="modal" data-target="#modal-detalles" data-id="${id_solicitud}">
                                    <i class="fas fa-eye c-negro"></i>
                                </div>
                            </a>
                        ` + ((paso == 0) ? '<div class="enlace pointer ml-2 btn-delete" data-toggle="tooltip" data-placement="top" aria-label="Eliminar trámite" title="Eliminar trámite" data-id="' + id_solicitud + '"><a href="#!"><i class="fas fa-trash c-negro"></i></a></div>' : '') + `
                        </td>
                        <td>                
                            ` + ((estatus == 'pendiente' || estatus == 'autorizado') ? '<div class="justify-content-center align-items-center ml-2" style=" display: inline-flex !important"><a href="{{url("solicitudes/consulta_solicitudes")}}/ ' + id_solicitud + ' "><button class="ab-btn b-primary-color text-white">Continuar</button></a></div>' : '') + `
                        </td>
                        </tr>
                    `;
        }
    });
</script>
@endsection