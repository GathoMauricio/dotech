@extends('layouts.app')
@section('content')
<h4 class="title_page">Documentación de {{ $company->name }}</h4>
<br>
<p>
    <a href="#" onclick="$('#add_company_document_modal').modal();" class="float-right"><span class="icon-plus"></span> Agregar nuevo</a>
</p>
<br>
@if(count($documents) <= 0)
@include('layouts.no_records')
@else
{{ $documents->links('pagination-links') }}
<table class="table table-bordered">
    <thead>
        <tr>
            <th >Fecha</th>
            <th >Autor</th>
            <th >Descripción</th>
            <th >Documento</th>
            <th ></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documents as $document)
            <tr>
                <td>{{ onlyDate($document->created_at) }}</td>
                <td>{{ $document->author['name'] }} {{ $document->author['middle_name'] }} {{ $document->author['last_name'] }}</td>
                <td>{{ $document->description }}</td>
                <td><a href="{{ asset('storage') }}/{{ $document->document }}" target="_blank">{{ $document->document }}</a></td>
                <td>
                    @if(\Auth::user()->rol_user_id == 1 || \Auth::user()->id == $document->author['id'])
                    <a href='#' onclick='editCompanyDocument({{ $document->id }})' style='cursor:pointer;color:orange;'><span title='Actualizar...' class='icon icon-pencil'></span> Editar</a>
                    <br>
                    <a href='#' onclick='deleteCompanyDocument({{ $document->id }})' style='cursor:pointer;color:red;'><span title='Eliminar..' class='icon icon-bin' style='cursor:pointer;color:red;'> Eliminar</span></a>
                    @endif
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
@endif

@include('company_documents.create')
@include('company_documents.edit')

<script>
    editCompanyDocument = id => {
        $.ajax({
            type: 'GET',
            url: '{{ route('edit_company_document') }}',
            data: {id: id},
            success: data => {
                console.log(data);
                $("#txt_edit_company_document_id").val(data.id);
                $("#a_edit_company_document_document").prop('href','{{ asset('storage') }}/'+data.document);
                $("#a_edit_company_document_document").text(data.document);
                $("#txt_edit_company_document_description").val(data.description);
                $("#edit_company_document_modal").modal();
            },
            error: err => console.log(err)
        });
    };
    deleteCompanyDocument = id => {
        alertify.confirm("",
            function() {
                window.location = "{{ route('delete_company_document') }}/"+id;
            },
            function() {
                //alertify.error('Cancel');
            })
        .set('labels', { ok: 'Si, eliminar!', cancel: 'Cancelar' })
        .set({ transition: 'flipx', title: 'Alerta', message: '¿Eliminar registro?' });
    };

</script>
@endsection