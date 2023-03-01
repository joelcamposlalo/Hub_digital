@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Prelicencia de funcionamiento</h1>
<small class="font text-muted mb-5">Folio de trámite: {{$folio}}</small>
<div class="row mt-5">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border active d-flex justify-content-center align-items-center">

                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>

                    <small class="font f-15 bold  text-white">1</small>
                </div>
                <small class="font c-carbon f-11 text-center">Carta responsiva</small>
            </div>
            <div class="line"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa @if($id_etapa == 15 || $id_etapa == 17) active @else process @endif border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 15 || $id_etapa == 17)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 15 || $id_etapa == 17) text-white @else text-muted @endif">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-12">Solicitud</small>
            </div>
            <div class="@if($id_etapa == 17)line @else line_off @endif"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa @if($id_etapa == 17) active @endif border d-flex justify-content-center align-items-center">
                    @if($id_etapa == 17)
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    @endif
                    <small class="font f-15 bold @if($id_etapa == 17) text-white @else text-muted @endif">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-12">Completado</small>
            </div>
        </div>
    </div>
</div>

<div class="row descarga ocultar">
    <div class="col-md-9 mt-4" id="top-5">
        <div class="card  shadow-sm rounded border-none">
            <div class="card-header">
                <small>Descarga</small>
            </div>
            <div class="card-body">

                <!-- Alert -->

                <div class="alert alert-success " role="alert">
                    <strong class="f-14">Tu Prelicencia fue aprobada. ¡Descárgala ahora!</strong>
                </div>
                <div class="col-md-12 mt-2">
                    @if(isset($id_precaptura))
                    <a href="https://kioscos.zapopan.gob.mx/permiso_provisional/formato_prelicencia.php?folio={{$id_precaptura}}" target="_blank">
                        <button type="button" class="btn btn-success panel-button">Descargar</button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row position-relative carta">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_1 rounded border-none">
            <div class="card-header" id="card_header_1">
                <small>Giro</small>
            </div>
            <div class="card-body">


                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="f-11">Nota:</strong> <small class="f-11">Zapopan te invita a realizar tu trámite de PRELICENCIA, para abrir tu negocio de manera inmediata validando únicamente tu uso de suelo.
                        Esta prelicencia tendrá una vigencia de 28 días a partir de su emisión, y en este lapso podrás recabar los requisitos para iniciar tu trámite de licencia.<nav></nav></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <small class="f-11">El trámite de PRE LICENCIA PARA GIRO COMERCIAL será expedido por la Dirección de Padrón y Licencias únicamente para giros de bajo impacto (categoría “A”) y de mediano impacto (categoría “B”); lo anterior en relación a la clasificación que refiere el artículo 19 fracción I y II del Reglamento para el Comercio, la Industria y la Prestación de Servicios en el Municipio de Zapopan, Jalisco<nav></nav></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-10">
                        <label for=""><strong>Giros disponibles</strong></label>
                        <br><strong><small>La prelicencia es un trámite exclusivo para giros A y B</small></strong>
                        @if(isset($idGiro))
                        @foreach($giros as $giro)
                        @if($idGiro == $giro->IdGiro)
                        <input name="nombre_giro" id="nombre_giro" value="{{$giro->Nombre}}" class="ab-form background-color rounded border" type="text" readonly>
                        <input name="giro" id="giro" value="{{$giro->IdGiro}}" class="ab-form background-color rounded border" type="hidden" readonly>
                        @endif
                        @endforeach
                        @else
                        <select name="giro" id="giro" class="ab-form background-color rounded border giro" required>
                            <option value="">Seleccione la actividad o tipo de giro</option>
                            @foreach($giros as $giro)
                            <option value="{{ $giro->IdGiro }}">{{ $giro->Nombre}}</option>
                            @endforeach
                        </select>
                        @endif


                    </div>
                </div>
                <br>
                <div class="alert alert-light alert-dismissible fade show" role="alert">
                    <small class="f-11">Para trámites con categorías tipo "C" y "D" deberás acudir únicamente a las
                        instalaciones de la Dirección de Pdrón y Licencias ubicada en Av. Vallarta, #6503, local D-15,
                        Col. Granja, C.P.:45010 Zapopan, Jalisco.<nav></nav></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2 text-right">
                        <button class="ab-btn b-primary-color continuar btn_continuar">Continuar</button>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>

<div class="row position-relative carta">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_2 rounded border-none">
            <div class="card-header" id="card_header_2">
                <small>Documentos requeridos para el trámite de licencia de funcionamiento definitiva</small>
            </div>
            <div class="card-body">


                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="f-11">Nota:</strong> <small class="f-11">La Dirección de Padrón y Licencias podrá
                        solicitar diversos requisitos administrativos para el trámite de alta de licencia de
                        funcionamiento definitiva, mismos que se encuentren relacionados a la actividad comercial
                        que se pretende ejercer; lo anterior con fundamento en los artículos 49 fracciones
                        LXXIX y LXXXI del Reglamento de la Administración Pública Municipal; 1, 8 y 16 del
                        Reglamento para el Comercio, la Industria y la Prestación de Servicios en el Municipio
                        de Zapopan, Jalisco.<nav></nav></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-warning alert-dismissible fade show ocultar" role="alert">
                    <strong class="f-11">Nota:</strong> <small class="f-11">Valida si cumples con todos los requisitos, puedes imprimirlos <a href="#!" class="aqui">aquí</a></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-12 requisitos">
                        <ul>
                            <li class="requisito_prelicencia">Formato múltiple.</li>
                            <li class="requisito_prelicencia">Identificación oficial con fotografía del titular.</li>
                            <li class="requisito_prelicencia">Comprobante de domicilio del predio donde desarrollará la actividad comercial.</li>
                            <li class="requisito_prelicencia">Contrato de arrendamiento o documento que acredite la titularidad o legal posesión del inmueble donde se desarrollará la actividad comercial.</li>
                            <li class="requisito_prelicencia">Tres fotografías a color del predio donde se desarrollará la actividad comercial, siendo una la fachada que se aprecie los inmuebles colindantes, una del interior y una del estacionamiento. </li>
                            <li class="requisito_prelicencia">Constancia de uso de suelo, expedida por la Dirección de Padrón y Licencias. </li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 mt-2 text-right">
                        <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                        <button class="ab-btn b-primary-color continuar btn_continuar_2">Continuar</button>
                    </div>
                </div>


                </form>

            </div>

        </div>
    </div>
</div>

<div class="row position-relative carta">
    <div class="col-md-9 mt-4">
        <div class="card shadow-sm card_3 rounded border-none">
            <div class="card-header" id='card_header_3'>
                <small>Datos del negocio</small>
            </div>
            <div class="card-body">
                <form id="form_3" action="{{ url('prelicencias/ingresa_solicitud') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong class="f-11">Nota:</strong> <small class="f-11">Si tu prelicencia es aceptada, te llegara una notificación al correo: {{ session('correo') }}
                            <nav></nav>
                        </small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="tipo_persona"><small>Tipo de persona</small></label>
                            <input name="tipo_persona" id="tipo_persona" value="{{session('tipo_persona')}}" class="ab-form background-color rounded border tipo_persona" type="text" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="cuenta"><small>Cuenta Predial</small></label>
                            <input name="cuenta" id="cuenta" value="{{((isset($cuenta))?$cuenta:'')}}" class="ab-form background-color rounded border cuenta" type="text" data-parsley-type="number" data-parsley-pattern="^[0-9]+" data-parsley-minlength="10" maxlength="10" autocomplete="off">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curt"><small>CURT</small></label>
                            <input name="curt" id="curt" value="{{((isset($curt))?$curt:'')}}" class="ab-form background-color rounded border curt" type="text" data-parsley-type="number" data-parsley-pattern="^[0-9]+" data-parsley-minlength="31" maxlength="31" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="actividad_a_realizar"><small>Actividad a realizar</small></label>
                            <input name="actividad_a_realizar" id="actividad_a_realizar" value="{{((isset($actividad_a_realizar))?$actividad_a_realizar:'')}}" class="ab-form background-color rounded border actividad_a_realizar" type="text" maxlength="255" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="nombre_negocio"><small>Nombre del solicitante / Razón social</small></label>
                            <input name="nombre_negocio" id="nombre_negocio" value="{{((isset($nombre_negocio))?$nombre_negocio:'')}}" class="ab-form background-color rounded border nombre_negocio" type="text" autocomplete="off" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="rfc"><small>RFC</small></label>
                            <input name="rfc" id="rfc" value="{{((isset($rfc))?$rfc:session('rfc'))}}" class="ab-form background-color rounded border rfc" type="text" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="superficie"><small>Superficie del local (máximo 200 mts<span style="vertical-align: super;"><small>2</small></span>)</small></label>
                            <input name="superficie" id="superficie" value="{{((isset($superficie))?$superficie:'')}}" class="ab-form background-color rounded border superficie" type="text" data-parsley-type="number" data-parsley-min="0" autocomplete="off" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cajones"><small>Cajones de estacionamiento</small></label>
                            <input name="cajones" id="cajones" value="{{((isset($cajones))?$cajones:'')}}" class="ab-form background-color rounded border cajones" type="text" data-parsley-type="number" data-parsley-pattern="^[0-9]+" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="niveles"><small>Niveles</small></label>
                            <input name="niveles" id="niveles" value="{{((isset($niveles))?$niveles:'')}}" class="ab-form background-color rounded border niveles" type="text" data-parsley-type="number" data-parsley-pattern="^[0-9]+" autocomplete="off">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="inversion"><small>Inversión estimada</small></label>
                            <input name="inversion" id="inversion" value="{{((isset($inversion))?$inversion:'')}}" class="ab-form background-color rounded border inversion" type="text" data-parsley-type="number" data-parsley-min="0" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="empleos_creados"><small>Empleos creados</small></label>
                            <input name="empleos_creados" id="empleos_creados" value="{{((isset($empleos_creados))?$empleos_creados:'')}}" class="ab-form background-color rounded border empleos_creados" type="text" data-parsley-type="number" data-parsley-min="0" autocomplete="off">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="telefonoest"><small>Teléfono establecimiento</small></label>
                            <input name="telefonoest" id="telefonoest" value="{{((isset($telefonoest))?$telefonoest:'')}}" class="ab-form background-color rounded border telefonoest" type="text" data-parsley-type="number" data-parsley-pattern="^[0-9]+" data-parsley-minlength="10" maxlength="10" autocomplete="off">
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="ComCalleNegocio"><small>Domicilio</small></label>
                            @if(isset($ComCalleNegocio))
                            @foreach($calles as $calle)
                            @if ($ComCalleNegocio == $calle->IdCalle)
                            <input name="ComCalleNegocio" id="ComCalleNegocio" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="ComCalleNegocio" id="ComCalleNegocio" class="ab-form background-color rounded border ComCalleNegocio" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="ComColoniaNegocio"><small>Colonia</small></label>
                            @if(isset($ComColoniaNegocio))
                            @foreach($colonias as $colonia)
                            @if ($ComColoniaNegocio == $colonia->IdColonia)
                            <input name="ComColoniaNegocio" id="ComColoniaNegocio" value="{{$colonia->NombreColonia}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="ComColoniaNegocio" id="ComColoniaNegocio" class="ab-form background-color rounded border ComColoniaNegocio" required>
                                <option value="">Seleccione la Colonia</option>
                                @foreach($colonias as $colonia)
                                <option value="{{ $colonia->IdColonia }}">{{ $colonia->NombreColonia }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="exterior"><small>No. exterior</small></label>
                            <input name="exterior" id="exterior" value="{{((isset($exterior))?$exterior:'')}}" class="ab-form background-color rounded border exterior" type="text" autocomplete="off" required>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="interior"><small>No. interior</small></label>
                            <input name="interior" id="interior" value="{{((isset($interior))?$interior:'')}}" class="ab-form background-color rounded border interior" type="text" autocomplete="off">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="cpneg"><small>C.P.</small></label>
                            <input name="cpneg" id="cpneg" value="{{((isset($cpneg))?$cpneg:'')}}" class="ab-form background-color rounded border cpneg" type="text" data-parsley-type="number" data-parsley-minlength="5" maxlength="5" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="ComCalleCruce1"><small>Calle izquierda</small></label>
                            @if(isset($ComCalleCruce1))
                            @foreach($calles as $calle)
                            @if ($ComCalleCruce1 == $calle->IdCalle)
                            <input name="ComCalleCruce1" id="ComCalleCruce1" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="ComCalleCruce1" id="ComCalleCruce1" class="ab-form background-color rounded border ComCalleCruce1" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="ComCalleCruce2"><small>Calle derecha</small></label>
                            @if(isset($ComCalleCruce2))
                            @foreach($calles as $calle)
                            @if ($ComCalleCruce2 == $calle->IdCalle)
                            <input name="ComCalleCruce2" id="ComCalleCruce2" value="{{ $calle->NombreOficial }}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="ComCalleCruce2" id="ComCalleCruce2" class="ab-form background-color rounded border ComCalleCruce2" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="ComCallePosterior"><small>Calle posterior</small></label>
                            @if(isset($ComCallePosterior))
                            @foreach($calles as $calle)
                            @if ($ComCallePosterior == $calle->IdCalle)
                            <input name="ComCallePosterior" id="ComCallePosterior" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="ComCallePosterior" id="ComCallePosterior" class="ab-form background-color rounded border ComCallePosterior" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="PlazaComercial"><small>¿El local se encuentra en una plaza comercial?</small></label>
                            <select name="PlazaComercial" id="PlazaComercial" onChange="((this.value=='1')?$('#file_1').attr('required',true):$('#file_1').attr('required',false));" class="ab-form background-color rounded border PlazaComercial" required>
                                <option value="">Seleccine una opción</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input name="poligono" class="poligono" type="hidden" value="{{((isset($poligono))?$poligono:'')}}">
                            <input name="idGiro" id="idGiro" value="{{((isset($idGiro))?$idGiro:'')}}" type="hidden">
                            @if(session('tipo_persona') == 'fisica')
                            <input name="apellido_paterno" id="apellido_paterno" type="hidden" value="{{((isset($apellido_paterno))?$apellido_paterno: session('primer_apellido'))}}">
                            <input name="apellido_materno" id="apellido_materno" type="hidden" value="{{((isset($apellido_materno))?$apellido_materno: session('segundo_apellido'))}}">
                            <input name="nombre_solicitante" id="nombre_solicitante" type="hidden" value="{{((isset($nombre_solicitante))?$nombre_solicitante: session('nombre'))}}">
                            @else
                            <input name="nombre_solicitante" id="nombre_solicitante" type="hidden" value="{{((isset($nombre_solicitante))?$nombre_solicitante: session('razon_social'))}}">
                            @endif
                            <input name="telefono" id="telefono" type="hidden" value="{{((isset($telefono))?$telefono: session('telefono'))}}">
                            <input name="correo" id="correo" type="hidden" value="{{((isset($correo))?$correo: session('correo'))}}">
                            <input name="domicilio" id="domicilio" type="hidden" value="{{((isset($domicilio))?$domicilio: session('calle'))}}">
                            <input name="no_exterior" id="no_exterior" type="hidden" value="{{((isset($no_exterior))?$no_exterior: session('no_exterior'))}}">
                            <input name="letra_exterior" id="letra_exterior" type="hidden" value="{{((isset($letra_exterior))?$letra_exterior: session('letra_exterior'))}}">
                            <input name="no_interior" id="no_interior" type="hidden" value="{{((isset($no_interior))?$no_interior: session('no_interior'))}}">
                            <input name="letra_interior" id="letra_interior" type="hidden" value="{{((isset($letra_interior))?$letra_interior: session('letra_interior'))}}">
                            <input name="cp" id="cp" type="hidden" value="{{((isset($cp))?$cp: session('cp'))}}">
                            <input name="colonia" id="colonia" type="hidden" value="{{session('colonia')}}">
                            <input name="id_solicitud" id="id_solicitud" type="hidden" value="{{$folio}}">

                        </div>
                    </div>
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
                                    @if($file->obligatorio == 1)
                                    <small class="f-10 font text-danger error">Este archivo es obligatorio</small>
                                    @else
                                    <small class="f-10 font text-success success">Este archivo es opcional</small>
                                    @endif

                                </td>
                                <td class="f-12 font filesize">Extensión: {{$file->extension}}</td>
                                <td class="f-12 p-0"></td>
                                <td class="f-14 acciones">

                                    <?php

                                    /*if (!in_array($file->id_documento, $files['validados'])) {
                                    ?>
                                        <label for="{{$file->nombre}}" class="ab-btn-effect bold font btn-file">
                                            <small class="font bold f-10 progreso">Actualizar</small>
                                            <input class="file" id="{{$file->nombre}}" type="file" name="file_{{$file->id_documento}}" data-archivo="{{$file->nombre}}" value="{{$file->nombre}}" data-cat-archivo="{{$file->id_cat_archivo}}" data-update="{{$file->id_archivo}}" data-upload="0" data-required="{{$file->obligatorio}}">
                                        </label>
                                    <?php
                                    } else {*/
                                    ?>
                                        <label for="{{$file->nombre}}" class="ab-btn-effect bold font btn-file" style="background-color:#75cfb8 !important">
                                            <small class="font bold f-10 text-white success">VALIDADO</small>
                                        </label>
                                    <?php

                                    //}
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
                                        <input class="file" id="file_{{$key}}" type="file" name="file_{{$file->id_documento}}" data-upload="0" data-required="{{$file->obligatorio}}" @if($file->obligatorio == 1)
                                        required
                                        @endif
                                        >
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">

                            <button data-back=".card_2 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color continuar enviar" type="submit">Enviar</button>
                        </div>
                    </div>



                    <div class="alert alert-light alert-dismissible fade show" role="alert">
                        Centros de atención:
                        <br>
                        <small class="f-11">
                            Dirección de Padrón y Licencias ubicada en Av. Vallarta, #6503, local D-15,
                            Col. Granja, C.P.:45010 Zapopan, Jalisco.
                            Horario de atención: 7:00 a 15:00 horas Tel 3338-182200<nav></nav></small>
                        <br>
                        <small class="f-11">
                            Oficina enlace CISZ de la Dirección de Padrón y Licencias: Centro Integral de
                            Servicios Zapopan. Av. Prolongación Laureles #300, Col. Zapopan, Jalisco
                            Horario de atención: 9:00 a 15:00 horas Tel 3338-182200 ext 2706 y 2707.<nav></nav></small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3 mt-4 position-absolute linkPago" style="right: 0;">

        <div class="card mt-3">
            <div class="card-body">
                <!-- Si tiene adeudo pone link para pago-->
                <div class="alert alert-warning alert-dismissible fade show mt-3 " role="alert">
                    <strong class="f-11">Importante:</strong> <small class="f-11">Su cuenta <div class="txtCuenta bold" style="overflow-wrap: break-word;"></div> presenta adeudo predial. Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
                </div>
            </div>
        </div>




    </div>
</div>





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
    $(document).ready(function() {

        @if($id_etapa == 17 && $estatus == 'autorizado')
        $('.descarga').removeClass('ocultar');
        $('.card_2 .card-body').slideDown('slow');
        $('.card_3 .card-body').slideDown('slow');
        requisitos($('#giro').val());
        $('.continuar').fadeOut();
        $('.btn-regresar').fadeOut();
        $('input').prop('readonly', true);

        @else
        $('.card_2 .card-body').slideUp('fast');
        $('.card_3 .card-body').slideUp('fast');
        @endif

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
        @if(!isset($id_captura))
        $('#form_1').parsley();
        $('#form_2').parsley();
        $('#form_3').parsley();
        @endif

        /**
         * 
         * Completando la primera parte
         * 
         */


        $('.btn_continuar').click(function() {

            $('.requisito').remove();
            var giro = $('#giro').val();
            if (giro > 0) {
                $('#idGiro').val(giro);
                requisitos(giro);
                $('.card_1 .card-body').slideUp('slow');
                $('.card_2 .card-body').slideDown('slow');

                setTimeout(() => {
                    $('html, body').animate({
                        scrollTop: $('#card_header_2').position().top
                    }, 500);
                }, 500);


            } else {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Debes seleccionar un giro para continuar.',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
            }

        });

        /**
         * 
         * Completando la primera parte
         * 
         */

        $('.btn_continuar_2').click(function() {

            $('.card_2 .card-body').slideUp('slow');
            $('.card_3 .card-body').slideDown('slow');

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#card_header_3').position().top
                }, 500);
            }, 500);

        });

        $('.aqui').click(function() {
            var giro = $('#giro').val();
            var url = '{{url("prelicencias/requisitos")}}'
            var ruta = url + '/' + giro;

            if (giro != undefined || giro != '') {
                window.open(ruta, '_blank');
            }

        });

        /**
         * 
         * Completando la primera parte
         * 
         */


        $('#form_3').submit(function(e) {

            $('.carta').addClass('ocultar');
            $('.loading').fadeIn();

            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $('#card_header_4').position().top
                }, 500);
            }, 500);

        });

        $('.cuenta').change(function() {

            var cuenta = $('.cuenta').val();
            $('.curt').val('');

            if (cuenta.length == 10) {
                iziToast.show({
                    title: 'Un momento por favor,',
                    message: 'estamos validando tu Cuenta Predial',
                    backgroundColor: '#fdffbc',
                    closeOnEscape: true,
                    position: 'center',
                });

                try {
                    consulta_cuenta(cuenta);

                } catch (error) {
                    console.log(error);

                }
            } else {
                console.log('no hay cuenta');
            }

        });

        $('.curt').change(function() {

            var curt = $('.curt').val();
            $('.cuenta').val('');

            if (curt.length == 31) {
                iziToast.show({
                    title: 'Un momento por favor,',
                    message: 'estamos validando tu CURT',
                    backgroundColor: '#fdffbc',
                    closeOnEscape: true,
                    position: 'center',
                });

                try {
                    consulta_cuenta(curt);

                } catch (error) {
                    console.log(error);

                }
            } else {
                console.log('no hay cuenta');
            }

        });




        $('.btn-regresar').click(function() {

            let atras = $(this).attr('data-back');

            $(atras).slideDown('slow');
            $(this).parents('.card-body').slideUp('slow');
            $('html, body').animate({
                scrollTop: $(atras).siblings('.card-header').offset().top
            }, 500);

        });


        function requisitos(idGiro) {


            $.ajax({
                url: "{{url('prelicencias/get_requisitos')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "idGiro": idGiro
                },
                type: 'get',
                dataType: "json",
                success: function(response) {

                    /* response.forEach(element => {
                         $('.requisitos').append(plantilla(element.Nombre));
                     });*/

                }
            })
        }

        const plantilla = (nombre) => {

            return `
                <li class="requisito">${nombre}</li>
                `;
        }

        function consulta_cuenta(cuenta) {
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
                        } else {

                            if (response[0].estatus_predio == 'A') {

                                $('.cuenta').val(response[0].precuentapredialant);
                                $('.curt').val(response[0].precuentapredial);
                                $('.poligono').val(response[0].coordenadas);
                                //agregar_poligono(response[0].coordenadas);
                                consulta_adeudo(cuenta);
                                $('.enviar').fadeIn();



                            } else {

                                iziToast.show({
                                    title: 'Ups ☹️',
                                    message: 'La cuenta no puede ser utilizada, consulta con la Dirección de Catastro',
                                    backgroundColor: '#ff9b93',
                                    closeOnEscape: true,
                                    position: 'center',
                                });

                                $('.enviar').fadeOut();

                            }


                        }

                    } catch (error) {
                        console.log(error);
                    }


                },
                error: function(error) {


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
                        $('.continuar').fadeIn('fast');

                    }

                },
                async: false,
                error: function(error) {

                    $('.btn-buscar').prop('disabled', false);
                    $('.btn-buscar').text("Buscar predio");

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


    });
</script>
</script>
@endsection