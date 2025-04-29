@extends('base')

@section('title', 'Solicitud')

@section('aside')
    {{ menu_ciudadano('') }}
@endsection

@section('notification')
    {{ get_notificaciones() }}
@endsection

@section('container')

    <h1 class="text-muted font m-0 bold c-primary-color">
        Dictaminación de Imagen Urbana
    </h1>
    <small class="font text-muted mb-5 f-15">Folio de trámite: {{ $folio }}</small>


    <input name="id_etapa" id="id_etapa" type="hidden" value="{{ $id_etapa ?? '' }}">

    {{-- Visualización de las etapas --}}
    @include('daiu.partials.etapas')
    @include('daiu.partials.consulta_predial', ['id_solicitud' => $id_solicitud])
    @include('daiu.partials.datos_solicitante', ['id_solicitud' => $id_solicitud])
    @include('daiu.partials.selector_adecuaciones', ['id_solicitud' => $id_solicitud])
    @include('daiu.partials.inmueble_informacion', ['id_solicitud' => $id_solicitud])
    @include('daiu.partials.croquis_mapa', ['id_solicitud' => $id_solicitud])



@endsection

@section('menu_mobile')
    {{ menu_mobil_ciudadano('') }}
@endsection

@section('css')
    @parent
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/daiu/solicitud.css') }}">
@endsection

@section('js')
    @parent
    <script src="{{ asset('vendors/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendors/parsley/es.js') }}"></script>
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="{{ asset('vendors/lightbox/dist/js/lightbox.min.js') }}"></script>
    <script>
        const rutaConsultaPredial = "{{ route('consulta_predial') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/daiu/consulta_predial.js') }}"></script>
    <script src="{{ asset('js/daiu/datos_solicitante.js') }}"></script>
    <script src="{{ asset('js/daiu/selector_adecuaciones.js') }}"></script>
    <script src="{{ asset('js/daiu/inmueble_informacion.js') }}"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <script src="{{ asset('js/daiu/croquis_mapa.js') }}"></script> 
@endsection
