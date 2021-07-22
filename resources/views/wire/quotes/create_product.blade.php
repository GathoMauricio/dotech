<!-- Modal -->
<div wire:ignore.self class="modal fade" id="create_product_quote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
               @include('wire.quotes.body_product')
                <div class="modal-footer">
                    <button wire:click = "storeProduct" class="btn btn-primary">Agregar</button>
                </div>
        </div>
    </div>
</div>