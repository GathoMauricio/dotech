@extends('layouts.app')
@section('content')
<a href="#" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar repositorio ]</a>
<h4 class="title_page">Repositorio de {{ $company->name }}</h4> 
<form action="{{ route('store_company_repository')}}" method="POST">
    @csrf
    <input name="company_id" type="hidden" value="{{ $company->id }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Título</label>
                    <input name="title" type="text" class="form-control" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold color-primary-sys">Contenido</label>
                    <textarea name="body" class="form-control" required ></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <br/>
                    <input type="submit" class="btn btn-primary float-right" value="Agregar"/>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection