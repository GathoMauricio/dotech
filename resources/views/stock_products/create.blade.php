@extends('layouts.app')
@section('content')
<br><br>
<h4 class="title_page">Crear producto</h4>
<form class="form" action="{{ route('stock_product_store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <a onclick="addStockProductCategory()" href="#" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar categoría ]</a>
                    <label class="font-weight-bold color-primary-sys">Categoría*</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Producto*</label>
                    <input name="product" type="text" class="form-control" required/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Descripción</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Cantidad*</label>
                    <input name="quantity" type="number" min="1" value="1" class="form-control" required/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Con regreso</label>
                    <select name="return" class="form-control" >
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
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
                    <input type="submit" class="btn btn-primary float-right" value="Guardar"/>
                </div>
            </div>
        </div>
    </div>
</form>
@include('stock_category_products.create_modal')
@endsection