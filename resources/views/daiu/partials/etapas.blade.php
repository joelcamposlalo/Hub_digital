<div class="row mt-5 etapas_info">
    <div class="col">
        <div class="etapas d-flex justify-content-center align-items-center">

            {{-- Etapa 1 --}}
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa border {{ $id_etapa == 172 ? 'process' : 'active' }} d-flex justify-content-center align-items-center">
                    @if ($id_etapa != 172)
                        <div class="success d-flex justify-content-center align-items-center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                    @endif
                    <small class="font f-15 bold {{ $id_etapa != 172 ? '' : 'text-muted' }}">1</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10">Solicitud</small>
            </div>

            <div class="{{ $id_etapa != 172 ? 'line' : 'line_off' }}"></div>

            {{-- Etapa 2 --}}
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa {{ in_array($id_etapa, [173]) ? 'active text-white' : (in_array($id_etapa, [66, 67, 72]) ? 'process' : '') }} border d-flex justify-content-center align-items-center">
                    @if ($id_etapa == 173)
                        <div class="success d-flex justify-content-center align-items-center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                    @endif
                    <small class="font f-15 bold {{ in_array($id_etapa, [173, 178]) ? 'text-white' : 'text-muted' }}">2</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos del Solicitante</small>
            </div>

            <div class="{{ $id_etapa == 173 ? 'line' : 'line_off' }}"></div>

            {{-- Etapa 3 --}}
            <div style="width: 60px; transform: translateY(7px);" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa {{ $id_etapa == 173 ? 'active' : ($id_etapa == 178 ? 'process' : '') }} border d-flex justify-content-center align-items-center">
                    @if ($id_etapa == 173)
                        <div class="success d-flex justify-content-center align-items-center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                    @endif
                    <small class="font f-15 bold {{ $id_etapa == 174 ? 'text-white' : 'text-muted' }}">3</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Datos Para Verificación</small>
            </div>

            <div class="{{ $id_etapa == 174 ? 'line' : 'line_off' }}"></div>

            {{-- Etapa 4 --}}
            <div style="width: 60px;" class="d-flex flex-column justify-content-center align-items-center">
                <div class="etapa {{ $id_etapa == 175 ? 'active' : '' }} border d-flex justify-content-center align-items-center">
                    @if ($id_etapa == 175)
                        <div class="success d-flex justify-content-center align-items-center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2 bold text-white"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </div>
                    @endif
                    <small class="font f-15 bold {{ $id_etapa == 175 ? 'text-white' : 'text-muted' }}">4</small>
                </div>
                <small class="mt-1 mb-1 font c-carbon f-10 text-center">Fotografías Adjuntas</small>
            </div>
        </div>
    </div>
</div>
