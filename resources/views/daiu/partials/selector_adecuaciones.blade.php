<div class="row">
    <div class="col mt-4" id="top_3">
        <div class="card shadow-sm card_3 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-header">
                    <span class="step-badge">3</span>
                    <small class="step-title">Adecuaciones</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_3">
                    {{-- Selector de categorías --}}
                    <div class="form-group">
                        <label for="categoria_selector"><small>Selecciona una categoría:</small></label>
                        <div class="d-flex flex-wrap gap-3 mt-2" id="categoria_selector_cards">
                            <div class="categoria-card text-center p-3 border rounded shadow-sm flex-fill categoria_trigger"
                                data-categoria="mantenimiento">
                                <i class="fas fa-tools fs-3 mb-2 d-block"></i>
                                <span>Obras de mantenimiento</span>
                            </div>

                            <div class="categoria-card text-center p-3 border rounded shadow-sm flex-fill categoria_trigger"
                                data-categoria="anuncio">
                                <i class="fas fa-bullhorn fs-3 mb-2 d-block"></i>
                                <span>Anuncio</span>
                            </div>

                            <div class="categoria-card text-center p-3 border rounded shadow-sm flex-fill categoria_trigger"
                                data-categoria="otro">
                                <i class="fa-solid fa-otter fs-3 mb-2 d-block"></i>
                                <span>Otro</span>
                            </div>

                        </div>
                    </div>




                    {{-- MANTENIMIENTO --}}
                    <div id="mantenimiento_section" class="mt-3" style="display: none;">
                        <label><strong>Obras de mantenimiento:</strong></label>

                        @foreach ([
        'remozamiento_fachada' => ['label' => 'Remozamiento de fachada', 'icon' => 'fa-building'],
        'cambio_piso' => ['label' => 'Cambio de piso', 'icon' => 'fa-border-all'],
        'electricas' => ['label' => 'Instalaciones eléctricas', 'icon' => 'fa-bolt'],
        'impermeabilizacion' => ['label' => 'Impermeabilización', 'icon' => 'fa-water'],
        'resane_grietas' => ['label' => 'Resane de grietas', 'icon' => 'fa-fill-drip'],
        'cambio_canceleria' => ['label' => 'Cambio de cancelería', 'icon' => 'fa-window-restore'],
        'reparacion_techo' => ['label' => 'Reparación de techo', 'icon' => 'fa-house-chimney'],
        'sustitucion_luminarias' => ['label' => 'Sustitución de luminarias', 'icon' => 'fa-lightbulb'],
    ] as $id => $item)
                            <div class="form-check d-flex align-items-center iconos-lista mb-2">
                                <input type="checkbox" class="form-check-input" id="{{ $id }}"
                                    name="mantenimiento[]">
                                <i class="fas {{ $item['icon'] }} text-muted"></i>
                                <label class="form-check-label" for="{{ $id }}">{{ $item['label'] }}</label>
                            </div>
                        @endforeach

                        {{-- Pintura en fachada con inputs adicionales --}}
                        <div class="form-check d-flex align-items-center mb-2 iconos-lista-min ">
                            <input type="checkbox" class="form-check-input" id="pintura_fachada" name="mantenimiento[]">
                            <i class="fas fa-paint-roller text-muted"></i>
                            <label class="form-check-label" for="pintura_fachada">Pintura en fachada</label>
                        </div>

                        <div id="pintura_fachada_inputs" style="display: none;" class="mt-2">
                            <div class="form-group">
                                <label>Número de gama</label>
                                <input type="text" class="form-control" name="gama">
                            </div>
                            <div class="form-group">
                                <label>Molduras (clave no)</label>
                                <input type="text" class="form-control" name="molduras">
                            </div>
                            <div class="form-group">
                                <label>Macizo (clave no)</label>
                                <input type="text" class="form-control" name="macizo">
                            </div>
                            <div class="form-group">
                                <label>Marca de pintura</label>
                                <input type="text" class="form-control" name="marca_pintura">
                            </div>
                            <div class="form-group">
                                <label>Otro</label>
                                <input type="text" class="form-control" name="otro_mantenimiento">
                            </div>
                        </div>
                    </div>


                    {{-- ANUNCIO --}}
                    {{-- ANUNCIO --}}
                    <div id="anuncio_section" class="mt-4" style="display: none;">
                        <label><strong>Anuncio:</strong></label>
                        @foreach ([
        'rotulado_lamina' => ['label' => 'Rotulado en lámina metálica', 'icon' => 'fa-sign'],
        'interior_vano' => ['label' => 'Interior del vano', 'icon' => 'fa-window-maximize'],
        'letra_individual' => ['label' => 'Letra individual (solo fachadas de 8.00ml)', 'icon' => 'fa-font'],
        'bandera' => ['label' => 'Bandera', 'icon' => 'fa-flag'],
    ] as $id => $item)
                            <div class="form-check d-flex align-items-center iconos-lista  mb-2">
                                <input type="checkbox" class="form-check-input" id="{{ $id }}"
                                    name="anuncio[]">
                                <i class="fas {{ $item['icon'] }} text-muted"></i>
                                <label class="form-check-label" for="{{ $id }}">{{ $item['label'] }}</label>
                            </div>
                        @endforeach

                        <div class="form-check d-flex align-items-center iconos-lista-min mb-2">
                            <input type="checkbox" id="toldo_check" class="form-check-input" name="anuncio[]">
                            <i class="fas fa-umbrella text-muted"></i>
                            <label class="form-check-label" for="toldo_check">Toldo (previa obtención)</label>
                        </div>

                        <div id="dimensiones_toldo" style="display: none;" class="form-group mt-2">
                            <label>Dimensiones propuestas</label>
                            <input type="text" class="form-control" name="dimensiones_toldo">
                        </div>
                    </div>

                    {{-- OTRO --}}
                    <div id="otro_section" class="mt-4" style="display: none;">
                        <label><strong>Otro:</strong></label>
                        @foreach ([
        'toldo_fachada' => ['label' => 'Colocación de toldo en fachada', 'icon' => 'fa-umbrella'],
        'mobiliario_urbano' => ['label' => 'Mobiliario Urbano', 'icon' => 'fa-cogs'],
        'extension_giro' => ['label' => 'Extensión de giro comercial', 'icon' => 'fa-store'],
        'adecuacion_general' => ['label' => 'Adecuación a la imagen urbana', 'icon' => 'fa-paint-roller'],
    ] as $id => $item)
                            <div class="form-check d-flex align-items-center iconos-lista  mb-2">
                                <input type="checkbox" class="form-check-input" id="{{ $id }}" name="otro[]">
                                <i class="fas {{ $item['icon'] }} text-muted"></i>
                                <label class="form-check-label" for="{{ $id }}">{{ $item['label'] }}</label>
                            </div>
                        @endforeach

                        <div class="form-group mt-2">
                            <label>Otro</label>
                            <input type="text" class="form-control" name="otro_otro">
                        </div>
                    </div>

                    <div class="text-right mt-4">
                        <button type="button" id="btn_regresar_card3"
                            class="ab-btn btn-primary-color btn-style me-2">
                            Regresar a la verificación
                        </button>
                        <button type="button" class="ab-btn b-primary-color btn-style" id="btn_inserta_3">
                            Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
