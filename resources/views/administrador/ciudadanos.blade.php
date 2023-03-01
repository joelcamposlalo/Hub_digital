@extends('base_admin')

@section('title', 'Ciudadanos')

@section('menu')
{{menu_administrador('ciudadanos')}}
@endsection

@section('notification')
3
@endsection

@section('container')
<div id="content" class="container position-relative">
    <div class="row">
        <div class="col d-flex justify-content-between align-items-center container-search">
            <h1 class="font bold">Ciudadanos</h1>
            <input type="text" name="" class="ab-form rounded border search" placeholder="Buscar ciudadano (Nombre, Teléfono, Correo)" autocomplete="off">
        </div>
    </div>
    <section>
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-4 ciudadanos_container">
                </div>
                <p class="font text-left ver more"><a href="#!" class="text-decoration-none font f-13">Ver más</a></p>
            </div>
        </div>
    </section>
    <p class="font text-center text-muted f-14 mt-4 ocultar">No hay registros para mostrar</p>
</div>
@endsection


@section('css')
@parent
<link rel="stylesheet" href="{{asset('css/administrador/ciudadano.css')}}">
@endsection

@section('js')
@parent

<script>
    $(document).ready(function() {

        var total = 6;
        var next_page_url = `{{url('')}}/ciudadano/get_by_name?page=1`;
        var activo = false;

        $('.card').hover(function() {
            $(this).addClass('shadow');
        }, function() {
            $(this).removeClass('shadow');
        });

        $('.more').click(function() {
            if (activo) {
                get_ciudadanos(next_page_url);
            }
        });


        $('.search').keyup(function(e) {

            if (e.keyCode == 13) {
                next_page_url = `{{url('')}}/ciudadano/get_by_name?page=1`;
                $('.ciudadanos_container').empty();
                get_ciudadanos(next_page_url);
            }

        });


        const get_ciudadanos = (url) => {

            $('.ver').show();
            $('.ver a').text('Cargando...');
            $('.ocultar').hide();
            activo = false;


            axios.post(url, {
                total: total,
                name: $('.search').val().trim()
            }).then(function(response) {


                ($('.search').val().trim() == '' ? $('.ver a').text('Ver más') : $('.ver').hide());

                if ($('.search').val().trim() == '') {

                    if (Object.keys(response.data.data).length > 0) {

                        if (response.data.next_page_url != null) {
                            next_page_url = response.data.next_page_url;
                        } else {
                            $('.ver').hide();
                        }

                        response.data.data.forEach(element => {
                            $('.ciudadanos_container').append(plantilla(element.id_usuario, element.perfil, element.nombre, element.razon_social, element.solicitudes, element.predios, element.telefono));
                        });

                        activo = true;

                    } else {
                        $('.ver').hide();
                        $('.ocultar').show();
                        $('.ciudadanos_container').empty();
                    }
                } else {

                    $('.ciudadanos_container').empty();

                    if (Object.keys(response.data).length > 0) {
                        $('.ciudadanos_container').empty();
                        response.data.forEach(element => {
                            $('.ciudadanos_container').append(plantilla(element.id_usuario, element.perfil, element.nombre, element.razon_social, element.solicitudes, element.predios, element.telefono));
                        });
                    } else {
                        $('.ver').hide();
                        $('.ocultar').show();
                        $('.ciudadanos_container').empty();
                    }
                }

            }).catch(function(error) {
                iziToast.show({
                    title: 'Ups ☹️',
                    message: 'Ocurrió un problema al tratar de obtener la información',
                    backgroundColor: '#ff9b93',
                    closeOnEscape: true
                });
                console.log(error);
            });

        }

        get_ciudadanos(next_page_url);


        const plantilla = (id_usuario, perfil, nombre, razon_social, solicitudes, predios, telefono) => {


            if (perfil != null && perfil != '') {
                perfil = `{{Storage::disk('s3')->url('public') }}/${id_usuario}/${perfil}`;
            } else {
                perfil = "{{asset('media/flaticon/avatar.svg')}}";
            }

            return `
            <div class="col-md-6 col-sm-6 col-l-4 mt-4">
                <a href="{{url('administrador/detalle/${id_usuario}')}}" class="text-decoration-none">
                    <div class="card card-ciudadano">
                        <div class="card-body">
                            <div class="circle">
                                <img src="${perfil}" alt="avatar">
                            </div>
                            <h6 style="width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="font bold mt-3 mb-0 text-decoration-none text-center text-truncate" title="${ nombre != '' ? nombre : razon_social }"> ${ nombre != '' ? nombre : razon_social } </h6>
                            <small class="text-muted mb-2">${telefono}</small>
                            <small class="badge bg-warning text-dark f-10 p-2 pointer">Ver detalle</small>
                            <div class="row cuadros mt-3">
                                <div class="col p-3 d-flex flex-column align-items-center">
                                    <small class="font f-10 text-center">Solicitudes</small>
                                    <small>${solicitudes}</small>
                                </div>
                                <div class="col p-3 d-flex flex-column align-items-center">
                                    <small class="font f-10 text-center">Predios</small>
                                    <small>${predios}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            `
        }

    });
</script>
@endsection