<!-- Modal -->
<div class="modal fade" id="modal_adjuntar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjuntar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('adjunto_mailing') }}" method="post" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="mailing_id" value="{{ $mailing_id }}" />
                <div class="modal-body">
                    <input type="file" name="adjunto" class="form-control" accept=".pdf, .jpg, .jpeg, .png" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
