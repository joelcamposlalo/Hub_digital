<div class="row position-relative">
    <div class="col mt-4" id="top_1">
        <div class="card  shadow-sm card_1 rounded border-none">
            <div class="card-header">
                <div class="step-card-title">
                    <span class="step-card-number">1</span>
                    <small class="step-card-label">Consulta</small>
                </div>
            </div>
            <div class="card-body">
                <form id="form_1" method="POST" action="{{ route('consulta_predial') }}" data-parsley-validate="">
                    @csrf
                    <input name="id_captura" id="id_captura" type="hidden"
                        value="{{ isset($id_captura) ? $id_captura : '' }}">
                    <div class="row">
                        <div class="col mt-2">
                            <label for="cuenta"><small>Consulta cuenta Predial O CURT</small></label>
                            <input name="cuenta" id="cuenta" value="{{ isset($predial) ? $predial : '' }}"
                                class="ab-form background-color rounded border capitalize predial" type="number">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 mt-2 text-right">
                            <button type="button" id="continuar_sin_consulta"
                                class="ab-btn btn-secondary-color">
                                Continuar sin consultar
                            </button>
                            <button class="ab-btn b-primary-color continuar btn_inserta" id="btn_inserta"
                                type="submit">
                                Consulta Cuenta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
