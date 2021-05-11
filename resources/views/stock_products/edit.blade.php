@extends('layouts.app')
@section('content')
<br><br>
<h4 class="title_page">Editar producto</h4>
<form class="form" action="{{ route('stock_product_update',$product->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <a onclick="addStockProductCategory()" href="#" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar categoría ]</a>
                    <label class="font-weight-bold color-primary-sys">Categoría*</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                        @if($product->id == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Producto*</label>
                    <input name="product" type="text" value="{{ $product->product }}" class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Descripción</label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Cantidad*</label>
                    <input name="quantity" type="number" min="1" value="{{ $product->quantity }}" class="form-control" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Con regreso</label>
                    <select name="return" class="form-control" >
                        @if($product->return == 'SI')
                        <option value="SI" selected>SI</option>
                        <option value="NO">NO</option>
                        @else
                        <option value="SI">SI</option>
                        <option value="NO" selected>NO</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Imagen</label>
                    <input name="image" type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary float-right" value="Actualizar"/>
                </div>
            </div>
        </div>
    </div>
</form>
@include('stock_category_products.create_modal')
@endsection