@extends('base')

@section('title', 'Reportes')

@section('aside')
{{menu_revisor('reportes')}}
@endsection


@section('notification')
{{get_notificaciones()}}
@endsection


@section('container')
<h1 class="text-muted font m-0 bold c-primary-color">Reportes</h1>
<small class="font text-muted mb-5">Estadística de trámite por fecha</small>

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
        <div class="col-md-3 mt-4">
            <input type="text" class="ab-form border rounded" name="search" id="fecha_inicio" autocomplete="off" placeholder="Fecha inicio">
        </div>
        <div class="col-md-3 mt-4">
            <input type="text" class="ab-form border rounded" name="search" id="fecha_fin" autocomplete="off" placeholder="Fecha fin">
        </div>
        <div class="col-md-2 mt-4 d-flex align-items-center">
            <button class="ab-btn ab-form font b-primary-color text-white rounded ml-3 filtrar d-flex justify-content-center">Filtrar</button>
        </div>
    </div>
    <div class="graficas mt-3">
        <div class="row">
            <div class="col-md-6 mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <small>Grafica</small>
                    </div>
                    <div class="card-body">
                        <canvas id="grafica1" width="800" height="450"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('menu_mobile')
{{menu_mobil_revisor('')}}
@endsection

@section('css')
@parent
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('vendors/chart/dist/Chart.min.css')}}">
@endsection

@section('js')
@parent
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('vendors/chart/dist/Chart.min.js')}}"></script>
<script>
    $(document).ready(function() {

        var url = '{{url()->current()}}';
        var chart = '';


        $('#nav .menu').click(function() {
            $('.menu-mobile').addClass('open');
        });

        $('.menu-mobile .close').click(function() {
            $('.menu-mobile').removeClass('open');
        });

        var fecha_inicio = $("#fecha_inicio").flatpickr({
            onChange: function(selectedDates, dateStr, instance) {
                fecha_final.set('minDate', dateStr);
            },
        });

        var fecha_final = $("#fecha_fin").flatpickr({
            onChange: function(selectedDates, dateStr, instance) {
                fecha_inicio.set('maxDate', dateStr);
            },
        });


        function removeData(chart) {

            let total = chart.data.labels.length;

            while (total >= 0) {
                chart.data.labels.pop();
                chart.data.datasets[0].data.pop();
                total--;
            }

            chart.update();
        }


        $('.filtrar').click(function() {

            $(this).prop('disabled', true);
            $(this).html(spiner());
            var inicio = $("#fecha_inicio").val();
            var fin = $("#fecha_fin").val();

            get_data(inicio, fin);

        });


        const get_data = (inicio = '', fin = '') => {

            if (chart != '') {
                removeData(chart);
            }

            axios.post("{{url('graficas/solicitudes_estatus')}}", {
                'fecha_inicio': inicio,
                'fecha_fin': fin,
                'id_tramite': '{{session("id_coordinacion")}}'
            }).then(function(response) {

                var response = response.data;

                var label = [];
                var total = [];

                response.forEach(element => {
                    label.push(capitalize(element.estatus));
                    total.push(element.total);
                });

                chart = new Chart(document.getElementById("grafica1"), {
                    type: 'pie',
                    data: {
                        labels: label,
                        datasets: [{
                            label: "",
                            backgroundColor: ["#8869a5", "#c58ade", "#b1beea", "#90c4e9", "#8095ce"],
                            data: total
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Solicitudes por trámite'
                        }
                    }
                });

                $('.filtrar').prop('disabled', false);
                $('.filtrar').text('Filtrar');

            }).catch(function(error) {
                console.log(error);
                $('.filtrar').prop('disabled', false);
                $('.filtrar').text('Filtrar');
            });
        }

        get_data();

        function capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }


    });
</script>

</script>
@endsection