@extends('base')

@section('title', 'Primera etapa')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<div id="section">
    <div class="row">
        <div data-aos-duration="1500" data-aos="fade-up" class="col-md-12 p-0 mt-4 rounded position-relative" style="height: auto;">
            <div class="box-green position-absolute rounded" style="height: 250px; width: 100%;  background-color: #2fd099; top: 0; z-index: -1;">
            </div>
            <div data-aos-duration="1500" data-aos="fade-up" class="shadow-sm bg-white rounded p-5 d-flex flex-column align-items-center" style="width: 80%;  margin: 50px auto 0 auto; z-index: 1000 !important;">
                <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_UDFLD9.json" background="transparent" speed="1" style="width: 250px; height: 250px;" loop autoplay></lottie-player>
                <h1 class="font c-negro bold text-center">Notificación de registro de trámite en línea</h1>
                <small class="font text-center">Mantente atento a tu correo, ya que a través de él te informarán sobre la validación de tu trámite</small>
                <a data-aos-duration="2000" data-aos="fade-up" data-aos-anchor-placement="top-bottom" href="{{url('ciudadano/tramites')}}" class="mt-3 text-decoration-none p-2">Ir a mis trámites</a>
                <small class="font text-center">Ayuda a que más personas puedan realizar su trámite en línea</small>
                <div class="mt-1">
                    <div class="fb-share-button mt-3" data-href="https://vdigital.zapopan.gob.mx/" data-layout="button_count"></div>
                    <a href="https://wa.me/?text=https://vdigital.zapopan.gob.mx/" target="_blank" style="text-decoration: none; transform: translateY(3px); border-radius: 3px; padding: 2px 5px; background-color: #55cd6c; font-size: 11px; font-weight: bold; color: white; display: inline-flex; justify-content: center; align-items: center;"> <img src="{{asset('media/flaticon/whatsapp.png')}}" style="width: 15px; margin-right: 4px;" alt="icono de whatsapp"> Compartir</a>
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
<link rel="stylesheet" href="{{asset('css/ciudadano/tramites.css')}}">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('js')
@parent
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/es_LA/all.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    AOS.init();

    $(document).ready(function() {

        var url = '{{url()->current()}}';

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

    });
</script>
@endsection
