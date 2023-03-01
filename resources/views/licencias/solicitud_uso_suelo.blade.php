@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Licencia de funcionamiento comercial</h1>
<small class="font text-muted mb-5">Folio de trámite: {{$folio}} </small>

<div class="row mt-5 etapas_info">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center mt-2">
                <div class="etapa border @if($id_etapa == 40) active @else process @endif d-flex justify-content-center align-items-center">
                    @if($id_etapa == 40)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 40) text-white @else text-muted @endif">1</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Solicitud consulta uso de suelo</small>
            </div>
            <div class="line"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa  @if($id_etapa == 41) active text-white @else process @endif  border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 41)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 41) text-white @else text-muted @endif ">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Revisión consulta uso de suelo</small>
            </div>
            <div class="line"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center mb-2">
                <div class="etapa  @if($id_etapa == 42) active text-white @else process @endif  border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 42)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 42) text-white @else text-muted @endif ">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Solicitud y requisitos</small>
            </div>
            <div class="line"></div>
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center mb-2">
                <div class="etapa  @if($id_etapa == 44) active text-white @else process @endif  border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 44)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 44) text-white @else text-muted @endif ">4</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Revisión de requisitos</small>
            </div>
        </div>
    </div>
</div>

<!-- Muestra la observacion cuando se regresa al ciudadano en movil-->
@if($id_etapa == 45)
<div class="card mt-3 d-block d-sm-none">
    <div class="card-header">
        <small>Observaciones del revisor</small> <br>
        <span class="badge badge-pill badge-warning">{{isset($notificacion->created_at)}}</span>
    </div>
    <div class="card-body">
        <small>{!! isset($notificacion->descripcion) !!}</small>
    </div>
</div>
@endif

<div class="row position-relative">
    <div class="col-md-9 mt-4 card_predios">
        <div class="card shadow-sm card_1 rounded border-none">
            <div class="card-header">
                <small>Mis predios</small>
            </div>
            <div class="card-body">
                <form id="form_1" action="" method="post">
                    <!-- Tabla -->
                    <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                        <table class="w-100">
                            @foreach($predios as $predio)
                            <tr class="w-100 predio">
                                <td class="f-14" data-cuenta="{{$predio->curt}}">
                                    <label for="{{$predio->curt}}" class="container-check p-0 m-0">
                                        <input id="{{$predio->curt}}" type="checkbox" value="{{$predio->curt}}">
                                        <span class="checkmark"></span>
                                        <small class="f-12 font data-cuenta ml-5">CURT: {{$predio->curt}}</small>
                                    </label>
                                </td>

                                @if($predio->cuenta_predial != '')<td class="f-12 font">Cuenta: {{$predio->cuenta_predial}}</td>@endif
                                <!--<td class="f-12"><span class="badge badge-pill badge-success">Pagado</span></td>-->
                                <td class="f-12 acciones">
                                    <button type="button" class="ab-btn-effect bold font f-10 btn-seleccionar">Seleccionar</button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>


                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="" class="font f-11 d-inline text-decoration-none agregar mt-4" data-toggle="modal" data-target="#modal-predio">¿Aun no agregas tu predio? Agregalo aquí</a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input class="ab-btn b-primary-color continuar_lista_predio ocultar" type="submit" value="Continuar">
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="col-md-3 mt-4 position-absolute" style="right: 0;">
        <!-- Aqui va un mapa -->
        <div class="card d-none d-md-block d-lg-block d-xl-block">
            <div class="card-header">
                <small>Ubicación del negocio</small>
            </div>
            <div class="card-body">

                <div class="alert alert-warning alert-dismissible fade show notas" role="alert">
                    <strong class="f-11">Nota:</strong><small class="f-11"> El sistema calcula automáticamente las coordenadas con base en la dirección. En caso de no coincidir, arrastra el marcador a la posición correcta en el mapa.</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="border rounded mapa1" id="map"></div>
            </div>
        </div>
        <!-- Si tiene adeudo pone link para pago-->
        <div class="alert alert-warning alert-dismissible fade show mt-3 linkPago" role="alert">
            <strong class="f-11">Importante:</strong> <small class="f-11">Su cuenta <div class="txtCuenta bold" style="overflow-wrap: break-word;"></div> presenta adeudo predial. Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
        </div>

        <!-- Muestra la observacion cuando se regresa al ciudadano -->
        @if($id_etapa == 45)
        <div class="card mt-3 d-none d-md-block d-lg-block d-xl-block">
            <div class="card-header">
                <small>Observaciones del revisor</small> <br>
                <span class="badge badge-pill badge-warning">{{isset($notificacion->created_at)}}</span>
            </div>
            <div class="card-body">
                <small>{!! isset($notificacion->descripcion) !!}</small>
            </div>
        </div>
        @endif
    </div>


</div>

<div class="row">
    <div class="col-md-9 mt-4" id="top-2">
        <div class="card  shadow-sm card_2 rounded border-none">
            <div class="card-header">
                <small>Datos de solicitud</small>
            </div>
            <div class="card-body">
                <form id=form_2 action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="tipo_persona"><small>Tipo de persona que solicita </small></label>
                            <select name="tipo_persona" id="tipo_persona" class="ab-form background-color rounded border tipo_persona" required>
                                <option value="F" @if(session('tipo_persona')=='fisica' || (isset($tipo_persona) && $tipo_persona=='F' ) ) selected @endif>Fisica</option>
                                <option value="M" @if(session('tipo_persona')=='moral' || (isset($tipo_persona) && $tipo_persona=='M' ) ) selected @endif>Moral</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small class="nombre_sol">@if(session('tipo_persona') == 'fisica' || (isset($tipo_persona) && $tipo_persona == 'F')) Nombre @else Razón social @endif</small></label>
                            <input name="nombre" id="nombre" class="ab-form background-color rounded border nombre" type="text" value="{{((isset($nombre))?$nombre:((session('nombre') != '')?session('nombre'):session('razon_social')))}}" required>
                        </div>
                    </div>

                    <div class="row apellidos @if(session('tipo_persona') == 'moral' || (isset($tipo_persona) && $tipo_persona=='M')) ocultar @endif">
                        <div class="col-md-6 mt-2">
                            <label for="apellido_paterno"><small>Apellido paterno</small></label>
                            <input name="apellido_paterno" id="apellido_paterno" value="{{((isset($apellido_paterno))?$apellido_paterno:'')}}" class="ab-form background-color rounded border apellido_paterno" @if(session('nombre') !='' ) required @endif>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="apellido_materno"><small>Apellido materno</small></label>
                            <input name="apellido_materno" id="apellido_materno" value="{{((isset($apellido_materno))?$apellido_materno:'')}}" class="ab-form background-color rounded border apellido_materno">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="cuenta"><small>Cuenta predial</small></label>
                            <input name="cuenta" id="cuenta" class="ab-form background-color rounded border cuenta" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" value="{{((isset($cuenta))?$cuenta:'')}}" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curt"><small>CURT</small></label>
                            <input name="curt" id="curt" value="{{((isset($curt))?$curt:'')}}" class="ab-form background-color rounded border curt" type="text" data-parsley-type="number" data-parsley-minlength="31" maxlength="31" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle_negocio"><small>Calle</small></label>
                            <select name="calle_negocio" id="calle_negocio" class="ab-form background-color rounded border calle_negocio" required>
                                <option value="">Selecciona la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}" @if(isset($calle_negocio) && $calle_negocio==$calle->IdCalle) selected="true" @endif>{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="no_exterior_negocio"><small>No. exterior</small></label>
                            <input name="no_exterior_negocio" id="no_exterior_negocio" class="ab-form background-color rounded border no_exterior_negocio" type="text" data-parsley-type="number" value="{{isset($no_exterior_negocio) ? $no_exterior_negocio : ''}}" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_exterior_negocio"><small>Letra exterior</small></label>
                            <input name="letra_exterior_negocio" id="letra_exterior_negocio" class="ab-form background-color rounded border uppercase letra_exterior_negocio" type="text" value="{{isset($letra_exterior_negocio) ? $letra_exterior_negocio : ''}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="no_interior_negocio"><small>No. interior</small></label>
                            <input name="no_interior_negocio" id="no_interior_negocio" class="ab-form background-color rounded border no_interior_negocio" type="text" value="{{isset($no_interior_negocio) ? $no_interior_negocio : ''}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_interior_negocio"><small>Letra interior</small></label>
                            <input name="letra_interior_negocio" id="letra_interior_negocio" class="ab-form background-color rounded border uppercase letra_interior_negocio" type="text" value="{{isset($letra_interior_negocio) ? $letra_interior_negocio : ''}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="colonia_negocio"><small>Colonia</small></label>
                            <select name="colonia_negocio" id="colonia_negocio" class="ab-form background-color rounded border colonia_negocio" required>
                                <option value="">Selecciona la Colonia</option>
                                @foreach($colonias as $colonia)
                                <option value="{{ $colonia->IdColonia }}" @if(isset($colonia_negocio) && $colonia_negocio==$colonia->IdColonia) selected="true" @endif>{{ $colonia->NombreColonia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="plaza_negocio"><small>Plaza comercial, mercado privado o municipal <i id="plaza-tooltip" class="fas fa-question-circle pointer text-info"></i></small></label>
                            <select name="plaza_negocio" id="plaza_negocio" class="ab-form background-color rounded borde plaza_negocio">
                                <option value="">Selecciona la plaza o mercado</option>
                                @foreach($plazas as $plaza)
                                <option value="{{ $plaza->IdPlaza }}" @if(isset($plaza_negocio) && $plaza_negocio==$plaza->IdPlaza) selected="true" @endif>{{ $plaza->NombrePlaza }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle1_negocio"><small>Entre la calle</small></label>
                            <select name="calle1_negocio" id="calle1_negocio" class="ab-form background-color rounded border calle1_negocio" required>
                                <option value="">Selecciona la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}" @if(isset($calle1_negocio) && $calle1_negocio==$calle->IdCalle) selected="true" @endif>{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle2_negocio"><small>Y la calle</small></label>
                            <select name="calle2_negocio" id="calle2_negocio" class="ab-form background-color rounded border calle2_negocio" required>
                                <option value="">Selecciona la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}" @if(isset($calle2_negocio) && $calle2_negocio==$calle->IdCalle) selected="true" @endif>{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle3_negocio"><small>Calle posterior</small></label>
                            <select name="calle3_negocio" id="calle3_negocio" class="ab-form background-color rounded border calle3_negocio" required>
                                <option value="">Selecciona la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}" @if(isset($calle3_negocio) && $calle3_negocio==$calle->IdCalle) selected="true" @endif>{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="giro"><small>Giro principal</small></label>
                            <select name="giro" id="giro" class="ab-form background-color rounded border giro" data-giro="1" required>
                                <option value="">Selecciona la actividad o tipo de giro</option>
                                @foreach($giros as $giroF)
                                <option value="{{ $giroF->IdGiro }}" @if(isset($giro) && $giro===$giroF->IdGiro) selected="true" @endif>{{ $giroF->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="sup_negocio"><small>Superficie del local mts<span style="vertical-align: super;"><small>2</small></span></small></label>
                            <input name="sup_negocio" id="sup_negocio" class="ab-form background-color rounded border sup_negocio" type="text" value="{{isset($sup_negocio) ? $sup_negocio : ''}}" data-parsley-type="number" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input name="latitud" class="latitud" type="hidden" value="{{((isset($latitud))?$latitud:'')}}">
                            <input name="longitud" class="longitud" type="hidden" value="{{((isset($longitud))?$longitud:'')}}">
                            <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                            <input name="id_solicitud" class="id_solicitud" type="hidden" value="{{((isset($folio))?$folio:'')}}">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <input class="ab-btn b-primary-color btn-form2" type="submit" value="Guardar">
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

                <div class="alert alert-warning alert-dismissible fade show notas" role="alert">
                    <strong class="f-11">Nota:</strong><small class="f-11"> El sistema calcula automáticamente las coordenadas con base en la dirección. En caso de no coincidir, arrastra el marcador a la posición correcta en el mapa.</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Si tiene adeudo pone link para pago-->
                <div class="alert alert-warning alert-dismissible fade show mb-3 linkPago" role="alert">
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

<!-- Modal Agregar Predio -->
<div class="modal fade" id="modal-predio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_predio" action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar predio</h5>
                    <button type="button" class="close btn-cerrar-predial" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">Escribe la cuenta o en su defecto la CURT y luego da click en Buscar predio. Sí alguno de los datos está incorrecto por favor acude a la Dirección de Catastro.</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Cuenta predial <i id="cuenta-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="cuenta" id="cuenta_form" class="ab-form background-color rounded border cuenta" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" value="{{((isset($cuenta))?$cuenta:'')}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>CURT <i id="curt-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="curt" id="curt_form" value="{{((isset($curt))?$curt:'')}}" class="ab-form background-color rounded border curt" type="text" data-parsley-type="number" data-parsley-minlength="31" maxlength="31" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-right">
                            <button type="button" class="ab-btn b-primary-color btn-buscar">Buscar predio</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Calle</small></label>
                            <input name="calle" class="ab-form background-color rounded border capitalize calle" type="text" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Número exterior</small></label>
                            <input name="numero" class="ab-form background-color rounded border capitalize numero" type="text" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Letra exterior</small></label>
                            <input name="letraE" class="ab-form background-color rounded border capitalize letraE" type="text" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Número interior</small></label>
                            <input name="interior" class="ab-form background-color rounded border capitalize interior" type="text" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Letra interior</small></label>
                            <input name="letraI" class="ab-form background-color rounded border capitalize letraI" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Fraccionamiento/Colonia</small></label>
                            <input name="colonia" class="ab-form background-color rounded border capitalize colonia" type="text" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Manzana</small></label>
                            <input name="manzana" class="ab-form background-color rounded border capitalize manzana" type="text" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>Lote</small></label>
                            <input name="lote" class="ab-form background-color rounded border capitalize lote" type="text" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Condominio</small></label>
                            <input name="condominio" class="ab-form background-color rounded border capitalize condominio" type="text" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Unidad privativa</small></label>
                            <input name="privativa" class="ab-form background-color rounded border capitalize privativa" type="text" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input name="poligono" class="poligono" type="hidden">
                    <button type="button" class="ab-btn btn-cancel btn-cerrar-predial" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn b-primary-color btn-agregar">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Agregar Anuncio -->

<div class="btnFloat" data-toggle="modal" data-target="#modal-map"><i class="fas fa-map-marker-alt text-white"></i></div>

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
    $('.card_2 .card-body').slideUp('fast');
    $('.linkPago').fadeOut();

    var map;
    var response = false;

    //Valida si esta en la versión mobile 
    if (typeof window.orientation !== 'undefined') {
        $('.mapa1').remove();
    } else {
        $('.mapa2').remove();
    }


    $(document).ready(function() {

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

        tippy('#plaza-tooltip', {
            content: '<small class="font f-10"> Si tu establecimiento esta ubicado dentro de una plaza comercial, mercado privado o municipal, seleccionalo</small>',
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
         * Inicializamos la validación de 
         * los formularios
         * 
         */

        $('#form_1').parsley();
        $('#form_2').parsley();
        $('#form_predio').parsley();

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
                $('.btn-buscar').text("Buscar predio");
                $('.continuar_lista_predio').val('Continuar');

            }

        });

        $('.agregar').click(function(e) {
            limpia_predio();
            $('.btn-agregar').prop('disabled', false);
            $('.btn-agregar').text('Agregar');

        });

        $('.btn-cerrar-predial').click(function() {

            $('.card_1 .card-body').slideDown('slow');
            $('.card_2 .card-body').slideUp('slow');
        });

        $('#form_predio').submit(async function(e) {

            $('.btn-agregar').prop('disabled', true);
            $('.btn-agregar').html(spiner());
            e.preventDefault();

            /**
             * Guardar datos en tabla predios
             */

            var form = document.getElementById('form_predio');
            var data = new FormData(form);


            var res = await axios.post('{{url("predios/post")}}', data, {
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            }).then(function(reponse) {

                iziToast.show({
                    title: '¡Excelente!',
                    message: 'Se agregó la cuenta',
                    backgroundColor: '#2fd099',
                    closeOnEscape: true
                });

                $('#modal-predio').modal('hide');
                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#top-2').position().top
                    }, 500);
                }, 500);
            }).catch(function(error) {
                console.log(error);

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Ocurrio un error al tratar de agregar el predio, por favor intente más tarde',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

                $('.card_1 .card-body').slideDown('slow');
                $('.card_2 .card-body').slideUp('slow');

            });

        });

        /**
         * 
         * Completando la segunda parte
         * 
         */

        $('#form_2').submit(function(e) {


            $('.btn-form2').html(spiner());
            $('.btn-form2').prop('disabled', true);

            e.preventDefault();

            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                displayMode: 'once',
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Ya revisaste que el marcador del mapa este en la dirección correcta?',
                position: 'center',
                backgroundColor: '#ffd66b',
                buttons: [
                    ['<button class="btn-cerrar"><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                        $('.btn-agregar').text('Guardar');
                        $('.btn-form2').prop('disabled', false);

                    }],
                    [`<button class="continuar">Si, continuar</button>`, async function(instance, toast) {

                        $('.btn-cerrar').hide();
                        $('.continuar').prop('disabled', true);
                        $('.continuar').html(spiner());

                        const formData = new FormData();
                        formData.append("tipo_persona", $('.tipo_persona').val());
                        formData.append("nombre", $('.nombre').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase()));
                        formData.append("apellido_paterno", $('.apellido_paterno').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase()));
                        formData.append("apellido_materno", $('.apellido_materno').val().toLowerCase().replace(/^\w/, (c) => c.toUpperCase()));
                        formData.append("cuenta", $('.cuenta').val());
                        formData.append("curt", $('.curt').val());
                        formData.append("calle_negocio", $('.calle_negocio').val());
                        formData.append("no_exterior_negocio", $('.no_exterior_negocio').val());
                        formData.append("letra_exterior_negocio", $('.letra_exterior_negocio').val().toUpperCase());
                        formData.append("no_interior_negocio", $('.no_interior_negocio').val());
                        formData.append("letra_interior_negocio", $('.letra_interior_negocio').val().toUpperCase());
                        formData.append("colonia_negocio", $('.colonia_negocio').val());
                        formData.append("plaza_negocio", $('.plaza_negocio').val());
                        formData.append("calle1_negocio", $('.calle1_negocio').val());
                        formData.append("calle2_negocio", $('.calle2_negocio').val());
                        formData.append("calle3_negocio", $('.calle3_negocio').val());
                        formData.append("giro", $('.giro').val());
                        formData.append("sup_negocio", $('.sup_negocio').val());
                        formData.append("latitud", $('.latitud').val());
                        formData.append("longitud", $('.longitud').val());
                        formData.append("poligono", $('.poligono').val());
                        formData.append("id_solicitud", $('.id_solicitud').val());

                        var response = await axios.post('{{url("licencias/ingresa_solicitud_uso_suelo")}}', formData, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {
                            console.log(response);
                        }).then(function(response) {

                            window.location.href = '{{url("ciudadano/descanso")}}';

                        }).catch(function(error) {
                            console.log(error);
                        });





                    }, true]
                ],
            });

        });



        $('.tipo_persona').change(function() {

            var tipo = $('.tipo_persona').val();

            if (tipo == 'M') {

                $('.nombre_sol').text('Razón Social');
                $('.nombre').val('');
                $('.apellidos').addClass('ocultar');
                $('.apellido_paterno').val('');
                $('.apellido_paterno').prop("required", false);
                $('.apellido_materno').val('');

            } else {

                $('.nombre_sol').text('Nombre');
                $('.nombre').val('');
                $('.apellidos').removeClass('ocultar');
                $('.apellido_paterno').val('');
                $('.apellido_paterno').prop("required", true);
                $('.apellido_materno').val('');
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

        $('.btn-seleccionar').click(function() {
            var cuenta = $(this).parent('td').siblings('td').find('input[type=checkbox]').parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).parent('td').siblings('td').find('input[type=checkbox]').prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');

        });

        $('input[type=checkbox]').change(function() {
            var cuenta = $(this).parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');
        });

        /** 
            Elimina la cuenta anterior para buscar la nueva  
        */

        $('#curt_form').change(function() {
            $('.cuenta').val('');
        });

        $('#curt_form').keyup(function() {
            if ($('#curt_form').val().trim() > 0 && $('#cuenta_form').val().trim() == 0) {
                $('.btn-agregar').hide();
            } else if ($('#curt_form').val().trim() == 0 && $('#cuenta_form').val().trim() == 0) {
                $('.btn-agregar').show();
            } else {
                $('.btn-agregar').hide();
            }
        });

        $('#cuenta_form').change(function() {
            $('.curt').val('');
        });

        $('#cuenta_form').keyup(function() {
            if ($('#cuenta_form').val().trim() > 0 && $('#curt_form').val().trim() == 0) {
                $('.btn-agregar').hide();
            } else if ($('#cuenta_form').val().trim() == 0 && $('#curt_form').val().trim() == 0) {
                $('.btn-agregar').show();
            } else {
                $('.btn-agregar').hide();
            }
        });


        /**
           Buscar predio
        */


        $('.btn-buscar').click(function() {

            $(this).prop('disabled', true);
            $(this).html(spiner());

            //$('.continuar').fadeOut('fast');

            var cuenta = $('#cuenta_form').val().trim();
            var curt = $('#curt_form').val().trim();

            if (cuenta != '' && /^\d+$/.test(cuenta)) {

                try {
                    consulta_cuenta(cuenta);
                } catch (error) {
                    console.log(error);
                }

            } else if (curt != '' && /^\d+$/.test(curt)) {

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

                $('.btn-agregar').fadeOut('fast');
                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar predio");

            }

        });

    });

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
                        $('.btn-agregar').fadeIn('fast');

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

                            }

                            $('.numero').val(((response[0].numext_interior != null) ? response[0].numext_interior : "") + ((response[0].numint != null) ? ' ' + response[0].numint : ''));
                            $('.letra').val(response[0].letraext);
                            $('.manzana').val(response[0].manzana);
                            $('.cuenta').val(response[0].precuentapredialant);
                            $('.curt').val(response[0].precuentapredial);
                            $('.lote').val(response[0].lote);
                            $('.condominio').val(response[0].edificio);
                            $('.fraccionamiento').val(response[0].catcol_nombre);
                            $('.privativa').val(response[0].unidad);
                            //$('.nombre').val(((response[0].persona_nombre != null && response[0].persona_nombre != "") ? response[0].persona_nombre : response[0].persona_razsoc));
                            //$('.apellido_1').val(response[0].persona_apepaterno);
                            //$('.apellido_2').val(response[0].persona_apematerno);
                            $('.poligono').val(response[0].coordenadas);

                            //agregar_poligono(response[0].coordenadas);
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
                            $('.btn-agregar').fadeIn('fast');


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
                $('.btn-buscar').text("Buscar predio");
                $('.continuar_lista_predio').val('Continuar');

            },
            error: function(error) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar predio");
                $('.continuar_lista_predio').val('Continuar');
                $('.cuenta').val('');
                $('.curt').val('');
                $('#cuenta_form').val('');
                $('#curt_from').val('');

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
                $('.btn-buscar').text("Buscar predio");

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
                        $('.btn-agregar').fadeIn('fast');

                    } else {

                        if (response == "1") {

                            iziToast.show({
                                title: '¡Excelente!, continuemos',
                                backgroundColor: '#2fd099',
                                closeOnEscape: true
                            });

                            $('.btn-agregar').fadeIn('slow');
                            $('.linkPago').fadeOut();


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

                            $('.linkPago').fadeIn();
                            $('.txtCuenta').text(cuenta);
                        }
                    }

                } catch (error) {
                    console.log(error);
                    //Borra los campos y pone continuar visible
                    $('.cuenta').val('');
                    $('.curt').val('');
                    $('.btn-agregar').fadeIn('fast');

                }

            },
            async: false,
            error: function(error) {

                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar predio");

                //Borra los campos y pone continuar visible
                $('.cuenta').val('');
                $('.curt').val('');
                $('.btn-agregar').fadeIn('fast');

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


    function limpia_predio() {
        $('.calle').val('');
        $('.numero').val('');
        $('.letra').val('');
        $('.fraccionamiento').val('');
        $('.manzana').val('');
        $('.cuenta').val('');
        $('.curt').val('');
        $('.lote').val('');
        $('.condominio').val('');
        $('.colonia').val('');
        $('.privativa').val('');


    }


    function limpia_form() {
        $('.calle').val('');
        $('.numero').val('');
        $('.letra').val('');
        $('.fraccionamiento').val('');
        $('.manzana').val('');
        $('.cuenta').val('');
        $('.curt').val('');
        $('.lote').val('');
        $('.condominio').val('');
        $('.colonia').val('');
        $('.privativa').val('');
    }


    var marker;
    var map;

    function initMap() {

        var coordenadas = {};

        var markers = [];

        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 20.721395,
                lng: -103.391745
            },
            zoom: 14,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: true,
            rotateControl: false,
            fullscreenControl: false
        });

        marker = new google.maps.Marker({
            position: coordenadas,
            draggable: true
        });

        markers.push(marker);
        marker.setMap(map);

        google.maps.event.addListener(marker, 'dragend', function(event) {
            $('.latitud').val(event.latLng.lat());
            $('.longitud').val(event.latLng.lng());
        })

        const geocoder = new google.maps.Geocoder(); //Creamos la instancia de geocoder


        $('.colonia_negocio').change(function() {

            var calle = $('.calle_negocio option:selected').text();
            var numext = $('.no_exterior_negocio').val();
            var letext = $('.letra_exterior_negocio').val();
            var colonia = $('.colonia_negocio option:selected').text();
            var municipio = 'Zapopan';

            var address = `${calle} #${numext}${letext} ${colonia} ${municipio}`;

            console.log(address);

            geocodeAddress(geocoder, map, address); // Ubica en base a la direccion las coordenadas en el mapa        

        });

        function geocodeAddress(geocoder, resultsMap, address) {

            geocoder.geocode({
                address: address
            }, (results, status) => {
                if (status === "OK") {

                    resultsMap.setCenter(results[0].geometry.location); //Centra el mapa en las coordenadas obtenidas   
                    $('.latitud').val(results[0].geometry.location.lat());
                    $('.longitud').val(results[0].geometry.location.lng());

                    cleanMarkers(); //Limpia todos los marcadores para posicionar el nuevo

                    marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map,
                        draggable: true
                    });

                    markers.push(marker);

                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        $('.latitud').val(event.latLng.lat());
                        $('.longitud').val(event.latLng.lng());
                    });

                } else {
                    //alert("No se encontró la dirección especificada " + status);
                    $('#buscar').prop('disabled', false); //Habilita el boton
                    $('#buscar').text('Buscar'); //Quita el loading
                }
            });
        }

        function cleanMarkers() {

            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }

            markers = [];

        }

    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection