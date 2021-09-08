<!-- Modal Password-->
<div wire:ignore.self class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class ="container">
            <div class="row">
                <div class="col-md-12">
                    <label for="password">Ingrese un nuevo password</label>
                    <input wire:model = "password" type="password" class="form-control" />
                    @if($errors->has('password'))
                    <small style="color:#d30035">{{ $errors->first('password') }}</small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="password_confirmation">Repita su password</label>
                    <input wire:model = "password_confirmation" type="password" class="form-control" />
                    @if($errors->has('password_confirmation'))
                    <small style="color:#d30035">{{ $errors->first('password_confirmation') }}</small>
                    @endif
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click = "updatePassword" type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>