@extends('base_admin')

@section('title', 'Reportes')

@section('menu')
{{menu_administrador('reportes')}}
@endsection


@section('notification')
3
@endsection

@section('container')
<div class="container position-relative" style="padding: 0 20px;">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center">
            <h1 class="font bold">Reportes</h1>
        </div>
    </div>
    <section>
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
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <canvas id="grafica" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/administrador/predios.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('vendors/chart/dist/Chart.min.css')}}">
@endsection

@section('js')
@parent
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('vendors/chart/dist/Chart.min.js')}}"></script>
<script>
    $(document).ready(function() {

        var chart = '';

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

            axios.post("{{url('graficas/solicitudes_revisor')}}", {
                'fecha_inicio': inicio,
                'fecha_fin': fin,
                'id_tramite': '{{session("id_coordinacion")}}'
            }).then(function(response) {

                var response = response.data;

                var label = [];
                var total = [];

                response.forEach(element => {
                    label.push(`${element.estatus.charAt(0).toUpperCase() + element.estatus.slice(1)} ${element.correo}`);
                    total.push(element.total);
                });

                chart = new Chart(document.getElementById("grafica"), {
                    type: 'bar',
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
                            text: 'Solicitudes concluidas'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    stepSize: 1,
                                    beginAtZero: true,
                                },
                            }],
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

    });
</script>
@endsection