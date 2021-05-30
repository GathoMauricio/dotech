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
            <!--
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Imagen</label>
                    <input name="image" type="file" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                </div>
            </div>
            -->
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
<br/>
<table class="table table-striped">
        <thead>
            <tr>
                <th colspan="3" class="text-center" style="background-color:#d30035;color:white;">
                    <a href="#" onclick="addStockProductImage({{ $product->id }})" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
                    Fotos
                </th>
            </tr>
            <tr>
                <th>Imagen</th>
                <th>Descripción</th>
                @if(Auth::user()->rol_user_id == 1)
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <td><a href="{{asset('storage')}}/{{ $image->image }}" target="_blank"><img src="{{asset('storage')}}/{{ $image->image }}" width="120"/></a></td>
                <td>{{ $image->description }}</td>
                @if(Auth::user()->rol_user_id == 1)
                <td>
                    <a href="#" onclick="deleteStockProductImage({{ $image->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
                </td>
                @endif
            </tr>
            @endforeach
            @if(count($images) <= 0)
            <tr>
                <td class="text-center font-weight-bold" colspan="3">
                    No hay regirtros para mostrar
                </td>
            </tr>
            @endif
        </tbody>
    </table>
<input type="hidden" id="txt_destroy_stock_product_image" value="{{ route('delete_stock_product_image') }}">
@include('stock_category_products.create_modal')
@include('stock_products.add_stock_product_image_modal')
@endsection