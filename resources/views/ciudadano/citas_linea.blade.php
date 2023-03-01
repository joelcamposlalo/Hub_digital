@extends('base')

@section('title', 'Citas en línea')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<div class="container position-relative" style="padding: 0 !important">
    <div class="d-flex align-items-center">
        <a href="{{url('ciudadano/nuevo_tramite')}}" style="padding: 13px 0 0 0 !important" aria-label="Regresar a nuevo trámite">
            <button class="back b-primary-color mr-3" style="color: white" aria-hidden="true">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="text-muted font m-0 bold c-primary-color">Citas en línea</h1>
    </div>
    <small class="font text-muted mb-5">Agenda, consulta o cancela tu cita.</small>
</div>

<div id="section">
    <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite">
            <a style="text-decoration: none; color: gray;" href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/consulta_servicio_pyl">
                <div style="height: 260px;" class="card card-hover-effect">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="height: 110px" class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="120px" alt="dirección de padron y licencias" aria-hidden="true">
                            <span class="badge badge-warning mt-4">Dirección de Padrón y Licencias</span>
                        </div>
                        <div style="height: 150px" class="d-flex flex-column justify-content-center align-items-center">
                            <small class="text-center mt-2">Citas en línea</small>
                            <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;" class="circle mt-4 d-flex justify-content-center align-items-center">
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite">
            <a style="text-decoration: none; color: gray;" href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/cita_catastro">
                <div style="height: 260px;" class="card card-hover-effect">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="height: 110px" class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/catastro.svg')}}" width="120px" alt="dirección de catastro" aria-hidden="true">
                            <span class="badge badge-warning mt-4">Dirección de Catastro</span>
                        </div>
                        <div style="height: 150px" class="d-flex flex-column justify-content-center align-items-center">
                            <small class="text-center mt-2">Citas en línea</small>
                            <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;" class="circle mt-4 d-flex justify-content-center align-items-center">
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite">
            <a style="text-decoration: none; color: gray;" href="https://indicadores.zapopan.gob.mx:8080/CitasZapopan/citas_obp.php?id_servicio=360">
                <div style="height: 260px;" class="card card-hover-effect">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="height: 110px" class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/trabajos_menores.svg')}}" width="120px" alt="dirección de obras públicas" aria-hidden="true">
                            <span class="badge badge-warning mt-4">Dirección de Obras Públicas</span>
                        </div>
                        <div style="height: 150px" class="d-flex flex-column justify-content-center align-items-center">
                            <small class="text-center mt-2">Citas en línea</small>
                            <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;" class="circle mt-4 d-flex justify-content-center align-items-center">
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite">
            <a style="text-decoration: none; color: gray;" href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/cita_registro">
                <div style="height: 260px;" class="card card-hover-effect">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="height: 110px" class="d-flex flex-column justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/prematrimoniales.svg')}}" width="120px" alt="dirección de registro civil" aria-hidden="true">
                            <span class="badge badge-warning mt-4">Dirección de Registro Civil</span>
                        </div>
                        <div style="height: 150px" class="d-flex flex-column justify-content-center align-items-center">
                            <small class="text-center mt-2">Citas en línea</small>
                            <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;" class="circle mt-4 d-flex justify-content-center align-items-center">
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('nuevo_tramite')}}
@endsection

@section('css')
@parent
<!-- Library css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('js')
@parent

<script src="{{asset('js/frontend.js')}}"></script>
<script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';

        /**
            Menu         
         */
        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('.card').hover(function() {
            $(this).find('.circle').addClass('animate__animated animate__headShake animate__slower');
            $(this).addClass('shadow');
        }, function() {
            $(this).find('.circle').removeClass('animate__animated animate__headShake animate__slower');
            $(this).removeClass('shadow');
        });

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
                    element: document.querySelector('#carta'),
                    title: '<small class="bold"> 📑 ¿Encontraste el trámite? </small>',
                    intro: "<small> Da click sobre él para comenzar. </small>",
                    position: 'right'
                }, ]
            }).start();
        });


    });
</script>
@endsection