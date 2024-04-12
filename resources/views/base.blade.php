<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta datos para la busqueda facebook -->
    <meta property="og:url" content="https://vdigital.zapopan.gob.mx/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="VDigital" />
    <meta property="og:description" content="Todos tus trámites en un solo lugar. Crea una cuenta para gestionar tus trámites y darles seguimiento." />
    <meta property="og:image" content="{{asset('media/screen.png')}}" />
    <meta property="og:keywords" content="trámites, tramites, en línea, en linea, línea, linea, vdigital, ventanilla digital, ventanilla, digital, zapopan, más clicks, mas clicks, menos filas, trámites en línea, tramites en linea, trámites y servicios, servicios, zap, ayuntamiento, ayuntamiento de zapopan, zapopan jalisco, jalisco, catálogo, catalogo, retys, catálogo de retys, catalogo de retys, cartografía municipal, cartografia municipal, cartografía, cartografia, municipal, citas en línea, citas en linea, citas, ciudapp, facturación electrónica, facturacion electronica, facturación, facturacion, electrónica, electronica, acreditación de movilidad, acreditacion de movilidad, acreditación, acreditacion, movilidad, ganchito, padrón de proveedores, padron de proveedores, padrón, padron, proveedores, proveedores, pagos en línea, pagos en linea, pagos, pláticas prematrimoniales, platicas prematrimoniales, registro municipal, registro, iniciar sesión, iniciar sesion, iniciar, sesión, sesion, crear cuenta, crear, cuenta, padrón y licencias, licencias, catastro, obras públicas, obras publicas, obras, públicas, movilidad y trasnporte, trasnporte, dirección, direccion">
    <title> @section('title') @show</title>

    @section('css')
    <!-- Css -->
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/toast/css/iziToast.min.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('media/favicon/site.webmanifest')}}">

    <!-- Meta datos para la busqueda -->

    @show

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LBL5HKTKV6"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LBL5HKTKV6');
    </script>

</head>

<body class="background-color position-relative">

    <div class="loading">
        <img src="{{asset('media/gif/loading.gif')}}" alt="loading">
    </div>

    <div class="contenedor">
        <div class="aside left bg-white m-0 border-right b-primary-color">
            <div class="profile-img mt-5">
                @if(Storage::disk('s3')->exists('public/'.session('id_usuario').'/perfil.jpg'))
                <img src="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/perfil.jpg" alt="foto de perfil">
                @else
                <img src="{{asset('media/flaticon/avatar.svg')}}" alt="foto de perfil predeterminada">
                @endif
                <label for="profile">
                    <i class="fas fa-camera"></i>
                    <input type="file" name="" accept=".jpg, .jpeg, .png" id="profile">
                </label>
            </div>
            @section('aside')

            @show
        </div>
        <div class="right m-0 p-0">
            <div id="nav" class="bg-white border-bottom">
                <div class="container d-flex flex-row justify-content-between align-items-center">
                    <svg width="20px" viewBox="0 0 16 16" class="bi bi-list pointer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    <div class="actions">
                        @if(session('primera_vista') == 1 && session('tipo') == "ciudadano")
                        @if(Request::path() == 'ciudadano/expediente' || Request::path() == 'ciudadano/nuevo_tramite' || Request::path() == 'ciudadano/predios' || Request::path() == 'ciudadano/tramites')
                        <div id="tutorial" class="cuadro position-relative" aria-label="Tutorial">
                            <i class="fas fa-shoe-prints c-negro"></i>
                        </div>
                        @endif
                        @endif

                        @if(session('tipo') == "ciudadano")
                        <a href="{{url('ciudadano/notificaciones')}}" class="text-decoration-none" aria-label="Notificaciones @section('notification') @show">
                            <div id="notificacion" class="cuadro nofificaciones position-relative">
                                <i class="fas fa-bell c-negro"></i>
                                <div class="count f-10 font text-white d-flex justify-content-center align-items-center">@section('notification') @show</div>
                            </div>
                        </a>
                        <a href="{{ url ('cuenta/logout') }}" aria-label="Cerrar sesión">
                            <div id="salir" class="cuadro position-relative">
                                <i class="fas fa-sign-out-alt c-negro"></i>
                            </div>
                        </a>
                        @elseif(session('tipo') == "revisor")
                        <div class="dropdown">
                            <div class="cuadro  dropdown-toggle" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-angle-up c-negro"></i>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-configuracion">Configuración</a>
                                <a class="dropdown-item" href="{{ url ('cuenta/logout') }}">Cerrar sesión</a>
                            </div>
                        </div>
                        @endif
                        <div class="cuadro menu position-relative">
                            <i class="fas fa-th-large c-negro"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contenido">
                <div class="container mb-5">
                    @section('container')

                    @show
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-configuracion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="form-contraseña" action="{{url('cuenta/cambiar_contrasena')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font bold">Configuración</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <label for=""><small>Contraseña actual</small></label>
                                <input type="password" class="ab-form background-color rounded border" name="cactual" type="text" data-parsley-minlength="8" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for=""><small>Nueva contraseña</small></label>
                                <input id="ncontrasena" type="password" class="ab-form background-color rounded border" name="ncontrasena" type="text" data-parsley-minlength="8" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for=""><small>Confirmar contraseña</small></label>
                                <input type="password" class="ab-form background-color rounded border" name="ccontraseña" type="text" data-parsley-equalto="#ncontrasena" data-parsley-minlength="8" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="ab-btn b-primary-color btn-cambiar-contraseña">Cambiar contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Menu mobile -->
    @section('menu_mobile')

    @show

</body>

<!-- Scripts -->
@section('js')
<script src="{{asset('vendors/bootstrap/js/jquery.js')}}"></script>
<script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('vendors/toast/js/iziToast.min.js')}}"></script>
<script src="https://kit.fontawesome.com/e44ca10330.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@show


<script>
    $('.loading').fadeIn();

    $(document).ready(function() {

        $('#form-contraseña').parsley();


        $('#form-contraseña').submit(function() {

            $('.btn-cambiar-contraseña').prop('disabled', true);
            $('.btn-cambiar-contraseña').html(spiner());

        })

        $('.dropdown-toggle').dropdown()

        $('.contenedor').css('display', 'flex');
        $('.loading').fadeOut();

        $('.bi-list').click(function() {

            $('.aside').toggleClass('close');

        });


        $('#profile').change(async function(event) {

            var file = event.target.files[0];
            var formdata = new FormData();

            if (get_extension(file.name) == 'jpg' || get_extension(file.name) == 'jpeg' || get_extension(file.name) == 'png' || get_extension(file.name) == 'JPG' || get_extension(file.name) == 'JPEG' || get_extension(file.name) == 'PNG') {

                formdata.append('file', file);

                var res = await axios.post('{{url("ciudadano/perfil")}}', formdata, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    },
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    onUploadProgress: function(e) {
                        console.log(Math.round(e.loaded * 100) / e.total);
                    }
                });

                window.location.href = '{{url()->current()}}';

            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'El formato no es válido, recuerde que solo es posible subir en formato jpg, png, jpeg',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }
        });


        setInterval(() => {

            if (!navigator.onLine) {
                iziToast.show({
                    title: 'Conexion a internet',
                    message: 'Lo siento pero no tiene conexion a internet',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true,
                    timeout: 5000,
                    drag: true,
                    progressBar: true,
                    position: 'center',
                    buttons: [
                        ['<button class="ab-btn"><b>De acuerdo </b></button>', function(instance, toast) {

                            instance.hide({
                                transitionOut: 'fadeOut'
                            }, toast, 'button');

                        }, true]
                    ]
                });
            }
        }, 6000);
    });
</script>

</html>
