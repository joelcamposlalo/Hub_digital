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
                        <small class="font text-muted f-10">{{$ciudadano['solicitud']->created_at}}</small>
                    </div>
                </div>
                <div class="card-body">
                    <span class="badge badge-pill badge-warning f-10 mb-2">Folio: {{$ciudadano['solicitud']->folio}}</span>
                    <h6 class="font bold f-15">Información del solicitante</h6>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Nombre o Razón Social</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['nombre_solicitante']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Primer apellido</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{((isset($ciudadano['datos']['apellido_paterno']))?$ciudadano['datos']['apellido_paterno']:'')}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Segundo apellido</small></label>
                            <input class="ab-form background-color rounded border capitalize" readonly type="text" value="{{((isset($ciudadano['datos']['apellido_materno']))?$ciudadano['datos']['apellido_materno']:'')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>RFC</small></label>
                            <input name="rfc" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['rfc']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Telefono</small></label>
                            <input class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['telefono']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Tipo de persona</small></label>
                            <input name="tipo_persona" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['tipo_persona']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Correo</small></label>
                            <input class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['correo']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Domicilio</small></label>
                            <input name="" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['domicilio']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>No. exterior</small></label>
                            <input id="exterior_solicitante" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['no_exterior']}} {{$ciudadano['datos']['letra_exterior']}}">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""><small>No. Interior</small></label>
                            <input id="interior_solicitante" class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['no_interior']}} {{$ciudadano['datos']['letra_interior']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>C.P.</small></label>
                            <input name="cp" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['cp']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Colonia</small></label>
                            <input class="ab-form background-color rounded border" readonly type="text" value="{{$ciudadano['datos']['colonia']}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mt-5">

                <div class="card-body">

                    <h6 class="font bold f-15">Información del negocio</h6>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Giro</small></label>
                            @foreach($ciudadano['giros'] as $giro)
                            @if($ciudadano['datos']['idGiro'] == $giro->IdGiro)
                            <input name="giro_nombre" class="ab-form background-color rounded border" readonly type="text" value="{{$giro->Nombre}}">
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Actividad a realizar</small></label>
                            <input name="actividad_a_realizar" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['actividad_a_realizar']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for=""><small>Nombre del solicitante / Razón social</small></label>
                            <input name="nombre_negocio" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['nombre_negocio']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Superficie del local</small></label>
                            <input name="superficie" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['superficie']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Cajones de estacionamiento</small></label>
                            <input name="cajones" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['cajones']}}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Niveles</small></label>
                            <input name="niveles" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['niveles']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Inversión estimada</small></label>
                            <input name="inversion" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['inversion']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Empleos creados</small></label>
                            <input name="empleos_creados" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['empleos_creados']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Teléfono establecimiento</small></label>
                            <input name="telefonoest" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['telefonoest']}}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Cuenta Predial</small></label>
                            <input name="cuenta" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['cuenta']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>CURT</small></label>
                            <input name="curt" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['curt']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Domicilio</small></label>
                            @foreach($ciudadano['calles'] as $calle)
                            @if($ciudadano['datos']['ComCalleNegocio'] == $calle->IdCalle)
                            <input name="ComCalleNegocio" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$calle->NombreOficial}}">
                            @endif
                            @endforeach
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Colonia</small></label>
                            @foreach($ciudadano['colonias'] as $colonia)
                            @if($ciudadano['datos']['ComColoniaNegocio'] == $colonia->IdColonia)
                            <input name="ComColoniaNegocio" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$colonia->NombreColonia}}">
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>No. exterior</small></label>
                            <input name="exterior" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['exterior']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>No. interior</small></label>
                            <input name="interior" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['interior']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>C.P.</small></label>
                            <input name="cpneg" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['datos']['cpneg']}}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Calle izquierda</small></label>
                            @foreach($ciudadano['calles'] as $calle)
                            @if($ciudadano['datos']['ComCalleCruce1'] == $calle->IdCalle)
                            <input name="ComCalleCruce1" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$calle->NombreOficial}}">
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Calle derecha</small></label>
                            @foreach($ciudadano['calles'] as $calle)
                            @if($ciudadano['datos']['ComCalleCruce2'] == $calle->IdCalle)
                            <input name="ComCalleCruce2" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$calle->NombreOficial}}">
                            @endif
                            @endforeach
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for=""><small>Calle posterior</small></label>
                            @foreach($ciudadano['calles'] as $calle)
                            @if($ciudadano['datos']['ComCallePosterior'] == $calle->IdCalle)
                            <input name="ComCallePosterior" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$calle->NombreOficial}}">
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="PlazaComercial"><small>¿El local se encuentra en una plaza comercial?</small></label>
                            <select name="PlazaComercial" id="PlazaComercial" onChange="((this.value=='1')?$('#file_2').attr('required',true):$('#file_2').attr('required',false));" class="ab-form background-color rounded border PlazaComercial" required>
                                <option value="">Seleccine una opción</option>
                                @if (isset($ciudadano['datos']['PlazaComercial'])&&$ciudadano['datos']['PlazaComercial']==1)
                                <option value="1" selected>Si</option>
                                @else
                                <option value="1">Si</option>
                                @endif
                                @if (isset($ciudadano['datos']['PlazaComercial'])&&$ciudadano['datos']['PlazaComercial']==0)
                                <option value="0" selected>No</option>
                                @else
                                <option value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="responsive w-100" style="width: 100%; overflow-x: auto;">
                        <table class="w-100">

                            @foreach($ciudadano['archivos'] as $file)
                            <tr class="w-100 predio">
                                <td class="f-14">
                                    @if($file->extension == 'pdf')
                                    <a href="{{ Storage::disk('s3')->url('public/') }}{{$file->id_usuario}}/{{$file->archivo}}" target="_blank">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/pdf.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @elseif ($file->extension == 'jpg' or $file->extension == 'jpeg')
                                    <a href="{{ Storage::disk('s3')->url('public/') }}{{$file->id_usuario}}/{{$file->archivo}}" data-lightbox="roadtrip">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/jpg.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @else
                                    <a href="{{ Storage::disk('s3')->url('public/') }}{{$file->id_usuario}}/{{$file->archivo}}" data-lightbox="roadtrip">
                                        <img class="icono" src="{{asset('media/flaticon/archivos/png.svg')}}" width="50px" alt="{{$file->nombre}}">
                                    </a>
                                    @endif
                                </td>

                                <td class="f-12 font archivo">{{$file->descripcion_larga}} <br>
                                    @if($file->obligatorio == 1)
                                    <small class="f-10 font text-danger error">Este archivo es obligatorio</small>
                                    @else
                                    <small class="f-10 font text-success success">Este archivo es opcional</small>
                                    @endif

                                </td>
                                <td class="f-12 font filesize">Extensión: {{$file->extension}}</td>
                                <td class="f-12 p-0"></td>

                            </tr>
                            @endforeach

                        </table>
                    </div>

                </div>
            </div>

            <div class="card shadow-sm mt-5">
                <div class="card-body">
                    <h6 class="font bold f-15">Posibles repetidos</h6>
                    <table class="mt-3">
                        <tr class="table-header">
                            <th class="text-muted f-15">Folio precaptura</th>
                            <th class="text-muted f-15">Id alerta</th>
                            <th class="text-muted f-15">No. licencia</th>
                            <th class="text-muted f-15">No. solicitud</th>
                            <th class="text-muted f-15">Fecha</th>
                            <th class="text-muted f-15">Calle</th>
                            <th class="text-muted f-15">Exterior</th>
                            <th class="text-muted f-15">Interior</th>
                        </tr>
                        <tbody class="table-body">
                            @foreach($ciudadano['repetidos'] as $repetido)
                            <tr>
                                <th>{{$repetido->FOLIOPRECAPTURA}}</th>
                                <th>{{$repetido->IdAlerta}}</th>
                                <th>{{$repetido->numlicencia}}</th>
                                <th>{{$repetido->numsolicitud}}</th>
                                <th>{{$repetido->fecha}}</th>
                                <th>{{$repetido->calle}}</th>
                                <th>{{$repetido->exterior}}</th>
                                <th>{{$repetido->interior}}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            @if($ciudadano['solicitud']->status == 'en revision')
            <div class="card-footer text-right">
                <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ff8585;" data-toggle="modal" data-target="#modal-rechazar">Rechazar</button>
                <button class="ab-btn text-decoration-none text-white bold f-12 font" style="background-color: #ffd66b;" data-toggle="modal" data-target="#modal-regresar">Condicionar</button>
                <button class="ab-btn text-decoration-none text-white bold f-12 font btn-continuar" style="background-color: #91d18b;">Autorizar</button>
            </div>
            @elseif($ciudadano['solicitud']->status == 'autorizado')
            <div class="card-footer">
                <label for=""><small class="capitalize">{{$ciudadano['solicitud']->status}} por:</small></label>
                <input name="revisor" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['revisor']->nombre}} {{$ciudadano['revisor']->primer_apellido}} {{$ciudadano['revisor']->segundo_apellido}}">
                <div class="text-right">
                    <a href="https://kioscos.zapopan.gob.mx:8080/permiso_provisional/formato_prelicencia.php?folio={{$ciudadano['datos']['id_precaptura']}}"><button class="ab-btn text-decoration-none text-white bold f-12 font mt-2 btn-imprimir" style="background-color: #91d18b;">Imprimir</button></a>
                    <a href='{{url("prelicencias/reenviar")}}/{{$ciudadano["solicitud"]->folio}}'><button class="ab-btn text-decoration-none text-white bold f-12 font mt-2 btn-reenviar" style="background-color: #ffd66b;">Reenviar correo</button></a>
                </div>
            </div>
            @else
            <div class="card-footer">
                <label for=""><small class="capitalize">{{$ciudadano['solicitud']->status}} por:</small></label>
                <input name="revisor" class="ab-form background-color rounded border capitalize" readonly type="text" value="{{$ciudadano['revisor']->nombre}} {{$ciudadano['revisor']->primer_apellido}} {{$ciudadano['revisor']->segundo_apellido}}">
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 300px;"></div>
                    <hr class="mt-4 mb-2">
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
            <form id="form-rechazar" action="{{url('prelicencias/rechazar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota</strong> <small class="f-11">Para cancelar, es necesario que escriba el porqué la solicitud no puede continuar</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <textarea class="w-100 background-color rounded border p-2 txt-rechazar font f-15" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="17">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->id_solicitud}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="id_precaptura" value="{{$ciudadano['datos']['id_precaptura']}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                    <input name="idGiro" class="ab-form background-color rounded border" readonly type="hidden" value="{{$ciudadano['datos']['idGiro']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-rechazar ocultar" style="background-color: #ff8585;">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal condicional  -->
<div class="modal fade" id="modal-regresar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font bold">Condicionar solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-regresar" action="{{url('prelicencias/condicionar')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota</strong> <small class="f-11">Para autorizar con condición, es necesario que escriba el porqué se condiciona la solicitud</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <textarea class="w-100 background-color rounded border p-2 txt-regresar font f-15" name="descripcion" rows="5" placeholder="Introduzca una observación" style="outline: none !important;"></textarea>
                    <input type="hidden" name="id_etapa" value="6">
                    <input type="hidden" name="id_tramite" value="{{$ciudadano['solicitud']->id_tramite}}">
                    <input type="hidden" name="id_usuario" value="{{$ciudadano['solicitud']->id_usuario}}">
                    <input type="hidden" name="id_solicitud" value="{{$ciudadano['solicitud']->id_solicitud}}">
                    <input type="hidden" name="correo" value="{{$ciudadano['solicitud']->correo}}">
                    <input type="hidden" name="id_precaptura" value="{{$ciudadano['datos']['id_precaptura']}}">
                    <input type="hidden" name="id_coordinacion" value="{{$ciudadano['solicitud']->id_coordinacion}}">
                    <input name="idGiro" class="ab-form background-color rounded border" readonly type="hidden" value="{{$ciudadano['datos']['idGiro']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="ab-btn btn-regresar ocultar" style="background-color: #ffd66b;">Autorizar con condición</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let map;

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

        $('.txt-regresar').keyup(function() {
            var texto = $(this).val();

            if (texto.length > 0) {
                $('.btn-regresar').fadeIn('slow');
            } else {
                $('.btn-regresar').fadeOut('fast');
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

            var id_solicitud = "{{$ciudadano['solicitud']->id_solicitud}}";

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
                    [`<button class="continuar" data-id="${id_solicitud}">Si, autorizar</button>`, async function(instance, toast) {

                        $('.btn-cerrar').hide();
                        $('.continuar').prop('disabled', true);
                        $('.continuar').html(spiner());


                        const formData = new FormData();
                        formData.append("id_etapa", "5");
                        formData.append("id_tramite", "{{$ciudadano['solicitud']->id_tramite}}");
                        formData.append("id_usuario", "{{$ciudadano['solicitud']->id_usuario}}");
                        formData.append("id_solicitud", "{{$ciudadano['solicitud']->folio}}");
                        formData.append("correo", "{{$ciudadano['solicitud']->correo}}");
                        formData.append("id_precaptura", "{{$ciudadano['datos']['id_precaptura']}}");
                        formData.append("idGiro", "{{$ciudadano['datos']['idGiro']}}");
                        formData.append("id_coordinacion", "{{$ciudadano['solicitud']->id_coordinacion}}");


                        var response = await axios.post('{{url("prelicencias/autorizar")}}', formData, {
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

    function initMap() {

        var zapopan = {
            lat: 20.721395,
            lng: -103.391745
        };

        map = new google.maps.Map(document.getElementById("map"), {
            center: zapopan,
            zoom: 13,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false
        });

        if ("{{$ciudadano['datos']['poligono']}}" != '' && "{{$ciudadano['datos']['poligono']}}" != null) {

            var arr = GeoPolygonToJson("{{$ciudadano['datos']['poligono']}}");

            var poligono = new google.maps.Polygon({
                path: arr,
                strokeColor: "#a8dda8",
                strokeOpacity: 1,
                strokeWeight: 2,
                fillColor: "#a8dda8",
                fillOpacity: 0.3,
            });

            poligono.setMap(map);
            map.setZoom(18);
            map.setCenter(arr[1]);
        } else {
            map.setZoom(14);
            map.setCenter(zapopan);

        }

    }
</script>
<script defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
@endsection