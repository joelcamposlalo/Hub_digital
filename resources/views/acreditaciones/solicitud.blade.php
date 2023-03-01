@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Acreditación de movilidad</h1>
<small class="font text-muted mb-5">Folio de trámite: {{$folio}}</small>
<div class="row mt-5">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border @if($id_etapa == 7) active @else process @endif d-flex justify-content-center align-items-center">
                    @if($id_etapa == 7)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-16 bold @if($id_etapa == 7) text-white @else text-muted @endif">1</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-13">Carta responsiva</small>
            </div>
            <div class="line"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border @if($id_etapa == 11) active @else process @endif d-flex justify-content-center align-items-center">
                    @if($id_etapa == 11)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-16 bold @if($id_etapa == 11) text-white @else text-muted @endif">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-13">Solicitud</small>
            </div>
        </div>
    </div>
</div>

<!-- Muestra la observacion cuando se regresa al ciudadano en movil-->

@if($id_etapa == 12)
<div class="col-md-3 mt-4 position-absolute d-sm-none" style="right: 0;">
    <div class="card">
        <div class="card-header">
            <small>Observaciones del revisor</small> <br>
            <span class="badge badge-pill badge-warning">{{$notificacion->created_at}}</span>
        </div>
        <div class="card-body">
            <small>{!! $notificacion->descripcion !!}</small>
        </div>
    </div>
</div>
@endif

<div class="row descarga ocultar">
    <div class="col-md-9 mt-4" id="top-5">
        <div class="card  shadow-sm card_5 rounded border-none">
            <div class="card-header">
                <small>Acreditación aprobada</small>
            </div>
            <div class="card-body">

                <!-- Alert -->

                <div class="alert alert-success " role="alert">
                    <strong class="f-15">Su acreditación fue aprobada y puede descargarla aquí
                        <br> o recogerla en el
                        centro de atención seleccionado:</strong>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for=""><small>Puede recoger su acreditación en la oficina seleccionada</small></label>
                        <br>
                        <h3>
                            @if( isset($oficina)&&$oficina==1)
                            <span>Centro Integral de Servicios Zapopan (CISZ)</span>
                            @endif

                            @if( isset($oficina)&&$oficina==2)
                            <span>Unidad Administrativa Basílica oficina (2)</span>
                            @endif

                            @if( isset($oficina)&&$oficina==3)
                            <span>Unidad Administrativa Guadalupe #6899</span>
                            @endif

                        </h3>

                    </div>
                    <div class="col-md-6 mt-2">
                        <label for=""><small>
                                Puede imprimir y portar la acreditación en su vehículo</small></label>
                        <a href="{{route('acreditacion_movilidad', $folio)}}">
                            <button type="button" class="btn btn-success panel-button">Descargar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row position-relative">
    <div class="col-md-9 mt-4" id="top-1">
        <div class="card  shadow-sm card_1 rounded border-none">
            <div class="card-header">
                <small>Trámite a realizar</small>
            </div>
            <div class="card-body">
                <form id=form_1 method="post">

                    <div class="alerta_form1 ">
                    </div>

                    <!-- Alert -->

                    <div class="alert alert-warning alert-dismissible fade show notas" role="alert">
                        <strong class="f-15">Nota:</strong> <small class="f-15">Selecciona el trámite<nav></nav></small>
                    </div>

                    <!-- Alert -->
                    <div class="responsive w-100">
                        <table class="w-100">
                            <tr class="w-100 fila">
                                <td class="f-15">
                                    <label for="chknueva" class="container-check p-0 m-0">
                                        <input class="tipo" type="checkbox" value="1" id="chknueva" {{((isset($tipo_tramite)&& $tipo_tramite==1) ? 'checked': '')}} role="checkbox">
                                        <span class="checkmark"></span>
                                        <small class="f-16 font data-tipo-tramite ml-5" data-tipo-tramite="1">Nueva acreditación</small>
                                    </label>
                                </td>
                                <!--<td class="f-14"><span class="badge badge-pill badge-success">Pagado</span></td>-->
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-15 ">
                                    <label for="chkrenueva" class="container-check p-0 m-0">
                                        <input class="tipo" type="checkbox" value="2" id="chkrenueva" {{((isset($tipo_tramite)&& $tipo_tramite==2) ? 'checked': '')}}>
                                        <span class="checkmark"></span>
                                        <small class="f-16 font data-tipo-tramite ml-5" data-tipo-tramite="2">Renovación</small>
                                    </label>
                                </td>
                                <!--<td class="f-14"><span class="badge badge-pill badge-success">Pagado</span></td>-->

                            </tr>

                        </table>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input type="hidden" name="tipo_tramite_js" id="tipo_tramite_js" value="{{((isset($tipo_tramite))?$tipo_tramite:'')}}">
                            <input name="origen" type="hidden" value='solicitud'>
                            <input class="ab-btn b-primary-color continuar-tramite" type="submit" value="Continuar" data-tipo-tramite="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Muestra la observacion cuando se regresa al ciudadano -->
    @if($id_etapa == 12)
    <div class="col-md-3 mt-4 position-absolute d-none d-md-block d-lg-block d-xl-block" style="right: 0;">
        <div class="card">
            <div class="card-header">
                <small>Observaciones del revisor</small> <br>
                <span class="badge badge-pill badge-warning">{{$notificacion->created_at}}</span>
            </div>
            <div class="card-body">
                <small>{!! $notificacion->descripcion !!}</small>
            </div>
        </div>
    </div>
    @endif

    <div id="multas" class="col-md-3 mt-4 position-absolute ocultar" style="right: 0;">

        <div class="card">
            <div class="card-header">
                <small>Multas del vehículo</small> <br>
                <span class="badge badge-pill badge-warning"></span>
            </div>
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="f-15">Nota:</strong> <small class="f-14">Tu(s) vehículo(s) cuenta(n) con adeudo, puedes pagarlo <a href="https://pagos.zapopan.gob.mx/PortalCiudadano/Recaudacion/Multas/BuscarMultas.aspx" target="_blank">aquí</a>
                        <nav></nav>
                    </small>
                </div>
                <table class="mt-3">
                    <tr class="table-header">
                        <th class="text-muted f-16">Fecha de la infracción</th>
                    </tr>
                    <tbody class="table-body">

                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>


<div class="row">
    <div class="col-md-9 mt-4" id="top-2">
        <div class="card  shadow-sm card_2 rounded border-none">
            <div class="card-header">
                <small>Datos de la solicitud</small>
            </div>
            <div class="card-body">
                <form id="form_2" method="post">

                    <!-- Alert -->

                    <div class="alert alert-warning alert-dismissible fade show notas" role="alert">
                        <strong class="f-13">Nota:</strong> <small class="f-13">Escribe el folio (si cuentas con una acreditación anterior)
                            o tu CURP para continuar<nav></nav></small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Alert -->
                    <div class="row">
                        <div class="col-md-6 mt-2 div_folio_expediente">
                            <label for="folio_expediente"><small>Folio de la acreditación anterior <i id="folio_expediente-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="folio_expediente" oninput="this.value = this.value.toUpperCase()" id="folio_expediente" class="ab-form background-color rounded border folio_expediente" type="text" value="{{((isset($folio_expediente))?$folio_expediente:'')}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curp"><small>CURP <i id="curp-tooltip" class="fas fa-question-circle pointer text-info"></i> </small></label>
                            <input name="curp" id="curp" oninput="this.value = this.value.toUpperCase()" value="{{((isset($curp))?$curp:'')}}" data-parsley-pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[A-Z]{3}[0-9A-Z]\d)" class="ab-form background-color rounded border curp uppercase" type="text" maxlength="18" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col text-right">
                            <button type="button" class="ab-btn b-primary-color btn-buscar">Validar</button>
                        </div>
                    </div>
                    <div class="row ocultar div_vigencias">

                        <div class="col-md-6">
                            <label for="fecha_inicio"><small>Fecha inicio</small></label>
                            <input name="fecha_inicio" id="fecha_inicio" value="{{((isset($fecha_inicio))?$fecha_inicio:'')}}" class="ab-form background-color rounded border fecha_inicio" type="text" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_fin"><small>Fecha fin</small></label>
                            <input name="fecha_fin" id="fecha_fin" value="{{((isset($fecha_fin))?$fecha_fin:'')}}" class="ab-form background-color rounded border fecha_fin" type="text" readonly>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <input class="ab-btn b-primary-color ocultar continuar btnForm2" type="button" value="Continuar">
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
                <small>Datos del acreditado</small>
            </div>
            <div class="card-body">
                <form id=form_3 method="post">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="tipo_acreditacion"><small>Tipo de acreditación</small></label>

                            <select name="tipo_acreditacion" id="tipo_acreditacion" onchange="muestra_placas(this.value);" required class="ab-form background-color rounded border tipo_acreditacion">
                                <option value="" selected="selected">Seleccione el tipo de acreditación</option>
                                @if (isset($tipo_acreditacion)&&$tipo_acreditacion==1)
                                <option value="1" selected="selected">Acreditación para adultos mayores</option>
                                @else
                                <option value="1">Acreditación para adultos mayores</option>
                                @endif
                                @if (isset($tipo_acreditacion)&&$tipo_acreditacion=="2")
                                <option value="2" selected="selected">Acreditación para mujeres embarazadas</option>
                                @else
                                <option value="2">Acreditación para mujeres embarazadas</option>
                                @endif

                                @if (isset($tipo_acreditacion)&&$tipo_acreditacion=="3")
                                <option value="3" selected="selected">Acreditación para personas con discapacidad permanente</option>
                                @else
                                <option value="3">Acreditación para personas con discapacidad permanente</option>
                                @endif

                                @if (isset($tipo_acreditacion)&&$tipo_acreditacion=="4")
                                <option value="4" selected="selected">Acreditación para personas con discapacidad temporal</option>
                                @else
                                <option value="4">Acreditación para personas con discapacidad temporal</option>
                                @endif
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="placa"><small>Placa</small></label>
                            <input name="placa" oninput="this.value = this.value.toUpperCase()" id="placa" value="{{((isset($placa))?$placa:'')}}" required class="ab-form background-color rounded border placa placasM" pattern="[a-zA-Z0-9-]+" maxlength="10" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="nombre"><small>Nombre</small></label>
                            <input name="nombre" id="nombre" value="{{((isset($nombre))?$nombre:'')}}" required class="ab-form background-color rounded border nombre capitalize" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="paterno"><small>Apellido paterno</small></label>

                            <input name="paterno" id="paterno" value="{{((isset($paterno))?$paterno:'')}}" required class="ab-form background-color rounded border capitalize paterno" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="materno"><small>Apellido materno</small></label>
                            <input name="materno" id="materno" value="{{((isset($materno))?$materno:'')}}" class="ab-form background-color rounded border capitalize materno" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="telefono"><small>Teléfono</small></label>
                            <input class="ab-form background-color rounded border telefono" type="text" required name="telefono" id="telefono" value="{{((isset($telefono)) ? $telefono : session('telefono'))}}" data-parsley-minlength="10" maxlength="10">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="correo_electronico"><small>Email</small></label>
                            <input class="ab-form background-color rounded border correo_electronico" name="correo_electronico" id="correo_electronico" value="{{((isset($correo_electronico)) ? $correo_electronico : session('correo'))}}" type="email" data-parsley-type="email" readonly required>

                            <input name="id_acreditacion" value="{{((isset($id_acreditacion)) ? 
                                $id_acreditacion : '')}}" id="id_acreditacion" type="hidden">
                            <input name="tipo_tramite" value="{{((isset($tipo_tramite)) ? 
                                $tipo_tramite : 0)}}" id="tipo_tramite" type="hidden">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="propiedad_vehiculo"><small>A quien pertenece el vehículo</small></label>
                            <select id="propiedad_vehiculo" name="propiedad_vehiculo" required class="ab-form background-color rounded border propiedad_vehiculo">
                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==1)
                                <option value="1" selected="selected">Pertenece al acreditado</option>
                                @else
                                <option value="1" selected="selected">Pertenece al acreditado</option>
                                @endif

                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==2)
                                <option value="2" selected="selected">El vehículo es arrendado</option>
                                @else
                                <option value="2">El vehículo es arrendado</option>
                                @endif
                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==3)
                                <option value="3" selected="selected">Pertenece a una empresa</option>
                                @else
                                <option value="3">Pertenece a una empresa</option>
                                @endif
                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==4)
                                <option value="4" selected="selected">Pertenece al conyugue</option>
                                @else
                                <option value="4">Pertenece al conyugue</option>
                                @endif

                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==5)
                                <option value="5" selected="selected">Pertenece a un familiar directo</option>
                                @else
                                <option value="5">Pertenece a un familiar directo</option>
                                @endif
                                @if (isset($propiedad_vehiculo)&&$propiedad_vehiculo==6)
                                <option value="6" selected="selected">Pertenece a otra persona</option>
                                @else
                                <option value="6">Pertenece a otra persona</option>
                                @endif

                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="parentezco_acreditado"><small>Indica el parentesco con el dueño del vehículo</small></label>
                            <input name="parentezco_acreditado" id="parentezco_acreditado" value="{{((isset($parentezco_acreditado))?$parentezco_acreditado:'')}}" class="ab-form background-color rounded border  parentezco_acreditado" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="trasladado"><small>El acreditado será trasladado por otra persona</small></label>
                            <select class="ab-form background-color rounded border trasladado" onchange="muestra_placas($('#tipo_acreditacion').val());" required="" id="trasladado" name="trasladado">
                                <option value="">Indique si será trasladado</option>
                                @if (isset($trasladado)&&$trasladado==1)
                                <option value="1" selected="selected">Si</option>
                                @else
                                <option value="1">Si</option>
                                @endif

                                @if (isset($trasladado)&&$trasladado==0)
                                <option value="0" selected="selected">No</option>
                                @else
                                <option value="0">No</option>
                                @endif


                            </select>

                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="menor_edad"><small>Indica si el acreditado es menor de edad</small></label>
                            <select class="ab-form background-color rounded border  menor_edad" required id="menor_edad" name="menor_edad">
                                <option value="">Indique si el arcreditado es menor de edad</option>
                                @if (isset($menor_edad)&&$menor_edad==1)
                                <option value="1" selected="selected">Si</option>
                                @else
                                <option value="1">Si</option>
                                @endif

                                @if (isset($menor_edad)&&$menor_edad==0)
                                <option value="0" selected="selected">No</option>
                                @else
                                <option value="0">No</option>
                                @endif
                            </select>

                        </div>

                    </div>
                    <div class="row placas ocultar">
                        <div class="col-md-6 mt-2">
                            <label for="placa2"><small>Si utilizará su acreditación en otro auto ingrese placa #2</small></label>
                            <input name="placa2" oninput="this.value = this.value.toUpperCase()" id="placa2" value="{{((isset($placa2))?$placa2:'')}}" pattern="[a-zA-Z0-9-]+" class="ab-form background-color rounded border placa2 placasM" type="text">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="placa3"><small>Si utilizará su acreditación en otro auto ingrese placa #3</small></label>
                            <input name="placa3" oninput="this.value = this.value.toUpperCase()" id="placa3" value="{{((isset($placa3))?$placa3:'')}}" pattern="[a-zA-Z0-9-]+" class="ab-form background-color rounded border placa3 placasM" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="oficina"><small>Seleccione el centro de antención donde recogerá el gancho en físico</small></label>


                            <select id="oficina" name="oficina" required class="ab-form background-color rounded border oficina">
                                <option value="1">Centro Integral de Servicios Zapopan (CISZ)</option>
                                <option value="2">Unidad Administrativa Basílica oficina (2)</option>
                                <!--<option value="3">Unidad Administrativa Guadalupe #6899</option>-->
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <small class="d-block mt-4">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    @if(isset($id_etapa) && ($id_etapa == 11))
                                    <strong class="f-13">Nota:</strong> <small class="f-13">Puedes visualizar la carta compromiso <a href="#!" data-toggle="modal" data-target="#modal-carta" id="enlace">aquí.</a></small>
                                    @else
                                    <strong class="f-13">Nota:</strong> <small class="f-13">Para continuar debes aceptar la carta compromiso, puedes visualizarla <a href="#!" data-toggle="modal" data-target="#modal-carta" id="enlace">aquí.</a></small>
                                    @endif
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="check-carta">
                                <div class="switch">
                                    <input id="check-carta" type="checkbox" required>
                                    <span class="slider round"></span>
                                </div>
                                <small class="f-16 font ml-2">Estoy de acuerdo</small>
                            </label>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_2 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <input class="ab-btn b-primary-color btn-guardar" type="submit" value="Continuar">
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
                <div class="alert alert-warning alert-dismissible fade show notas" role="alert">
                    <strong class="f-13">Nota</strong> <small class="f-13">Recuerda que los formatos válidos para subir los archivos son: jpg, png, jpeg, pdf</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_4" action="{{url('acreditaciones/ingresa_tramite')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="responsive w-100">
                        <table class="w-100" id="tb_req">
                            <tbody>
                                @if(isset($files))
                                @foreach($files['terminados'] as $file)
                                <tr class="w-100 predio">
                                    <td class="f-15">
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
                                    <td class="f-14 font archivo">{{$file->nombre}}</td>
                                    <td class="f-14 font filesize">Extensión: {{$file->extension}}</td>
                                    <td class="f-14 p-0"></td>
                                    <td class="f-15 acciones">
                                        @if($id_etapa==12)
                                        <label for="{{$file->nombre}}" class="ab-btn-effect bold font btn-file">
                                            <small class="font bold f-13 progreso">Actualizar</small>
                                            <input class="file" id="{{$file->nombre}}" type="file" name="file_{{$file->id_archivo}}" data_archivo="{{$file->nombre}}" value="{{$file->nombre}}" data-cat-archivo="{{$file->id_cat_archivo}}" data-update="{{$file->id_archivo}}">
                                        </label>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                @endif
                            </tbody>
                        </table>
                    </div>


                    <input name="id_solicitud" id="id_solicitud_frm4" type="hidden" value="{{$folio}}">
                    <input name="tipo_acreditacion" id="tipo_acreditacion_frm4" type="hidden" value="{{((isset($tipo_acreditacion)) ? $tipo_acreditacion : '')}}">
                    <input name="propiedad_vehiculo" id="propiedad_vehiculo_frm4" type="hidden" value="{{((isset($propiedad_vehiculo)) ? $propiedad_vehiculo : '')}}">
                    <input name="menor_edad" id="menor_edad_frm4" type="hidden" value="{{((isset($menor_edad)) ? $menor_edad : '')}}">
                    <input name="trasladado" id="trasladado_frm4" type="hidden" value="{{((isset($trasladado)) ? $trasladado : '')}}">
                    <input name="id_etapa" id="id_etapa" type="hidden" value="{{$id_etapa}}">
                    <input name="id_solicitud_ac" id="id_solicitud_ac" type="hidden" value="{{((isset($id_solicitud_ac)) ? $id_solicitud_ac : '')}}">
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button data-back=".card_3 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color btn-form4" type="button">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="modal-carta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font bold">Dirección de Movilidad y Transporte</h5>
                </div>
                <div class="modal-body" style="height: 200px;">
                    <small id="fecha" class="font"></small>
                    <br>
                    <small class="font bold">Carta compromiso</small>
                    <br>
                    <br>
                    <small class="font">Por medio de la presente el (la) suscrito(a) acepto, recibo, y manifiesto estar informado respecto de las implicaciones y responsabilidades cívicas de solicitar
                        la acreditación para el uso de espacios exclusivos para personas con discapacidad, adultos mayores, y mujeres embarazadas. Asimismo, reconozco que la acreditación no me autoriza
                        a estacionarme en espacios regulados por estacionometros sin cubrir la cantidad correspondiente, arriba de aceras y/o obstruyendo el libre paso peatonal, tapando cocheras,
                        en espacios designados como prohibidos por la autoridad competente y/o cualquier otra conducta que sea sancionada por la legislación aplicable. Además asumo que no se procederá
                        a la cancelación de la infracción por olvido en la presente así como cuando las placas del vehículo no correspondan. La presente carta representa un compromiso por parte del (la) suscrito(a)
                        a representar lo establecido en los artículos 61, 62, y 63 del Reglamento de Movilidad, Tránsito y Seguridad Vial para el Municipio de Zapopan y demás legislación aplicable sea
                        estatal o municipal, así como el compromiso de hacer uso de dichos espacios de una forma ética, consiente, responsable y respetuosa. Por último, por medio del presente hago de mi conocimiento
                        que la sanción correspondiente establecida en el artículo 128 inciso J numeral 35 de la Ley de Ingresos para el municipio de Zapopan para el año 2021, por una cantidad de 1.42 UMAS.</small>
                    <br>
                    <br>
                    <small id="firma" class="font bold"></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <!-- <button class="ab-btn b-primary-color btn-acuerdo">De acuerdo</button>-->
                    <button class="ab-btn b-primary-color btn-acuerdo">De acuerdo</button>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
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
    var curp_validada = false;

    $(document).ready(function() {



        /**
         * 
         * Abre las cartas si llegó aqui
         * desde detalle        
         * 
         */


        @if(isset($id_etapa) && ($id_etapa == 7))
        limpia_form();
        limpia_seleccion();
        $('.card_1 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideUp('slow');
        $('.card_3 .card-body').slideUp('slow');
        $('.card_4 .card-body').slideUp('slow');
        $('.continuar').fadeOut();
        $('.btn-guardar').fadeOut();
        $('.btn-form3').fadeOut();
        $('.btn-buscar').fadeIn();
        @elseif(isset($id_etapa) && ($id_etapa == 8))
        @if(isset($tipo_tramite) && $tipo_tramite == "1")
        $('.div_folio_expediente').css('display', 'none');
        $('#folio expediente').val('');
        @else
        $('.div_folio_expediente').css('display', 'inline');
        @endif
        muestra_placas("{{$tipo_acreditacion}}");
        $('.card_1 .card-body').slideUp('slow');
        $('.card_2 .card-body').slideUp('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideUp('slow');
        $('.continuar').fadeOut();
        $('.btn-guardar').fadeIn();
        $('.btn-form3').fadeIn();
        $('.btn-buscar').fadeIn();

        $('#form_3').animate({
            top: 0
        }, 100);
        $('#form_3').scrollTop(1000);
        @elseif(isset($id_etapa) && ($id_etapa == 9 || $id_etapa == 12))
        $('.card_1 .card-body').slideUp('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideDown('slow');

        @elseif(isset($id_etapa) && ($id_etapa == 11) && $estatus == 'autorizado')

        $('.continuar').fadeOut();
        $('.btn-guardar').fadeOut();
        $('.btn-form3').fadeOut();
        $('.btn-buscar').fadeOut();
        $('.ab-btn').fadeOut();
        muestra_placas($("#tipo_tramite_js").val());
        $('#check-carta').prop('checked', true);
        $('#check-carta').prop('disabled', true);
        $('.btn-cancel').fadeIn();
        $('.btn-regresar').fadeOut();
        $('#fecha').addClass('ocultar');
        $('input[type=checkbox]').prop('disabled', true);
        $('.card_5 .card-body').slideDown('slow');
        $('.descarga').fadeIn();
        $('.card_1 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideDown('slow');
        $('form').prop('disabled', true);
        $('.notas').addClass('ocultar');

        @else
        $('.continuar').fadeOut();
        $('.btn-guardar').fadeOut();
        $('.btn-form3').fadeOut();
        $('.btn-buscar').fadeOut();
        $('.ab-btn').fadeOut();

        $('input[type=checkbox]').prop('disabled', true);
        $('.card_1 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_4 .card-body').slideDown('slow');
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
         * Inicializamos la validación de 
         * los formularios
         * 
         */
        $('#form_1').parsley();
        $('#form_2').parsley();
        $('#form_3').parsley();

        /**
         * 
         * Tooltip
         * 
         */

        tippy('#curp-tooltip', {
            content: '<small class="font f-13"> Recuerda que son 18 dígitos </small>',
            animation: 'scale',
            allowHTML: true,
        });

        tippy('#placa-tooltip', {
            content: '<small class="font f-13"> Recuerda que son máximo 10 dígigos </small>',
            animation: 'scale',
            allowHTML: true,
        });

        tippy('#folio_expediente-tooltip', {
            content: '<small class="font f-13"> Ejemplo: 000 A </small>',
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



        /**
         * 
         * Completando la primera parte
         * 
         */


        $('#form_1').submit(function(e) {

            limpia_form();
            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-2').position().top
                }, 500);
            }, 500);

            e.preventDefault();

            var tipo_tramite = $('.continuar-tramite').attr('data-tipo-tramite');
            if (tipo_tramite > 0) {
                console.log('tipo tramite ' + tipo_tramite);

                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                if (tipo_tramite == 1) {
                    $('.div_folio_expediente').css('display', 'none');
                    $('#tipo_tramite').val("1");
                    $('#folio expediente').val('');
                    $('#curp').val('');
                    $('#curp').focus();
                } else {
                    $('.div_folio_expediente').css('display', 'inline');
                    $('#tipo_tramite').val("2");
                    $('.btn-buscar').removeClass('ocultar');
                }
            } else {
                $('.alerta_form1').html('<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">\
                        <small>Debes seleccionar un trámite para continuar</small>\
                        </button>\
                    </div>');
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes seleccionar un trámite para continuar',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }
        });

        $('.tipo').change(function() {

            $('.tipo').prop('checked', false);

            $(this).prop('checked', true);

            var tipo_tramite = $(this).parents('.fila').find('.data-tipo-tramite').attr('data-tipo-tramite');
            console.log('tipo tramite ' + tipo_tramite);


            $('.continuar-tramite').attr('data-tipo-tramite', tipo_tramite);
            console.log($('.continuar-tramite').attr('data-tipo-tramite'));
            $('.continuar-tramite').fadeIn('fast');

        });

        /**
         * 
         * Completando la segunda parte
         * 
         */

        /*$('#form_2').submit(function(e) {

            //e.preventDefault();
            
            //alert('en form 2 submit');
			return false;
            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-3').position().top
                }, 500);
            }, 500);

            $('.card_2 .card-body').slideUp('slow');
            $('.card_3 .card-body').slideDown('slow');
            
        });*/

        $('.btnForm2').click(function(e) {

            //$("#form_2").submit();

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-3').position().top
                }, 500);
            }, 500);

            $('.card_2 .card-body').slideUp('slow');
            $('.card_3 .card-body').slideDown('slow');
        });

        /**
         * 
         * Completando la tercera parte
         * 
         */

        $('#form_3').submit(async function(e) {

            e.preventDefault();

            /**
             * Guardar datos en solicitud
             */

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#top-4').position().top
                }, 500);
            }, 500);

            var id_solicitud = "{{$folio}}";
            var curp = $('#curp').val().toUpperCase();
            var folio_expediente = $('#folio_expediente').val();
            var id_acreditacion = $('#id_acreditacion').val();
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_fin = $('#fecha_fin').val();
            var tipo_acreditacion = $('#tipo_acreditacion').val();
            var placa = $('#placa').val();
            var placa2 = $('#placa2').val();
            var placa3 = $('#placa3').val();
            var nombre = $('#nombre').val();
            var paterno = $('#paterno').val();
            var materno = $('#materno').val();
            var telefono = $('#telefono').val();
            var correo_electronico = $('#correo_electronico').val();
            var propiedad_vehiculo = $('#propiedad_vehiculo').val();
            var parentezco_acreditado = $('#parentezco_acreditado').val();
            var trasladado = $('#trasladado').val();
            var menor_edad = $('#menor_edad').val();
            var id_etapa = $('#id_etapa').val();
            var tipo_tramite = $('#tipo_tramite').val();
            var id_solicitud_ac = $('#id_solicitud_ac').val();
            var oficina = $('#oficina').val();
            if (id_solicitud > 0) {

                var formdata = new FormData();

                formdata.append('id_solicitud', id_solicitud);
                formdata.append('curp', curp);
                formdata.append('folio_expediente', folio_expediente);
                formdata.append('id_acreditacion', id_acreditacion);
                formdata.append('fecha_inicio', fecha_inicio);
                formdata.append('fecha_fin', fecha_fin);
                formdata.append('tipo_acreditacion', tipo_acreditacion);
                formdata.append('placa', placa);
                formdata.append('placa2', placa2);
                formdata.append('placa3', placa3);
                formdata.append('nombre', nombre);
                formdata.append('paterno', paterno);
                formdata.append('materno', materno);
                formdata.append('telefono', telefono);
                formdata.append('correo_electronico', correo_electronico);
                formdata.append('propiedad_vehiculo', propiedad_vehiculo);
                formdata.append('parentezco_acreditado', parentezco_acreditado);
                formdata.append('trasladado', trasladado);
                formdata.append('menor_edad', menor_edad);
                //formdata.append('id_etapa', id_etapa);
                formdata.append('tipo_tramite', tipo_tramite);
                if (id_solicitud_ac > 0)
                    formdata.append('id_solicitud_ac', id_solicitud_ac);
                formdata.append('oficina', oficina);
                if (!curp_validada) {
                    var validacion = new RegExp("[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}");
                    if (!validacion.test(curp) || curp.length != 18) {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: 'La CURP no es correcta, favor de corregir',
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                        $('.btn-form4').html('Guardar');
                        $('.curp').focus();
                        curp_validada = false;
                        $('.card_2 .card-body').slideDown('slow');
                        $('.card_3 .card-body').slideUp('slow');
                        $('.card_4 .card-body').slideUp('slow');
                        return false;
                    } else
                        curp_validada = true;
                }

                if (curp_validada) {

                    if (id_etapa == 0)
                        formdata.append('etapa', 7);
                    else
                        formdata.append('etapa', id_etapa);

                    //console.log("id id_solicitud_ac  " + $('#id_solicitud_ac').val());

                    axios.all([

                        await axios.post(
                            '{{url("acreditaciones/ingresa_solicitud")}}', formdata, {
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                }
                            }),
                        await axios.post('{{url("acreditaciones/consulta_requisitos")}}', formdata, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        })

                    ]).then(axios.spread((response1, response2) =>

                        {
                            console.log(response1);
                            console.log(response1.data);

                            if (parseInt(response1.data) > 0) {
                                $('#id_solicitud_ac').val(response1.data);
                                $('#tipo_acreditacion_frm4').val(tipo_acreditacion);
                                $('#menor_edad_frm4').val(menor_edad);
                                $('#propiedad_vehiculo_frm4').val(propiedad_vehiculo);
                                $('#trasladado_frm4').val(trasladado);


                                console.log(response2);
                                var src_img = "{{asset('media/flaticon/archivos/upload.svg')}}";
                                $('#tb_req').find('tbody').html('');
                                var num_requisitos = 0;
                                for (var f in response2.data) {
                                    num_requisitos++;

                                    if (response2.data[f].id_archivo_usuario > 0) {
                                        ruta = "{{ Storage::disk('s3')->url('public/'.session('id_usuario')) }}/" + response2.data[f].nombre_archivo_usuario + "";
                                        if (response2.data[f].extension == 'pdf')
                                            src_img = "{{asset('media/flaticon/archivos/pdf.svg')}}";
                                        else if (response2.data[f].extension == 'png')
                                            src_img = "{{asset('media/flaticon/archivos/png.svg')}}";
                                        else if (response2.data[f].extension == 'jpg' || response2.data[f].extension == 'jpeg')
                                            src_img = "{{asset('media/flaticon/archivos/jpg.svg')}}";
                                    } else {
                                        ruta = '#!';
                                        src_img = "{{asset('media/flaticon/archivos/upload.svg')}}";

                                    }

                                    console.log(' archivos en posición ' + f, response2.data[f]);

                                    var rowCount = $('#tb_req tr').length;
                                    console.log('FILAS ' + rowCount);

                                    if (rowCount == 0) {
                                        $('#tb_req').find('tbody').append('<tr class="w-100 file ' + response2.data[f].id_archivo + '">\
                                    <td class="f-15">\
                                    <a href="' + ruta + '">\
                                        <img class="icono" style="transform: translateX(10px);" \
                                        src="' + src_img + '" width="38px" alt="archivo">\
                                    </a>\
                                </td>\
                                <td class="f-14 font archivo">' + response2.data[f].descripcion_larga + '</td>\
                                <td class="f-14 font filesize">Tamaño: 0 bytes</td>\
                                <td class="f-14 p-0"></td>\
                                <td class="f-15 acciones">\
                                    <label for="' + response2.data[f].nombre + '" class="ab-btn-effect bold font btn-file">\
                                        <small class="font bold f-13 progreso">Subir Archivo</small>\
                                        <input class="file" id="' + response2.data[f].nombre + '" \
                                        type="file" name="file_' + response2.data[f].id_archivo + '"\
                                         onchange="carga_archivo(this);" \
                                         required data_archivo="' + ((response2.data[f].nombre_archivo_usuario == null) ? '' : response2.data[f].nombre_archivo_usuario) + '"  \
                                         data-cat-archivo="' + response2.data[f].id_archivo + '" data-update="" data-upload="0" data-required="1">\
                                    </label>\
                                </td>\
                            </tr>');

                                    } else
                                        $('#tb_req tr:last').after('<tr class="w-100 file ' + response2.data[f].id_archivo + '">\
                                    <td class="f-15">\
                                    <a href="' + ruta + '">\
                                        <img class="icono" style="transform: translateX(10px);" \
                                        src="' + src_img + '" width="38px" alt="archivo">\
                                    </a>\
                                </td>\
                                <td class="f-14 font archivo">' + response2.data[f].descripcion_larga + '</td>\
                                <td class="f-14 font filesize">Tamaño: 0 bytes</td>\
                                <td class="f-14 p-0"></td>\
                                <td class="f-15 acciones">\
                                    <label for="' + response2.data[f].nombre + '" class="ab-btn-effect bold font btn-file">\
                                        <small class="font bold f-13 progreso">Subir Archivo</small>\
                                        <input class="file" id="' + response2.data[f].nombre + '" \
                                        type="file" name="file_' + response2.data[f].id_archivo + '"\
                                        onchange="carga_archivo(this);" \
                                        required data_archivo="' + ((response2.data[f].nombre_archivo_usuario == null) ? '' : response2.data[f].nombre_archivo_usuario) + '"  \
                                         data-cat-archivo="' + response2.data[f].id_archivo + '" data-update="" data-upload="0" data-required="1">\
                                    </label>\
                                </td>\
                            </tr>');

                                }
                                if (num_requisitos > 0) {
                                    iziToast.show({
                                        message: 'Se registró la información correctamente, puedes ingresar tus archivos',
                                        backgroundColor: '#2fd099',
                                        closeOnEscape: true
                                    });
                                    $('.card_4 .card-body').slideDown('slow');
                                    $('.card_3 .card-body').slideUp('slow');
                                } else {
                                    iziToast.show({
                                        message: 'Se presentó un error al ingresar la solicitud',
                                        backgroundColor: '#ff9b93',
                                        closeOnEscape: true
                                    });
                                    $('.card_4 .card-body').slideDown('slow');
                                    $('.card_3 .card-body').slideUp('slow');
                                }

                            } else {
                                $('.card_4 .card-body').slideUp('slow');
                                $('.card_3 .card-body').slideDown('slow');

                            }
                        }));
                }
            }
        });

        $('#enlace').click(function() {

            var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
            var f = new Date();

            $('#fecha').text(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

            $('#firma').text($('#nombre').val().toUpperCase() + ' ' + $('#paterno').val().toUpperCase() + ' ' + $('#materno').val().toUpperCase());

        });

        $('.btn-acuerdo').click(function() {

            $('#modal-carta').modal('hide');
            $('#check-carta').prop('checked', true);


        });


        $('.btn-form4').click(function() {


            if (fileIsRequired() == 0) {
                $('.btn-form4').html(spiner());
                $('.btn-form4').prop('disabled', true);
                $('#form_4').submit();
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

            let atras = $(this).attr('data-back');

            $(atras).slideDown('slow');
            $(this).parents('.card-body').slideUp('slow');
            $('html, body').animate({
                scrollTop: $(atras).siblings('.card-header').offset().top
            }, 500);
            $(this).prop('disabled', false);
            //$(this).html('Validar');

        });

        $('.btn-buscar').click(function() {


            $(this).prop('disabled', true);
            $(this).html(spiner());

            $('.continuar').fadeOut('fast');
            var validacion = new RegExp("[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}");

            if ($('#tipo_tramite').val() == "2")
                var folio_expediente = $('.folio_expediente').val().trim();
            else
                folio_expediente = null;
            var curp = $('#curp').val().trim().toUpperCase();
            console.log('folio expediente ' + folio_expediente);
            console.log('curp ' + curp);

            if (folio_expediente != '' && folio_expediente != null || curp != '' && curp != null) {

                try {
                    /**
                    Validar
                    */

                    if (curp != '') {
                        if (validacion.test(curp) && curp.length == 18) {
                            curp_validada = true;
                            consulta_acreditaciones_previas(folio_expediente, curp);
                        } else {
                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'Debes introducir una CURP válida',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });

                            $('.continuar').fadeOut('fast');
                            $('.btn-buscar').prop('disabled', false);
                            $('.btn-buscar').text("Validar");
                            $('.card_3 .card-body').slideUp('slow');
                            $('.card_4 .card-body').slideUp('slow');
                        }

                    } else if (folio_expediente != '') {

                        consulta_acreditaciones_previas(folio_expediente, curp);
                    } else {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: 'Debes introducir una CURP válida',
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });

                        $('.continuar').fadeOut('fast');
                        $('.btn-buscar').prop('disabled', false);
                        $('.btn-buscar').text("Validar");
                        $('.card_3 .card-body').slideUp('slow');
                        $('.card_4 .card-body').slideUp('slow');

                    }



                } catch (error) {
                    console.log(error);
                }

            } else {

                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes introducir la curp del acreditado o el folio de acreditación anterior en caso de contar con el',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });

                $('.continuar').fadeOut('fast');
                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Validar");

            }

        });


        /**
         * Subir archivos
         */


        $('.file').change(async function() {


            var file = event.target.files[0];
            var name = $(this).attr('data_archivo');
            var accion = $(this).siblings('.progreso').text();
            var id_archivo = $(this).attr('data-update');
            var id_solicitud = "{{$folio}}";
            var me = $(this);
            var formdata = new FormData();
            //alert('on change ' + id_archivo);
            if (id_solicitud <= 0) {
                alert('Intenta crear la solicitud nuevamente');
                return;
            }
            if (get_extension(file.name) == 'jpg' || get_extension(file.name) == 'jpeg' || get_extension(file.name) == 'png' || get_extension(file.name) == 'pdf' || get_extension(file.name) == 'PDF') {

                formdata.append('file', file);
                formdata.append('name', name);
                formdata.append('id_solicitud', id_solicitud);
                formdata.append('id_cat_archivo', id_cat_archivo);
                (accion == 'Actualizar' ? formdata.append('id_archivo', id_archivo) : '');


                var res = await axios.post('{{url("acreditaciones/upload")}}', formdata, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    },
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    onUploadProgress: function(e) {
                        var progreso = Math.round((e.loaded * 100) / e.total);
                        me.siblings('.progreso').text(`%${progreso}`);
                        me.parents('.acciones').siblings('.filesize').text(`Tamaño: ${e.loaded} bytes`);
                    }
                });

                console.log(res);
                me.siblings('.progreso').text("Actualizar");
                me.parents('.acciones').siblings('td').find('.icono').attr('src', `{{asset('media/flaticon/archivos/${get_extension(file.name)}.svg')}}`);
                me.parents('.acciones').siblings('td').find('.icono').attr('width', `50px`);
                me.attr('data-update', res.data);

            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'El formato no es válido, recuerda que solo es posible subir en formato jpg, png, jpeg, pdf',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }



        });


        $('.placasM').change(function() {

            var placa = $('.placa').val();
            var placa2 = $('.placa2').val();
            var placa3 = $('.placa3').val();

            if (placa.length != 0 || placa2.length != 0 || placa3.length != 0) {
                try {
                    get_multas(placa, placa2, placa3);

                } catch (error) {
                    console.log(error);
                }
            } else {
                console.log('no hay placa');
            }

        });


    });

    /**
     * 
     * Completando la tercera parte
     * 
     */

    function consulta_requisitos() {
        var tipo_acreditacion = $('#tipo_acreditacion').val();
        var propiedad_vehiculo = $('#propiedad_vehiculo').val();
        var trasladado = $('#trasladado').val();
        var menor_edad = $('#menor_edad').val();
        var id_solicitud = $('#id_solicitud').val();
        console.log('ID SOLICITUD' + id_solicitud);
        if (id_solicitud > 0) {
            var res = $.ajax({
                url: "{{url('acreditaciones/consulta_requisitos')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tipo_acreditacion": tipo_acreditacion,
                    "propiedad_vehiculo": propiedad_vehiculo,
                    "trasladado": trasladado,
                    'menor_edad': menor_edad
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
                        } else {

                            if (response == "1") {

                                iziToast.show({
                                    title: '¡Excelente!, continuemos',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true
                                });

                                $('.continuar').fadeIn('slow');


                            } else {
                                $('.continuar').fadeOut('fast');
                                $('.btn-guardar').prop('disabled', false);
                                iziToast.show({
                                    title: 'Ups ☹️',
                                    message: 'La cuenta presenta adeudo predial y no puede ser utilizada',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });

                            }
                        }

                    } catch (error) {
                        console.log(error);

                    }

                },

            });
        }
    }

    function consulta_acreditaciones_previas(folio_expediente, curp) {



        $('.continuar').fadeOut('fast');
        tipo_tramite = $('#tipo_tramite').val();
        $.ajax({
            url: "{{url('acreditaciones/get_acreditaciones_previas')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "folio_expediente": folio_expediente,
                "curp": curp
            },
            type: 'post',
            dataType: "json",
            success: function(response) {
                console.log('response acreditaciones previas');
                console.log(response);

                try {

                    if (typeof(response) == 'undefined') {

                        console.log('NO SE ENCONTRO RESPUESTA tipo tramite ' + tipo_tramite);
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: response.msg,
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                    } else {

                        console.log('respuesta ' + response);
                        console.log(response.estatus);

                        if (tipo_tramite == 2 || response.estatus == 2) {

                            console.log(response.fecha_fin);

                            if (response.estatus == 2) {
                                tipo_tramite = 2;

                                iziToast.show({
                                    message: 'Tu acreditación se encuentra vencida, puedes realizar el trámite de renovación',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true

                                });

                                $('.div_vigencias').fadeIn();
                                $('.continuar').fadeIn();
                                $('folio_expediente').fadeIn();
                                $('.div_folio_expediente').css('display', 'inline');
                                if (folio_expediente == "" || folio_expediente == null)
                                    $('#folio_expediente').val(response.folio_expediente);
                                $('#fecha_inicio').val(response.fecha_inicio);
                                $('#fecha_fin').val(response.fecha_fin);
                                $('#id_acreditacion').val(response.id_acreditacion);
                                $('#nombre').val(response.nombre);
                                $('#curp').val(response.curp);
                                $('#paterno').val(response.paterno);
                                $('#materno').val(response.materno);
                                $('#tipo_acreditacion').val(response.tipo_acreditacion);
                                $('#placa').val(response.placa);
                                $('#placa2').val(response.placa2);
                                $('#placa3').val(response.placa3);
                                $('#parentezco_acreditado').val(response.parentezco_acreditado);
                                $('#trasladado').val(response.trasladado);
                                if (response.correo_electronico != null && response.correo_electronico != "" &&
                                    response.correo_electronico.length > 0) {
                                    $('#correo_electronico').val(response.correo_electronico);
                                }

                                if (response.telefono != null && response.telefono != "" &&
                                    response.telefono.length > 0) {
                                    $('#telefono').val(response.telefono);
                                } else {
                                    $('#telefono').val("{{session('telefono')}}");
                                }
                                $('#propiedad_vehiculo').val(response.propiedad_vehiculo);
                                $('#menor_edad').val(response.menor_edad);
                                $('.btn-guardar').fadeIn('slow');
                                $('.btn-buscar').prop('disabled', false);
                                $('.btn-buscar').text("Validar");
                            } else if (response.estatus == 1) {


                                iziToast.show({
                                    title: 'Ups ☹️',
                                    message: 'La acreditación se encuentra vigente con el folio: ' + response.folio_expediente + ', no es posible realizar ningún trámite',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });

                                $('#fecha_inicio').val(response.fecha_inicio);
                                $('#fecha_fin').val(response.fecha_fin);
                                $('.div_vigencias').fadeIn();
                                $('.btn-guardar').fadeOut();
                                $('.continuar').fadeOut('fast');
                                $('.btn-buscar').prop('disabled', false);
                                $('.btn-buscar').text("Validar");

                            }

                        } else {
                            console.log('estatus ' + response.estatus);
                            if (response.estatus == 1) {
                                iziToast.show({
                                    title: 'Ups ☹️',
                                    message: 'Ya existe una acreditación vigente para esa CURP con el folio: ' + response.folio_expediente,
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true
                                });
                                $('#fecha_inicio').val(response.fecha_inicio);
                                $('#fecha_fin').val(response.fecha_fin);
                                $('.div_vigencias').fadeIn();
                                $('.btn-guardar').fadeOut();
                                $('.continuar').fadeOut('fast');
                                $('.btn-buscar').prop('disabled', false);
                                $('.btn-buscar').text("Validar");
                            } else {
                                iziToast.show({
                                    message: 'Excelente continuemos',
                                    backgroundColor: '#2fd099',
                                    closeOnEscape: true

                                });

                                $('.continuar').fadeIn();
                                $('.btn-guardar').fadeIn('slow');
                                $('.btn-buscar').prop('disabled', false);
                                $('.btn-buscar').text("Validar");

                                if ($('#id_etapa').val() != 12 && $('#id_etapa').val() != 9 && $('#id_etapa').val() != 8)
                                    limpia_form();
                                $('.card_3 .card-body').slideUp('slow');

                            }


                        }

                    }

                } catch (error) {
                    console.log(error);
                }




            },
            error: function(error) {
                if (typeof(response) == 'undefined') {
                    console.log('EN ERROR');

                    if (tipo_tramite == 2) {
                        iziToast.show({
                            title: 'Ups ☹️',
                            message: 'No se encontraron acreditaciones previas para esos datos, por favor revise la información',
                            backgroundColor: '#ff9b93',
                            closeOnEscape: true
                        });
                        $('.continuar').fadeOut('fast');
                        $('.btn-buscar').prop('disabled', false);
                        $('.btn-buscar').text("Validar");
                    } else {
                        iziToast.show({
                            message: 'Excelente continuemos',
                            backgroundColor: '#2fd099',
                            closeOnEscape: true

                        });
                        $('.continuar').fadeIn();
                        $('.btn-guardar').fadeIn('slow');
                        $('.btn-buscar').prop('disabled', false);
                        $('.btn-buscar').text("Validar");

                        if ($('#id_etapa').val() != 12 && $('#id_etapa').val() != 9 && $('#id_etapa').val() != 8)
                            limpia_form();

                        $('.card_2 .card-body').slideUp('slow');
                        $('.card_3 .card-body').slideDown('slow');
                    }


                } else {
                    iziToast.show({
                        title: 'Ups ☹️',
                        message: response.msg,
                        backgroundColor: '#ff9b93',
                        closeOnEscape: true
                    });
                }


            }
        });
    }


    function limpia_form() {
        $('.div_vigencias').fadeOut();
        $('#fecha_inicio').val('');
        $('#fecha_fin').val('');
        //$('#curp').val('');
        $('#id_acreditacion').val('');
        $('#fecha_inicio').val('');
        $('#fecha_fin').val('');
        $('#tipo_acreditacion').val('');
        $('#placa').val('');
        $('#placa2').val('');
        $('#placa3').val('');
        $('#nombre').val('');
        $('#paterno').val('');
        $('#materno').val('');
        $('#telefono').val("{{session('telefono')}}");

        $('#correo_electronico').val("{{session('correo')}}");
        $('#propiedad_vehiculo').val('');
        $('#parentezco_acreditado').val('');
        $('#trasladado').val('');
        $('#menor_edad').val('');

    }

    function limpia_seleccion() {
        $('.continuar-tramite').attr('data-tipo-tramite', '');
        $('input[type=checkbox]').prop('checked', false);

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

    function carga_archivo(file_field) {


        //var file = event.target.files[0];
        var file = file_field.files[0];
        var name = $("#" + file.id).attr('data_archivo');
        var accion = $("#" + file.id).siblings('.progreso').text();
        var id_archivo = $("#" + file.id).attr('data-update');
        var id_solicitud = "{{$folio}}";
        var me = file;
        var formdata = new FormData();
        console.log(file);

        console.log('on change ' + file_field.id);
        console.log(file.name);
        console.log('extension ' + get_extension(file.name));
        if (id_solicitud <= 0) {
            alert('Intenta crear la solicitud nuevamente');
            return;
        }
        if (get_extension(file.name) == 'jpg' || get_extension(file.name) == 'jpeg' || get_extension(file.name) == 'png' || get_extension(file.name) == 'pdf' || get_extension(file.name) == 'PDF' || get_extension(file.name) == 'JPG' || get_extension(file.name) == 'JPEG' || get_extension(file.name) == 'PNG') {

            $(file_field).attr('data-upload', 1);
            $(file_field).siblings('.progreso').text('Cargado');
            $(file_field).parents('.acciones').siblings('td').find('.icono').attr('src', `{{asset('media/flaticon/archivos/${get_extension(file.name)}.svg')}}`);
            $(file_field).parents('.acciones').siblings('.filesize').text('Tamaño: ' + file.size + ' bytes');

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

    }

    function muestra_placas(tipo_acreditacion) {
        if (tipo_acreditacion == "3" || tipo_acreditacion == "4") {
            $('.placas').removeClass('ocultar');
        } else if (tipo_acreditacion == "1" && $('#trasladado').val() == "1") {
            $('.placas').removeClass('ocultar');
        } else {
            $('.placas').addClass('ocultar');
        }
    }

    function get_multas(placa, placa2, placa3) {

        $.ajax({
            url: "{{url('parkimetros/get_multas')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "placa": placa,
                "placa2": placa2,
                "placa3": placa3
            },
            type: 'post',
            dataType: "json",
            success: function(response) {

                console.log(response);

                $('.table-body').empty();
                $('#multas').removeClass('ocultar');

                response.forEach(element => {
                    $('.table-body').append(plantilla(element.fecha, element.folio, element.placa, element.tipo_infraccion));
                });

            },
            error: function(err) {
                $('#multas').addClass('ocultar');
            }
        })
    }

    const plantilla = (fecha, folio, placa, descripcion) => {

        return `
        <tr>
            <th>${fecha}</th>
        </tr>
        `;
    }
</script>

@endsection