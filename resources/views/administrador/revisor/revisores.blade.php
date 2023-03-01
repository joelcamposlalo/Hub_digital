@extends('base_admin')

@section('title', 'Revisores')

@section('menu')
{{menu_administrador('revisores')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container" style="min-height: 100%; height: 100%; padding: 0 20px;">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center">
            <h1 class="font bold">Revisores</h1>
        </div>
    </div>
    <section>
        <div class="row">
            <div class="col">

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



                @if($revisores != '[]')
                <div class="responsive mt-4" style="width: 100%; overflow-x: auto;">
                    <table class="mt-3">
                        <tr>
                            <th class="text-muted f-15">ID usuario</th>
                            <th class="text-muted f-15">Correo</th>
                            <th class="text-muted f-15">Estatus</th>
                            <th class="text-muted f-15">Trámite</th>
                            <th class="text-muted f-15">Acciones</th>
                        </tr>
                        @foreach($revisores as $revisor)
                        <tr>
                            <td class="f-14">{{$revisor->id_usuario}}</td>
                            <td class="f-14">{{$revisor->correo}}</td>
                            <td class="f-14"><span class="badge badge-pill @if($revisor->estatus == 'activo') badge-success @else bg-warning @endif mt-2">{{Str::ucfirst($revisor->estatus)}}</span></td>
                            <td class="f-14">{{Str::ucfirst($revisor->tramite)}}</td>
                            <td class="f-14 acciones">

                                <a href="{{url('revisor/form/Editar')}}/{{$revisor->id_usuario}}" class="text-decoration-none">
                                    <div class="enlace pointer" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-pencil-alt c-negro"></i>
                                    </div>
                                </a>
                                <!--
                                <div class="enlace pointer ml-2 btn-delete" data-id="{{$revisor->id_usuario}}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                    <a href="#">
                                        <i class="fas fa-trash c-negro"></i>
                                    </a>
                                </div>
                                -->

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <p class="font text-center text-muted f-14 mt-5">No hay revisores para mostrar | <a href="{{url('revisor/form/Agregar')}}">Agregar revisor</a></p>
                @endif
            </div>
        </div>
    </section>

    <!-- Btn float -->
    <a href="{{url('revisor/form/Agregar')}}" class="btn-float bg-warning c-negro mt-5 d-flex justify-content-center align-items-center text-decoration-none"><i class="fas fa-plus"></i></a>

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

        var url = '{{url()->current()}}';

        $('.card').hover(function() {
            $(this).addClass('shadow');
        }, function() {
            $(this).removeClass('shadow');
        });

        $('[data-toggle="tooltip"]').tooltip()

        /*
        $('.btn-delete').click(function() {
            var id_archivo = $(this).attr('data-id');

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                zindex: 999,
                title: '{{session("nombre")}}',
                message: '¿Desea eliminar el revisor?',
                position: 'center',
                backgroundColor: '#ff9b93',
                buttons: [
                    ['<button class="cerrar"><b>No, cerrar<b></button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                    [`<button class="delete">Si, eliminar</button>`, async function(instance, toast) {


                        $('.cerrar').hide();
                        $('.delete').prop('disabled', true);
                        $('.delete').html(spiner());

                        var response = await axios.post('{{url("ciudadano/delete_file")}}', {
                            "_token": "{{ csrf_token() }}",
                            'id_archivo': id_archivo,
                            'name': name,
                        }).then(function(response) {
                            console.log(response);
                        }).catch(function(error) {
                            iziToast.show({
                                title: 'Ups ☹️',
                                message: 'Ocurrió un problema al tratar de eliminar el archivo',
                                backgroundColor: '#ff9b93',
                                closeOnEscape: true
                            });
                        });


                        window.location.href = '{{url()->current()}}';

                    }, true]
                ]
            });
        });
        */

    });
</script>
@endsection