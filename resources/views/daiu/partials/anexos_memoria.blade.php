<div class="row">
    <div class="col mt-4" id="top_6">
        <div class="card shadow-sm card_6 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-card-title">
                    <small class="step-card-label">Anexos y memoria</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_6">
                    <input type="hidden" name="id_captura" class="daiu-id-captura"
                        value="{{ isset($id_captura) ? $id_captura : '' }}">
                    {{-- Memoria descriptiva --}}
                    <div class="form-group">
                        <label for="memoria_descriptiva"><strong>Memoria descriptiva</strong></label>
                        <textarea class="form-control" id="memoria_descriptiva" name="memoria_descriptiva" rows="5"
                            placeholder="Describe a detalle las acciones que se realizarán en el inmueble"></textarea>
                        <small class="form-text text-muted">Puedes detallar materiales, acabados y cualquier otra
                            consideración relevante.</small>
                    </div>

                    {{-- Dimensiones de la fachada --}}
                    <div class="mt-4">
                        <label class="d-block mb-3"><strong>Dimensiones de la fachada (ejemplo)</strong></label>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="numero_color">No. color</label>
                                <input type="text" class="form-control" id="numero_color" name="numero_color"
                                    placeholder="Ej. Verde 22-45">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo_letra">Letra individual</label>
                                <input type="text" class="form-control" id="tipo_letra" name="tipo_letra"
                                    placeholder="Ej. Acero inoxidable">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="dim_altura">Altura (m)</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="dim_altura"
                                    name="dim_altura" placeholder="Ej. 2.50">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dim_ancho">Ancho (m)</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="dim_ancho"
                                    name="dim_ancho" placeholder="Ej. 5.20">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dim_fondo">Fondo (m)</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="dim_fondo"
                                    name="dim_fondo" placeholder="Ej. 0.40">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dim_observaciones">Observaciones</label>
                            <textarea class="form-control" id="dim_observaciones" name="dim_observaciones" rows="3"
                                placeholder="Incluye referencias de materiales, iluminación u otros datos que faciliten la revisión."></textarea>
                        </div>
                    </div>

                    <div class="step-card-actions mt-4">
                        <button type="button" id="btn_regresar_card6" class="ab-btn btn-secondary-color">
                            Regresar al croquis
                        </button>
                        <button type="submit" class="ab-btn b-primary-color" id="btn_finalizar_solicitud">
                            Guardar información
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
