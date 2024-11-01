 <div class="modal-body container">
     <div class="row">
         <div class="col-md-12">
             <div class="form-group">
                 <label for="currency" class="font-weight-bold color-primary-sys">
                     Descripción del producto
                 </label>
                 <textarea wire:model="productDescription" class="form-control"></textarea>
                 @error('productDescription')
                     <span class="error-message">{{ $message }}</span>
                 @enderror
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-3">
             <div class="form-group">
                 <label for="quantity" class="font-weight-bold color-primary-sys">
                     Cantidad
                 </label>
                 <input type="number" wire:model="productQuantity" value="1" min="1" class="form-control">
                 @error('productQuantity')
                     <span class="error-message">{{ $message }}</span>
                 @enderror
             </div>
         </div>
         <div class="col-md-3">
             <div class="form-group">
                 <label for="measure" class="font-weight-bold color-primary-sys">
                     Unida de medida
                 </label>
                 <input type="text" wire:model="productMeasure" class="form-control">
                 @error('productMeasure')
                     <span class="error-message">{{ $message }}</span>
                 @enderror
             </div>
         </div>
         {{--  <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount" class="font-weight-bold color-primary-sys">
                                    Descuento
                                </label>
                                <input type="number" wire:model="productDiscount" value="0" min="0" class="form-control">
                                @error('productDiscount') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>  --}}
         <div class="col-md-3">
             <div class="form-group">
                 <label for="unity_price_sell" class="font-weight-bold color-primary-sys">
                     P/U Venta
                 </label>
                 <input type="number" wire:model="productUnityPriceSell" step="0.01" value="1" min="1"
                     class="form-control">
                 @error('productUnityPriceSell')
                     <span class="error-message">{{ $message }}</span>
                 @enderror
             </div>
         </div>
     </div>
 </div>
