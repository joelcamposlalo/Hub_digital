<div class="row">
    <div class="col mt-4" id="top_5">
        <div class="card shadow-sm card_5 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-card-title">
                    <span class="step-card-number">5</span>
                    <small class="step-card-label">Croquis</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_5">
                    {{-- Contenedor del mapa --}}
                    <div id="map"></div>
                    <div id="coordinates-display" class="mt-2 text-muted small"></div>

                    {{-- Botón para guardar la ubicación --}}
                    <div class="row mt-4">
                        <div class="col-md-12 map-actions">
                            <button type="button" id="btn_limpiar_mapa" class="ab-btn b-secondary-color">
                                Limpiar mapa y reiniciar el punto original
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 map-actions">
                            <button type="button" id="btn_regresar_card5" class="ab-btn btn-primary-color">
                                Regresar
                            </button>
                            <button type="button" id="btn_guardar_mapa" class="ab-btn b-primary-color">
                                Guardar croquis y continuar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
