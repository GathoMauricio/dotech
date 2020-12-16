@extends('layouts.app')
@section('content')
<h4 class="title_page">Crear tarea</h4>
<form action="{{ route('task_store') }}" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="priority" class="font-weight-bold color-primary-sys">Prioridad</label>
                    <select name="priority" class="custom-select">
                        <option value="Urgente">Urgente</option>
                        <option value="Alta">Alta</option>
                        <option value="Normal" selected>Normal</option>
                        <option value="Baja">Baja</option>
                    </select>
                    @if($errors->has('priority'))
                    <small style="color:#d30035">{{ $errors->first('priority') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="context" class="font-weight-bold color-primary-sys">Contexto</label>
                    <select name="context" class="custom-select">
                        <option value="Trabajo" selected>Trabajo</option>
                        <option value="Reunión">Reunión</option>
                        <option value="Documento">Documento</option>
                        <option value="Internet">Internet</option>
                        <option value="Teléfono">Teléfono</option>
                        <option value="Email">Email</option>
                        <option value="Hogar">Hogar</option>
                        <option value="Otro">Otro</option>
                    </select>
                    @if($errors->has('context'))
                    <small style="color:#d30035">{{ $errors->first('context') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="deadline" class="font-weight-bold color-primary-sys">Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                    @if($errors->has('deadline'))
                    <small style="color:#d30035">{{ $errors->first('deadline') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <!--
            <div class="col-md-6">
                <div class="form-group">
                    <a href="#" class="float-right font-weight-bold link-sys" onclick="createProjectModal();">
                        [ <small class="  icon-plus"></small> Crear proyecto ]
                    </a>
                    <label for="project_id" class="font-weight-bold color-primary-sys">Proyecto</label>
                    <select id="select_project_task" name="project_id" class="custom-select">
                        <option value selected>--Sin seleccionar--</option>
                        @foreach($projects as $project) 
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project_id'))
                    <small style="color:#d30035">{{ $errors->first('project_id') }}</small>
                    @endif
                </div>
            </div>
            -->
            <div class="col-md-12">
                <div class="form-group">
                    <input type="hidden" name="project_id" value="0">
                    <label for="user_id" class="font-weight-bold color-primary-sys">Usuario</label>
                    <select name="user_id" class="custom-select">
                        <option value selected>--Seleccione una opción--</option>
                        @foreach($users as $user) 
                        <option value="{{ $user->id }}">
                            {{ $user->name }} 
                            {{ $user->middle_name }} 
                            {{ $user->last_name }} 
                            - 
                            {{ $user->rol['name'] }} 
                            - 
                            {{ $user->location['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('user_id'))
                    <small style="color:#d30035">{{ $errors->first('user_id') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title" class="font-weight-bold color-primary-sys">Título</label>
                    <input type="text" name="title" placeholder="Ingrese un título a esta tarea..." class="form-control">
                    @if($errors->has('title'))
                    <small style="color:#d30035">{{ $errors->first('title') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="font-weight-bold color-primary-sys">Descripción</label>
                    <textarea name="description" placeholder="Ingrese una descropción a esta tarea..." class="form-control"></textarea>
                    @if($errors->has('description'))
                    <small style="color:#d30035">{{ $errors->first('description') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status" class="font-weight-bold color-primary-sys">Estatus</label>
                    <select name="status" class="custom-select">
                        <option value="0%" selected>0%</option>
                        <option value="20%" >20%</option>
                        <option value="40%" >40%</option>
                        <option value="60%" >60%</option>
                        <option value="80%" >80%</option>
                        <option value="100%" >100%</option>
                    </select>
                    @if($errors->has('status'))
                    <small style="color:#d30035">{{ $errors->first('status') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="visibility" class="font-weight-bold color-primary-sys">Visibilidad</label>
                    <table style="width:100%;">
                        <tr>
                            <td width="50%">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" value="Público" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Público 
                                        <span 
                                        onclick="alert('Si selecciona esta opción todos podrán ver y commentar esta tarea.');" 
                                        class="icon icon-info color-primary-sys" 
                                        style="cursor:pointer;">
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td width="50%">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" value="Privado" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Privado 
                                        <span 
                                        onclick="alert('Si selecciona esta opción solo el usuario asignado y quien creo la tarea podrá ver y comentar esta misma.');" 
                                        class="icon icon-info color-primary-sys" 
                                        style="cursor:pointer;">
                                        </span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>
                    @if($errors->has('visibility'))
                    <small style="color:#d30035">{{ $errors->first('visibility') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br>
                <input type="submit" value="Guardar" class="btn btn-primary-sys float-right">
                <a href="{{ route('task_index') }}" class="btn btn-default-sys float-right">Cancelar</a>
            </div>
        </div>
    </div>
</form>
@include('projects.create_modal')
@endsection