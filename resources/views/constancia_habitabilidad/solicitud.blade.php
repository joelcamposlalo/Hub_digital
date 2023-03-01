@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Constancia de habitabilidad @isset($id_captura)@endisset</h1>
<small class="font text-muted mb-5">Folio de trámite: {{$folio}}</small>

<div class="row mt-5 etapas_info">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border @if($id_etapa == 79) process @else active @endif d-flex justify-content-center align-items-center">
                    @if($id_etapa != 79)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa != 79) text-white @else text-muted @endif">1</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
            </div>
            <div class="@if($id_etapa != 79) line @else line_off @endif"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 83) active text-white @elseif($id_etapa == 80 || $id_etapa == 81 || $id_etapa == 82) process @endif  border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 83 )
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 83) text-white @else text-muted @endif ">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Adjuntar requisitos</small>
            </div>
            <div class="@if($id_etapa == 83) line @else line_off @endif"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 83) active @else process @endif border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 84)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 83) text-white @else text-muted @endif">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Carta responsiva</small>
            </div>
            <div class="@if($id_etapa == 83) line @else line_off @endif"></div>
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 83) active @endif border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 83)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 83) text-white @else text-muted @endif">4</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Terminado</small>
            </div>
        </div>

    </div>
</div>

<!-- Muestra la observacion cuando se regresa al ciudadano en movil-->
@if($id_etapa == 84)
<div class="card mt-3 d-block d-sm-none">
    <div class="card-header">
        <small>Observaciones del revisor</small> <br>
        <span class="badge badge-pill badge-warning">{{$notificacion->created_at}}</span>
    </div>
    <div class="card-body">
        <small>{!! $notificacion->descripcion !!}</small>
    </div>
</div>
@endif

@if($id_etapa == 90)
<div class="row descarga">
    <div class="col-md-9 mt-4" id="top-5">
        <div class="card  shadow-sm card_5 rounded border-none">
            <div class="card-header">
                <small>Solicitud en cotejo</small>
            </div>
            <div class="card-body">

                <!-- Alert -->

                <div class="alert alert-success " role="alert">
                    <strong class="f-14">Su solicitud se encuentra en cotejo, debe descargar la carta responsiva para
                        presentarse a cotejo cuando se le notifique</strong>
                </div>

                <div class="row">

                    <div class="col-md-6 mt-2">
                        <a href="#!" class="aqui">Descargar carta responsiva</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row position-relative">
    
    <div class="col-md-3 mt-4 position-absolute" style="right: 0;">
        <!-- Aqui va un mapa -->
        <div class="border rounded mapa1" id="map"></div>

        <!-- Si tiene adeudo pone link para pago-->
        <div class="alert alert-warning alert-dismissible fade show mt-3 linkPago" role="alert">
            <strong class="f-11">Importante:</strong> <small class="f-11">Su cuenta <div class="txtCuenta bold" style="overflow-wrap: break-word;"></div> presenta adeudo predial. Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
        </div>

        <!-- Muestra la observacion cuando se regresa al ciudadano -->
        @if($id_etapa == 84)
        <div class="card mt-3 d-none d-md-block d-lg-block d-xl-block">
            <div class="card-header">
                <small>Observaciones del revisor</small> <br>
                <span class="badge badge-pill badge-warning">{{$notificacion->created_at}}</span>
            </div>
            <div class="card-body">
                <small>{!! $notificacion->descripcion !!}</small>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-9 mt-4" id="top-2">
        <div class="card  shadow-sm card_2 rounded border-none">
            <div class="card-header">
                <small>Datos del predio</small>
            </div>
            <div class="card-body">
                <form id="form_2" method="post">

                    <!-- Alert -->

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">Escribe la Licencia y luego da click en
                            Buscar licencia. Sí alguno de los datos esta incorrecto por favor
                            acude a la Dirección de Catastro</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Alert -->

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="clave"><small>Clave de licencia <i id="clave-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="clave" id="clave" class="ab-form background-color rounded border clave" type="text" data-parsley-minlength="10" maxlength="16" value="{{((isset($clave))?$clave:'')}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="tipo_persona"><small>Tipo de persona</small></label>
                            
                            <select name="tipo_persona" id="tipo_persona" class="ab-form background-color rounded border tipo_persona" required>
                                <option value="">Seleccione el tipo de persona</option>
                                @if (isset($tipo_persona)&&$tipo_persona=="F")
                                <option value="1" selected="selected">Física</option>
                                @else
                                <option value="1">Física</option>
                                @endif
                                @if (isset($tipo_persona)&&$tipo_persona=="M")
                                <option value="2" selected="selected">Moral</option>
                                @else
                                <option value="2">Moral</option>
                                @endif                                  
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <button type="button" class="ab-btn b-primary-color btn-buscar">Buscar licencia</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="cuenta"><small>Cuenta predial <i id="cuenta-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="cuenta" id="cuenta" 
                            readonly
                            class="ab-form background-color rounded border cuenta" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" value="{{((isset($cuenta))?$cuenta:'')}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curt"><small>CURT <i id="curt-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="curt" 
                            readonly
                            id="curt" value="{{((isset($curt))?$curt:'')}}" class="ab-form background-color rounded border curt" type="text" data-parsley-type="number" data-parsley-minlength="31" maxlength="31">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="calle"><small>Calle</small></label>
                            <input name="calle" id="calle" 
                            readonly 
                            value="{{((isset($calle))?$calle:'')}}" class="ab-form background-color rounded border capitalize calle" type="text" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 mt-2">
                            <label for="numero"><small>Número exterior</small></label>
                            <input name="numero" 
                            readonly
                            id="numero" value="{{((isset($numero))?$numero:'')}}" class="ab-form background-color rounded border numero" type="text" data-parsley-type="number" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letraE"><small>Letra exterior</small></label>
                            <input name="letraE" id="letraE" value="{{((isset($letraE))?$letraE:'')}}" class="ab-form background-color rounded border letraE" type="text" maxlength="5" style="text-transform: uppercase;">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="interior"><small>Número interior</small></label>
                            <input name="interior" 
                            readonly
                            id="interior" value="{{((isset($interior))?$interior:'')}}" class="ab-form background-color rounded border capitalize interior" type="text">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letraI"><small>Letra interior</small></label>
                            <input name="letraI" 
                            readonly
                            id="letraI" value="{{((isset($LetraI))?$LetraI:'')}}" class="ab-form background-color rounded border capitalize LetraI" type="text" maxlength="5" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="fraccionamiento"><small>Fraccionamiento/Colonia</small></label>
                            <input name="fraccionamiento" 
                            readonly
                            id="fraccionamiento" value="{{((isset($fraccionamiento))?$fraccionamiento:'')}}" class="ab-form background-color rounded border capitalize fraccionamiento" type="text" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="manzana"><small>Manzana</small></label>
                            <input name="manzana" 
                            readonly
                            id="manzana" value="{{((isset($manzana))?$manzana:'')}}" class="ab-form background-color rounded border capitalize manzana" type="text" data-parsley-maxlength="10">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="lote"><small>Lote</small></label>
                            <input name="lote" id="lote" value="{{((isset($lote))?$lote:'')}}" class="ab-form background-color rounded border capitalize lote" data-parsley-maxlength="10" type="text" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="condominio"><small>Condominio</small></label>
                            <input name="condominio" id="condominio" value="{{((isset($condominio))?$condominio:'')}}" class="ab-form background-color rounded border capitalize condominio" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="privativa"><small>Unidad privativa</small></label>
                            <input name="privativa" id="privativa" 
                            readonly
                            value="{{((isset($privativa))?$privativa:'')}}" 
                            class="ab-form background-color rounded border capitalize privativa" 
                            type="text">
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle_1"><small>Entre la calle</small></label>
                            <input name="calle_1" id="calle_1" value="{{((isset($calle_1))?$calle_1:'')}}" class="ab-form background-color rounded border capitalize calle_1" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle_2"><small>Y la calle</small></label>
                            <input name="calle_2" id="calle_2" value="{{((isset($calle_2))?$calle_2:'')}}" class="ab-form background-color rounded border capitalize calle_2" type="text">
                        </div>
                    </div>-->
                    <!--<div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="giro"><small>Giro de construcción</small></label>
                            <select name="giro" id="giro" class="ab-form background-color rounded border giro" required>
                                <option value="">Seleccione un giro</option>
                                @if (isset($giro)&&$giro==1)
                                <option value="1" selected="selected">Comercial</option>
                                @else
                                <option value="1">Comercial</option>
                                @endif
                                @if (isset($giro)&&$giro=="2")
                                <option value="2" selected="selected">Habitacional</option>
                                @else
                                <option value="2">Habitacional</option>
                                @endif

                                @if (isset($giro)&&$giro==3)
                                <option value="3" selected="selected">Industrial</option>
                                @else
                                <option value="3">Industrial</option>
                                @endif

                                @if (isset($giro)&&$giro==4)
                                <option value="4" selected="selected">Equipamiento</option>
                                @else
                                <option value="4">Equipamiento</option>
                                @endif

                                @if (isset($giro)&&$giro==5)
                                <option value="5" selected="selected">Mixto</option>
                                @else
                                <option value="5">Mixto</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    -->
                    <!--<div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="suelo"><small>No. dictamen de uso de suelo</small></label>
                            <input name="suelo" id="suelo" value="{{((isset($suelo))?$suelo:'')}}" class="ab-form background-color rounded border capitalize suelo" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="alineamiento"><small>No. alineamiento</small></label>
                            <input name="alineamiento" id="alineamiento" value="{{((isset($alineamiento))?$alineamiento:'')}}" id="alineamiento" class="ab-form background-color rounded border capitalize alineamiento" type="text">
                        </div>
                    </div>
                                    -->
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                            <input name="origen" type="hidden" value='solicitud'>
                            <button class="ab-btn b-primary-color continuar" type="submit">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 mt-4" id="top-3">
        <div class="card  shadow-sm card_3 rounded border-none">
            <div class="card-header">
                <small>Datos del propietario</small>
            </div>
            <div class="card-body">
                <form id=form_3 method="post">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small>Nombre o Razón Social</small></label>
                            <input name="nombre" id="nombre" value="{{((isset($nombre))?$nombre:'')}}"
                             class="ab-form background-color rounded border capitalize nombre" type="text" required>
                        </div>
                        <!--<div class="col-md-3 mt-2">
                            <label for="apellido_1"><small>Primer apellido</small></label>
                            <input name="apellido_1" id="apellido_1" value="{{((isset($apellido_p))?$apellido_p:'')}}" class="ab-form background-color rounded border capitalize apellido_1" type="text">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="apellido_2"><small>Segundo apellido</small></label>
                            <input name="apellido_2" id="apellido_2" value="{{((isset($apellido_m))?$apellido_m:'')}}" class="ab-form background-color rounded border capitalize apellido_2" type="text">
                        </div>-->
                    </div>
                    <div class="row" style="display:none">
                        <div class="col-md-12 mt-2">
                            <label for="domicilio"><small>Domicilo</small></label>
                            <input name="domicilio" id="domicilio" 
                            
                            class="ab-form background-color rounded border capitalize domicilio" type="hidden" 
                            value="{{((isset($domicilio))?$domicilio:session('domicilio'))}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mt-2">
                            <label for="correo_propietario"><small>Correo</small></label>
                            <input name="correo_propietario" id="correo_propietario"
                             class="ab-form background-color rounded border correo_propietario" 
                             type="text" value="{{((isset($correo_propietario))?$correo_propietario:session('correo'))}}" required>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="telefono"><small>Telefono</small></label>
                            <input name="telefono" id="telefono" class="ab-form background-color rounded border telefono" type="text" value="{{((isset($telefono))?$telefono:session('telefono'))}}" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="drz"><small>Clave director responsable</small></label>
                            <input name="drz" id="drz" class="ab-form background-color rounded border capitalize drz"
                             type="text" value="{{((isset($drz))?$drz:'')}}" required>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <input name="correo" id="correo" type="hidden" value="{{session('correo')}}">
                        <input name="id_captura" value="{{((isset($id_captura)) ? $id_captura : '')}}" id="id_captura" type="hidden">
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_2 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color btn-predial btn-guardar" type="submit">Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-9 mt-4" id="top-4">
        <div class="card  shadow-sm card_4 rounded border-none">
            <div class="card-header">
                <small>Archivos requeridos</small>
            </div>
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    <div class="ocultar carta" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">Descarga tu "Carta responsiva"
                            <a href="#!" class="aqui">aquí</a></small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h5 class="font">
                        Debe de adjuntar la todos los archivos obligatorios
                    </h5>
                </div>
                <div class="alert alert-warning alert-dismissible fade show mt-4 notas" role="alert">
                    <h6 class="font">
                        Nota: Debes de adjuntar todos los archivos obligatorios, descarga la solicitud
                        <a href="javascript:;" id="ref_sol" onclick="descarga_solicitud(this);" target="_blank">aquí</a>


                    </h6>
                </div>
                <form id="form_4" action="{{url('constancia_habitabilidad/ingresa_tramite')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                        <table class="w-100">

                            @foreach($files['terminados'] as $file)
                            <tr class="w-100 predio">
                                <td class="f-14">
                                    @if($file->extension == 'pdf')
                                    <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->archivo}}" target="_blank">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @elseif ($file->extension == 'jpg' or $file->extension == 'jpeg')
                                    <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->archivo}}" data-lightbox="roadtrip">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @else
                                    <a href="{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/{{$file->archivo}}" data-lightbox="roadtrip">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/png.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @endif
                                </td>

                                <td class="f-12 font archivo">{{$file->descripcion_larga}} <br>
                                    @if(!in_array($file->id_documento, $files['validados']))
                                    @if($file->obligatorio == 1)
                                    <small class="f-10 font text-danger error">Este archivo es obligatorio</small>
                                    @else
                                    <small class="f-10 font text-success success">Este archivo es opcional</small>
                                    @endif
                                    @endif
                                </td>
                                <td class="f-12 font filesize">Extensión: {{$file->extension}}</td>
                                <td class="f-12 p-0"></td>
                                <td class="f-14 acciones">

                                    <?php

                                    if (!in_array($file->id_documento, $files['validados'])) {
                                    ?>
                                        <label for="{{$file->nombre}}" class="ab-btn-effect bold font btn-file">
                                            <small class="font bold f-10 progreso">Actualizar</small>
                                            <input class="file" id="{{$file->nombre}}" type="file" name="file_{{$file->id_documento}}" data-archivo="{{$file->nombre}}" value="{{$file->nombre}}" data-cat-archivo="{{$file->id_cat_archivo}}" data-update="{{$file->id_archivo}}" data-upload="0" data-required="{{$file->obligatorio}}">
                                        </label>
                                    <?php
                                    } else {
                                    ?>
                                        <label for="{{$file->nombre}}" class="ab-btn-effect bold font btn-file" style="background-color:#75cfb8 !important">
                                            <small class="font bold f-10 text-white success">VALIDADO</small>
                                        </label>
                                    <?php

                                    }
                                    ?>

                                </td>
                            </tr>
                            @endforeach
                            @foreach($files['pendientes'] as $key => $file)
                            <tr class="w-100 predio">
                                <td class="f-14">
                                    <a class="enlace_box" href="#!">
                                        <img class="icono" style="transform: translateX(10px);" src="{{asset('media/flaticon/archivos/upload.svg')}}" width="38px" alt="{{$file->nombre}}">
                                    </a>
                                </td>
                                <td class="f-12 font archivo">{{$file->descripcion_larga}} <br>
                                    @if($file->obligatorio == 1)
                                    <small class="f-10 font text-danger error">Este archivo es obligatorio</small>
                                    @else
                                    <small class="f-10 font text-success success">Este archivo es opcional</small>
                                    @endif
                                </td>
                                <td class="f-12 font filesize">Tamaño: 0 bytes</td>
                                <td class="f-12 p-0"></td>
                                <td class="f-14 acciones">
                                    <label for="file_{{$key}}" class="ab-btn-effect bold font btn-file">
                                        <small class="font bold f-10 progreso">Subir Archivo</small>
                                        <input class="file" id="file_{{$key}}" type="file" name="file_{{$file->id_documento}}" data-upload="0" data-required="{{$file->obligatorio}}">
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <input name="id_captura" id="id_captura_frm4" type="hidden" value="{{((isset($id_captura)) ? $id_captura : '')}}" required>
                    <input name="id_solicitud" id="id_solicitud_frm4" type="hidden" value="{{$folio}}">
                    <input name="id_etapa" id="id_etapa" type="hidden" value="@if(isset($id_etapa)){{$id_etapa}}@endif">
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_3 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color btn-form4" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-map" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Ubicación del predio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Si tiene adeudo pone link para pago-->
                <div class="alert alert-warning alert-dismissible fade show mb-3 linkPagoResponsive" role="alert">
                    <strong class="f-11">Importante:</strong> <small class="f-11">Su cuenta <div class="txtCuenta bold" style="overflow-wrap: break-word;"></div> presenta adeudo predial. Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
                </div>
                <div class="border rounded mapa2" id="map"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<div class="btnFloat" data-toggle="modal" data-target="#modal-map"><i class="fas fa-map-marker-alt text-white"></i>
</div>

<p id="parrafo"></p>
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/trabajos_menores/solicitud.css')}}">
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script src="{{asset('js/frontend.js')}}"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script>
    $('.card_2 .card-body').slideDown('fast');
    $('.card_3 .card-body').slideUp('fast');
    $('.card_4 .card-body').slideUp('fast');

    var map;
    var n = 0;

    //Valida si esta en la versión mobile 
    //Valida si esta en la versión mobile 
    if (is_mobile()) {
        $('.mapa1').remove();
    } else {
        $('.mapa2').remove();
    }

    $(document).ready(function() {

        @if(isset($id_etapa) && ($id_etapa == 82)) //regresado para revision
        $('.continuar').fadeOut();
        $('.btn-guardar').fadeOut();
        $('.btn-form3').fadeOut();
        $('.btn-buscar').fadeOut();
        $('.ab-btn').fadeOut();
        $('.descarga').fadeIn();
        $('.carta').fadeIn();

        $('.card_predios').fadeOut();
        $('.progreso').fadeOut();

        $('.card_1 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideDown('slow');
        $('form').prop('disabled', true);
        @endif

        @if(isset($id_etapa) && ($id_etapa == 83)) //completado
        $('.continuar').fadeOut();
        $('.btn-guardar').fadeOut();
        $('.btn-form3').fadeOut();
        $('.btn-buscar').fadeOut();
        $('.ab-btn').fadeOut();
        $('.descarga').fadeOut();
        $('.etapas_info').fadeOut();
        $('.aqui').fadeOut();
        $('.card_predios').fadeOut();
        $('.progreso').fadeOut();

        $('.card_1 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideDown('slow');
        $('form').prop('disabled', true);
        @endif


        @if(isset($id_etapa) && ($id_etapa == 82)) //ingresado para revision
        $('.descarga').fadeOut();
        $('.card_1 .card-body').slideUp('slow');
        $('.card_2 .card-body').slideUp('slow');
        $('.card_3 .card-body').slideUp('slow');
        $('.card_4 .card-body').slideDown('slow');
        $('form').prop('disabled', true);
        $('.continuar').fadeIn();
        @endif


        @if(isset($id_etapa) && ($id_etapa == 80)) //datos de la solicitud
        $('.card_1 .card-body').slideUp('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.continuar').fadeIn();
        @elseif(isset($id_etapa) && ($id_etapa == 81)) //datos de la solicitud
        $('.card_1 .card-body').slideUp('slow');
        $('.card_4 .card-body').slideDown('slow');
        $('.continuar').fadeIn();
        @endif
        /**
            lightbox
         */

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })


        /**
         * 
         * Tooltip
         * 
         */

        tippy('#cuenta-tooltip', {
            content: '<small class="font f-10"> Recuerda que son 10 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
        });

        tippy('#curt-tooltip', {
            content: '<small class="font f-10"> Recuerda que son 31 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
        });

        tippy('.btn-detalle', {
            content: '<small class="font f-10"> Abrir detalle</small>',
            animation: 'scale',
            allowHTML: true,
        });


        /** 
         * Menu de optiones
         * 
         */

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        /**
         * 
         * Paginado de prediales
         * 
         */

        $('.anterior').click(function() {
            n = n - 5;
            var ultimo = parseInt($('#ultimo').val());

            if (n == 0) {
                $('.antLi').addClass('disabled');
            }

            if (n < ultimo) {
                $('.sigLi').removeClass('disabled');
            }

            get_predios(n);
        });

        $('.siguiente').click(function() {
            n = n + 5;
            var ultimo = parseInt($('#ultimo').val());

            if (n == ultimo - 5) {
                $('.sigLi').addClass('disabled');
            }

            if (n > 0) {
                $('.antLi').removeClass('disabled');
            }

            get_predios(n);

        });

        /**
         * 
         * Inicializamos la validación de 
         * los formularios
         * 
         */

        $('#form_1').parsley();
        $('#form_2').parsley();
        $('#form_3').parsley();
        $('#form-cuenta').parsley();

        /**
         * 
         * Completando la primera parte
         * 
         */


        $('#form_1').submit(function(e) {

            $('.card_1 .card-body').slideUp('slow');
            $('.card_2 .card-body').slideDown('slow');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-2').position().top
                }, 500);
            }, 500);

            e.preventDefault();

        });


        $('.continuar_lista_predio').click(function(e) {

            $(this).val('Cargando...');

            var cuenta = $(this).attr('data-cuenta');
            var curt = "";

            if (cuenta.length == 31) {
                curt = $(this).attr('data-cuenta');
            }

            limpia_predio();

            $('.continuar').fadeOut('fast');

            $('html, body').animate({
                scrollTop: $('.card_2 .card-header').offset().top
            }, 500);

            e.preventDefault();

            if (cuenta != '') {

                try {
                    consulta_cuenta(cuenta);
                } catch (error) {
                    console.log(error);
                }

            } else if (curt != '') {

                try {
                    consulta_cuenta(curt);
                } catch (error) {
                    console.log(error);
                }

            } else {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes introducir una cuenta predial o CURT para poder continuar',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });


                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");
                $('.continuar_lista_predio').val('Continuar');

            }

        });


        $('.agregar').click(function(e) {

            if ($('#id_captura').val() == "") {
                limpia_predio();
            }

            //$('.continuar').fadeOut('fast');
            $('.card_1 .card-body').slideUp('slow');
            $('.card_2 .card-body').slideDown('slow');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-2').position().top
                }, 500);
            }, 500);

            e.preventDefault();

        });

        /**
         * 
         * Completando la segunda parte
         * 
         */

        $('#form_2').submit(async function(e) {

            e.preventDefault();

            /**
             * Guardar datos en tabla predios
             */

            var form = document.getElementById('form_2');
            var data = new FormData(form);

            console.log(' en form submit 2');
            //Si no escribe la cuenta ni la CURT no se guarda en predios

            if ($('.cuenta').val() || $('.curt').val()) {
                var cuenta = $('.cuenta').val();
                var curt = $('.curt').val();

                
                if (cuenta != '') {

                    try {
                        consulta_adeudo(cuenta);
                    } catch (error) {
                        console.log(error);
                    }

                } else if (curt != '') {

                    try {
                        consulta_adeudo(curt);
                    } catch (error) {
                        console.log(error);
                    }

                }


                var res = await axios.post('{{url("predios/post")}}', data, {
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }).then(function(reponse) {
                    //Si todo sale bien
                }).catch(function(error) {
                    //Si ocurre un problema al guardar el predio
                    console.log(error);
                });
            }


            $('.card_2 .card-body').slideUp('slow');
            $('.card_3 .card-body').slideDown('slow');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-3').position().top
                }, 500);
            }, 500);


        });

        /**
         * 
         * Completando la tercera parte
         * 
         */

        $('#form_3').submit(async function(e) {

            //$('.btn-guardar').prop('disabled', true);

            e.preventDefault();

            var id_solicitud = "{{$folio}}";
            var cuenta = $('.cuenta').val();
            var curt = $('.curt').val();
            var calle = $('.calle').val();
            var numero = $('.numero').val();
            var interior = $('.interior').val();
            var letrae = $('.letraE').val();
            var letrai = $('.letraI').val();
            var tipo_persona = $('.tipo_persona').val();
            if (letrai === undefined) {
                letrai = '';
            }

            var fraccionamiento = $('.fraccionamiento').val();
            var manzana = $('.manzana').val();
            var lote = $('.lote').val();
            var condominio = $('.condominio').val();
            var privativa = $('.privativa').val();
            var calle_1 = $('.calle_1').val();
            var calle_2 = $('.calle_2').val();
            var drz = $('.drz').val();
            //var giro = $('.giro').val();
            //var dictamen = $('.suelo').val();
            //var alineamiento = $('.alineamiento').val();
            var nombre = $('.nombre').val();

            var apellido_p = $('.apellido_1').val();
            var apellido_m = $('.apellido_2').val();
            var domicilio = $('.domicilio').val();
            var telefono = $('.telefono').val();
            var clave = $('.clave').val();
            var correo_propietario = $('.correo_propietario').val();
            var correo = $('#correo').val();
            var id_etapa = $('#id_etapa').val();
            $('.btn-form4').html('Guardar');
            if (id_solicitud > 0) {

                if ((consulta_adeudo(curt)) != 1) {


                    $('.card_2 .card-body').slideDown('slow');
                    $('.card_3 .card-body').slideUp('slow');
                    $('.card_4 .card-body').slideUp('slow');

                    //$('.continuar').fadeOut();


                    $('.btn-buscar').fadeIn();

                    return false;
                }

                //formdata.append('id_solicitud', id_solicitud);                
                var formdata = new FormData();
                formdata.append('cuenta', cuenta);
                formdata.append('curt', curt);
                formdata.append('calle', calle);
                formdata.append('numero', numero);
                formdata.append('interior', interior);
                formdata.append('letraE', letrae);
                formdata.append('letraI', letrai);
                formdata.append('fraccionamiento', fraccionamiento);
                formdata.append('manzana', manzana);
                formdata.append('lote', lote);
                formdata.append('condominio', condominio);
                formdata.append('privativa', privativa);
                formdata.append('calle_1', calle_1);
                formdata.append('calle_2', calle_2);
                formdata.append('tipo_persona', tipo_persona);
                //formdata.append('suelo', dictamen);
                //formdata.append('alineamiento', alineamiento);
                formdata.append('nombre', nombre);
                formdata.append('apellido_p', apellido_p);
                formdata.append('apellido_m', apellido_m);
                formdata.append('domicilio', domicilio);
                formdata.append('telefono', telefono);
                formdata.append('correo_propietario', correo_propietario);
                formdata.append('correo', correo);
                //formdata.append('id_etapa', id_etapa);
                formdata.append('clave', clave);                
                formdata.append('drz', drz);  
                formdata.append('id_solicitud', id_solicitud);
                if (id_etapa == 0) {
                    formdata.append('etapa', 79); //inicio del tramite
                } else {
                    formdata.append('etapa', id_etapa);
                }
                console.log("id captura  " + $('#id_captura').val());

                if ($('#id_captura').val() == "") {

                    var res = await axios.post('{{url("constancia_habitabilidad/ingresa_solitud")}}',
                        formdata, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {

                        if (parseInt(response.data) > 0) {
                            $('#id_captura').val(response.data);
                            $('#id_captura_frm4').val(response.data);

                            $('.card_3 .card-body').slideUp('slow');
                            $('.card_4 .card-body').slideDown('slow');
                            $('.btn-form4').prop('disabled', false);
                            iziToast.show({
                                message: 'Se registró la información correctamente, puedes ingresar tus archivos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });
                        } else {
                            $('.card_4 .card-body').slideUp('slow');
                            $('.card_3 .card-body').slideDown('slow');

                            iziToast.show({
                                message: 'Ocurrió un error al tratar de registrar la información, por favor intenta más tarde',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });

                        }
                    });

                } else {
                    //alert("MODIFICANDO SOLICITUD CON id captura  " + $('#id_captura').val());
                    formdata.append('id_captura', $('#id_captura').val());
                    var res = await axios.post('{{url("constancia_habitabilidad/actualiza_solitud")}}',
                        formdata, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {

                        if (parseInt(response.data) > 0) {

                            $('#id_captura_frm4').val(response.data);
                            $('.btn-form4').prop('disabled', false);
                            $('.card_3 .card-body').slideUp('slow');
                            $('.card_4 .card-body').slideDown('slow');
                            iziToast.show({
                                message: 'Se actualizo la información correctamente, si lo requieres puedes ingresar tus archivos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });

                        } else {
                            $('.card_4 .card-body').slideUp('slow');
                            $('.card_3 .card-body').slideDown('slow');

                        }
                    });

                }


            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Se produjo un error al registra la solicitud',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                $('.card_4 .card-body').slideUp('slow');
                $('.card_3 .card-body').slideDown('slow');
                $('.btn-form4').html('Guardar');
                return false;
            }
        });

        /*
        $('.btn-form4').click(function() {

            if ($('.file').val() == '') {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes cargar todos los archivos requeridos',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

            }

        });
        */

        $('.aqui').click(function() {
            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                "Sábado");
            var f = new Date();
            var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] +
                " de " + f.getFullYear()
            var id_captura = $('#id_captura').val();
            var url = '{{url("constancia_habitabilidad/carta")}}'
            var ruta = url + '/' + fecha + '/' + id_captura;

            window.open(ruta, '_blank');


        });

        $('#form_4').submit(function(e) {

            if (fileIsRequired() == 0) {
                $('.btn-form4').html(spiner());
                $('.btn-form4').prop('disabled', true);
                return true;
            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: `${fileIsRequired() > 1 ? `${fileIsRequired()} Archivos requeridos faltantes` : `${fileIsRequired()} Archivo requerido faltante`}. Debes cargar todos los archivos`,
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                $('.btn-form4').text('Guardar');
                return false;
            }

        });

        $('.btn-regresar').click(function() {

            $('.btn-guardar').prop('disabled', false);

            let atras = $(this).attr('data-back');

            $(atras).slideDown('slow');
            $(this).parents('.card-body').slideUp('slow');
            $('html, body').animate({
                scrollTop: $(atras).siblings('.card-header').offset().top
            }, 500);

        });

        /**
         * 
         * Primer paso 
         * 
         */

        $(document).on('click', '.btn-seleccionar', function() {
            var cuenta = $(this).parent('td').siblings('td').find('input[type=checkbox]').parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).parent('td').siblings('td').find('input[type=checkbox]').prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');

        });

        $(document).on('change', 'input[type=checkbox]', function() {
            var cuenta = $(this).parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');
        });

        /** 
            Elimina la cuenta anterior para buscar la nueva  
        */


        $('.curt').keyup(function() {
            if ($('.curt').val().trim() > 0 && $('.cuenta').val().trim() == 0) {
                $('.continuar').hide();
            } else if ($('.curt').val().trim() == 0 && $('.cuenta').val().trim() == 0) {
                $('.continuar').show();
            } else {
                $('.continuar').hide();
            }
        });


        $('.cuenta').keyup(function() {
            if ($('.cuenta').val().trim() > 0 && $('.curt').val().trim() == 0) {
                $('.continuar').hide();
            } else if ($('.cuenta').val().trim() == 0 && $('.curt').val().trim() == 0) {
                $('.continuar').show();
            } else {
                $('.continuar').hide();
            }
        });



        /**
           Buscar predio
        */


        $('.btn-buscar').click(function() {

            $(this).prop('disabled', true);
            $(this).html(spiner());

            //$('.continuar').fadeOut('fast');
            //$(input).prop('disabled', true);

            var clave = $('.clave').val().trim();
            console.log("clave " + clave);
            if (clave != '') {

                try {
                    consulta_licencia(clave);
                    $('.continuar').fadeIn('fast');
                    $(this).prop('disabled', false);
                } catch (error) {
                    console.log(error);
                }

            } else {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes introducir una clave de licencia para poder continuar',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

                $('.continuar').fadeOut('fast');
                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");

            }

        });

    });

    /**
     * 
     * Paginado de prediales
     * 
     */

    const get_predios = (n) => {

        axios.post('{{url("predios/get_all")}}', {
            _token: "{{ csrf_token() }}",
            n: n
        }).then(function(response) {

            let total = Object.keys(response.data).length;

            if (total > 0) {

                $('.predio').remove();


                response.data.forEach(element => {
                    $('.table-body').append(plantilla(element.curt, element.cuenta_predial));
                });

            } else {

                $('.predio').empty();

            }

        }).catch(function(error) {
            console.log(error);
        });
    };

    const plantilla = (curt, cuenta) => {

        return `
            <tr class="w-100 predio">
                <td class="f-14" data-cuenta=" ` + curt + `">
                    <label for="` + curt + `" class="container-check p-0 m-0">
                        <input id="` + curt + `" type="checkbox" value="` + curt + `">
                        <span class="checkmark"></span>
                        <small class="f-12 font data-cuenta ml-5">CURT: ` + curt + `</small>
                    </label>
                </td>
                ` + (cuenta != '' ? '<td class="f-12 font">Cuenta: ' + cuenta + '</td>' : '') + `
                <td class="f-12 acciones">
                    <button type="button" class="ab-btn-effect bold font f-10 btn-seleccionar">Seleccionar</button>
                </td>
            </tr>
            `;
    };

    function consulta_cuenta(cuenta) {

        //$('.continuar').fadeOut('fast');
        limpia_form();
        $.ajax({
            url: "{{url('catastro/get_by_cuenta')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cuenta": cuenta
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                try {

                    if (typeof(response.msg) != 'undefined') {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: response.msg,
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });


                        //Borra los campos y pone continuar visible
                        $('.cuenta').val('');
                        $('.curt').val('');
                        $('.continuar').fadeIn('fast');

                    } else {

                        if (response[0].estatus_predio == 'A') {

                            iziToast.show({
                                message: 'Se encontró la cuenta, vamos a validarla',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });


                            $('.calle').val(response[0].catcalle_nombre);
                            $('.colonia').val(response[0].catcol_nombre);
                            $('.numero').val(response[0].prenoext);

                            if (response[0].prenoext == null || response[0].prenoext == "0") {
                                $('.numero').prop('readonly', false);
                                $('.calle').val(response[0].ubicacion);
                            } else {
                                $('.numero').prop('readonly', true);
                            }

                            $('.interior').val(((response[0].numext_interior != null) ? response[0]
                                .numext_interior : "") + ((response[0].numint != null) ? ' ' +
                                response[0].numint : ''));
                            $('.LetraE').val(response[0].letraext);
                            $('.manzana').val(response[0].manzana);
                            $('.cuenta').val(response[0].precuentapredialant);
                            $('.curt').val(response[0].precuentapredial);

                            if (response[0].lote != null && response[0].lote != '')
                                $('.lote').val(response[0].lote);
                            else
                                $('.lote').val('0');

                            $('.condominio').val(response[0].edificio);
                            $('.fraccionamiento').val(response[0].catcol_nombre);
                            $('.privativa').val(response[0].unidad);
                            $('.nombre').val(((response[0].persona_nombre != null && response[0]
                                .persona_nombre != "") ? response[0].persona_nombre : response[
                                0].persona_razsoc));
                            $('.apellido_1').val(response[0].persona_apepaterno);
                            $('.apellido_2').val(response[0].persona_apematerno);
                            $('.poligono').val(response[0].coordenadas);

                            agregar_poligono(response[0].coordenadas);
                            consulta_adeudo(cuenta);


                        } else {

                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'La cuenta no puede ser utilizada, consulta con la Dirección de Catastro',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });

                            //Borra los campos y pone continuar visible
                            $('.cuenta').val('');
                            $('.curt').val('');
                            $('.continuar').fadeIn('fast');


                        }
                    }

                } catch (error) {
                    console.log(error);
                    $('.cuenta').val('');
                    $('.curt').val('');
                }

                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");
                $('.continuar_lista_predio').val('Continuar');

            },
            error: function(error) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");
                $('.continuar_lista_predio').val('Continuar');
                $('.cuenta').val('');
                $('.curt').val('');

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

    function consulta_licencia(licencia) {

        //$('.continuar').fadeOut('fast');
        limpia_form();
        $.ajax({
            url: "{{url('constancia_habitabilidad/get_by_licencia')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "clave": licencia
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                try {

                    if (typeof(response.msg) != 'undefined') {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: response.msg,
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });


                        //Borra los campos y pone continuar visible
                        $('.cuenta').val('');
                        $('.curt').val('');
                        $('.continuar').fadeOut('fast');

                    } else {
                        console.log(response[0]);
                        if (parseInt(response[0].EdoActLic) >= 4 && response[0].bloqueo == "0") {

                            iziToast.show({
                                message: 'Se encontró la licencia, vamos a validarla',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });


                            $('.calle').val(response[0].Calle);
                            $('.colonia').val(response[0].catcol_nombre);
                            $('.numero').val(response[0].Numero);
                            cuenta = response[0].CuentaPredial;
                            /*if (response[0].prenoext == null || response[0].prenoext == "0") {
                                $('.numero').prop('readonly', false);
                                $('.calle').val(response[0].ubicacion);
                            } else {
                                $('.numero').prop('readonly', true);
                            }*/

                            $('.interior').val(((response[0].numext_interior != null) ? response[0]
                                .numext_interior : "") + ((response[0].numint != null) ? ' ' +
                                response[0].numint : ''));
                            //$('.LetraE').val(response[0].letraext);
                            $('.condominio').val(response[0].Condominio);
                            $('.manzana').val(response[0].Manzana);


                            if (response[0].Lote != null && response[0].Lote != '')
                                $('.lote').val(response[0].Lote);
                            else
                                $('.lote').val('0');


                            $('.fraccionamiento').val(response[0].Fraccionamiento);
                            $('.privativa').val(response[0].UnidadPrivativa);
                            $('.nombre').val(response[0].NombrePropietario);
                            $('.telefono').val(response[0].TelefonoPropietario);
                            $('.drz').val(response[0].IdPerito);
                            
                           /* $('.nombre').val(((response[0].persona_nombre != null && response[0]
                                .persona_nombre != "") ? response[0].persona_nombre : response[
                                0].persona_razsoc));
                            $('.apellido_1').val(response[0].persona_apepaterno);
                            $('.apellido_2').val(response[0].persona_apematerno);*/

                            $('.poligono').val(response[0].coordenadas);

                            agregar_poligono(response[0].coordenadas);
                            $('.cuenta').val(response[0].CuentaPredial);
                            $('.curt').val(response[0].CuentaSiapa);

                            $('.continuar').fadeIn('fast');
                            $('.continuar').prop('disabled', false);

                        } else {

                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'La licencia no puede ser utilizada',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });

                            //Borra los campos y pone continuar visible
                            $('.cuenta').val('');
                            $('.curt').val('');
                            $('.continuar').fadeIn('fast');


                        }
                    }

                } catch (error) {
                    console.log(error);
                    $('.cuenta').val('');
                    $('.curt').val('');
                }

                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");
                $('.continuar_lista_predio').val('Continuar');

            },
            error: function(error) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");
                $('.continuar_lista_predio').val('Continuar');
                $('.cuenta').val('');
                $('.curt').val('');

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


    function consulta_adeudo(cuenta) {

        var res = $.ajax({
            url: "{{url('catastro/get_adeudo_cuenta')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "cuenta": cuenta
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");

                try {

                    if (typeof(response.msg) != 'undefined') {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: response.msg,
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });

                        //Borra los campos y pone continuar visible
                        $('.cuenta').val('');
                        $('.curt').val('');
                        $('.continuar').fadeIn('fast');

                    } else {

                        if (response == "1") {

                            iziToast.show({
                                title: '¡Excelente!, continuemos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });

                            $('.continuar').fadeIn('slow');
                            $('.linkPago').fadeOut();
                            $('.linkPagoResponsive').fadeOut();


                        } else {
                            /*$('.continuar').fadeOut('fast');
                            $('.btn-guardar').prop('disabled', false);*/
                            $('.continuar').fadeIn('slow');
                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'La cuenta presenta adeudo predial',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });

                            //Valida si esta en la versión mobile 
                            if (is_mobile()) {
                                $('.linkPagoResponsive').fadeIn();
                            } else {
                                $('.linkPago').fadeIn();
                            }

                            $('.txtCuenta').text(cuenta);
                        }
                    }

                } catch (error) {
                    console.log(error);
                    //Borra los campos y pone continuar visible
                    $('.cuenta').val('');
                    $('.curt').val('');
                    $('.continuar').fadeIn('fast');

                }

            },
            async: false,
            error: function(error) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar licencia");

                //Borra los campos y pone continuar visible
                $('.cuenta').val('');
                $('.curt').val('');
                $('.continuar').fadeIn('fast');

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
        }).responseText;


        return "1";



    }


    function agregar_poligono(geopolygon) {
        if (geopolygon != null) {

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 18
            });

            var arr = GeoPolygonToJson(geopolygon);

            const poligono = new google.maps.Polygon({
                path: arr,
                strokeColor: "#a8dda8",
                strokeOpacity: 1,
                strokeWeight: 2,
                fillColor: "#a8dda8",
                fillOpacity: 0.3,
            });

            map.setCenter(arr[1]);
            poligono.setMap(map);

        } else {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 18
            });

            var arr = [];

            const poligono = new google.maps.Polygon({
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


    /**
     * Subir archivos
     */


    $('.file').change(function() {

        var file = event.target.files[0];
        var name = $(this).attr('data-archivo');
        var id_solicitud = "{{$folio}}";
        var me = $(this);
        var total = 0;

        if (id_solicitud <= 0) {
            alert('Intenta crear la solicitud nuevamente');
            return;
        }

        if (get_extension(file.name) == 'jpg' || get_extension(file.name) == 'jpeg' || get_extension(file
                .name) == 'png' || get_extension(file.name) == 'pdf' || get_extension(file.name) == 'PDF' ||
            get_extension(file.name) == 'PNG' || get_extension(file.name) == 'JPG' || get_extension(file
                .name) == 'JPEG') {

            me.attr('data-upload', '1');
            me.siblings('.progreso').text("Actualizar");
            me.parents('.acciones').siblings('td').find('.icono').attr('src',
                `{{asset('media/flaticon/archivos/${get_extension(file.name)}.svg')}}`);
            me.parents('.acciones').siblings('td').find('.icono').parents('.enlace_box').attr('href', '#!')
            me.parents('.acciones').siblings('td').find('.icono').attr('width', `50px`);
            me.parents('.acciones').siblings('.filesize').text(`Tamaño: ${file.size} bytes`);
            me.parents('.acciones').siblings('.archivo').find('br').remove();
            me.parents('.acciones').siblings('.archivo').find('.error').remove();
            me.parents('.acciones').siblings('td').find('.icono').css('transform', `translateX(0)`);

            iziToast.show({
                message: 'Se subió el archivo correctamente',
                backgroundColor: '#2fd099',
                closeOnEscape: true
            });

        } else {
            iziToast.show({
                title: 'Ups ☹️',
                message: 'El formato no es válido, recuerda que solo es posible subir en formato jpg, png, jpeg, pdf',
                backgroundColor: '#ff9b93',
                closeOnEscape: true
            });
        }

    });


    function limpia_predio() {
        $('.calle').val('');
        $('.numero').val('');
        $('.interior').val('');
        $('.fraccionamiento').val('');
        $('.manzana').val('');
        $('.cuenta').val('');
        $('.curt').val('');
        $('.lote').val('');
        $('.condominio').val('');
        $('.privativa').val('');
        $('.calle_1').val('');
        $('.calle_2').val('');
        $('.giro').val('');
        $('.dictamen').val('');
        $('.alineamiento').val('');
        $('.alineamiento').val('');
        $('.id_captura').val('');
        $('.nombre').val('');
        $('.apellido_1').val('');
        $('.apellido_2').val('');
        //$('.domicilio').val("{{session('domicilio')}}");
        $('.telefono').val("{{session('telefono')}}");
        $('.correo').val('');
        $('.LetraI').val('');
        $('.LetraE').val('');
        $('.suelo').val('');
        //agregar_poligono(null);        
    }


    function limpia_form() {
        $('.calle').val('');
        $('.numero').val('');
        $('.interior').val('');
        $('.fraccionamiento').val('');
        $('.manzana').val('');
        $('.lote').val('');
        $('.condominio').val('');
        $('.privativa').val('');
        $('.calle_1').val('');
        $('.calle_2').val('');
        $('.giro').val('');
        $('.dictamen').val('');
        $('.alineamiento').val('');
        $('.id_captura').val('');
        $('.nombre').val('');
        $('.apellido_1').val('');
        $('.apellido_2').val('');
        //$('.domicilio').val("{{session('domicilio')}}");
        $('.telefono').val("{{session('telefono')}}");
        $('.correo').val('');
        $('.LetraI').val('');
        $('.LetraE').val('');
        $('.suelo').val('');
        //agregar_poligono(null);        
    }


    /**
     * 
     * Total de archivos requeridos 
     * faltantes
     * 
     */

    function fileIsRequired() {

        var countFileRequired = 0;

        $('.file').each(function(i, item) {

            if ($(this).attr('data-upload') == 0 && $(this).attr('data-required') == 1) {
                countFileRequired += 1;
            }

        });

        return countFileRequired;

    }


    function initMap() {


        var markers = [];

        map = new google.maps.Map(document.getElementById("map"), { //Carga el mapa
            center: {
                lat: 20.6785454,
                lng: -103.4275859
            },
            zoom: 14,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: true,
            rotateControl: false,
            fullscreenControl: false
        });

    }

    function is_mobile() {

        if (typeof(window.orientation) != 'undefined') {
            return true;
        } else {
            return false;
        }

    }

    function descarga_solicitud(element) {

            $('#ref_sol').attr('href', 'https://indicadores.zapopan.gob.mx:8080/tramitesop/solicitudPDFV2.php?t=' + $('#id_captura').val());
    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection