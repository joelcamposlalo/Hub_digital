@extends('base_admin')

@section('title', 'Revisores')

@section('menu')
{{menu_administrador('revisores')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container" style="min-height: 100%; height: 100%;">

    <div class="d-flex align-items-center">
        <a href="{{url('administrador/revisores')}}">
            <button class="back bg-warning mr-3">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="font bold">{{$accion}} Revisor</h1>
    </div>

    <section>
        <div class="row mt-4">
            <div class="col-md-8">

                <!-- Alert -->
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-4" role="alert">
                    @foreach ($errors->all() as $error)
                    <small class="block block capitalize">{{ $error }}</small> <br>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <!-- End alert -->

                <!-- Alert -->
                @if(Session::has('alert'))
                <div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3 mb-3" role="alert">
                    <small>{{session('alert.msg')}}</small>
                    <!-- @if(Session::has('alert.link'))<a href="#"><small>Activar cuenta</small></a>@endif -->
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <!-- End alert -->

                <div class="card">
                    <div class="card-header">
                        <small class="font">Datos del revisor</small>
                    </div>
                    <div class="card-body">
                        @if($accion != 'Editar')
                        <form id="form" action="{{url('revisor/post')}}" method="post">
                            @else
                            <form id="form" action="{{url('revisor/put')}}" method="post">
                                <input type="hidden" name="id_usuario" value="{{$usuario->id_usuario}}">
                                <input type="hidden" name="id_rol_usuario" value="{{$usuario->id_rol_usuario}}">
                                <input type="hidden" name="id_rol_etapa" value="{{$usuario->id_rol_etapa}}">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Nombre</small></label>
                                        <input id="correo" type="text" name="nombre" class="ab-form background-color font" value="@if($accion == 'Editar'){{$usuario->nombre}}@endif" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Apellido paterno</small></label>
                                        <input id="correo" type="text" name="primer_apellido" class="ab-form background-color font" value="@if($accion == 'Editar'){{$usuario->primer_apellido}}@endif" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label><small>Apellido materno</small></label>
                                        <input id="correo" type="text" name="segundo_apellido" class="ab-form background-color font" value="@if($accion == 'Editar'){{$usuario->segundo_apellido}}@endif" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Correo</small></label>
                                        <input id="correo" type="email" name="correo" class="ab-form background-color font" value="@if($accion == 'Editar'){{$usuario->correo}}@endif" data-parsley-type="email" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Contraseña</small></label>
                                        <input id="contrasena" type="password" name="contrasena" class="ab-form background-color font" value="" @if($accion !='Editar' )required @endif data-parsley-minlength="8">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label><small>Confirmar contraseña</small></label>
                                        <input id="ccontrasena" type="password" name="ccontrasena" class="ab-form background-color font" value="" @if($accion !='Editar' ) required @endif data-parsley-equalto="#contrasena" data-parsley-minlength="8">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 mt-3">
                                        <label><small>Estatus</small></label>
                                        <select name="estatus" class="ab-form background-color">
                                            <option value="activo" class="font" @if($accion=='Editar' ) @if($usuario->estatus == 'activo') selected @endif @endif >Activo</option>
                                            @if($accion == 'Editar')<option value="suspendido" class="font" @if($accion=='Editar' ) @if($usuario->estatus == 'suspendido') selected @endif @endif >Suspendido</option> @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label><small>Trámites</small></label>
                                        <select name="tramite" class="ab-form background-color">
                                            @foreach($tramites as $tramite)
                                            <option value="{{$tramite->id_tramite}}" class="font" @if($accion=='Editar' ) @if($usuario->id_tramite == $tramite->id_tramite) selected @endif @endif > {{$tramite->tramite}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Número de empleado</small></label>
                                        <input type="number" name="num_empleado" class="ab-form background-color font" value="@if($accion == 'Editar'){{$usuario->num_empleado}}@endif" @if($accion !='Editar' ) required @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right mt-4">
                                        <button type="submit" class="ab-btn bg-warning c-negro guardar">@if($accion == 'Agregar') Guardar @else Editar @endif</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection


@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/administrador/revisores.css')}}">
@endsection

@section('js')
@parent
<script>
    $(document).ready(function() {

        $('#form').parsley();

        $('.card').hover(function() {
            $(this).addClass('shadow');
        }, function() {
            $(this).removeClass('shadow');
        });

        $('[data-toggle="tooltip"]').tooltip()

        $('#form').submit(function(e) {

            $('.guardar').prop('disabled', true);
            $('.guardar').html(spiner());

        });


    });
</script>
@endsection