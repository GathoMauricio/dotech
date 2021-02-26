@extends('layouts.app')
@section('content')
<a href="{{ route('create_company_repository',$company->id) }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar repositorio ]</a>
<h4 class="title_page">Repositorio de {{ $company->name }}</h4> 
@if(count($repositories) <= 0)
@include('layouts.no_records')
@else

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Contenido</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($repositories as $repository)
        <tr>
            <td>{{ $repository->title }}</td>
            <td>{{ $repository->body }}</td>
            <td>
                <a href="{{ route('edit_company_repository',$repository->id) }}" style="cursor:pointer;color:orange"><span title="Editar..." class="icon icon-pencil"></span> Editar</a>
                @if(Auth::user()->rol_user_id == 1)
                <br/>
                <a href="#" onclick="deleteCompanyRepository({{ $repository->id }})" style="cursor:pointer;color:red"><span title="Eliminar..." class="icon icon-bin"></span> Eliminar</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_destroy_company_repository_route" value="{{ route('destroy_company_repository') }}">
@endif
@endsection