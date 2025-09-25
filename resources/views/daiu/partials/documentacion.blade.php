<div class="row">
    <div class="col mt-4" id="top_7">
        <div class="card shadow-sm card_7 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-header">
                    <span class="step-badge">7</span>
                    <small class="step-title">Documentación</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_7">
                    <p class="text-muted">Carga de documentos de prueba. En próximas iteraciones se añadirá la funcionalidad de almacenamiento.</p>
                    <div class="row">
                        @foreach ([
                            'Identificación oficial',
                            'Comprobante de domicilio',
                            'Plano arquitectónico firmado',
                            'Memoria descriptiva firmada'
                        ] as $index => $label)
                            <div class="col-md-6 mb-3">
                                <label for="documento_{{ $index }}">{{ $label }}</label>
                                <input type="file" class="form-control" id="documento_{{ $index }}" name="documento_{{ $index }}">
                                <small class="form-text text-muted">Sólo maqueta visual, sin carga real.</small>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end flex-wrap gap-3 mt-4">
                        <button type="button" id="btn_regresar_card7" class="ab-btn btn-primary-color btn-style">
                            Regresar a anexos
                        </button>
                        <button type="submit" id="btn_finalizar_tramite" class="ab-btn b-primary-color btn-style">
                            Guardar documentación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
