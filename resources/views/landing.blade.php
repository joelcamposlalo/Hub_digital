<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <title>VDigital</title>

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
    <meta property="og:keywords" content="trámites, tramites, en línea, en linea, línea, linea, vdigital, ventanilla digital, ventanilla, digital, zapopan, más clicks, mas clicks, menos filas, trámites en línea, tramites en linea, trámites y servicios, servicios, zap, ayuntamiento, ayuntamiento de zapopan, zapopan jalisco, jalisco, catálogo, catalogo, retys, catálogo de retys, catalogo de retys, cartografía municipal, cartografia municipal, cartografía, cartografia, municipal, citas en línea, citas en linea, citas, ciudapp, facturación electrónica, facturacion electronica, facturación, facturacion, electrónica, electronica, acreditación de movilidad, acreditacion de movilidad, acreditación, acreditacion, movilidad, ganchito, padrón de proveedores, padron de proveedores, padrón, padron, proveedores, proveedores, pagos en línea, pagos en linea, pagos, pláticas prematrimoniales, platicas prematrimoniales, registro municipal, registro, iniciar sesión, iniciar sesion, iniciar, sesión, sesion, crear cuenta, crear, cuenta, padrón y licencias, licencias, catastro, obras públicas, obras publicas, obras, públicas, movilidad y trasnporte, trasnporte, dirección, direccion, permisos, licencias, contrucción, permisos y licencias de construcción">


</head>

<body class="background-color">


    <div class="loading">
        <img src="{{asset('media/gif/loading.gif')}}" alt="cargando página">
    </div>


    <div class="contenedor">
        <nav class="border" id="nav">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="https://www.zapopan.gob.mx/v3/" aria-label="Portal de Zapopan">
                    <div class="logo d-flex align-items-center">                        
                        <!--<div class="circle background-color d-flex justify-content-center align-items-center">
                            <img src="{{asset('media/ilustrator/logo.png')}}" width="50rem" alt="logo">
                        </div> -->                       
                        <img src="{{asset('media/ilustrator/logo.png')}}" width="270rem" alt="logo" aria-hidden="true">
                        <!--<img class="ml-3 logo-title" src="{{asset('media/ilustrator/ZapopanCiudadNinos.png')}}" width="180rem" alt="logo del gobierno de zapopan" aria-hidden="true"> -->
                    </div>
                </a>
                <div class="buttons">
                    <a class="crear_cuenta f-15 text-decoration-none rounded font" href="{{url('cuenta/registrof')}}">Crear cuenta</a>
                    <a class="iniciar_sesion f-15 text-decoration-none rounded font" href="{{url('cuenta')}}">Iniciar sesión</a>
                </div>
            </div>
        </nav>
        <header>
            <div class="container container-header d-flex justify-content-between align-items-center h-100">
                <div class="text pr-5 position-relative">
                    <h2 class="font c-primary-color bold d-block d-lg-none"><span class="c-second-color">V</span>Digital</h2>
                    <span class="badge badge-warning font f-15">Ventanilla Digital</span>
                    <h1 class="font c-negro bold mb-1">Todos tus trámites en un solo lugar</h1>
                    <small class="text-muted font mt-5 f-14">Crea una cuenta para gestionar tus trámites y darles seguimiento.
                    </small> <br>
                    <div id="bi-arrow-down-circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 animate__animated animate__bounce animate__delay-2s pointer bi-arrow-down-circle">
                        <i class="fas fa-arrow-down text-white" style="font-size: 1.563rem;"></i>
                    </div>
                </div>
                <div class="image">
                    <img width="400px" src="{{asset('media/ilustrator/header.svg')}}" alt="ventanilla digital, más clicks menos filas">
                </div>
            </div>
        </header>
        <section id="tramites">
            <div class="container">
                <h2 class="text-center font bold c-negro mt-2">Trámites y Servicios</h2>
                <div class="mb-4 text-center">
                    <span class="badge badge-warning font f-15 d-none">Disponibles</span>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://retys.zapopan.gob.mx/" style="text-decoration: none;" target="_blank" aria-label="Catálogo de RETYS">
                            <div style="height: 280px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/retys.svg')}}" width="100px" alt="retys" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Catálogo de RETYS</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Catálogo de trámites y servicios.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4  c-card">
                        <a href="#Seccion_Direccion_de_Catastro" style="text-decoration: none;" aria-label="Catastro">
                            <div id="card_catastro" style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="catastro" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Catastro</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Cobro de derechos de avalúos.</li>
                                            <li class="font f-14">Constancia de no adeudo.</li>
                                            <li class="font f-14">Portal de notarios.</li>
                                            <li class="font f-14">Seguimiento de folio.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4  c-card">
                        <a href="http://geomatica.zapopan.gob.mx/mxsig/" style="text-decoration: none;" target="_blank" aria-label="Cartografía Municipal">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/cartografia.svg')}}" width="100px" alt="cartografia municipal" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Cartografía Municipal</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2">
                                            <li class="font f-14">Sistema de Información Geográfica Zapopan.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="#Seccion_Citas_en_linea" style="text-decoration: none;" aria-label="Citas en línea">
                            <div id="card_citas" style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/citas.svg')}}" width="100px" alt="citas en línea" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Citas en línea</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Padrón y Licencias.</li>
                                            <li class="font f-14">Catastro.</li>
                                            <li class="font f-14">Permisos y Licencias de Construcción</li>
                                            <li class="font f-14">Registro Civil.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://mapa.mejoratuciudad.org/mx.zapopan" style="text-decoration: none;" target="_blank" aria-label="Ciudapp">
                            <div id="" style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/ciudapp.svg')}}" width="100px" alt="ciudapp" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Ciudapp</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Realiza reportes de servicios Municipales.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>-->
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://facturas.zapopan.gob.mx/facturacion/" style="text-decoration: none" target="_blank" aria-label="Facturación electrónica">
                            <div id="card_facturacion" style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/facturacion.svg')}}" width="100px" alt="facturación electrónica" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Facturación electrónica</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Factura en línea.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="{{url('cuenta')}}" style="text-decoration: none;" target="_blank" aria-label="Movilidad y Transporte">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/acreditaciones_movilidad.svg')}}" width="100px" alt="movilidad y transporte" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Movilidad y Transporte</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Acreditación de movilidad.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-negro c-card">
                        <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                            <div class="card-body">
                                <a href="{{url('cuenta')}}" style="text-decoration: none !important;" target="_blank" aria-label="Ordenamiento del Territorio">
                                    <div style="height: 7.5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/ordenamiento.svg')}}" width="100px" alt="Ordenamiento del Territorio" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Ordenamiento del Territorio</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="c-negro" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Dictamen de Finca Antigua</li>
                                            <li class="font f-14">Dictamen de Imagen Urbana</li>
                                            <li class="font f-14">Dictamen de Trazo, Usos y Destinos Específicos</li>
                                            <li class="font f-14">Revisión de Proyecto en Línea</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-negro c-card">
                        <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                            <div class="card-body">
                                <a href="{{url('cuenta')}}" style="text-decoration: none !important;" target="_blank" aria-label="Permisos y Licencias de Construcción">
                                    <div style="height: 7.5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/trabajos_menores.svg')}}" width="100px" alt="Permisos y Licencias de Construcción" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Permisos y Licencias de Construcción</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="c-negro" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Certificado de Alineamiento y Número Oficial.</li>
                                            <li class="font f-14">Licencia de Construcción.</li>
                                            <li class="font f-14">Revisión de Proyecto digital.</li>
                                            <li class="font f-14">Trabajos menores.</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-negro c-card">
                        <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                            <div class="card-body">
                                <a href="{{url('cuenta')}}" style="text-decoration: none !important;" target="_blank" aria-label="Permisos y Licencias de Construcción">
                                    <div style="height: 7.5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/trabajos_menores.svg')}}" width="100px" alt="Permisos y Licencias de Construcción" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Medio Ambiente</h3>
                                    </div>
                                    <div style="height: 12.375rem" class="c-negro" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Dictamen de Registro de Emisiones a la Atmósfera (REA)</li>
                                            <li class="font f-14">Dictamen de generador de cantidades mínimas de residuos sólidos</li>
                                            <li class="font f-14">Dictamen para manejo de arbolado.</li>
                                            <li class="font f-14">Dictamen en materia de impacto ambiental para la instalación de biogestores</li>
                                            <li class="font f-14">Dictamen para manejo de arbolado.</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PortalProveedores/" style="text-decoration: none;" target="_blank" aria-label="Padrón de Proveedores">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/proveedores.svg')}}" width="100px" alt="padrón de proveedores" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Padrón de Proveedores</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Portal de compras y proveedores.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="#Seccion_Direccion_Padron_y_Licencias" style="text-decoration: none;" aria-label="Padrón y Licencias">
                            <div id="card_pyl" style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Padrón y Licencias</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Catálogos de giros.</li>
                                            <li class="font f-14">Trámite de licencia "A", "B".</li>
                                            <li class="font f-14">Impresión de licencia en línea.</li>
                                            <li class="font f-14">Trámite de prelicencia.</li>
                                            <li class="font f-14">Más...</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card" id="card_pagos">
                        <a href="#Seccion_pagos_en_linea" style="text-decoration: none;" aria-label="Pagos en línea">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/pago_linea.svg')}}" width="100px" alt="pagos en linea" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Pagos en línea</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Predial.</li>
                                            <li class="font f-14">Infracciones de movilidad.</li>
                                            <li class="font f-14">Refrendo de Licencia Municipal.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="http://platicas.difzapopan.gob.mx/" style="text-decoration: none;" target="_blank" aria-label="Pláticas prematrimoniales">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/prematrimoniales.svg')}}" width="100px" alt="pláticas prematrimoniales" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Pláticas prematrimoniales</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Registro para "Curso prematrimonial civil".</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://www.zapopan.gob.mx/verificadores/" style="text-decoration: none;" target="_blank" aria-label="Registro Municipal">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/inspectores.svg')}}" width="100px" alt="registro municipal de inspectore, verificadores, visitadores domiciliarios" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Registro Municipal</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Inspectores.</li>
                                            <li class="font f-14">Verificadores.</li>
                                            <li class="font f-14">Visitadores domiciliarios.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>                    
                </div>
        </section>
        <section id="registro">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="image">
                    <img width="100px" src="{{asset('media/ilustrator/add2.svg')}}" alt="regístrate para comenzar tus trámites" aria-hidden="true">
                </div>
                <p>
                <h3 class="font mt-3 text-center bold f-16 ml-5 registrate" aria-hidden="true">Regístrate </h3><a href="{{url('cuenta/registrof')}}" aria-label="Regístrate aquí para comenzar tus trámites" class="ml-1 mr-1"> aquí </a>
                <h3 class="font mt-3 text-center bold f-16" aria-hidden="true"> para comenzar tus trámites.</h3>
                </p>
            </div>
        </section>
        <section id="pasos" class="mt-3">
            <div class="container">
                <h2 class="text-center font bold c-negro mt-2">Realiza tu primer trámite</h2>
                <div class="mb-5 text-center">
                    <span class="badge badge-warning font f-15">¡Fácil y rápido!</span>
                </div>
                <div class="row mt-2 d-flex justify-content-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-l-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <span class="numero">1</span>
                                <img src="{{asset('media/drawkit/flat/png/Data.png')}}" class="mb-2" width="30px" alt="crea una cuenta" aria-hidden="true">
                                <h3 class="font bold f-16">
                                    Crea una cuenta
                                </h3>
                                <small class="font f-14 text-muted" aria-hidden="true">Recuerda que tus datos están seguros. Puedes consultar el Aviso de Privacidad Simplificado del Gobierno Municipal de Zapopan, Jalisco</small> <a href="https://www.zapopan.gob.mx/v3/avisodeprivacidad" target="_blank" aria-label="Recuerda que tus datos están seguros. Puedes consultar el Aviso de Privacidad Simplificado del Gobierno Municipal de Zapopan, Jalisco aquí">aquí.</a>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center">
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-registro.png')}}" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-l-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <span class="numero">2</span>
                                <img src="{{asset('media/drawkit/flat/png/Verification.png')}}" class="mb-2" width="30px" alt="completa tu información" aria-hidden="true">
                                <h3 class="font bold f-16">Completa tu información</h3>
                                <small class="font f-14 text-muted">Esta información es importante para que puedas utilizar tu expediente ciudadano en todos tus trámites.</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center">
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-expediente.png')}}" style="z-index: 100;" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-l-6 col-xl-6">
                        <div class="row guia-1 ocultar">
                            <div class="col-md-6 p-5">
                                <span class="numero">3</span>
                                <img src="{{asset('media/drawkit/flat/png/Unsubscribed.png')}}" class="mb-2" width="30px" alt="selecciona el trámite" aria-hidden="true">
                                <h3 class="font bold f-16">Selecciona el trámite</h3>
                                <small class="font f-14 text-muted">En pantalla podrás ver todos los trámites disponibles. Bastará con un click para empezar.</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center">
                                <div class="linea d-none d-xl-block d-xxl-block"></div>
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-tramite.png')}}" style="z-index: 1;" width="300px" alt="">
                            </div>
                        </div>
                        <div class="row guia-2">
                            <div class="col-md-6 p-5">
                                <span class="numero">4</span>
                                <img src="{{asset('media/drawkit/flat/png/Uploading.png')}}" class="mb-2" width="30px" alt="completa la información y sube la documentación" aria-hidden="true">
                                <h3 class="font bold f-16">Completa la información y sube la documentación</h3>
                                <small class="font f-14 text-muted">Se te solicitarán datos y documentos de acuerdo con el trámite que hayas seleccionado.</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center position-relative">
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-paso.png')}}" style="z-index: 1;" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-l-6 col-xl-6">
                        <div class="row guia-3 ocultar">
                            <div class="col-md-6 p-5">
                                <span class="numero">4</span>
                                <img src="{{asset('media/drawkit/flat/png/Uploading.png')}}" class="mb-2" width="30px" alt="completa la información y sube la documentación" aria-hidden="true">
                                <h3 class="font bold f-16">Completa la información y sube la documentación</h3>
                                <small class="font f-14 text-muted">Se te solicitarán datos y documentos de acuerdo con el trámite que hayas seleccionado.</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center position-relative">
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-paso.png')}}" style="z-index: 1;" width="300px" alt="">
                            </div>
                        </div>
                        <div class="row guia-4">
                            <div class="col-md-6 p-5">
                                <span class="numero">3</span>
                                <img src="{{asset('media/drawkit/flat/png/Unsubscribed.png')}}" class="mb-2" width="30px" alt="selecciona el trámite" aria-hidden="true">
                                <h3 class="font bold f-16">Selecciona el trámite</h3>
                                <small class="font f-14 text-muted">En pantalla podrás ver todos los trámites disponibles. Bastará con un click para empezar.</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center">
                                <div class="linea d-none d-xl-block d-xxl-block"></div>
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-tramite.png')}}" style="z-index: 1;" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-start">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-l-6 col-xl-6">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <span class="numero">5</span>
                                <img src="{{asset('media/drawkit/flat/png/Done.png')}}" class="mb-2" width="30px" alt="etapa concluida" aria-hidden="true">
                                <h3 class="font bold f-16">Etapa concluida</h3>
                                <small class="font f-14 text-muted">La campanita de notificaciones te mantendrá al tanto de cualquier actualización. ¡No olvides revisarla!</small>
                            </div>
                            <div class="col-md-6 p-3 d-flex justify-content-center align-items-center position-relative">
                                <div class="linea d-none d-xl-block d-xxl-block"></div>
                                <img class="border shadow" src="{{asset('media/ilustrator/landing-finish.png')}}" style="z-index: 1;" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="obras_publicas">
            <div class="image container d-flex justify-content-center align-items-center">
                <img src="{{asset('media/ilustrator/logo_plc.png')}}" class="logo-direccion" alt="Permisos y Licencias de Construcción" aria-hidden="true">
            </div>
            <div class="container text-center mt-3">
                <h2 class=" font bold c-negro">Portal de Permisos y Licencias de Construcción</h2>
                <small class="font f-16 text-muted">Realiza tus trámites relacionados con la Dirección de Permisos y Licencias de Construcción en su portal.</small>
            </div>
            <div class="container d-flex justify-content-center align-items-center">
            <a href="https://indicadores.zapopan.gob.mx:8080/tramitesop/inicio.php" style="text-decoration: none;" target="_blank" aria-label="Ir al portal de Permisos y Licencias de Construcción ahora">
                    <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                        <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                    </div>
                </a>
            </div>
            <div class="container text-center">
                <small class="font f-14 text-muted" aria-hidden="true">Ir ahora</small>
            </div>
        </section>
        <section id="citas_linea">
            <div class="container">
                <h2 class="text-center font bold c-negro mt-2">Citas en línea</h2>
                <div class="mb-4 text-center">
                    <span class="badge badge-warning font f-15 d-none">Disponibles</span>
                </div>
                <div class="row justify-content-center align-items-center">

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/cita_catastro" style="text-decoration: none;" target="_blank" aria-label="Dirección de Catastro">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="dirección de catastro" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Dirección de Catastro</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Citas en línea.</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://indicadores.zapopan.gob.mx:8080/CitasZapopan/citas_obp.php?id_servicio=360" style="text-decoration: none;" target="_blank" aria-label="Dirección de Permisos y Licencias de Construcción">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/trabajos_menores.svg')}}" width="100px" alt="Dirección de Permisos y Licencias de Construcción" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Dirección de Permisos y Licencias de Construcción</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Citas en línea.</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/consulta_servicio_pyl" style="text-decoration: none;" target="_blank" aria-label="Dirección de Padrón y Licencias">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="100px" alt="dirección padron y licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Dirección de Padrón y Licencias</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Citas en línea.</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://indicadores.zapopan.gob.mx:8080/AgendaCitaZapopan/cita/cita_registro" style="text-decoration: none;" target="_blank" aria-label="Dirección de Registro Civil">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/prematrimoniales.svg')}}" width="100px" alt="dirección de registro civil" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Dirección de Registro Civil</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Citas en línea.</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
        </section>
        <section id="facturacion">
            <div class="image container d-flex justify-content-center align-items-center">
                <img width="150px" src="{{asset('media/ilustrator/facturacion.svg')}}" alt="facturación en línea" aria-hidden="true">
            </div>
            <div class="container text-center mt-3">
                <h2 class=" font bold c-negro">Facturación en línea</h2>
                <small class="font f-16 text-muted">Generar tu factura electrónica correspondiente al recibo obtenido del Municipio de Zapopan.</small>
            </div>
            <div class="container d-flex justify-content-center align-items-center">
                <a href="https://facturas.zapopan.gob.mx/facturacion/" target="_blank" aria-label="Ir a facturación electrónica ahora">
                    <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                        <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                    </div>
                </a>
            </div>
            <div class="container text-center">
                <small class="font f-14 text-muted" aria-hidden="true">Ir ahora</small>
            </div>
        </section>
        <section id="pagos_linea">
            <div class="container">
                <h2 class="text-center font bold c-negro mt-2">Pago en línea</h2>
                <div class="mb-4 text-center">
                    <span class="badge badge-warning font f-15">¡Fácil y rápido!</span>
                </div>
                <div class="row justify-content-center align-items-center">

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PortalCiudadano/Recaudacion/Multas/BuscarMultas.aspx" style="text-decoration: none;" target="_blank" aria-label="Infracciones de movilidad">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/acreditaciones_movilidad.svg')}}" width="100px" alt="infracciones de movilidad" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Infracciones de movilidad</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <small>Necesitarás:</small>
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Placas.</li>
                                        </ul>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                    <a href="https://www.zapopan.gob.mx/v3/predial" style="text-decoration: none;" target="_blank" aria-label="Predial">
                       <!-- <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" style="text-decoration: none;" target="_blank" aria-label="Predial"> -->
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/predial.svg')}}" width="100px" alt="predial" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Predial.</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <small>Necesitarás:</small>
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Cuenta predial o CURT.</li>
                                        </ul>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PortalCiudadano/Recaudacion/Licencias/BuscarLicencias.aspx" style="text-decoration: none;" target="_blank" aria-label="Refrendo de Licencia Municipal">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="100px" alt="refrendo de licencia municipal" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Refrendo de Licencia Muncipal</h3>
                                    </div>
                                    <div style="height: 9.375rem" aria-hidden="true">
                                        <small>Necesitarás:</small>
                                        <ul class="ml-2 mt-2">
                                            <li class="font f-14">Número de licencia.</li>
                                        </ul>
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        </section>
        <section id="retys">
            <div class="image container d-flex justify-content-center align-items-center">
                <img width="150px" src="{{asset('media/ilustrator/retys.svg')}}" alt="catálogo de retys" aria-hidden="true">
            </div>
            <div class="container text-center mt-3">
                <h2 class=" font bold c-negro">Catálogo de RETYS</h2>
                <small class="font f-16 text-muted">Consulta toda la información necesaria para realizar tu trámite y/o servicio.</small>
            </div>
            <div class="container d-flex justify-content-center align-items-center">
                <a href="https://retys.zapopan.gob.mx/" style="text-decoration: none;" target="_blank" aria-label="Ir al catálogo de RETYS ahora">
                    <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                        <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                    </div>
                </a>
            </div>
            <div class="container text-center">
                <small class="font f-14 text-muted" aria-hidden="true">Ir ahora</small>
            </div>
        </section>
        <section id="pyl">
            <div class="image container d-flex justify-content-center align-items-center">
                <img width="150px" src="{{asset('media/ilustrator/logo_licencias.png')}}" class="logo-direccion" alt="Dirección de Padrón y Licencias">
            </div>
            <div class="linea_logo">
                <hr>
            </div>
            <div class="container">

                <div class="row justify-content-center align-items-center">

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://portal.zapopan.gob.mx/otras_consultas/cat_giros.asp" style="text-decoration: none;" target="_blank" aria-label="Catálogo de giro">
                            <div style="height: 16.875rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catalogo_giros.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Catálogo de giros</h3>
                                    </div>
                                    <div style="height: 5rem">

                                        <div class="ml-2" aria-hidden="true">
                                            <small>¿Cuál será el giro de tu negocio? <br> Conoce los requisitos para tu trámite.</small>
                                        </div>

                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60px;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="http://linea.zapopan.gob.mx/users/sign_in" style="text-decoration: none;" target="_blank" aria-label="Trámite de licencias A, B y C">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16" aria-hidden="true">Trámite de licencia "A", "B"</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Tramita tu licencia en línea.</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 7.5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PortalCiudadano/Recaudacion/Licencias/ImpresionLicencia.aspx" style="text-decoration: none;" target="_blank" aria-label="Impresión de licencia">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/impresion_licencia.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">Impresión de licencia</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Si ya realizaste el pago de tu licencia comercial, aquí podrás imprimirla.</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://www.zapopan.gob.mx/unidad-de-verificacion-multifuncional/" style="text-decoration: none;" target="_blank" aria-label="Personal del área de verificación">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/verificadores.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">Personal del área de Verificación</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Conoce al personal que labora en el área.</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="{{url('cuenta')}}" style="text-decoration: none;" target="_blank" aria-label="Trámite de prelicencia">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 5rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/giro_comercial.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">Trámite de prelicencia</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Realiza el trámite de tu prelicencia para abrir un negocio de manera inmediata.</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 60px;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://portal.zapopan.gob.mx/pyl/permisos/Login.asp" style="text-decoration: none;" target="_blank" aria-label="Permisos extraordinarios en línea">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/horas_extras.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">Permisos extraordinarios en línea</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Tramita tus permisos extraordinarios para horas extras o música.</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/2020-01/FormatoMultipleC.pdf" style="text-decoration: none;" target="_blank" aria-label="Descarga formato múltiple">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/impresion_licencia.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">Formato múltiple</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Descarga el formato para trámites de Padrón y Licencias</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://www.zapopan.gob.mx/req-pc-bomberos/" style="text-decoration: none;" target="_blank" aria-label="Conoce que tipo de riesgo es tu giro">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catalogo_giros.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 " aria-hidden="true">¿Qué tipo de riesgo es tu giro?</h3>
                                    </div>
                                    <div style="height: 7.5rem" aria-hidden="true">
                                        <div class="ml-2">
                                            <small>Reglamento y medidas a cumplir para protección civil y bomberos</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://portal.zapopan.gob.mx/medioambiente/documentos/guiaprocedimientoverificacionambiental.pdf" style="text-decoration: none;" target="_blank" aria-label="Guía del procedimiento de verificación y requisitos en materia ambiental">
                            <div style="height: 270px;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.25rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catalogo_giros.svg')}}" width="100px" alt="Padron y Licencias" aria-hidden="true">
                                        <h3 class="font mt-2 text-center bold f-16 " aria-hidden="true">Guía del procedimiento de verificación y requisitos en materia ambiental</h3>
                                    </div>
                                    <div style="height: 6.5rem " aria-hidden="true">
                                        <div class="ml-2 mt-2">
                                            <small>Requerimientos en una revisión de Medio Ambiente</small>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 5rem;">
                                            <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle pointer">
                                                <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        </section>
        <section id="prematrimoniales">
            <div class="image container d-flex justify-content-center align-items-center">
                <img width="150px" src="{{asset('media/ilustrator/prematrimoniales.svg')}}" alt="header" aria-hidden="true">
            </div>
            <div class="container text-center mt-3">
                <h2 class=" font bold c-negro">Pláticas prematrimoniales</h2>
                <small class="font f-16 text-muted">Regístrate al "Curso prematrimonial civil".</small>
            </div>
            <div class="container d-flex justify-content-center align-items-center">
                <a href="http://platicas.difzapopan.gob.mx/" target="_blank" aria-label="Ir a registrarme ahora">
                    <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                        <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                    </div>
                </a>
            </div>
            <div class="container text-center">
                <small class="font f-14 text-muted">Ir ahora</small>
            </div>
        </section>
        <section id="catastro">
            <div class="image container d-flex justify-content-center align-items-center">
                <img src="{{asset('media/ilustrator/logo_catastro.png')}}" width="250px" alt="Dirección Catastro">
            </div>
            <div class="linea_logo">
                <hr>
            </div>
            <div class="container">

                <div class="row justify-content-center align-items-center">

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/cobro-de-avaluos" style="text-decoration: none;" target="_blank" aria-label="Cobro de derechos de avalúos">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="catastros" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Cobro de derechos de avalúos</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Realiza el pago de tu derecho de avalúos</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" style="text-decoration: none;" target="_blank" aria-label="Constancia de no adeudo">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="catastro" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Constancia de no adeudo</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Tramita tu constancia de no adeudo</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://catastro.zapopan.gob.mx/portal_notarios/APP/login.php" style="text-decoration: none;" target="_blank" aria-label="Portal de notarios">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="catstros" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Portal de notarios</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Inicia sesión</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-4 c-card">
                        <a href="https://catastro.zapopan.gob.mx/Consulta_Tramite/index.php" style="text-decoration: none;" target="_blank" aria-label="Seguimiento de folio">
                            <div style="height: 17.5rem;" class="card card-hover-effect c-negro">
                                <div class="card-body">
                                    <div style="height: 6.875rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset('media/ilustrator/catastro.svg')}}" width="100px" alt="catastro" aria-hidden="true">
                                        <h3 class="font mt-3 text-center bold f-16 c-negro" aria-hidden="true">Seguimiento de folio</h3>
                                    </div>
                                    <div style="height: 9.375rem" class="d-flex flex-column justify-content-center align-items-center">
                                        <small class="text-center mt-2" aria-hidden="true">Consulta el estatus de tu trámite</small>
                                        <div id="circle" style="width: 2.5rem; height: 2.5rem; background-color: #ffc107; border-radius: 50%;" class="circle mt-3 pointer">
                                            <i class="fas fa-arrow-right text-white" style="font-size: 25px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
        </section>

        <div class="btn-float-menu pointer" style="width: 70px; height: 70px; background-color: #ffc107; position: fixed; bottom: 0; left: 0; margin: 30px; display: flex; justify-content: center; align-items: center; border-radius: 50%; z-index: 10000000;">
            <i class="fas fa-arrow-up text-white" style="font-size: 25px;"></i>
        </div>
        <footer class="pt-2" style="background-color: white;">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col">
                        <div class="row pt-5 pb-2">
                            <div class="col-md-6 col-lg-3 text-center p-4">
                                <img src="{{asset('media/ilustrator/zapopan.png')}}" width="250px" alt="Logo de zapopan">
                            </div>
                            <div class="col-md-6 col-lg-3 text-start p-4">
                                <a href="https://www.zapopan.gob.mx/v3/circulares-interes-general" class="font d-block">Circulares de interés general</a>
                                <a href="https://www.zapopan.gob.mx/v3/recomendaciones-visualizacion" class="font d-block mt-2">Recomendaciones para visualizar el sitio</a>
                                <a href="https://www.zapopan.gob.mx/v3/avisodeprivacidad" class="font d-block mt-2">Aviso de privacidad</a>
                            </div>
                            <div class="col-md-6 col-lg-3 text-start p-4">
                                <a href="https://www.zapopan.gob.mx/v3/gobierno" class="font d-block">Gobierno</a>
                                <a href="#!" class="font d-block mt-2 bi-arrow-down-circle">Trámites en línea</a>
                                <a href="https://www.zapopan.gob.mx/transparencia/" class="font d-block mt-2">Transparencia</a>
                                <a href="https://www.zapopan.gob.mx/v3/normatividad" class="font d-block mt-2">Normatividad</a>
                                <a href="https://www.zapopan.gob.mx/v3/ciudad" class="font d-block mt-2">Ciudad</a>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center p-4">
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <a href="https://www.facebook.com/ZapopanGob/" aria-label="Facebook" target="_blank" ><img width="40px" alt="logo facebook" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Facebook-zap_1.png" /></a>
                                    <a href="https://www.instagram.com/zapopangob/" aria-label="Instagram" target="_blank"> <span class="sr-only">Instagram</span><img width="40px" alt="logo instagram" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Instagram-zap_2.png" /></a>
                                    <a href="https://twitter.com/zapopangob/" aria-label="twitter" target="_blank"> <span class="sr-only">Twitter</span><img width="40px" alt="logo twitter" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_Twitter-zap_1.png" /></a>
                                    <a href="https://www.youtube.com/zapopangob/" aria-label="youtube" target="_blank"> <span class="sr-only">Youtube</span> <img width="40px" alt="logo youtube" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://servicios.zapopan.gob.mx:8000/wwwportal/publicfiles/inline-images/Ico_YouTube-zap_1.png" /></a>
                                    <a href="https://livestream.com/zapopangob" aria-label="livestream" target="_blank"> <span class="sr-only">Transmision</span> <img width="40px" alt="logo_transmision" aria-hidden="true" data-entity-type="" data-entity-uuid="" src="https://www.zapopan.gob.mx/wp-content/uploads/2021/02/Ico_Trans-zap_1-1.png" /></a>
                                    <div class="mt-3">
                                        <div class="fb-share-button mt-3" data-href="https://vdigital.zapopan.gob.mx/" data-layout="button_count"></div>
                                        <a href="https://wa.me/?text=https://vdigital.zapopan.gob.mx/" target="_blank" style="text-decoration: none; transform: translateY(2.5px); border-radius: 3px; padding: 2px 5px; background-color: #55cd6c; font-size: 11px; font-weight: bold; color: white; display: inline-flex; justify-content: center; align-items: center;"> <img src="{{asset('media/flaticon/whatsapp.png')}}" style="width: 15px; margin-right: 4px;" alt="icono de whatsapp"> Compartir</a>
                                        <br><br><small class="badge-warning p-2 mt-2 rounded " style="background-color: #e1e5ea;">ßeta</small>
                                    </div>
                                </div>
                                <!--<div>
                                    <a href="{{url ('cuenta/preguntas_respuestas')}}" class="font d-block mt-3">¿Necesitas ayuda?</a>
                                </div> -->
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col text-center">
                                <small>Nos encantaria conocer cual fue tu experiencia, escribenos a <a href="#!">webmaster@zapopan.gob.mx</a></small>
                            </div>
                            
                        </div>
                    </div>
        </footer>
        <div class="d-flex justify-content-center align-items-center p-3 bg-white">
            <small class="mb-4 text-center">
                Con amor &#x1F498 &#x2661 Unidad de Desarrollo | 2021 - 2024 - Gobierno de Zapopan
            </small>
        </div>
    </div>

</body>

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
        js.src = "https://connect.facebook.net/es_LA/all.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    $('.loading').fadeIn();

    $(document).ready(function() {
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        if (isChrome) {
            var styles = '.c-card:focus-within {outline:0.2rem solid #fc0}';
            //     alert(styles);
            var styleTag = document.createElement('style');
            if (styleTag.styleSheet)
                styleTag.styleSheet.cssText = styles;
            else
                styleTag.appendChild(document.createTextNode(styles));

            document.getElementsByTagName('head')[0].appendChild(styleTag);

        }
        $('.loading').fadeOut();
        $('.contenedor').fadeIn();

        $('.bi-arrow-down-circle').click(function() {
            $('html, body').animate({
                scrollTop: $("#tramites").offset().top
            }, 500);
        });

        $('.card').hover(function() {
            $(this).addClass('shadow');
        }, function() {
            $(this).removeClass('shadow');
        });

        $('#card_pagos').click(function() {
            $('html, body').animate({
                scrollTop: $("#pagos_linea").offset().top
            }, 500);
        });

        $('#card_catastro').click(function() {
            $('html, body').animate({
                scrollTop: $("#catastro").offset().top
            }, 500);
        });

        $('#card_citas').click(function() {
            $('html, body').animate({
                scrollTop: $("#citas_linea").offset().top
            }, 500);
        });

        $('#card_pyl').click(function() {
            $('html, body').animate({
                scrollTop: $("#pyl").offset().top
            }, 500);
        });

        $('.btn-float-menu').click(function() {
            $('html, body').animate({
                scrollTop: $("#nav").offset().top
            }, 500);
        });

    });
</script>

</html>