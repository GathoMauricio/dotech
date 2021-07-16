<div wire:ignore.self class="full-modal" id="full_modal_index_products">
    <p>
        <span wire:click="dissmisFullModal" class="icon-cross float-right p-3" style="cursor:pointer;"></span>
    </p>
    @if(!is_null($currentQuote))
    <div class="col-md-11 float-right">
        <h3 class="m-3">
            Productos: {{ $currentQuote->description }}
        </h3>

    </div>
    @endif
</div>