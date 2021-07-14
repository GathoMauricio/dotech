@extends('layouts.app')
@section('content')
<a href="{{ route('task_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar tarea ]</a>
<h4 class="title_page">Tareas</h4> 
<small><a href="{{ route('task_archived_index') }}">[ Ver tareas archivadas ]</a></small>
@if(count($tasks) <= 0)
@include('layouts.no_records')
@else
<input type="hidden" id="txt_tasks_route" value="{{ route('task_index_ajax') }}">
<input type="hidden" id="txt_destroy_task_route" value="{{ route('task_destroy_ajax') }}">
<input type="hidden" id="txt_archive_task_route" value="{{ route('task_archive_ajax') }}">
<div id="task_table_render"></div>
@include('tasks.show_task_modal')
@include('users.show_user_modal')
@include('projects.show_project_modal')
@include('comments.index_task_comment_modal')
<input type="hidden" id="txt_set_task_status_route" value="{{ route('set_task_status')}}" />
@endif
@endsection