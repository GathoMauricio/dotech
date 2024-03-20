<!-- Modal -->
<div class="modal fade" id="editar_cliente_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar {{ $cliente->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="javascript:void(0)" onclick="nuevoOrigen();" class="float-right">Nuevo
                                    origen</a>
                                <label for="origin">Origen</label>
                                <select name="origin" id="cbo_edit_origin" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($origenes as $key => $origen)
                                        @if (old('origin', $cliente->origin) == $origen->origen)
                                            <option value="{{ $origen->origen }}" selected>{{ $origen->origen }}
                                            </option>
                                        @else
                                            <option value="{{ $origen->origen }}">{{ $origen->origen }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('origin')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="porcentaje">Porcentaje</label>
                                @if (Auth::user()->hasRole('Administrador'))
                                    <select name="porcentaje" class="form-control" required>
                                        <option value>--Seleccione una opción--</option>
                                        @if (old('porcentaje', $cliente->porcentaje) == 8)
                                            <option value="8" selected>8%</option>
                                            <option value="13">13%</option>
                                        @else
                                            <option value="8">8%</option>
                                            <option value="13" selected>13%</option>
                                        @endif
                                    </select>
                                @else
                                    <center><strong>{{ $cliente->porcentaje }}%</strong></center>
                                    <input type="hidden" name="porcentaje" value="{{ $cliente->porcentaje }}"
                                        id="cbo_edit_porcentaje" readonly>
                                @endif
                                @error('porcentaje')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Cliente / Empresa</label>
                                <input type="text" name="name" value="{{ old('name', $cliente->name) }}"
                                    class="form-control" required>
                                @error('name')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsable">Responsable</label>
                                <input type="text" name="responsable"
                                    value="{{ old('responsable', $cliente->responsable) }}" class="form-control"
                                    required>
                                @error('responsable')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="responsable">RFC</label>
                                <input type="text" name="rfc" value="{{ old('rfc', $cliente->rfc) }}"
                                    class="form-control">
                                @error('rfc')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" value="{{ old('phone', $cliente->phone) }}"
                                    class="form-control" required>
                                @error('phone')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ old('email', $cliente->email) }}"
                                    class="form-control" required>
                                @error('email')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <textarea name="address" class="form-control">{{ old('address', $cliente->address) }}</textarea>
                                @error('address')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if ($cliente->status == 'Cliente')
                        <div class="row">
                            <div class="col-md-12">
                                <label for="status">Vendedor asignado</label>
                                <select name="vendedor_id" id="cbo_edit_vendedor" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($vendedores as $vendedor)
                                        @if ($cliente->vendedor_id == $vendedor->id)
                                            <option value="{{ $vendedor->id }}" selected>
                                                {{ $vendedor->name }}
                                                {{ $vendedor->middle_name }}
                                                {{ $vendedor->last_name }}
                                            </option>
                                        @else
                                            <option value="{{ $vendedor->id }}">
                                                {{ $vendedor->name }}
                                                {{ $vendedor->middle_name }}
                                                {{ $vendedor->last_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <label for="status">Autor</label>
                                <select name="author_id" id="cbo_edit_author" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($vendedores as $vendedor)
                                        @if ($cliente->vendedor_id == $vendedor->id)
                                            <option value="{{ $vendedor->id }}" selected>
                                                {{ $vendedor->name }}
                                                {{ $vendedor->middle_name }}
                                                {{ $vendedor->last_name }}
                                            </option>
                                        @else
                                            <option value="{{ $vendedor->id }}">
                                                {{ $vendedor->name }}
                                                {{ $vendedor->middle_name }}
                                                {{ $vendedor->last_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" id="hidden_vendedor_id" name="vendedor_id">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
