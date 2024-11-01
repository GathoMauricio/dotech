<!-- Modal -->
<div class="modal fade" id="pendientes_modal_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Pendientes Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>
                    <i class="text-secondary">
                        Bienvenid@
                        {{ \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . \Auth::user()->last_name }}
                        favor de atender los siguientes pendientes:
                    </i>
                </h6>
                <div class="container">
                    <h6><a href="{{ url('wire_tasks') }}" target="_BLANK">Tareas activas</a></h6>
                    <ul id="lista_tareas_pendientes_admin">

                    </ul>
                    <h6><a href="{{ url('wire_whitdrawals') }}" target="_BLANK">Retiros pendientes</a></h6>
                    <ul id="lista_retiros_pendientes_admin">

                    </ul>
                    <h6><a href="{{ url('index_user') }}" target="_BLANK">Vacaciones pendientes</a></h6>
                    <ul id="lista_vacaciones_pendientes_admin">

                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
