<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- Css -->
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/cuenta/loyout.css')}}">
    <link rel="stylesheet" href="{{asset('css/cuenta/registro.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('media/favicon/site.webmanifest')}}">


</head>

<body class="background-color">


    <div class="loading">
        <img src="{{asset('media/gif/loading.gif')}}" alt="loading">
    </div>



    <nav class="border">
        <div class="container">
            <a href="{{url('/')}}">
                <div class="logo d-flex align-items-center" aria-label="Ir a página principal VDigital">
                    <!--
                    <div class="circle background-color d-flex justify-content-center align-items-center">
                        <img src="{{asset('media/ilustrator/logo.png')}}" width="30px" alt="logo">
                    </div>
                    <img src="{{asset('media/ilustrator/zapopan.png')}}" width="120px" class="ml-3" alt="Ir a página principal VDigital">
                    -->
                    <img src="{{asset('media/ilustrator/logo.png')}}" width="270rem" alt="logo" aria-hidden="true">
                    <!--<img class="ml-3 logo-title" src="{{asset('media/ilustrator/ZapopanCiudadNinos_original.png')}}" width="180rem" alt="logo del gobierno de zapopan" aria-hidden="true">-->
                </div>
            </a>
        </div>
    </nav>


    <div class="contenedor border shadow-sm">
        <form id="form" action="{{url('cuenta/registrarf')}}" method="post" class="left">
            <h2 class="font font-500" style="color: #090910;">Crear cuenta</h4>
                <span class="badge badge-pill badge-warning">Ciudadano</span>

                @csrf

                <!-- Alert -->
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    @foreach ($errors->all() as $error)
                    <small class="block block">{{ $error }}</small> <br>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- End alert -->
                @endif

                <!-- Alert -->
                @if(Session::has('alert'))
                <div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3" role="alert">
                    <small>{{session('alert.msg')}}</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <!-- End alert -->


                <input name="correo" type="email" class="background-color rounded border" placeholder="Correo" autocomplete="off" required>
                <input id="contrasena" name="contrasena" type="password" class="background-color rounded border" placeholder="Contraseña" data-parsley-minlength="8" required>
                <input name="ccontrasena" type="password" class="background-color rounded border" placeholder="Confirmar contraseña" data-parsley-minlength="8" data-parsley-equalto="#contrasena" required>
                <small class="f-10 mt-2">Al hacer click en Registrarme, aceptas la <a href="https://www.zapopan.gob.mx/v3/avisodeprivacidad" target="_blank"> Política de privacidad</a> del Gobierno Municipal de Zapopan, Jalisco.</small>
                 <!-- ReCaptcha -->
            {!! RecaptchaV3::initJs() !!}
            {!! RecaptchaV3::field('register') !!}

            @error('g-recaptcha-response')
            <div class="alert alert-danger  alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Ups</strong>
                Al parecer no eres una persona
                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
            </div>
            @enderror
				<button type="submit" class="b-primary-color text-white font rounded">Registrarme</button>
                <a href="{{url('cuenta/registrom')}}" class="f-13 mt-2">Soy una Empresa o Institución</a>
                <a href="{{url('cuenta')}}" class="f-13">Iniciar sesión</a>

        </form>
        <div class="right b-primary-color">
            <img src="{{asset('media/ilustrator/registro.svg')}}" width="200px" alt="registro de ciudadano">
            <h4 class="font text-white text-center mt-4">Regístrate ahora</h4>
            <small class="text-center text-white font">Ingresa tus datos y da click en Registrarme. ¡Fácil y rápido!</small>
        </div>
    </div>









    <!-- Scripts -->
    <script src="{{asset('vendors/bootstrap/js/jquery.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('vendors/parsley/es.js')}}"></script>
    <script src="{{asset('js/frontend.js')}}"></script>


    <script>
        $('.loading').fadeIn();

        $(document).ready(function() {

            $('#form').parsley();
            $('.loading').fadeOut();
            $('nav').fadeIn('slow');
            $('.contenedor').fadeIn('slow');

            $('#form').submit(function() {
                $('button[type=submit]').prop('disabled', true);
                $('button[type=submit]').html(spiner());
            });
        });
    </script>

</body>

</html>