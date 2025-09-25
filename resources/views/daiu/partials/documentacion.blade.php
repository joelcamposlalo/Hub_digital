<div class="row">
    <div class="col mt-4" id="top_7">
        <div class="card shadow-sm card_7 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-card-title">
                    <span class="step-card-number">7</span>
                    <small class="step-card-label">Documentación</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_7">
                    <p class="text-muted">Carga de documentos de prueba. En próximas iteraciones se añadirá la funcionalidad de almacenamiento.</p>
                    <div class="document-list">
                        @foreach ([
                            'Identificación oficial',
                            'Comprobante de domicilio',
                            'Plano arquitectónico firmado',
                            'Memoria descriptiva firmada'
                        ] as $index => $label)
                            <div class="document-item">
                                <div class="document-info">
                                    <span class="document-title">{{ $label }}</span>
                                    <span class="document-hint">Sólo maqueta visual, sin carga real.</span>
                                </div>
                                <label for="documento_{{ $index }}" class="document-upload-btn">
                                    <i class="fas fa-upload"></i>
                                    <span>Seleccionar archivo</span>
                                    <input type="file" id="documento_{{ $index }}" name="documento_{{ $index }}">
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end flex-wrap gap-3 mt-4">
                        <button type="button" id="btn_regresar_card7" class="ab-btn btn-primary-color">
                            Regresar a anexos
                        </button>
                        <button type="submit" id="btn_finalizar_tramite" class="ab-btn b-primary-color">
                            Guardar documentación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
