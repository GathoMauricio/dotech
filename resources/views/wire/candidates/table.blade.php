<a href="{{ route('candidates_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar aspirante ]</a>
<br/><br/>
@include('wire.partials.search')
@if(count($users) <= 0)
        @include('layouts.no_records')
    @else
    {{ $whitdrawals->links('pagination-links') }}
        <br><br>
        <table class="table table-bordered" id="index_table">
            <thead>
            <tr>
                <th width="20%">Foto</th>
                <th width="20%">Nombre</th>
                <th width="20%">Email</th>
                <th width="20%">Teléfono</th>
                <th width="10%">Localidad</th>
                <th width="20%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->image == 'perfil.png')
                            <img onclick="showUserImage(this.src)" src="{{asset('img')}}/{{ $user->image }}" width="50" height="50"/>
                        @else
                            <img onclick="showUserImage(this.src)"  src="{{asset('storage')}}/{{ $user->image }}" width="50" height="50"/>
                        @endif
                    </td>
                    <td>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->location['name'] }}</td>
                    <td>
                        <a href="{{ route('candidates_edit', $user->id) }}"><span class="icon-eye" title="Ver/Editar" style="cursor:pointer;color:#F39C12"> Ver/Editar</span></a>
                        <br>
                        <a href="#" onclick="mostrarTest({{ $user->id }})"><span class="icon-file-text" title="Test de evaluación" style="cursor:pointer;color:blue"> Test</span></a>
                        <br>
                        <a href="#" onclick="deleteCandidate({{ $user->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                        <br>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('candidates.test')
        @endif
    <input type="hidden" id="txt_delete_candidate_route" value="{{ route('candidates_destroy') }}">