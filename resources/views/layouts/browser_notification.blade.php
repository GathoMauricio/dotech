browser_notification_modal
<!-- Modal -->
<div class="modal fade" id="browser_notification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enviar notificación a dotech.tech</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id ="form_browser_notification" action="{{ route('notificar') }}">
        <div class="modal-body">
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" name="titulo" placeholder="Aa" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje" placeholder="Cuerpo del mensaje" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        </form>
      </div>
    </div>
  </div>