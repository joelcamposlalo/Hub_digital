<div class="row">
    <div class="col mt-4" id="top_7">
        <div class="card shadow-sm card_7 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-card-title">
                    <small class="step-card-label">Documentación</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_7">
                    <div class="document-note mb-4">
                        <p class="mb-1">
                            <strong>Nota:</strong> Debes adjuntar todos los archivos obligatorios cuando la carga esté habilitada.
                        </p>
                        <p class="mb-0">Por ahora sólo es una maqueta visual, sin envío real de documentos.</p>
                    </div>

                    @php
                        $documentos = [
                            [
                                'label' => 'Identificación oficial',
                                'descripcion' => 'Credencial vigente del representante o propietario.',
                                'obligatorio' => true,
                            ],
                            [
                                'label' => 'Comprobante de domicilio',
                                'descripcion' => 'Documento con antigüedad no mayor a 3 meses.',
                                'obligatorio' => true,
                            ],
                            [
                                'label' => 'Plano arquitectónico firmado',
                                'descripcion' => 'Archivo en formato PDF o imagen con firmas correspondientes.',
                                'obligatorio' => true,
                            ],
                            [
                                'label' => 'Memoria descriptiva firmada',
                                'descripcion' => 'Documento que describe la intervención propuesta.',
                                'obligatorio' => false,
                            ],
                        ];
                    @endphp

                    <div class="document-table-wrapper">
                        <table class="document-table">
                            <tbody>
                                @foreach ($documentos as $index => $documento)
                                    <tr>
                                        <td class="document-icon">
                                            <img src="{{ asset('media/flaticon/archivos/upload.svg') }}" alt="Icono documento">
                                        </td>
                                        <td class="document-description">
                                            <span class="document-title">{{ $documento['label'] }}</span>
                                            <span class="text-muted d-block small">{{ $documento['descripcion'] }}</span>
                                            <span class="document-required {{ $documento['obligatorio'] ? 'text-danger' : 'text-success' }}">
                                                {{ $documento['obligatorio'] ? 'Este archivo es obligatorio' : 'Este archivo es opcional' }}
                                            </span>
                                        </td>
                                        <td class="document-size">Tamaño: 0 bytes</td>
                                        <td class="document-upload">
                                            <label for="documento_{{ $index }}" class="document-upload-btn">
                                                <span>Subir archivo</span>
                                                <input type="file" id="documento_{{ $index }}" name="documento_{{ $index }}">
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="step-card-actions mt-4">
                        <button type="button" id="btn_regresar_card7" class="ab-btn btn-secondary-color">
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
