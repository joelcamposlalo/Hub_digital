@extends('base')

@section('title', 'Mis notificaciones')

@section('aside')
{{menu_ciudadano('')}}
@endsection

@section('notification')
{{get_notificaciones()}}
@endsection

@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Mis notificaciones</h1>
<small class="font text-muted mb-5">En cada notificación encontrarás tres puntos, da click en ellos para marcar como leída o eliminar la notificación.</small>

@forelse($notificaciones as $notificacion)
<div class="row notificacion">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-body position-relative p-4">
                <span class="badge badge-pill badge-warning mt-2">{{$notificacion->tramite}}</span>
                <h4 class="font mb-0 c-negro bold">{{$notificacion->titulo}}</h4>
                <small class="text-muted font f-10 d-block">{{$notificacion->fecha}}</small>
                <small class="text-muted font f-10 d-block">Folio: {{$notificacion->id_solicitud}}</small>
                <small class="font">{!! $notificacion->desc !!}</small>
                @if($notificacion->visto == false)
                <div class="visto position-absolute rounded" style="width: 4px; height: 50px; background-color: #ffc107; top: 0; left: 0; margin-top: 30px;"></div>
                @endif
                <div class="dropdown position-absolute" style="top: 0; right: 0;">
                    <svg id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" width="2em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical m-3 pointer p-1 dropdown-toggle c-negro" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        @if($notificacion->visto == false)
                        <a class="dropdown-item btn-leido" data-id="{{$notificacion->id_notificacion}}" href="#!">Marcar como leído</a>
                        @endif
                        <a class="dropdown-item btn-eliminar" data-id="{{$notificacion->id_notificacion}}" href="#!">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<p class="font text-center text-muted f-14 mt-5">No hay notificaciones para mostrar</p>
@endforelse
@endsection

@section('menu_mobile')
{{menu_mobil_ciudadano('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/ciudadano/tramites.css')}}">
@endsection

@section('js')
@parent
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';


        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('.dropdown-toggle').dropdown()


        //Marcar como leído
        $('.btn-leido').click(async function() {

            var id_notificacion = $(this).attr('data-id');
            var me = $(this);

            await axios.post('{{url("notificaciones/visto")}}', {
                "_token": "{{ csrf_token() }}",
                "id_notificacion": id_notificacion
            }).then(function(response) {

                var notificacion = $('.count').text();
                $('.count').text(notificacion - 1);

                me.parents('.dropdown').siblings('.visto').fadeOut('slow', function() {
                    $(this).remove();
                });

                me.remove();


            }).catch(function(error) {

                console.log(error);
            });
        });

        //Eliminar
        $('.btn-eliminar').click(async function() {

            var id_notificacion = $(this).attr('data-id');
            var me = $(this);

            await axios.post('{{url("notificaciones/eliminar")}}', {
                "_token": "{{ csrf_token() }}",
                "id_notificacion": id_notificacion
            }).then(function(response) {

                me.parents('.notificacion').fadeOut('slow', function() {
                    $(this).remove();
                });

                location.reload(url);

            }).catch(function(error) {

                console.log(error);
            });

        });
    });
</script>
@endsection