<div class="row">
    <div class="col mt-4" id="top_4">
        <div class="card shadow-sm card_4 rounded border-none">
            <div class="card-header d-flex justify-content-between align-items-center">
                <small>Información del inmueble</small>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_4">
                    {{-- Dimensión total de la fachada --}}
                    <div class="form-group">
                        <label for="dimension_fachada">Dimensión total de la fachada del inmueble</label>
                        <input type="number" class="form-control" id="dimension_fachada" name="dimension_fachada" placeholder="Ingrese la dimensión total">
                    </div>

                    {{-- Ancho del ingreso al comercio --}}
                    <div class="form-group">
                        <label for="ancho_ingreso">Ancho del ingreso al comercio</label>
                        <input type="number" class="form-control" id="ancho_ingreso" name="ancho_ingreso" placeholder="Ingrese el ancho del ingreso">
                    </div>

                    {{-- Altura --}}
                    <div class="form-group">
                        <label for="altura">Altura</label>
                        <input type="number" class="form-control" id="altura" name="altura" placeholder="Ingrese la altura">
                    </div>

                    {{-- Anuncio instalado --}}
                    <div class="form-group">
                        <label for="anuncio_instalado">¿Anuncio instalado?</label>
                        <select class="form-control" id="anuncio_instalado" name="anuncio_instalado">
                            <option value="">Seleccione una opción</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    {{-- Tipo --}}
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Ingrese el tipo">
                    </div>

                    {{-- Nombre o razón social --}}
                    <div class="form-group">
                        <label for="razon_social">Nombre o razón social</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingrese el nombre o razón social">
                    </div>

                    {{-- Giro comercial --}}
                    <div class="form-group">
                        <label for="giro_comercial">Giro comercial</label>
                        <input type="text" class="form-control" id="giro_comercial" name="giro_comercial" placeholder="Ingrese el giro comercial">
                    </div>

                    {{-- No. de cédula comercial --}}
                    <div class="form-group">
                        <label for="cedula_comercial">No. de cédula comercial</label>
                        <input type="text" class="form-control" id="cedula_comercial" name="cedula_comercial" placeholder="Ingrese el número de cédula comercial">
                    </div>

                    {{-- Plaza comercial --}}
                    <div class="form-group">
                        <label for="plaza_comercial">¿Plaza comercial?</label>
                        <select class="form-control" id="plaza_comercial" name="plaza_comercial">
                            <option value="">Seleccione una opción</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    {{-- Nombre de la plaza comercial (solo si selecciona "Sí") --}}
                    <div class="form-group" id="nombre_plaza_group" style="display: none;">
                        <label for="nombre_plaza">Nombre de la plaza comercial</label>
                        <input type="text" class="form-control" id="nombre_plaza" name="nombre_plaza" placeholder="Ingrese el nombre de la plaza">
                    </div>

                    <div class="text-right mt-4">
                        <button type="button" id="btn_regresar_card4" class="ab-btn btn-primary-color btn-style me-2">
                            Regresar a adecuaciones
                        </button>
                        <button type="button" class="ab-btn b-primary-color btn-style" id="btn_inserta_4">
                            Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


