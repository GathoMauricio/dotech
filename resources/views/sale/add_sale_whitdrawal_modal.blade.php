<!-- Modal -->
<div class="modal fade" id="add_sale_whitdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Solicitud de retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_sale_whitdrawal') }}" method="POST" accept-charset="UTF-8"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sale_id" id="txt_add_sale_whitdrawal_modal_sale_id">
                <input type="hidden" name="status" value="Pendiente">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="whitdrawal_provider_id"
                                    class="font-weight-bold color-primary-sys">Proovedor</label>
                                <select name="whitdrawal_provider_id" class="custom-select">
                                    @php $providers = \App\WhitdrawalProvider::orderBy('name')->get() @endphp
                                    @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity" class="font-weight-bold color-primary-sys">Monto</label>
                                <input type="number" name="quantity" class="form-control" step="0.01" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoive" class="font-weight-bold color-primary-sys">Factura</label>
                                <select name="invoive" class="custom-select">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="font-weight-bold color-primary-sys">Descripción</label>
                                <textarea  name="description" class="form-control" required /></textarea
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>