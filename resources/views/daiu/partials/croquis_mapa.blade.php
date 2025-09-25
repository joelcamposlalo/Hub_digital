<div class="row">
    <div class="col mt-4" id="top_5">
        <div class="card shadow-sm card_5 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-header">
                    <span class="step-badge">5</span>
                    <small class="step-title">Croquis</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_5">
                    {{-- Contenedor del mapa --}}
                    <div id="map" style="height: 400px; width: 100%;"></div>
                    <div id="coordinates-display" class="mt-2 text-muted small"></div>

                    {{-- Botón para guardar la ubicación --}}
                    <div class="row mt-4">

                        <div class="col-md-12 d-flex justify-content-center flex-wrap gap-3">

                            <button type="button" id="btn_limpiar_mapa"
                                class="ab-btn b-secondary-color btn-style">
                                Limpiar mapa y reiniciar el punto original
                            </button>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-center flex-wrap gap-3">
                            <button type="button" id="btn_regresar_card5"
                                class="ab-btn btn-primary-color btn-style">
                                Regresar
                            </button>
                            <button type="button" id="btn_guardar_mapa"
                                class="ab-btn b-primary-color btn-style">
                                Continuar con anexos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos adicionales para mejorar la interfaz */
#map {
    min-height: 400px;
    width: 100%;
    display: none; /* Se mostrará con JS */
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#coordinates-display {
    padding: 5px 10px;
    background-color: #f8f9fa;
    border-radius: 4px;
    border: 1px solid #eee;
}

.esri-ui .esri-widget {
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

.btn-style {
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.b-primary-color {
    background-color: #1e636d;
    color: white;
    border: none;
}

.b-secondary-color {
    background-color: #6c757d;
    color: white;
    border: none;
}

.btn-style:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}
</style>
