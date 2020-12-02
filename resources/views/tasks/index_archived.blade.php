@extends('layouts.app')
@section('content')
<h4 class="title_page">Tareas archivadas</h4>
<small><a href="{{ route('task_index') }}">[ Ver tareas activas ]</a></small>
@if(count($tasks) <= 0)
@include('layouts.no_records')
@else
<input type="hidden" id="txt_tasks_archived_route" value="{{ route('task_archived_index_ajax') }}">
<input type="hidden" id="txt_destroy_task_route" value="{{ route('task_destroy_ajax') }}">
<div id="task_archived_table_render"></div>
@include('tasks.show_task_modal')
@include('users.show_user_modal')
@include('projects.show_project_modal')
@include('comments.index_task_comment_modal')
@endif
@endsection