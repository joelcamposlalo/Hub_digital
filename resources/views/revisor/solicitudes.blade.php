@extends('base')

@section('title', 'Solicitudes')

@section('aside')
{{menu_revisor('solicitudes')}}
@endsection


@section('notification')
{{get_notificaciones()}}
@endsection


@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Solicitudes</h1>
<small class="font text-muted mb-5">Sección en la cual podrás ver todas las solicitudes pendientes por revisar.</small>

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
    <div class="row">
        <div class="col-md-4 mt-4">
            <input type="text" class="ab-form border rounded" name="search" id="search" autocomplete="off" placeholder="Buscar registro">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <button class="f-10 ab-btn-small active" data-estatus="en revision" style="border-radius: 30px !important;">Pendientes</button>
            <button class="f-10 ab-btn-small" data-estatus="no autorizado" style="border-radius: 30px !important;">No autorizados</button>
            <button class="f-10 ab-btn-small" data-estatus="autorizado" style="border-radius: 30px !important;">Autorizados</button>
        </div>
    </div>
    <p class="font text-center text-muted f-14 mt-5 ocultar no-tramites">No hay solicitudes por revisar</p>
    <div class="responsive ocultar" style="width: 100%; overflow-x: auto;">
        <table class="mt-3">
            <tr class="table-header">
                <th class="text-muted f-15">Folio</th>
                <th class="text-muted f-15">Trámite</th>
                <th class="text-muted f-15">Estatus</th>
                <th class="text-muted f-15">Progreso</th>
                <th class="text-muted f-15">Acciones</th>
            </tr>
            <tbody class="table-body">
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('menu_mobile')
{{menu_mobil_revisor('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/ciudadano/tramites.css')}}">
<link rel="stylesheet" href="{{asset('vendors/loading/loading-bar.min.css')}}">
@endsection

@section('js')
@parent
<script src="{{asset('vendors/loading/loading-bar.min.js')}}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';
        var text = '';
        var cambio = false;
        var timer_id = null;
        var total = 0;
        var estatus = 'en revision';


        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        $('#search').keyup(function() {
            text = $(this).val();
            get_all();
        });


        //Filtros
        $('.ab-btn-small').click(function() {
            $('.ab-btn-small').removeClass('active');
            $(this).addClass('active');
            estatus = $(this).attr('data-estatus');
            get_all();
        });


        const get_all = () => {

            axios.post('{{url("solicitud/get_all")}}', {
                'search': text,
                'filtro': estatus
            }).then(function(response) {
                console.log(response.data);

                //console.log(typeof(response));
                total = Object.keys(response.data).length;

                if (total > 0) {

                    $('.tramites').remove();
                    $('.responsive').show();
                    $('.no-tramites').hide();

                    // console.log(response.data);                    
                    response.data.forEach(element => {

                        $('.table-body').append(plantilla(element.id_solicitud, element.tramite, element.estatus, element.porcentaje, element.paso, element.id_tramite, element.id_captura, element.id_etapa));
                        var bar = new ldBar(`.element_${element.id_solicitud}`);
                        bar.set(element.porcentaje);
                    });

                } else {
                    $('.tramites').empty();
                    $('.responsive').hide();
                    $('.no-tramites').show();
                }

            }).catch(function(error) {
                console.log(error);
            });
        }


        get_all();


        setInterval(() => {

            get_all();

            if (total > (localStorage.getItem('count') == null || localStorage.getItem('count') == '' ? 0 : localStorage.getItem('count'))) {

                timer_id = window.setInterval(() => {

                    clearInterval(timer_id);

                    var dif = total - (localStorage.getItem('count') == null || localStorage.getItem('count') == '' ? 0 : localStorage.getItem('count'));

                    if (cambio) {
                        if (dif > 1) {
                            document.title = `(${dif}) 🔔 Nuevas solicitudes`;
                        } else if (dif == 1) {
                            document.title = `(${dif}) 🔔 Nueva solicitud`;
                        } else {
                            clearIntervalo();
                        }

                        cambio = false;
                    } else {
                        document.title = `Solicitudes`;
                        cambio = true;
                    }

                }, 1500);

            } else {
                clearIntervalo();
            }

        }, 15000);


        $('body, html').mousemove(function() {
            clearIntervalo();
        });



        const clearIntervalo = () => {
            clearInterval(timer_id);
            document.title = `Solicitudes`;
            cambio = false;
            localStorage.setItem('count', total)
        }


        const plantilla = (id_solicitud, tramite, estatus, porcentaje, paso, id_tramite, id_captura, id_etapa) => {

            return `
            <tr class="tramites">
                <td class="f-14">${id_solicitud}
                        <small class="font text-muted mb-5">-PRECAPTURA:
                            ${id_captura}</small>
                </td>
                <td class="f-14">${tramite}</td>
                <td class="f-14"><span class="badge badge-pill mayuscula mt-2" style="background-color: ` + ((estatus == 'autorizado') ? '#28a745' : ((estatus == 'pendiente' || estatus == 'en revision') ? '#ffc107' : '#fa9579')) + `
                    ">${estatus}</span></td>
                <td class="f-14">
                    <div class="ldBar label-center element_${id_solicitud}" data-preset="fan" data-value="${porcentaje}" data-stroke=" ` + ((porcentaje >= 50) ? '#28a745' : '#fa9579') + ` "></div>
                </td>
                <td class="f-14 acciones">
                    <form action="{{url('revisor/detalle')}}" method="post">
                        @csrf
                        <input type="submit" class="ab-btn b-primary-color text-white" value="Revisar">
                        <input type="hidden" name="id_solicitud" value="${id_solicitud}">
                        <input type="hidden" name="id_tramite" value="${id_tramite}">   
                        <input type="hidden" name="id_etapa" value="${id_etapa}">                     
                    </form>
                </td>
            </tr>
                `;
        }


    });
</script>

</script>
@endsection