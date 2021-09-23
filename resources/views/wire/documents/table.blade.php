<a href="#" onclick = "$('#create_document').modal();" class="float-right">[<span class="icon-plus">Subir documento<span>]</a><br/><br/>
    @include('wire.partials.search')
    @if(count($documents) <= 0)
    @include('layouts.no_records')
    @else
    {{ $documents->links('pagination-links') }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="20%">Autor</th>
                <th width="15%">Nombre</th>
                <th width="25%">Descriptción</th>
                <th width="15%">Visibilidad</th>
                <th width="15%">Fecha</th>
                <th width="15%">Documento</th>
                <th width="15%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document) 
            <tr>
                <td>{{ $document->author['name'] }} {{ $document->author['middle_name'] }} {{ $document->author['last_name'] }}</td>
                <td>{{ $document->name }}</td>
                <td>{{ $document->description }}</td>
                <td>{{ $document->visibility }}</td>
                <td>{{ $document->created_at }}</td>
                <td><a href = "{{ asset('storage/documents') }}/{{ $document->document }}" target="_blank">{{ $document->document }}</a></td>
                <td>
                    @if(\Auth::user()->rol_user_id == 1 || $document->author_id == \Auth::user()->id)
                    <a href="javascript:void(0)" onclick="destroyDocument({{ $document->id }});" style = "color:red;"><span class = "icon-bin"> Eliminar</span></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    @endif