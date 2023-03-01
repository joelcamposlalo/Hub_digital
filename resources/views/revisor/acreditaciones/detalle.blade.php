@extends('base')

@section('title', 'Detalle')

@section('aside')
{{menu_revisor('detalles')}}
@endsection


@section('notification')
{{get_notificaciones()}}
@endsection


@section('container')
<div class="container position-relative" style="padding: 0 !important">
    <div class="d-flex align-items-center">
        <a href="{{url('revisor/solicitudes')}}" style="padding: 13px 0 0 0 !important">
            <button class="back b-primary-color mr-3" style="color: white">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="text-muted font m-0 bold c-primary-color">Detalles de la solicitud</h1>
    </div>
</div>
<small class="font text-muted mb-5">Revisa la información correctamente</small>

<!-- Alert -->
@if(Session::has('alert'))
<div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3" role="alert">
    <small>{{session('alert.msg')}}</small>
    <!-- @if(Session::has('alert.link'))<a href="#"><small>Activar cuenta</small></a>@endif -->
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- End alert -->

<!-- Alert -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    @foreach ($errors->all() as $error)
    <small class="block block capitalize">{{ $error }}</small> <br>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- End alert -->

<div id="section">
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <div class="detalle-profile-img">
                        @if($ciudadano['solicitud']->perfil != '')
                        <img src="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario) }}/perfil.jpg" alt="perfil">
                        @else
                        <img src="{{asset('media/flaticon/avatar.svg')}}" alt="avatar">
                        @endif
                    </div>
                    <div class="ml-3 d-flex flex-column">
                        <small class="font c-negro"><b>{{$ciudadano['solicitud']->correo}}</b></small>
                        <small class="font text-muted f-10">{{$ciudadano['solicitud']->fecha}}</small>
                    </div>
                </div>
                <div class="card-body">
                    <span class="badge badge-pill badge-warning f-10 mb-2">Folio: {{$ciudadano['solicitud']->folio}}</span>
                    <h6 class="font bold f-15">Información de la solicitud</h6>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Tipo de trámite</small></label>
                            @if($ciudadano['datos']['folio_expediente'] == '')
                            <input name="nuevo" class="ab-form background-color rounded border capitalize" readonly type="text" value="Nuevo">
                            @else
                            <input name="renovacion" class="ab-form background-color rounded border capitalize" readonly type="text" value="Renovación">
                            @endif
                        </div>
                    </div>
                    @if($ciudadano['datos']['folio_expediente'] == '')
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>CURP</small></label>
                            <input name="curp" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['curp']}}">
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>CURP</small></label>
                            <input name="curp" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['curp']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Folio de la acreditación anterior</small></label>
                            <input name="folioAC" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['folio_expediente']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Fecha inicio</small></label>
                            <input name="fecha_inicio" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['fecha_inicio']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Fecha fin</small></label>
                            <input name="fecha_fin" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['fecha_fin']}}">
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Tipo de acreditación</small></label>
                            @if($ciudadano['datos']['tipo_acreditacion'] == 1)
                            <input name="tipo" class="ab-form background-color rounded border" readonly type="text" value="Adulto mayor">
                            @elseif($ciudadano['datos']['tipo_acreditacion'] == 2)
                            <input name="tipo" class="ab-form background-color rounded border" readonly type="text" value="Mujer embarazada">
                            @elseif($ciudadano['datos']['tipo_acreditacion'] == 3)
                            <input name="tipo" class="ab-form background-color rounded border" readonly type="text" value="Discapacidad permanente">
                            @else
                            <input name="tipo" class="ab-form background-color rounded border" readonly type="text" value="Discapacidad temporal">
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Placa</small></label>
                            <input name="placa" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['placa']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Placa No. 2</small></label>
                            <input name="placa" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['placa2']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Placa No. 3</small></label>
                            <input name="placa" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['placa3']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Nombre</small></label>
                            <input name="nombre" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['nombre']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Apellido paterno</small></label>
                            <input name="paterno" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['paterno']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Apellido materno</small></label>
                            <input name="materno" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['materno']}}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8 mt-2">
                            <label for=""><small>Correo</small></label>
                            <input name="correo" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['correo_electronico']}}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""><small>Teléfono</small></label>
                            <input name="telefono" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['telefono']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Propietario del vehículo</small></label>
                            @if($ciudadano['datos']['propiedad_vehiculo'] == 1)
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="Pertenece al acreditado">
                            @elseif($ciudadano['datos']['propiedad_vehiculo'] == 2)
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="El vahículo es arrendado">
                            @elseif($ciudadano['datos']['propiedad_vehiculo'] == 3)
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="Pertenece a una empresa">
                            @elseif($ciudadano['datos']['propiedad_vehiculo'] == 4)
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="Pertenece al cónyuge">
                            @elseif($ciudadano['datos']['propiedad_vehiculo'] == 5)
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="Pertenece al un familiar directo">
                            @else
                            <input name="propietario" class="ab-form background-color rounded border" readonly type="text" value="Pertenece a otra persona">
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Parentesco con el dueño del vehículo</small></label>
                            <input name="parentezco" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['parentezco_acreditado']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>El acreditado será trasladado por otra persona</small></label>
                            @if($ciudadano['datos']['trasladado'] == 1)
                            <input name="traslado" class="ab-form background-color rounded border" readonly type="text" value="Si">
                            @else
                            <input name="traslado" class="ab-form background-color rounded border" readonly type="text" value="No">
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>El acreditado es menor de edad</small></label>
                            @if($ciudadano['datos']['menor_edad'] == 1)
                            <input name="menor" class="ab-form background-color rounded border" readonly type="text" value="Si">
                            @else
                            <input name="menor" class="ab-form background-color rounded border" readonly type="text" value="No">
                            @endif
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Oficina donde recogerá</small></label>
                            @if($ciudadano['datos']['oficina'] == 1)
                            <input id="oficina" name="oficina" class="ab-form background-color rounded border" readonly type="text" value="CISZ: Centro Integral de Servicios Zapopan, ventanilla 116 y 117">
                            @elseif($ciudadano['datos']['oficina'] == 2)
                            <input id="oficina" name="oficina" class="ab-form background-color rounded border" readonly type="text" value="Unidad Basílica: Unidad Administrativa Basílica, ventanilla 1, 2 y 3">
                            @else($ciudadano['datos']['oficina'] == 3)
                            <input id="oficina" name="oficina" class="ab-form background-color rounded border" readonly type="text" value="Guadalupe: Unidad Administrativa Guadalupe, módulo de Movilidad y Transporte">
                            @endif
                        </div>
                    </div>
                    @if($ciudadano['datos']['tipo_acreditacion'] == 2 || $ciudadano['datos']['tipo_acreditacion'] == 4)
                    <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">Por favor selecciona los meses de vigencia para la acreditación en caso de aprobarla.<nav></nav></small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Meses de vigencia</small></label>
                            <select name="vigencia" id="vigencia" required class="ab-form background-color rounded border vigencia">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" id="vigencia" name="vigencia" value="12">
                    @endif
                </div>
                @if($ciudadano['solicitud']->status == 'en revision')
                <div class="card-footer text-right">
                    <input type="hidden" name="id_solicitud_ac" value="{{$ciudadano['datos']['id_solicitud_ac']}}">
                    <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ff8585;" data-toggle="modal" data-target="#modal-rechazar">Rechazar</button>
                    <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ffd66b;" data-toggle="modal" data-target="#modal-regresar">Regresar</button>
                    <button class="ab-btn text-decoration-none text-white bold f-12 font btn-continuar" style="background-color: #91d18b;">Continuar</button>
                </div>
                @elseif($ciudadano['solicitud']->status == 'autorizado')
                <div class="card-footer">
                    <label for=""><small class="capitalize">{{$ciudadano['solicitud']->status}} por:</small></label>
                    <input name="revisor" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['revisor']->nombre}} {{$ciudadano['revisor']->primer_apellido}} {{$ciudadano['revisor']->segundo_apellido}}">
                    <div class="text-right">
                        <a href="{{route('acreditacion_movilidad', $ciudadano['solicitud']->folio)}}"><button class="ab-btn text-decoration-none text-white bold f-12 font mt-2 btn-imprimir" style="background-color: #91d18b;">Imprimir</button></a>
                    </div>
                </div>
                @else
                <div class="card-footer">
                    <label for=""><small class="capitalize">{{$ciudadano['solicitud']->status}} por:</small></label>
                    <input name="revisor" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['revisor']->nombre}} {{$ciudadano['revisor']->primer_apellido}} {{$ciudadano['revisor']->segundo_apellido}}">
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="font bold f-15">Archivos</h6>
                    <div class="row">
                        @foreach($ciudadano['archivos'] as $archivo)
                        <div class="col-md-6 pl-2 pr-2">
                            <div class="card mt-3" data-toggle="tooltip" data-placement="top" title="{{$archivo->nombre}}">
                                <div class="card-body pt-2 pb-2 d-flex justify-content-center flex-column align-items-center">
                                    @if($archivo->extension == 'jpeg' or $archivo->extension == 'jpg')
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario)}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @elseif($archivo->extension == 'png')
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario)}}/{{$archivo->archivo}}" data-lightbox="roadtrip">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/png.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @else
                                    <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario)}}/{{$archivo->archivo}}" target="_blank">
                                        <img class="pointer" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="40px" alt="formato">
                                    </a>
                                    @endif
                                    <small class="text-center mt-1 mb-1 bold font f-10 text-truncate" style="width: 50px; text-overflow: ellipsis;">{{$archivo->nombre}}</small>
                                    <!-- <a href="{{ Storage::disk('s3')->url('public/'.$ciudadano['solicitud']->id_usuario)}}/{{$archivo->archivo}}" class="f-10 font text-center" download="">Descargar</a> -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal rechazar  -->
<div class="modal fade" id="modal-rechazar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Rechazar solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-rechazar" action="{{url('solicitud/rechazar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota</strong> <small class="f-11">Para rechazar, es necesario que selecciones al menos una observacion del porqué la solicitud no puede continuar</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="responsive w-100">
                        <table class="w-100">
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Licencia de conducir vencida.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Tarjeta de circulación vencida.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No se acredita propiedad, posesión o relación con el titular del vehículo.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No es adulto mayor.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No exhibe constancia o credencial de discapacidad temporal o permanente.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="6">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No especifica el tiempo por el cual la movilidad se ve reducida para la acreditación temporal.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="7">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Documentos no legibles.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="8">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No se acredita la necesidad de ser trasladado con los docuemntos.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="9">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">El certificado médico o constancia de discapacidad no son válidos.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-rechazar[]" class="respuesta-rechazar" type="checkbox" value="10" id="otro-rechazar">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Otro</td>
                            </tr>
                        </table>
                    </div>

                    <textarea class="mt-2 w-100 background-color rounded border p-2 txt-rechazar font f-15 descripcion-rechazar ocultar" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="11">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->folio}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="logo" value="{{$ciudadano['solicitud']->logo}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-rechazar ocultar" style="background-color: #ff8585;">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal regresar  -->
<div class="modal fade" id="modal-regresar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Regresar solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-regresar" action="{{url('solicitud/regresar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota</strong> <small class="f-11">Para regresar, es necesario que selecciones al menos una observacion del porqué la solicitud se debe regresar al contribuyente.</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="responsive w-100">
                        <table class="w-100">
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Licencia de conducir vencida.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Tarjeta de circulación vencida.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No se acredita propiedad, posesión o relación con el titular del vehículo.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No exhibe constancia o credencial de discapacidad temporal o permanente.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No especifica el tiempo por el cual la movilidad se ve reducida para la acreditación temporal.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="6">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Documentos no legibles.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="7">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">No se acredita la necesidad de ser trasladado con los documentos.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="8">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">El certificado médico o constancia de discapacidad no son válidas.</td>
                            </tr>
                            <tr class="w-100 fila">
                                <td class="f-14 pt-0 pb-0">
                                    <label class="container-check p-0 m-0">
                                        <input name="respuesta-regresar[]" class="respuesta-regresar" type="checkbox" value="9" id="otro-regresar">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td class="f-15 font pt-0 pb-0">Otro</td>
                            </tr>
                        </table>
                    </div>


                    <textarea class="mt-2 w-100 background-color rounded border p-2 txt-regresar font f-15  descripcion-regresar ocultar" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="12">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->folio}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="logo" value="{{$ciudadano['solicitud']->logo}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-regresar ocultar" style="background-color: #ffd66b;">Regresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal rechazar  -->

@endsection

@section('menu_mobile')
{{menu_mobil_revisor('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('vendors/lightbox/dist/css/lightbox.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/loading/loading-bar.min.js')}}"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';

        $('[data-toggle="tooltip"]').tooltip()

        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('.txt-rechazar').keyup(function() {
            var texto = $(this).val();

            if (texto.length > 0) {
                $('.btn-rechazar').fadeIn('slow');
            } else {
                $('.btn-rechazar').fadeOut('fast');
            }
        });

        $('.respuesta-rechazar').change(function() {

            if ($('.respuesta-rechazar:checked').length > 0) {
                $('.btn-rechazar').fadeIn('slow');
            } else {
                $('.btn-rechazar').fadeOut('fast');
            }

            if ($('#otro-rechazar').prop('checked')) {
                $('.btn-rechazar').fadeOut('fast');
                $('.descripcion-rechazar').removeClass('ocultar');
            } else {
                $('.descripcion-rechazar').addClass('ocultar');
            }

        });


        $('.txt-regresar').keyup(function() {
            var texto = $(this).val();

            if (texto.length > 0) {
                $('.btn-regresar').fadeIn('slow');
            } else {
                $('.btn-regresar').fadeOut('fast');
            }
        });

        $('.respuesta-regresar').change(function() {

            if ($('.respuesta-regresar:checked').length > 0) {
                $('.btn-regresar').fadeIn('slow');
            } else {
                $('.btn-regresar').fadeOut('fast');
            }

            if ($('#otro-regresar').prop('checked')) {
                $('.btn-regresar').fadeOut('fast');
                $('.descripcion-regresar').removeClass('ocultar');
            } else {
                $('.descripcion-regresar').addClass('ocultar');
            }


        });


        $('#form-rechazar').submit(function() {
            $('.btn-rechazar').prop('disabled', true);
            $('.btn-rechazar').html(spiner());
        });

        $('#form-regresar').submit(function() {
            $('.btn-regresar').prop('disabled', true);
            $('.btn-regresar').html(spiner());
        });



        $('.btn-continuar').click(function() {

            var id_solicitud = "{{$ciudadano['solicitud']->folio}}";

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: `${id_solicitud}`,
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Desea continuar con la solicitud?',
                position: 'center',
                backgroundColor: '#91d18b',
                buttons: [
                    ['<button class="btn-cerrar"><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                    [`<button class="continuar" data-id="${id_solicitud}">Si, continuar</button>`, async function(instance, toast) {

                        $('.btn-cerrar').hide();
                        $('.continuar').prop('disabled', true);
                        $('.continuar').html(spiner());


                        const formData = new FormData();
                        formData.append("id_etapa", "11");
                        formData.append("id_tramite", "{{$ciudadano['solicitud']->id_tramite}}");
                        formData.append("id_usuario", "{{$ciudadano['solicitud']->id_usuario}}");
                        formData.append("id_solicitud", "{{$ciudadano['solicitud']->folio}}");
                        formData.append("correo", "{{$ciudadano['solicitud']->correo}}");
                        formData.append("logo", "{{$ciudadano['solicitud']->logo}}");
                        formData.append("id_coordinacion", "{{$ciudadano['solicitud']->id_coordinacion}}");
                        formData.append("estatus", "autorizado");
                        formData.append("oficina", $('#oficina').val());
                        formData.append("id_solicitud_ac", "{{$ciudadano['datos']['id_solicitud_ac']}}");
                        formData.append("vigencia", $('#vigencia').val());

                        var response = await axios.post('{{url("solicitud/continuar")}}', formData, {
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }).then(function(response) {
                            console.log(response);
                        }).then(function(response) {

                            window.location.href = '{{url("revisor/solicitudes")}}';

                        }).catch(function(error) {
                            console.log(error);
                        });



                    }, true]
                ]
            });
        })

    });
</script>

</script>
@endsection