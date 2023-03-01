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
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center mb-3">
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
                <small>Datos del solicitante</small>
            </div>
            <div class="card-body">
                <form id="form_1" action="" method="post">

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="tipo_persona"><small>Tipo de persona que solicita</small></label>
                            <input name="tipo_persona" id="tipo_persona" class="ab-form background-color rounded border tipo_persona" type="text" value="{{((isset($tipo_persona) && $tipo_persona =='F')?'Física':'Moral')}}" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small class="nombre_sol">@if($tipo_persona == 'F')Nombre @else Razón social @endif </small></label>
                            <input name="nombre" id="nombre" class="ab-form background-color rounded border nombre" type="text" value="{{((isset($nombre))?$nombre:'')}}" readonly>
                        </div>
                    </div>

                    @if($tipo_persona == 'F')
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="apellido_paterno"><small>Apellido paterno</small></label>
                            <input name="apellido_paterno" id="apellido_paterno" value="{{((isset($apellido_paterno))?$apellido_paterno:'')}}" class="ab-form background-color rounded border apellido_paterno" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="apellido_materno"><small>Apellido materno</small></label>
                            <input name="apellido_materno" id="apellido_materno" value="{{((isset($apellido_materno))?$apellido_materno:'')}}" class="ab-form background-color rounded border apellido_materno" readonly>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="rfc"><small>RFC</small></label>
                            <input name="rfc" id="rfc" value="{{((isset($rfc))?$rfc:session('rfc'))}}" class="ab-form background-color rounded border rfc" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curp"><small>CURP</small></label>
                            <input name="curp" id="curp" value="{{((isset($curp))?$curp:session('curp'))}}" class="ab-form background-color rounded border curp">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle_sol"><small>Calle</small></label>
                            <input name="calle_sol" id="calle_sol" value="{{((isset($calle_sol))?$calle_sol:session('calle'))}}" class="ab-form background-color rounded border calle_sol" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="no_exterior_sol"><small>No. exterior</small></label>
                            <input name="no_exterior_sol" id="no_exterior_sol" value="{{((isset($no_exterior_sol))?$no_exterior_sol:session('no_exterior'))}}" class="ab-form background-color rounded border no_exterior_sol" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_exterior_sol"><small>Letra exterior</small></label>
                            <input name="letra_exterior_sol" id="letra_exterior_sol" value="{{((isset($letra_exterior_sol))?$letra_exterior_sol:session('letra_exterior'))}}" class="ab-form background-color rounded border letra_exterior_sol">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="no_interior_sol"><small>No. interior</small></label>
                            <input name="no_interior_sol" id="no_interior_sol" value="{{((isset($no_interior_sol))?$no_interior_sol:session('no_interior'))}}" class="ab-form background-color rounded border no_interior_sol">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_exterior_sol"><small>Letra exterior</small></label>
                            <input name="letra_exterior_sol" id="letra_exterior_sol" value="{{((isset($letra_exterior_sol))?$letra_exterior_sol:session('letra_exterior_sol'))}}" class="ab-form background-color rounded border letra_exterior_sol">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="colonia_sol"><small>Colonia</small></label>
                            <input name="colonia_sol" id="colonia_sol" value="{{((isset($colonia_sol))?$colonia_sol:session('colonia'))}}" class="ab-form background-color rounded border colonia_sol">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="municipio_sol"><small>Municipio / Población</small></label>
                            <input name="municipio_sol" id="municipio_sol" value="{{((isset($municipio_sol))?$no_interior_sol:session('municipio'))}}" class="ab-form background-color rounded border municipio_sol">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cp_sol"><small>CP</small></label>
                            <input name="cp_sol" id="cp_sol" value="{{((isset($cp_sol))?$cp_sol:session('cp'))}}" class="ab-form background-color rounded border cp_sol">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle1_sol"><small>Entre la calle</small></label>
                            <input name="calle1_sol" id="calle1_sol" value="{{((isset($calle1_sol))?$calle1_sol:'')}}" class="ab-form background-color rounded border calle1_sol">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle2_sol"><small>Y la calle</small></label>
                            <input name="calle2_sol" id="calle2_sol" value="{{((isset($calle2_sol))?$calle2_sol:'')}}" class="ab-form background-color rounded border calle2_sol">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="tel_sol"><small>Telefono</small></label>
                            <input name="tel_sol" id="tel_sol" value="{{((isset($tel_sol))?$tel_sol:session('telefono'))}}" class="ab-form background-color rounded border tel_sol">
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input class="ab-btn b-primary-color continuar" type="submit" value="Continuar">
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
                <small>Datos del negocio</small>
            </div>
            <div class="card-body">
                <form id=form_2 action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="actividad"><small>Actividad a realizar</small></label>
                            <textarea name="actividad" id="actividad" class="w-100 background-color rounded border p-2 font f-15 actividad" rows="5" style="outline: none !important; border: none !important" maxlength="255"></textarea>
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

                    <div class="row apellidos">
                        <div class="col-md-6 mt-2">
                            <label for="calle_negocio"><small>Calle</small></label>
                            @if(isset($calle_negocio))
                            @foreach($calles as $calle)
                            @if ($calle_negocio == $calle->IdCalle)
                            <input name="calle_negocio_readonly" id="calle_negocio_readonly" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border calle_negocio_readonly" type="text" readonly>
                            <input name="calle_negocio" id="calle_negocio" value="{{((isset($calle_negocio))?$calle_negocio:'')}}" class="ab-form background-color rounded border calle_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="calle_negocio" id="calle_negocio" value="" class="ab-form background-color rounded border calle_negocio" type="text" readonly>
                            @endif
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="no_exterior_negocio"><small>No. exterior</small></label>
                            <input name="no_exterior_negocio" id="no_exterior_negocio" value="{{((isset($no_exterior_negocio))?$no_exterior_negocio:'')}}" class="ab-form background-color rounded border no_exterior_negocio">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_exterior_negocio"><small>Letra exterior</small></label>
                            <input name="letra_exterior_negocio" id="letra_exterior_negocio" value="{{((isset($letra_exterior_negocio))?$letra_exterior_negocio:'')}}" class="ab-form background-color rounded border letra_exterior_negocio">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="no_interior_negocio"><small>No. interior</small></label>
                            <input name="no_interior_negocio" id="no_interior_negocio" class="ab-form background-color rounded border no_interior_negocio" type="text" value="{{((isset($no_interior_negocio))?$no_interior_negocio:'')}}" readonly>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letra_interior_negocio"><small>Letra interior</small></label>
                            <input name="letra_interior_negocio" id="letra_interior_negocio" value="{{((isset($letra_interior_negocio))?$letra_interior_negocio:'')}}" class="ab-form background-color rounded border letra_interior_negocio" type="text" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle1_negocio_readonly"><small>Entre la calle</small></label>
                            @if(isset($calle1_negocio))
                            @foreach($calles as $calle)
                            @if ($calle1_negocio == $calle->IdCalle)
                            <input name="calle1_negocio_readonly" id="calle1_negocio_readonly" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border calle1_negocio_readonly" type="text" readonly>
                            <input name="calle1_negocio" id="calle1_negocio" value="{{((isset($calle1_negocio))?$calle1_negocio:'')}}" class="ab-form background-color rounded border calle1_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="calle1_negocio" id="calle1_negocio" value="" class="ab-form background-color rounded border calle1_negocio" type="text" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calle2_negocio_readonly"><small>Y la calle</small></label>
                            @if(isset($calle2_negocio))
                            @foreach($calles as $calle)
                            @if ($calle2_negocio == $calle->IdCalle)
                            <input name="calle2_negocio_readonly" id="calle2_negocio_readonly" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border calle2_negocio_readonly" type="text" readonly>
                            <input name="calle2_negocio" id="calle2_negocio" value="{{((isset($calle2_negocio))?$calle2_negocio:'')}}" class="ab-form background-color rounded border calle2_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="calle2_negocio" id="calle2_negocio" value="" class="ab-form background-color rounded border calle2_negocio" type="text" readonly>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calle3_negocio_readonly"><small>Calle posterior</small></label>
                            @if(isset($calle3_negocio))
                            @foreach($calles as $calle)
                            @if ($calle3_negocio == $calle->IdCalle)
                            <input name="calle3_negocio_readonly" id="calle3_negocio_readonly" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border calle3_negocio_readonly" type="text" readonly>
                            <input name="calle3_negocio" id="calle3_negocio" value="{{((isset($calle3_negocio))?$calle3_negocio:'')}}" class="ab-form background-color rounded border calle3_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="calle3_negocio" id="calle3_negocio" value="" class="ab-form background-color rounded border calle3_negocio" type="text" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="colonia_negocio_readonly"><small>Colonia</small></label>
                            @if(isset($colonia_negocio))
                            @foreach($colonias as $colonia)
                            @if ($colonia_negocio == $colonia->IdColonia )
                            <input name="colonia_negocio_readonly" id="colonia_negocio_readonly" value="{{$colonia->NombreColonia}}" class="ab-form background-color rounded border colonia_negocio_readonly" type="text" readonly>
                            <input name="colonia_negocio" id="colonia_negocio" value="{{((isset($colonia_negocio))?$colonia_negocio:'')}}" class="ab-form background-color rounded border colonia_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="colonia_negocio" id="colonia_negocio" value="" class="ab-form background-color rounded border colonia_negocio" type="text">
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="plaza_negocio_readonly"><small>Plaza comercial, mercado privado o municipal</small></label>
                            @if(isset($plaza_negocio))
                            @foreach($plazas as $plaza)
                            @if ($plaza_negocio == $plaza->IdPlaza )
                            <input name="plaza_negocio_readonly" id="plaza_negocio_readonly" value="{{$plaza->NombrePlaza}}" class="ab-form background-color rounded border plaza_negocio_readonly" type="text" readonly>
                            <input name="plaza_negocio" id="plaza_negocio" value="{{((isset($plaza_negocio))?$plaza_negocio:'')}}" class="ab-form background-color rounded border plaza_negocio" type="hidden" readonly>
                            @endif
                            @endforeach
                            @else
                            <input name="plaza_negocio" id="plaza_negocio" value="" class="ab-form background-color rounded border plaza_negocio" type="text" readonly>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="cp_negocio"><small>CP</small></label>
                            <input name="cp_negocio" id="cp_negocio" value="{{((isset($cp_negocio))?$cp_negocio:'')}}" class="ab-form background-color rounded border cp_negocio" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="tel_negocio"><small>Telefono</small></label>
                            <input name="tel_negocio" id="tel_negocio" value="{{((isset($tel_negocio))?$tel_negocio:'')}}" class="ab-form background-color rounded border tel_negocio" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="sup_negocio"><small>Superficie del local mts<span style="vertical-align: super;"><small>2</small></span></small></label>
                            <input name="sup_negocio" id="sup_negocio" class="ab-form background-color rounded border sup_negocio" type="text" value="{{isset($sup_negocio) ? $sup_negocio : ''}}" data-parsley-type="number" readonly>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cajones"><small>Cajones de estacionamiento</small></label>
                            <input name="cajones" id="cajones" class="ab-form background-color rounded border cajones" type="text" value="{{isset($cajones) ? $cajones : ''}}" data-parsley-type="number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="inversion"><small>Inversion estimada</small></label>
                            <input name="inversion" id="inversion" class="ab-form background-color rounded border inversion" type="text" value="{{isset($inversion) ? $inversion : ''}}" data-parsley-type="number">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="empleos"><small>Número de empleos creados</small></label>
                            <input name="empleos" id="empleos" class="ab-form background-color rounded border empleos" type="text" value="{{isset($empleos) ? $empleos : ''}}" data-parsley-type="number">
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input name="latitud" class="latitud" type="hidden" value="{{((isset($latitud))?$latitud:'')}}">
                            <input name="longitud" class="longitud" type="hidden" value="{{((isset($longitud))?$longitud:'')}}">
                            <input name="poligono" id="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                            <input name="id_solicitud" type="hidden" value="{{((isset($folio))?$folio:'')}}">
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
    //$('.card_2 .card-body').slideUp('fast');
    cuenta = $('.curt').val();
    consulta_adeudo(cuenta);


    var map;

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


        /**
         * 
         * Completando la segunda parte
         * 
         */

        $('#form_2').submit(function(e) {
            e.preventDefault();

            $('.btn-form2').html(spiner());
            $('.btn-form2').prop('disabled', true);

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

        if ("{{$latitud}}" != '') {
            var coordenadas = {
                lat: parseFloat("{{$latitud}}"),
                lng: parseFloat("{{$longitud}}")
            }
        } else {
            var coordenadas = {}
        }

        var markers = [];

        map = new google.maps.Map(document.getElementById("map"), {
            center: coordenadas,
            zoom: 13,
            zoomControl: true,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: true,
            rotateControl: false,
            fullscreenControl: false
        });

        marker = new google.maps.Marker({
            position: coordenadas,
            draggable: false
        });

        markers.push(marker);

        marker.setMap(map);

        map.setZoom(18);
    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection