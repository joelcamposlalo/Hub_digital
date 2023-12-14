@extends('base')

@section('title', 'Dirección de Proteccion civil y bomberos')

@section('aside')
    {{ menu_ciudadano('') }}
@endsection

@section('notification')
    {{ get_notificaciones() }}
@endsection

@section('container')
    <div class="container position-relative" style="padding: 0 !important">
        <div class="d-flex align-items-center">
            <a href="{{ url('ciudadano/nuevo_tramite') }}" style="padding: 13px 0 0 0 !important"
                aria-label="Regresar a nuevo trámite">
                <button class="back b-primary-color mr-3" style="color: white" aria-hidden="true">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </a>
            <h1 class=" font m-0 bold c-primary-color">Coordinación Municipal de <br>Protección Civil y Bomberos Zapopan
            </h1>
        </div>
        <br>


        @if (!empty($leyendaVac[0]) && $leyendaVac[0]->fecha_inicio < $hoy && $leyendaVac[0]->fecha_fin > $hoy)

            <div class="alert alert-warning alert-dismissible fade show notas mt-2" role="alert">
                <strong class="f-15">Nota:</strong> <small class="f-15"> {{ $hoy }} @if (!empty($leyendaVac[0]))
                        {!! $leyendaVac[0]->nota !!}
                    @endif
                    <nav></nav>
                </small>
            </div>
        @endif

    </div>
    <div class="text-center"><small class="font  mb-5 f-15"><b>Trámites disponibles.</b></small></div>
    <div id="section">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite card-capacitacion" data-tramite="Capacitación"
                data-img="proteccion_civil.png" data-url="bombero_capacitacion/solicitud">
                <a style="text-decoration: none; color: gray;" href="#!" data-toggle="modal"
                    data-target="#modal-carta">
                    <div class="card card-hover-effect">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <img src="{{asset('media/ilustrator/logo_proteccion_civil.png')}}" class="bombero_logo_card"
                                    alt="Dirección de Proteccion civil y bomberos" aria-hidden="true">
                                <span class="badge badge-warning mt-4" aria-hidden="true">CAPACITACIONES</span>
                            </div>
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <small class="text-center mt-2"> SOLICITUD DE CAPACITACIÓN MEDIANTE VENTANILLA
                                    VIRTUAL</small>
                                <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;"
                                    class="circle mt-4 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-arrow-right text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite" data-tramite="EVALUACIÓN TÉCNICA DE RIESGOS"
                data-img="proteccion_civil.png" data-url="evaluacion_riesgos/solicitud">
                <a style="text-decoration: none; color: gray;" href="#!" data-toggle="modal"
                    data-target="#modal-carta">
                    <div class="card card-hover-effect">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <img src="{{asset('media/ilustrator/logo_proteccion_civil.png')}}" class="bombero_logo_card"
                                    alt="Dirección de Proteccion civil y bomberos" aria-hidden="true">
                                <span class="badge badge-warning mt-4" aria-hidden="true">EVALUACIÓN DE RIESGOS</span>
                            </div>
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <small class="text-center mt-2">SOLICITUD DE EVALUACIÓN POR
                                    FENÓMENOS PERTURBADORES
                                    MEDIANTE VENTANILLA VIRTUAL</small>
                                <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;"
                                    class="circle mt-4 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-arrow-right text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-4 card-tramite" data-tramite="Verificación de Riesgos"
                data-img="proteccion_civil.png" data-url="verificacion_tecnica_riesgos/solicitud">
                <a style="text-decoration: none; color: gray;" href="#!" data-toggle="modal"
                    data-target="#modal-carta">
                    <div class="card card-hover-effect">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <img src="{{asset('media/ilustrator/logo_proteccion_civil.png')}}" class="bombero_logo_card"
                                    alt="Dirección de Proteccion civil y bomberos" aria-hidden="true">
                                <span class="badge badge-warning mt-4" aria-hidden="true">VERIFICACIÓN TÉCNICA
                                    DE RIESGOS</span>
                            </div>
                            <div class="card-bombero d-flex flex-column justify-content-center align-items-center">
                                <small class="text-center mt-2">SOLICITUD DE VERIFICACIÓN TÉCNICA
                                    DE RIESGOS MEDIANTE VENTANILLA

                                    VIRTUAL</small>
                                <div style="width: 50px; height: 50px; background-color: #ffc107; border-radius: 50%;"
                                    class="circle mt-4 d-flex justify-content-center align-items-center">
                                    <i class="fas fa-arrow-right text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-carta" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font bold">Términos y Condiciones <br> <small
                            class="badge badge-warning f-11 label-tramites" style="transform: translateY(-2px);"></small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4 img-tramite">
                    </div>

                    <small class="d-block font">A continuación podrás leer los Términos y Condiciones a los que te
                        comprometes a cumplir bajo las normas del Ayuntamiento de Zapopan</small>
                    <div class="mt-4 text-center">
                        <button class="ab-btn b-primary-color carta-responsiva" data-toggle="modal"
                            data-target="#modal-terminos">Ver Términos y Condiciones</button>
                    </div>
                    <small class="d-block mt-4">
                        <label class="switch">
                            <input id="check-carta" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <label for="check-carta" class="ml-2 font pointer">He leído y acepto los términos y
                            condiciones</label>
                    </small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <form id="form" action="">
                        <button id="continuar" type="submit" class="ab-btn">Iniciar trámite</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal -->
    <div class="modal fade" id="modal-terminos" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font bold">AVISO DE PRIVACIDAD SIMPLIFICADO DEL GOBIERNO MUNICIPAL DE ZAPOPAN,
                        JALISCO</h5>
                </div>
                <div class="modal-body" style="height: 200px;">

                    <small class="bold">ADMINISTRACIÓN 2021-2024</small>
                    <br>
                    <br>
                    <small>El Gobierno Municipal de Zapopan, Jalisco, ubicado en la finca marcada con el número 151 de la
                        Avenida Hidalgo, Colonia Centro de Zapopan, Jalisco, C.P. 45100, con sitio web oficial
                        https://www.zapopan.gob.mx y teléfono (33) 3818-2200 es el responsable del uso y protección de sus
                        datos personales, y al respecto emite el presente Aviso de Privacidad Simplificado, por medio del
                        cual se da a conocer la utilización y procesos a los que puede ser sometida la información pública
                        confidencial en posesión de este sujeto obligado, por lo que se le informa lo siguiente:</small>
                    <br>
                    <br>
                    <small class="bold">A. Obtención de información personal.</small>
                    <br>
                    <small>El Gobierno Municipal de Zapopan, Jalisco, podrá recabar su información personal, directa o
                        indirectamente, por medios electrónicos, por escrito y vía telefónica y serán única y exclusivamente
                        utilizados para llevar a cabo los objetivos y atribuciones de este Gobierno Municipal y los
                        utilizaremos para las siguientes finalidades:
                        <br>
                        1. Registro de ingreso de las personas a las diferentes oficinas del Gobierno Municipal de Zapopan,
                        Jalisco
                        <br>
                        2. Datos personales y datos personales sensibles, como parte de los diferentes trámites y servicios
                        que se prestan a los usuarios y que son los que se enuncian en los artículos 9 al 55 del Reglamento
                        de la Administración Pública Municipal de Zapopan, Jalisco.
                        <br>
                        3. Para la integración de los expedientes laborales de las y los servidores públicos.
                        <br>
                        4. Cuando se realice la entrega de información y documentación en la oficialía de partes del
                        Gobierno Municipal de Zapopan, Jalisco, y en la de las diversas dependencias.
                        <br>
                        5. En el caso de solicitudes de acceso a la información pública y de protección de datos personales
                        (Ejercicio de los derechos de acceso, rectificación, cancelación y oposición ARCO)</small>
                    <br>
                    <br>
                    <small class="bold">B. Consentimiento.</small>
                    <br>
                    <small>El otorgamiento de datos personales que se hagan serán necesarios para que este Gobierno
                        Municipal de Zapopan, Jalisco, brinde servicios de calidad al usuario, realizar trámites y gestiones
                        ante las dependencias, federales y estatales correspondientes, así como para dar el debido
                        seguimiento a los mismos. Informando a usted que en caso de datos sensibles su consentimiento se
                        debe otorgar de manera expresa, en los formatos que al efecto le sean proporcionados.</small>
                    <br>
                    <br>
                    <small class="bold">C. Transferencias de datos personales.</small>
                    <br>
                    <small>El Gobierno Municipal de Zapopan, Jalisco, no realiza transferencias de datos personales
                        sensibles, sin embargo se le informa que con la aceptación del presente aviso de privacidad, se
                        entiende que otorga su autorización para que este Responsable transfiera sus datos personales a
                        terceros sin que para ello se requiera recabar nuevamente su consentimiento, cuando la transferencia
                        se ubique en alguno de los siguientes supuestos: Cuando la transferencia esté prevista en alguna
                        Ley, convenios o Tratados Internacionales suscritos y ratificados por México; cuando la
                        transferencia se realice entre responsables, siempre y cuando los datos personales se utilicen para
                        el ejercicio de facultades propias, compatibles o análogas con la finalidad que motivó el
                        tratamiento de los datos personales; cuando la transferencia sea legalmente exigida para la
                        investigación y persecución de los delitos, así como la procuración o administración de justicia;
                        cuando la transferencia sea precisa para el reconocimiento, ejercicio o defensa de un derecho ante
                        autoridad competente, siempre y cuando medie el requerimiento de esta última; cuando la
                        transferencia sea necesaria para la prevención o el diagnóstico médico, la prestación de asistencia
                        sanitaria, tratamiento médico o la gestión de servicios sanitarios, siempre y cuando dichos fines
                        sean acreditados; cuando la transferencia sea precisa para el mantenimiento o cumplimiento de una
                        relación jurídica entre usted y el Gobierno Municipal de Zapopan, Jalisco; cuando la transferencia
                        sea necesaria por virtud de un contrato celebrado o por celebrar en interés de usted como titular,
                        por el Gobierno Municipal de Zapopan, Jalisco y un tercero; o cuando se trate de los casos en los
                        que el responsable no esté obligado a recabar el consentimiento del titular para el tratamiento y
                        transmisión de sus datos personales, conforme a lo dispuesto en el artículo 15 y 75 de la Ley de
                        Protección de Datos Personales en Posesión de Sujetos Obligados para el Estado de Jalisco y sus
                        Municipios .
                        <br>
                        Se le informa que no se consideran transferencias las remisiones, ni la comunicación de datos entre
                        las dependencias de este sujeto obligado en el ejercicio de sus atribuciones. No obstante, se hace
                        de su conocimiento que los datos personales proporcionados de manera interna también serán
                        utilizados para efectos de control interno, auditoría, fiscalización y, eventualmente, fincamiento
                        de responsabilidades y atención de asuntos contenciosos, administrativos, judiciales o laborales,
                        así como aquellos que deriven de la relación laboral-administrativa entre el servidor público y el
                        Gobierno Municipal de Zapopan, Jalisco.
                        <br>
                        Sin perjuicio de lo anterior, el Gobierno Municipal de Zapopan, Jalisco, se compromete a velar por
                        el cumplimiento de los principios de protección de datos personales establecidos por la Ley y a
                        adoptar las medidas necesarias para su aplicación, así como a exigir su cumplimiento a las personas
                        físicas o morales a los que se llegue a transferir o se conceda el acceso a sus datos
                        personales.</small>
                    <br>
                    <br>
                    <small class="bold">D. Tratamiento de los datos personales.</small>
                    <br>
                    <small>El tratamiento que se dará a sus datos personales es única y exclusivamente para los fines que
                        fue recabada en los términos de lo que establece la normatividad por la que rige al Gobierno
                        Municipal de Zapopan, Jalisco.</small>
                    <br>
                    <br>
                    <small class="bold">E. Revocación del Consentimiento.</small>
                    <br>
                    <small>Usted podrá revocar el consentimiento otorgado para el tratamiento de sus datos personales, de
                        manera personal y directa, al efecto presentándose con escrito libre, ante la Dirección de
                        Transparencia y Buenas Prácticas, la cual se ubica en la Unidad Administrativa Basílica, Plaza de
                        las Américas 2do piso, Oficina 29, teléfono 3818-2200 extensión 1237, Zapopan, Jalisco. Sin embargo,
                        es importante que considere que no en todos los casos podremos atender su solicitud o concluir el
                        uso de forma inmediata, ya que existe la posibilidad que sigamos tratando sus datos personales
                        derivado del cumplimiento de alguna obligación legal.
                        <br>
                        De la misma manera, usted deberá considerar que, para ciertos fines, la revocación de su
                        consentimiento implicará que no le podamos seguir brindando el servicio que nos fue solicitado, o
                        bien, la relación con el Gobierno Municipal de Zapopan, Jalisco, concluyó.</small>
                    <br>
                    <br>
                    <small class="bold">F. Modificaciones al aviso de privacidad.</small>
                    <br>
                    <small>El presente aviso de privacidad puede ser modificado o actualizado con motivo de nuevos
                        requerimientos legales o de las necesidades propias por los servicios que ofrecemos. Si desea
                        conocer nuestro aviso de privacidad integral lo podrá consultar a través de la página de internet de
                        este sujeto obligado, la cual es: <a href="https://www.zapopan.gob.mx/" target="_blank">
                            www.zapopan.gob.mx</a> o bien de manera presencial en nuestras instalaciones.</small>

                </div>
                <div class="modal-footer">
                    <button type="button" class="ab-btn btn-cancel" data-dismiss="modal">Cerrar</button>
                    <button class="ab-btn b-primary-color btn-acuerdo">De acuerdo</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('menu_mobile')
    {{ menu_mobil_ciudadano('nuevo_tramite') }}
@endsection

@section('css')
    @parent
    <!-- Library css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/intro.js/minified/introjs.min.css" rel="stylesheet" type="text/css" />


    <style>
        @media only screen and (max-width: 1500px) {
            .card-bombero {
                height: 10rem;
            }

            .bombero_logo_card{
                width: 100px !important;
            }
        }

        @media only screen and (min-width: 1501px) {
            .card-bombero {
                height: 9rem;
            }

            .bombero_logo_card{
                width: 110px !important;
            }
        }
    </style>

@endsection

@section('js')
    @parent

    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {

            var url = '{{ url()->current() }}';

            /**
                Menu
             */
            $('#nav .menu').click(function() {
                $('.menu-mobile').addClass('open');
            });

            $('.menu-mobile .close').click(function() {
                $('.menu-mobile').removeClass('open');
            });

            $('.card').hover(function() {
                $(this).find('.circle').addClass('animate__animated animate__headShake animate__slower');
                $(this).addClass('shadow');
            }, function() {
                $(this).find('.circle').removeClass('animate__animated animate__headShake animate__slower');
                $(this).removeClass('shadow');
            });

            $("#continuar").prop('disabled', true);

            $("#check-carta").change(function() {
                if ($(this).is(":checked")) {
                    $("#continuar").prop('disabled', false);
                    $("#continuar").addClass('b-primary-color');
                } else {
                    $("#continuar").prop('disabled', true);
                    $("#continuar").removeClass('b-primary-color');
                }
            });

            $('#form').submit(function() {
                $('button[type=submit]').prop('disabled', true);
                $('button[type=submit]').html(spiner());
            });

            $('.carta-responsiva').click(function() {
                $('#modal-carta').modal('hide');
            });


            $('.btn-acuerdo').click(function() {
                $('#check-carta').prop('checked', true);
                $("#continuar").prop('disabled', false);
                $("#continuar").addClass('b-primary-color');
                $('#modal-carta').modal('show');
                $('#modal-terminos').modal('hide');
            });

            /**
               Terminos y condiciones dinamicos
            */

            $('.card-tramite').click(function() {

                var tramite = $(this).attr('data-tramite');
                var img = $(this).attr('data-img');
                var url = $(this).attr('data-url');
                var base = "{{ url('') }}";
                var ruta = base + '/' + url;

                $('#check-carta').prop('checked', false);
                $("#continuar").prop('disabled', true);
                $("#continuar").removeClass('b-primary-color');
                $('.label-tramites').text(tramite);
                $('.img-tramite').empty();
                $('#form').attr('action', ruta);
                $('.img-tramite').html(
                    `<img src="{{ asset('media/ilustrator/${img}') }}" width="120px" alt="${tramite}">`
                );

            });

        });
    </script>
@endsection
