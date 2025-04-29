{{-- filepath: c:\projects\HUB_VDigital\resources\views\daiu\partials\croquis_mapa.blade.php --}}
<div class="row">
    <div class="col mt-4" id="top_5">
        <div class="card shadow-sm card_5 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <small>Croquis del Mapa</small>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_5">
                    {{-- Contenedor del mapa --}}
                    <div id="map" style="height: 400px; width: 100%;"></div>

                    {{-- Botón para guardar la ubicación --}}
                    <div class="row mt-4">
                        <div class="col-md-12 text-right">
                            <button type="button" id="btn_guardar_mapa" class="ab-btn b-primary-color btn-style">
                                Guardar Croquis
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
