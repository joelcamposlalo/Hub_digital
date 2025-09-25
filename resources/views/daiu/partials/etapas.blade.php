@php
    $pasos = [
        ['numero' => 1, 'titulo' => 'Consulta'],
        ['numero' => 2, 'titulo' => 'Verificación'],
        ['numero' => 3, 'titulo' => 'Adecuaciones'],
        ['numero' => 4, 'titulo' => 'Inmueble'],
        ['numero' => 5, 'titulo' => 'Croquis'],
        ['numero' => 6, 'titulo' => 'Anexos'],
        ['numero' => 7, 'titulo' => 'Documentación'],
    ];
@endphp

<div class="row mt-5 etapas_info">
    <div class="col">
        <div class="step-flow">
            @foreach ($pasos as $paso)
                <div class="step-item">
                    <div class="step-circle">{{ $paso['numero'] }}</div>
                    <div class="step-label">{{ $paso['titulo'] }}</div>
                </div>
                @if (! $loop->last)
                    <div class="step-line"></div>
                @endif
            @endforeach
        </div>
    </div>
</div>
