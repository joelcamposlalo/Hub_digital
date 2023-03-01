<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title') @show</title>

    <!-- Css -->
    @section('css')
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/administrador/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/toast/css/iziToast.min.css')}}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('media/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('media/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('media/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('media/favicon/site.webmanifest')}}">
    @show

</head>

<body class="background-color position-relative">

    <nav class="border">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="left d-flex align-items-center">
                <i class="fas fa-bars mr-3 p-2"></i>
                <div class="circle background-color border">
                    <small class="font">{{Str::limit(session('nombre'), 1, '')}}</small>
                </div>
                @section('menu') @show
            </div>
            <div class="right d-flex align-items-center">
                <div class="dropdown">
                    <button class="ab-btn bg-warning c-negro font bold dropdown-toggle" id="dropmenu" data-toggle="dropdown" aria-expanded="false"> {{session('nombre')}} </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-configuracion">Configuración</a></li>
                        <li><a class="dropdown-item" href="{{ url ('cuenta/logout') }}">Cerrar sesión</a></li>
                    </ul>
                </div>
                <!--
                <a href="{{url('ciudadano/notificaciones')}}" class="text-decoration-none">
                    <div class="cuadro position-relative ml-4 pointer">
                        <i class="fas fa-bell c-negro"></i>
                        <div class="count f-10 text-white d-flex justify-content-center align-items-center">@section('notification') @show</div>
                    </div>
                </a>
                -->
            </div>
        </div>
    </nav>
    <section class="mt-5 mb-5">
        @section('container')
        @show
    </section>


    <!-- Model de configuracion -->
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
                        <button type="submit" class="ab-btn bg-warning btn-cambiar-contraseña c-negro">Cambiar contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Btn float menu -->
    <div class="btn-float-menu pointer" style="width: 70px; height: 70px; background-color: #ffc107; position: fixed; bottom: 0; left: 0; margin: 30px; display: flex; justify-content: center; align-items: center; border-radius: 50%;">
        <i class="fas fa-arrow-up c-negro"></i>
    </div>

    <!-- Menu mobile -->
    <div class="background-color p-4 menu-mobile">
        <button type="button" class="close" aria-label="Close" style="position: absolute; margin: 0 30px 80px 0; bottom: 0; right: 0;">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="font bold">Menú</h3>
        <div class="row">
            <div class="col-6 mt-4">
                <a class="c-negro" style="text-decoration: none" href="{{url('administrador/ciudadanos')}}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <span style="font-size: 30px">
                                <i class="fas fa-user c-negro"></i>
                            </span>
                            <p class="font">Ciudadanos</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 mt-4">
                <a class="c-negro" style="text-decoration: none" href="{{url('administrador/predios')}}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <span style="font-size: 30px">
                                <i class="fas fa-home c-negro"></i>
                            </span>
                            <p class="font">Predios</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 mt-4">
                <a class="c-negro" style="text-decoration: none" href="{{url('administrador/revisores')}}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <span style="font-size: 30px">
                                <i class="fas fa-id-card c-negro"></i>
                            </span>
                            <p class="font">Revisores</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 mt-4">
                <a class="c-negro" style="text-decoration: none" href="{{url('administrador/reportes')}}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <span style="font-size: 30px">
                                <i class="fas fa-chart-pie c-negro"></i>
                            </span>
                            <p class="font">Reportes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Js -->
    @section('js')
    <script src="{{asset('vendors/bootstrap/js/jquery.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('vendors/toast/js/iziToast.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/e44ca10330.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/frontend.js')}}"></script>
    <script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('vendors/parsley/es.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            $('#form-contraseña').parsley();

            $('#form-contraseña').submit(function() {
                $('.btn-cambiar-contraseña').prop('disabled', true);
                $('.btn-cambiar-contraseña').html(spiner());
            });

            $('.btn-float-menu').click(function() {
                $('.menu-mobile').addClass('active');
            });

            $('.close').click(function() {
                $('.menu-mobile').removeClass('active');
            });

        })
    </script>
    @show
</body>

</html>