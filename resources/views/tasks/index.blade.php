@extends('layouts.app')
@section('content')
@if(Session::has('message')) @include('layouts.message') @endif
<a href="{{ route('task_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar tarea ]</a>
<h4 class="title_page">Tareas</h4>
@if(count($tasks) <= 0)
@include('layouts.no_records')
@else
<input type="hidden" id="txt_tasks_route" value="{{ route('task_index_ajax') }}">
<table id="tbl_tasks" class="table table-bordered">
    <thead>
        <tr>
            <th width="2%" scope="col"></th>
            <th width="15%" scope="col">Proyecto</th>
            <th width="25%" scope="col">Titulo</th>
            <th width="20%" scope="col">Usuario</th>
            <th width="10%" scope="col">DeadLine</th>
            <th width="5%" scope="col">Comm</th>
            <th width="10%" scope="col">Estatus</th>
            <th width="5%" scope="col"></th>
        </tr>
    </thead>
</table>
@endif
@endsection