<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <title>Preguntas y respuestas</title>

    <!-- Css -->
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/landing.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <!-- Library css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('media/favicon/site.webmanifest')}}">

    <!-- Meta datos para la busqueda -->

    <!-- Meta datos para la busqueda facebook -->
    <meta property="og:url" content="https://vdigital.zapopan.gob.mx/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="VDigital" />
    <meta property="og:description" content="Todos tus trámites en un solo lugar. Crea una cuenta para gestionar tus trámites y darles seguimiento." />
    <meta property="og:image" content="{{asset('media/screen.png')}}" />
    <meta property="og:keywords" content="trámites, tramites, en línea, en linea, línea, linea, vdigital, ventanilla digital, ventanilla, digital, zapopan, más clicks, mas clicks, menos filas, trámites en línea, tramites en linea, trámites y servicios, servicios, zap, ayuntamiento, ayuntamiento de zapopan, zapopan jalisco, jalisco, catálogo, catalogo, retys, catálogo de retys, catalogo de retys, cartografía municipal, cartografia municipal, cartografía, cartografia, municipal, citas en línea, citas en linea, citas, ciudapp, facturación electrónica, facturacion electronica, facturación, facturacion, electrónica, electronica, acreditación de movilidad, acreditacion de movilidad, acreditación, acreditacion, movilidad, ganchito, padrón de proveedores, padron de proveedores, padrón, padron, proveedores, proveedores, pagos en línea, pagos en linea, pagos, pláticas prematrimoniales, platicas prematrimoniales, registro municipal, registro, iniciar sesión, iniciar sesion, iniciar, sesión, sesion, crear cuenta, crear, cuenta, padrón y licencias, licencias, catastro, obras públicas, obras publicas, obras, públicas, movilidad y trasnporte, trasnporte, dirección, direccion">


</head>

<body class="background-color">


    <div class="loading">
        <img src="{{asset('media/gif/loading.gif')}}" alt="cargando página">
    </div>


    <div class="contenedor">
        <nav class="border" id="nav">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="/">
                    <div class="logo d-flex align-items-center" aria-label="Ir a página principal VDigital">
                        <!--
                        <div class="circle background-color d-flex justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/logo.png')}}" width="30px" alt="logo">
                        </div>
                        <img class="ml-3 logo-title" src="{{asset('media/ilustrator/zapopan.png')}}" width="120px" alt="logo del gobierno de zapopan">
                        -->                        
                        <img src="{{asset('media/ilustrator/logo.png')}}" width="270rem" alt="logo" aria-hidden="true">
                        <!--<img class="ml-3 logo-title" src="{{asset('media/ilustrator/ZapopanCiudadNinos_original.png')}}" width="180rem" alt="logo del gobierno de zapopan" aria-hidden="true">-->
                    </div>
                </a>
                <div class="buttons">
                    <a class="iniciar_sesion f-13 text-decoration-none rounded font" href="{{url('cuenta')}}">Iniciar sesión</a>
                </div>
            </div>
        </nav>
        <header>
            <div class="container container-header d-flex justify-content-between align-items-center h-100">
                <div class="text pr-5 position-relative">
                    <span class="badge badge-warning font f-12">VDigital</span>
                    <h1 class="font c-negro bold mb-1">¿Necesitas ayuda?</h1>
                    <small class="text-muted font mt-5 f-13">Consulta nuestra sección de preguntas frecuentes</small> <br>
                    <div id="bi-arrow-down-circle" style="width: 40px; height: 40px; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 animate__animated animate__bounce animate__delay-2s pointer bi-arrow-down-circle">
                        <i class="fas fa-arrow-down text-white" style="font-size: 25px;"></i>
                    </div>
                </div>
                <div class="image">
                    <img width="500px" src="{{asset('media/ilustrator/questions.svg')}}" alt="ventanilla digital, más clicks menos filas">
                </div>
            </div>
        </header>
        <section id="preguntas">
            <div class="container pb-5">
                <h1 class="text-center font bold c-negro mt-2">Preguntas y respuestas</h1>
                <div class="mb-4 text-center">
                    <span class="badge badge-warning font f-12">Frecuentes</span>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-12 mt-3">
                        <a style="text-decoration: none !important;" data-toggle="collapse" href="#respuesta1" role="button" aria-expanded="false" aria-controls="respuesta1">
                            <div class="card-header c-negro card-efecto">
                                ¿Qué es VDigital?
                            </div>
                        </a>
                        <div class="collapse" id="respuesta1">
                            <div class="card card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <a style="text-decoration: none !important;" data-toggle="collapse" href="#respuesta2" role="button" aria-expanded="false" aria-controls="respuesta2">
                            <div class="card-header c-negro card-efecto">
                                ¿Qué es ...?
                            </div>
                        </a>
                        <div class="collapse" id="respuesta2">
                            <div class="card card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <a style="text-decoration: none !important;" data-toggle="collapse" href="#respuesta3" role="button" aria-expanded="false" aria-controls="respuesta3">
                            <div class="card-header c-negro card-efecto">
                                ¿Qué es ...?
                            </div>
                        </a>
                        <div class="collapse" id="respuesta3">
                            <div class="card card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


    <div class="btn-float-menu pointer" style="width: 70px; height: 70px; background-color: #ffc107; position: fixed; bottom: 0; left: 0; margin: 30px; display: flex; justify-content: center; align-items: center; border-radius: 50%; z-index: 10000000;">
        <i class="fas fa-arrow-up text-white" style="font-size: 25px;"></i>
    </div>
    <footer class="p-2" style="background-color: white;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <div class="row pt-5 pb-5 ">
                        <div class="col-md-6 col-lg-3 text-center p-4">
                            <img src="{{url('media/ilustrator/zapopan.png')}}" width="250px" alt="Logo de zapopan">
                        </div>
                        <div class="col-md-6 col-lg-3  text-center p-4">
                            <a href="https://www.zapopan.gob.mx/v3/circulares-interes-general" class="font d-block">Circulares de interés general</a>
                            <a href="https://www.zapopan.gob.mx/v3/recomendaciones-visualizacion" class="font d-block mt-2">Recomendaciones para visualizar el sitio</a>
                            <a href="https://www.zapopan.gob.mx/v3/avisodeprivacidad" class="font d-block mt-2">Aviso de privacidad</a>
                            <p class="font mt-2">2018 - 2021 - Gobierno de Zapopan</p>
                        </div>
                        <div class="col-md-6 col-lg-3 text-center p-4">
                            <a href="https://www.zapopan.gob.mx/v3/gobierno" class="font d-block">Gobierno</a>
                            <a href="#!" class="font d-block mt-2 bi-arrow-down-circle">Trámites en línea</a>
                            <a href="https://www.zapopan.gob.mx/transparencia/" class="font d-block mt-2">Transparencia</a>
                            <a href="https://www.zapopan.gob.mx/v3/normatividad" class="font d-block mt-2">Normatividad</a>
                            <a href="https://www.zapopan.gob.mx/v3/ciudad" class="font d-block mt-2">Ciudad</a>
                        </div>
                        <div class="col-md-6 col-lg-3 text-center p-4">
                            <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                <a href="https://www.facebook.com/ZapopanGob/" target="_blank"><img width="40px" alt="logo facebook" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Facebook-zap_1.png" /></a>
                                <a href="https://www.instagram.com/zapopangob/" target="_blank"> <span class="sr-only">Instagram</span><img width="40px" alt="logo instagram" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Instagram-zap_2.png" /></a>
                                <a href="https://twitter.com/zapopangob/" target="_blank"> <span class="sr-only">Twitter</span><img width="40px" alt="logo twitter" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Twitter-zap_1.png" /></a>
                                <a href="https://www.youtube.com/zapopangob/" target="_blank"> <span class="sr-only">Youtube</span> <img width="40px" alt="logo youtube" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_YouTube-zap_1.png" /></a>
                                <a href="https://livestream.com/zapopangob" target="_blank"> <span class="sr-only">Transmision</span> <img width="40px" alt="logo_transmision" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://www.zapopan.gob.mx/wp-content/uploads/2021/02/Ico_Trans-zap_1-1.png" /></a>
                                <div class="mt-3">
                                    <div class="fb-share-button mt-3" data-href="https://vdigital.zapopan.gob.mx/" data-layout="button_count"></div>
                                    <a href="https://wa.me/?text=https://vdigital.zapopan.gob.mx/" target="_blank" style="text-decoration: none; transform: translateY(2.5px); border-radius: 3px; padding: 2px 5px; background-color: #55cd6c; font-size: 11px; font-weight: bold; color: white; display: inline-flex; justify-content: center; align-items: center;"> <img src="{{asset('media/flaticon/whatsapp.png')}}" style="width: 15px; margin-right: 4px;" alt="icono de whatsapp"> Compartir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </footer>
    </div>



    <!-- Scripts -->
    <script src="{{asset('vendors/bootstrap/js/jquery.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/e44ca10330.js" crossorigin="anonymous"></script>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        $('.loading').fadeIn();

        $(document).ready(function() {
            $('.loading').fadeOut();
            $('.contenedor').fadeIn();

            $('.bi-arrow-down-circle').click(function() {
                $('html, body').animate({
                    scrollTop: $("#preguntas").offset().top
                }, 2000);
            });

            $('.btn-float-menu').click(function() {
                $('html, body').animate({
                    scrollTop: $("#nav").offset().top
                }, 2000);
            });

            $('.card-efecto').click(function() {

                $(this).toggleClass('card-click');

            });

        });
    </script>

</body>

</html>