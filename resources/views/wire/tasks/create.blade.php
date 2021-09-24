<!-- Modal -->
<div wire:ignore.self class="modal fade" id="create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Crear tarea
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="priority">Prioridad</label>
                                <select wire:model = "priority" class="custom-select">
                                    <option value>--Seleccione una opción--</option>
                                    <option value="Urgente">Urgente</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Normal" selected="">Normal</option>
                                    <option value="Baja">Baja</option>
                                </select>
                                @error('priority') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="context">Contexto</label>
                                <select wire:model="context" class="custom-select">
                                    <option value>--Seleccione una opción--</option>
                                    <option value="Trabajo" selected="">Trabajo</option>
                                    <option value="Reunión">Reunión</option>
                                    <option value="Documento">Documento</option>
                                    <option value="Internet">Internet</option>
                                    <option value="Teléfono">Teléfono</option>
                                    <option value="Email">Email</option>
                                    <option value="Hogar">Hogar</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('context') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input wire:model="deadline" type="date" class="form-control">
                                @error('deadline') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Cliente</label>
                                <select wire:model = "company_id" wire:change = "cambiarCliente" class="form-control">
                                    <option value>--Seleccione una opción--</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id }}">{{ $cliente->name }}</option>
                                    @endforeach
                                </select>
                                @error('') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sale_id">Proyecto</label>
                                <select wire:model = "sale_id" class="form-control">
                                    <option value>--Seleccione una opción--</option>
                                    @if(!is_null($proyectos))
                                    @foreach($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->description }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('sale_id') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">Asignar a</label>
                                <select wire:model="user_id" class="form-control">
                                    <option value>--Seleccione una opción--</option>
                                    @foreach($empleados as $empleado)
                                    <option value="{{$empleado->id }}">{{ $empleado->name }} {{ $empleado->middle_name }} {{ $empleado->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input wire:model="title"type="text" class="form-control" />
                            @error('title') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea  wire:model="description"class="form-control" ></textarea>
                            @error('description') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Estatus</label>
                            <select wire:model="status" class="custom-select">
                                <option value>--Seleccione una opción--</option>
                                <option value="0%" selected="">0%</option>
                                <option value="20%">20%</option>
                                <option value="40%">40%</option>
                                <option value="60%">60%</option>
                                <option value="80%">80%</option>
                                <option value="100%">100%</option>
                            </select>
                            @error('status') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visibility">Visibidad</label>
                            <select  wire:model="visibility"class="form-control" >
                                <option value>--Seleccione una opción--</option>
                                <option value="Privado">Privado</option>
                                <option value="Público">Público</option>
                            </select>
                            @error('visibility') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

            </div>
               
            <div class="modal-footer">
                    <button wire:click = "store" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>