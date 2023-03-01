@extends('base_admin')

@section('title', 'Días Inhabiles')

@section('menu')
{{menu_administrador('revisores')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container" style="min-height: 100%; height: 100%;">

    <div class="d-flex align-items-center">
        <a href="{{url('administrador/dias_inhabiles')}}">
            <button class="back bg-warning mr-3">
                <i class="fas fa-arrow-left"></i>
            </button>
        </a>
        <h1 class="font bold">{{$accion}} día inhábil</h1>
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
                        <small class="font">Día inhábil</small>
                    </div>
                    <div class="card-body">
                        @if($accion != 'Editar')
                        <form id="form" action="{{url('dias_inhabiles/post')}}" method="post">
                            @else
                            <form id="form" action="{{url('dias_inhabiles/put')}}" method="post">
                                <input type="hidden" name="id_dia" value="{{$usuario->id_dia}}">
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label><small>Fecha</small></label>
                                        <input id="fecha" type="text" name="fecha" class="ab-form background-color font" value="@isset($usuario->fecha){{$usuario->fecha}}@endisset" autocomplete="off" required>
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
                                    <div class="col-md-12 mt-3">
                                        <label><small>Descripción</small></label>
                                        <textarea class="ab-form background-color p-2" name="descripcion" required>@isset($usuario->fecha){{$usuario->desc}}@endisset</textarea>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('js')
@parent
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        @if($accion != 'Editar')
        var fecha = $("#fecha").flatpickr({
            mode: "multiple",
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);

                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            },
            conjunction: ":",
            minDate: "today"
        });

        @else
        var fecha = $("#fecha").flatpickr({
            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);

                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            },
            conjunction: ":",
            minDate: "today"
        });
        @endif


    });
</script>
@endsection