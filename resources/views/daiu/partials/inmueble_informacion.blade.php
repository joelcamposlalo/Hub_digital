<div class="row">
    <div class="col mt-4" id="top_4">
        <div class="card shadow-sm card_4 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="step-card-title">
                    <small class="step-card-label">Inmueble</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_4">
                    <input type="hidden" name="id_captura" class="daiu-id-captura"
                        value="{{ isset($id_captura) ? $id_captura : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- Dimensión total de la fachada --}}
                            <div class="form-group mb-3">
                                <label for="dimension_fachada">Dimensión total de la fachada del inmueble</label>
                                <input type="number" class="form-control" id="dimension_fachada" name="dimension_fachada" placeholder="Ingrese la dimensión total">
                            </div>

                            {{-- Altura --}}
                            <div class="form-group mb-3">
                                <label for="altura">Altura</label>
                                <input type="number" class="form-control" id="altura" name="altura" placeholder="Ingrese la altura">
                            </div>

                            {{-- Tipo --}}
                            <div class="form-group mb-3">
                                <label for="tipo">Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Ingrese el tipo">
                            </div>

                            {{-- Giro comercial --}}
                            <div class="form-group mb-3">
                                <label for="giro_comercial">Giro comercial</label>
                                <input type="text" class="form-control" id="giro_comercial" name="giro_comercial" placeholder="Ingrese el giro comercial">
                            </div>

                            {{-- Plaza comercial --}}
                            <div class="form-group mb-3">
                                <label for="plaza_comercial">¿Plaza comercial?</label>
                                <select class="form-control" id="plaza_comercial" name="plaza_comercial">
                                    <option value="">Seleccione una opción</option>
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Ancho del ingreso al comercio --}}
                            <div class="form-group mb-3">
                                <label for="ancho_ingreso">Ancho del ingreso al comercio</label>
                                <input type="number" class="form-control" id="ancho_ingreso" name="ancho_ingreso" placeholder="Ingrese el ancho del ingreso">
                            </div>

                            {{-- Anuncio instalado --}}
                            <div class="form-group mb-3">
                                <label for="anuncio_instalado">¿Anuncio instalado?</label>
                                <select class="form-control" id="anuncio_instalado" name="anuncio_instalado">
                                    <option value="">Seleccione una opción</option>
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            {{-- Nombre o razón social --}}
                            <div class="form-group mb-3">
                                <label for="razon_social">Nombre o razón social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese el nombre o razón social">
                            </div>

                            {{-- No. de cédula comercial --}}
                            <div class="form-group mb-3">
                                <label for="cedula_comercial">No. de cédula comercial</label>
                                <input type="text" class="form-control" id="cedula_comercial" name="cedula_comercial" placeholder="Ingrese el número de cédula comercial">
                            </div>
                        </div>

                        {{-- Nombre de la plaza comercial (solo si selecciona "Sí") --}}
                        <div class="col-12">
                            <div class="form-group mb-3" id="nombre_plaza_group" style="display: none;">
                                <label for="nombre_plaza">Nombre de la plaza comercial</label>
                                <input type="text" class="form-control" id="nombre_plaza" name="nombre_plaza" placeholder="Ingrese el nombre de la plaza">
                            </div>
                        </div>
                    </div>

                    <div class="step-card-actions mt-4">
                        <button type="button" id="btn_regresar_card4" class="ab-btn btn-secondary-color">
                            Regresar a adecuaciones
                        </button>
                        <button type="button" class="ab-btn b-primary-color" id="btn_inserta_4">
                            Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


