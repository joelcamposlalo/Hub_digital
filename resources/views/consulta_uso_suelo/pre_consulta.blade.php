@extends('base')

@section('title', 'Solicitud')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')

<h1 class="text-muted font m-0 bold c-primary-color">Pre-Consulta de uso de suelo</h1>
<small class="font text-muted mb-5">Folio de trámite: </small>

<div class="row mt-5">
    <div class="col-md-9">
        <div class="etapas d-flex justify-content-center align-items-center">
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border active d-flex justify-content-center align-items-center">
                    <div class="success d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="45_3 bi bi-check2 bold text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="font f-16 bold text-white">1</small>
                </div>
                <small class="font c-carbon f-11 text-center">Carta responsiva</small>
            </div>
            <div class="line"></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="46_1 etapa process border d-flex justify-content-center align-items-center">
                    <div class="46_2 d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="46_3 bi bi-check2 bold text-white ocultar " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="46_4 font f-16 bold text-muted">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-13 text-center">Consulta</small>
            </div>
            <div class="47  line_off "></div>
            <div style="width: 80px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="47_1 etapa border d-flex justify-content-center align-items-center">
                    <div class="47_2  d-flex justify-content-center align-items-center">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="47_3 bi bi-check2 bold text-white ocultar" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                    <small class="47_4 font f-16 bold  text-muted ">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-12 text-center">Inicia trámite</small>
            </div>
        </div>
    </div>
</div>

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
                            <tbody class="table-body">
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
                            </tbody>
                        </table>
                        <input type="hidden" id='ultimo' value="{{$ultimo}}">
                        <nav aria-label="Page navigation mt-2">
                            @if($ultimo>=6)
                            <ul class="pagination justify-content-end small mr-2">
                                <li class="page-item disabled antLi"><a class="page-link anterior" href="#">Anterior</a></li>
                                <li class="page-item sigLi"><a class="page-link siguiente" href="#">Siguiente</a></li>
                            </ul>
                            @endif
                        </nav>
                    </div>


                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="" class="font f-11 d-inline text-decoration-none agregar mt-4">¿Aun no agregas tu predio? Agregalo aquí</a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button class="ab-btn b-primary-color continuar_lista_predio ocultar" type="submit" data-cuenta="">Continuar</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="col-md-3 mt-4 position-absolute" style="right: 0;">

        <!-- Si tiene adeudo pone link para pago-->
        <div class="alert alert-warning alert-dismissible fade show mt-3 linkPago" role="alert">
            <strong class="f-11">Importante:</strong> <small class="f-11">Tu cuenta <div class="txtCuenta bold" style="overflow-wrap: break-word;"></div> presenta adeudo predial. Puedes realizar tu pago <a href="https://pagos.zapopan.gob.mx/PagoEnLinea/#/busqueda-del-predio" target="_blank">aquí</a></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9 mt-4" id="top-2">
        <div class="card  shadow-sm card_2 rounded border-none">
            <div class="card-header">
                <small>Datos</small>
            </div>
            <div class="card-body">
                <form id='form' action="">
                    <div class="row" id="notaCuenta">
                        <div class="col-md-12 mt-4">
                            <div class="alert alert-warning alert-dismissible fade show " role="alert">
                                <strong class="f-11">Nota:</strong> <small class="f-11"> El sistema calcula automáticamente las coordenadas con base en tu dirección. En caso de no ser el domicilio por favor coloca el marcador en el lugar correcto</small>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="cuenta"><small>Cuenta predial</small></label>
                            <input name="cuenta" id="cuenta" value="" class="ab-form background-color rounded border cuenta" type="text" data-parsley-type="number" data-parsley-minlength="10" maxlength="10" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="curt">CURT<small></small></label>
                            <input name="curt" id="curt" value="" class="ab-form background-color rounded border curt" type="text" data-parsley-type="number" data-parsley-minlength="31" maxlength="31" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calleNegocio"><small>Calle principal</small></label>
                            @if(isset($calleNegocio))
                            @foreach($calles as $calle)
                            @if ($calleNegocio == $calle->IdCalle)
                            <input name="calleNegocio" id="calleNegocio" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="calleNegocio" id="calleNegocio" class="ab-form background-color rounded border calleNegocio" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="noExterior"><small>Número exterior</small></label>
                            <input name="noExterior" id="no_exterior" value="" class="ab-form background-color rounded border noExterior" type="text" data-parsley-type="number" required>
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letraExterior"><small>Letra exterior</small></label>
                            <input name="letraExterior" id="letra_exterior" value="" class="ab-form background-color rounded border letraExterior" type="text">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="noInterior"><small>Número interior</small></label>
                            <input name="noInterior" id="no_interior" value="" class="ab-form background-color rounded border noInterior" type="text" data-parsley-type="number" >
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="letraInterior"><small>Letra interior</small></label>
                            <input name="letraInterior" id="letra_interior" value="" class="ab-form background-color rounded border letraInterior" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="coloniaNegocio"><small>Colonia</small></label>
                            @if(isset($coloniaNegocio))
                            @foreach($colonias as $colonia)
                            @if ($coloniaNegocio == $colonia->IdColonia)
                            <input name="coloniaNegocio" id="coloniaNegocio" value="{{$colonia->NombreColonia}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="coloniaNegocio" id="coloniaNegocio" class="ab-form background-color rounded border coloniaNegocio" required>
                                <option value="">Seleccione la Colonia</option>
                                @foreach($colonias as $colonia)
                                <option value="{{ $colonia->IdColonia }}">{{ $colonia->NombreColonia }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="PlazaComercial"><small>Plaza comercial / Mercado</small></label>
                            @if(isset($plazaCom))
                            @foreach($plazas as $plaza)
                            @if ($plazaComercial == $plaza->IdPlaza)
                            <input name="PlazaComercial" id="PlazaComercial" value="{{$plaza->NombrePlaza}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="PlazaComercial" id="PlazaComercial" class="ab-form background-color rounded border PlazaComercial">
                                <option value="">Seleccione la Plaza</option>
                                @foreach($plazas as $plaza)
                                <option value="{{ $colonia->IdColonia }}">{{ $plaza->NombrePlaza }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="calleIzquierda"><small>Calle izquierda</small></label>
                            @if(isset($calleIzquierda))
                            @foreach($calles as $calle)
                            @if ($calleIzquierda == $calle->IdCalle)
                            <input name="calleIzquierda" id="calleIzquierda" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="calleIzquierda" id="calleIzquierda" class="ab-form background-color rounded border calleIzquierda" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="calleDerecha"><small>Calle derecha</small></label>
                            @if(isset($ComCalleNegocio))
                            @foreach($calles as $calle)
                            @if ($ComCalleNegocio == $calle->IdCalle)
                            <input name="calleDerecha" id="calleDerecha" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="calleDerecha" id="calleDerecha" class="ab-form background-color rounded border calleDerecha" required>
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
                            <label for="callePosterior"><small>Calle posterior</small></label>
                            @if(isset($callePosterior))
                            @foreach($calles as $calle)
                            @if ($ComCallePosterior == $calle->IdCalle)
                            <input name="callePosterior" id="callePosterior" value="{{$calle->NombreOficial}}" class="ab-form background-color rounded border" type="text" readonly>
                            @endif
                            @endforeach
                            @else
                            <select name="callePosterior" id="callePosterior" class="ab-form background-color rounded border callePosterior" required>
                                <option value="">Seleccione la calle</option>
                                @foreach($calles as $calle)
                                <option value="{{ $calle->IdCalle }}">{{ $calle->NombreOficial }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="cp"><small>CP</small></label>
                            <input name="cp" id="calle" value="" class="ab-form background-color rounded border cp" type="text" data-parsley-type="number" data-parsley-minlength="5" maxlength="5" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="superficie"><small>Superficie en m<sup>2</sup> del local</small></label>
                            <input name="superficie" id="superficie" value="" class="ab-form background-color rounded border superficie" type="text" data-parsley-type="number" required>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="giro"><small>Giro principal</small></label>
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
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="border rounded mapa1" id="map"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right mt-4">
                            <input type="hidden" name="latitud" id="latitud" class="latitud">
                            <input type="hidden" name="longitud" id="longitud" class="longitud">
                            <button data-back=".card_1 .card-body" type="button" class="ab-btn btn-cancel btn-regresar">Regresar</button>
                            <button class="ab-btn b-primary-color" type="submit" data-cuenta="">Continuar</button>
                        </div>
                    </div>
                </form>
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
<script src="https://unpkg.com/intro.js/minified/intro.min.js" type="text/javascript"></script>
<script src="{{asset('vendors/lightbox/dist/js/lightbox.min.js')}}"></script>

<script>
    $(document).ready(function() {

        var n = 0;

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

        $('#form').parsley();

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

        $(document).on('click', '.btn-seleccionar', function() {
            var cuenta = $(this).parent('td').siblings('td').find('input[type=checkbox]').parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).parent('td').siblings('td').find('input[type=checkbox]').prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');
            $('.cuenta').prop('readonly', true);
            $('.curt').prop('readonly', true);
        });
        $(document).on('change', 'input[type=checkbox]', function() {
            var cuenta = $(this).parents('td').attr('data-cuenta');
            $('td').find('input[type=checkbox]').prop('checked', false);
            $(this).prop('checked', true);
            $('.continuar_lista_predio').attr('data-cuenta', cuenta);
            $('.continuar_lista_predio').fadeIn('fast');
            $('.cuenta').prop('readonly', true);
            $('.curt').prop('readonly', true);
        });

        $('.continuar_lista_predio').click(function(e) {
            e.preventDefault();
            $(this).html('Cargando...');
            $('#notaCuenta').addClass('ocultar');
            $('.cuenta').attr('readonly', true);

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
                    message: 'Debes seleccionar una cuenta predial o CURT para poder continuar',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });


                $('.btn-buscar').prop('disabled', false);
                $('.btn-buscar').text("Buscar predio");
                $('.continuar_lista_predio').val('Continuar');

            }
        });

        $('.agregar').click(function(e) {
            e.preventDefault()
            $('.card_1 .card-body').slideUp('slow');
            $('.card_2 .card-body').slideDown('slow');
            $('.cuenta').val('');
            $('.curt').val('');
            $('.cuenta').prop('readonly', false);
            $('.curt').prop('readonly', false);
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

                            $('.cuenta').val(response[0].precuentapredialant);
                            $('.curt').val(response[0].precuentapredial);

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
                    console.log('error');
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


    function limpia_predio() {


    }

    function limpia_form() {

    }

    var marker;

    function initMap() {

        var coordenadas = {
            lat: 20.6785454,
            lng: -103.4275859
        }

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


        if (typeof(marker) != 'undefined') {
            markers.push(marker);
            marker.setMap(map);
            google.maps.event.addListener(marker, 'dragend', function(event) {
                $('.latitud').val(event.latLng.lat());
                $('.longitud').val(event.latLng.lng());
            });
        }

        const geocoder = new google.maps.Geocoder(); //Creamos la instancia de geocoder

        $('.cp').blur(function() {

            var calle = $('.calleNegocio option:selected').text();
            var numext = $('.noExterior').val();
            var colonia = $('.coloniaNegocio option:selected').text();
            var municipio = 'Zapopan, Jalisco';

            var address = `${calle} #${numext}, ${colonia} , ${municipio}`;

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
                    marker.setMap(map);

                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        $('.latitud').val(event.latLng.lat());
                        $('.longitud').val(event.latLng.lng());

                    });

                } else {
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
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFfTN8foLoOUQvRGBJPGVHHbo9PYoDY84&callback=initMap"></script>
@endsection