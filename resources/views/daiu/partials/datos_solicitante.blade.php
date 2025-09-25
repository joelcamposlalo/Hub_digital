<div class="row">
    <div class="col mt-4" id="top_2">
        <div class="card shadow-sm card_2 rounded border-none">
            <div class="card-header">
                <div class="step-header">
                    <span class="step-badge">2</span>
                    <small class="step-title">Verificación</small>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <form id="form_2" data-parsley-validate="">
                    <input name="id_captura" id="id_captura_2" type="hidden"
                        value="{{ isset($id_captura) ? $id_captura : '' }}">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="nombre"><small>Nombre</small></label>
                            <input name="nombre" id="nombre"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                        <div class="col mt-2">
                            <label for="apellido_1"><small>Primer Apellido</small></label>
                            <input name="apellido_1" id="apellido_1"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                        <div class="col mt-2">
                            <label for="apellido_2"><small>Segundo Apellido</small></label>
                            <input name="apellido_2" id="apellido_2"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="domicilio"><small>Domicilio</small></label>
                            <input name="domicilio" id="domicilio"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                        <div class="col mt-2">
                            <label for="no_oficial"><small>No Oficial</small></label>
                            <input name="no_oficial" id="no_oficial"
                                class="ab-form background-color rounded border capitalize editable" type="text">
                        </div>
                        <div class="col mt-2">
                            <label for="interior"><small>Interior</small></label>
                            <input name="interior" id="interior"
                                class="ab-form background-color rounded border capitalize editable" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="entrecalle1"><small>Entre Calle 1</small></label>
                            <input name="entrecalle1" id="entrecalle1"
                                class="ab-form background-color rounded border capitalize editable" type="text">
                        </div>
                        <div class="col mt-2">
                            <label for="entrecalle2"><small>Entre Calle 2</small></label>
                            <input name="entrecalle2" id="entrecalle2"
                                class="ab-form background-color rounded border capitalize editable" type="text">
                        </div>
                        <div class="col mt-2">
                            <label for="colonia"><small>Poblado / Colonia</small></label>
                            <input name="colonia" id="colonia"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="manzana"><small>No. de Manzana</small></label>
                            <input name="manzana" id="manzana"
                                class="ab-form background-color rounded border capitalize editable" type="text"
                                required>
                        </div>
                        <div class="col mt-2">
                            <label for="lote"><small>Lote</small></label>
                            <input name="lote" id="lote"
                                class="ab-form background-color rounded border capitalize editable" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <label for="telefono"><small>Teléfono</small></label>
                            <input name="telefono" id="telefono"
                                class="ab-form background-color rounded border editable" type="text"
                                required>
                        </div>
                        <div class="col mt-2">
                            <label for="correo"><small>Correo Electrónico</small></label>
                            <input name="correo" id="correo"
                                class="ab-form background-color rounded border editable" type="email" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <input name="origen" type="hidden" value="solicitud">
                            <input name="id_captura" id="id_captura_frm4" type="hidden"
                                value="{{ isset($id_captura) ? $id_captura : '' }}">

                            <!-- Botón para regresar -->
                            <button type="button" id="btn_regresar" class="ab-btn btn-primary-color mt-4 btn-style">
                                Regresar a la consulta
                            </button>

                            <!-- Botón para continuar -->
                            <button type="submit" class="ab-btn b-primary-color btn-style" id="btn_inserta_2">
                                Continuar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
