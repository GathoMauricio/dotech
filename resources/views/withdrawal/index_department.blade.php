@extends('layouts.app')
@section('content')
<h4 class="title_page">Departamentos de retiro</h4> 
@include('config.menu')
<br/>
<a href="{{ route('create_department') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar departamento ]</a>
@if(count($departments) <= 0)
@include('layouts.no_records')
@else

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Creación</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ formatDate($department->created_at) }}</td>
            <th>
                <a href="{{ route('edit_department', $department->id) }}"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="#" onclick="deleteDepartment({{ $department->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                <br>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_delete_department_route" value="{{ route('delete_department') }}">
@endif
@endsection