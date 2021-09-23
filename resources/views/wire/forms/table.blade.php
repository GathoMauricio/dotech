<a href="#" onclick = "$('#create_form').modal();" class="float-right">[<span class="icon-plus">Subir machote<span>]</a><br/><br/>
    @include('wire.partials.search')
    @if(count($forms) <= 0)
    @include('layouts.no_records')
    @else
    {{ $forms->links('pagination-links') }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="20%">Autor</th>
                <th width="15%">Nombre</th>
                <th width="25%">Descriptción</th>
                <th width="15%">Fecha</th>
                <th width="15%">Documento</th>
                <th width="15%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form) 
            <tr>
                <td>{{ $form->author['name'] }} {{ $form->author['middle_name'] }} {{ $form->author['last_name'] }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ $form->description }}</td>
                <td>{{ $form->created_at }}</td>
                <td><a href = "{{ asset('storage/forms') }}/{{ $form->document }}" target="_blank">{{ $form->document }}</a></td>
                <td>
                    @if(\Auth::user()->rol_user_id == 1 || $form->author_id == \Auth::user()->id)
                    <a href="javascript:void(0)" wire:click="edit({{ $form->id }});" style = "color:rgb(255, 153, 0);"><span class = "icon-pencil"> Editar</span></a>
                    <a href="javascript:void(0)" onclick="destroyDocument({{ $form->id }});" style = "color:red;"><span class = "icon-bin"> Eliminar</span></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    @endif