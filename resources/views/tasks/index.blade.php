@extends('layouts.app')
@section('content')
@if(Session::has('message')) @include('layouts.message') @endif
<a href="{{ route('task_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar tarea ]</a>
<h4 class="title_page">Tareas</h4>
@if(count($tasks) <= 0)
@include('layouts.no_records')
@else
<input type="hidden" id="txt_tasks_route" value="{{ route('task_index_ajax') }}">
<div id="task_table_render"></div>
@include('tasks.show_task_modal')
@endif
@endsection