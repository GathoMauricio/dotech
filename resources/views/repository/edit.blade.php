@extends('layouts.app')
@section('content')
<a href="#" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar repositorio ]</a>
<h4 class="title_page">Editar repositorio {{ $repository->name }}</h4> 
<form action="{{ route('update_company_repository',$repository->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Título</label>
                    <input name="title" type="text" value="{{ $repository->title }}" class="form-control" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Contenido</label>
                    <textarea name="body" class="form-control" required >{{ $repository->body }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <br/>
                    <input type="submit" class="btn btn-primary float-right" value="Actualizar"/>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection