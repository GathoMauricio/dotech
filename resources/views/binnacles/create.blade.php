@extends('layouts.app')
@section('content')
<h4 class="title_page ">Crear bitácora</h4>
<br/><br/>
<form action="{{ route('store_binnacle',2) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Asociar a un proyecto
                    </label>
                    <select name="sale_id" class="form-control" onchange="changeProjectBinnacle(this.value)">
                        <option value>--No asociar--</option>
                        @foreach ($sales as $sale)
                        <option value="{{ $sale->id }}">{{ $sale->company['name'] }} - {{ $sale->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="div_alias">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="alias" class="font-weight-bold color-primary-sys">
                        Alias
                    </label>
                    <input name="alias" id="txt_alias_binnacle" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="origin" class="font-weight-bold color-primary-sys">
                        Descripción de la bitacora
                    </label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection