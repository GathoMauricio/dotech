@extends('layouts.app')
@section('content')
    <h4 class="title_page">Aspirantes</h4>
    <a href="{{ route('candidates_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar aspirante ]</a>
    @if(count($users) <= 0)
        @include('layouts.no_records')
    @else
        <br><br>
        <table class="table table-bordered" id="index_table">
            <thead>
            <tr>
                <th width="20%">Foto</th>
                <th width="20%">Nombre</th>
                <th width="20%">Email</th>
                <th width="20%">Teléfono</th>
                <th width="10%">Localidad</th>
                <th width="10%">Evaluación</th>
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
                    @if(empty($user->evaluation))
                    <td id="td_evaluation_{{ $user->id }}">No realizada</td>
                    @else
                    <td id="td_evaluation_{{ $user->id }}">{{ $user->evaluation }}</td>
                    @endif
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
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script>
            jQuery(document).ready(function(){
                $("#index_table").dataTable({
                    deferRender: true,
                    bJQueryUI: true,
                    bScrollInfinite: true,
                    bScrollCollapse: true,
                    bPaginate: true,
                    bFilter: true,
                    bSort: true,
                    aaSorting: [[2, "asc"]],
                    pageLength: 10,
                    bDestroy: true,
                    aoColumnDefs: [
                        {
                            bSortable: false,
                            aTargets: [0,6]
                        },
                    ],
                    oLanguage: {
                        sLengthMenu: "_MENU_ ",
                        sInfo:
                            "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                        sInfoEmpty: "No hay registros para mostrar",
                        sSearch: "",
                        oPaginate: {
                            sFirst: "Primer página",
                            sLast: "Última página",
                            sPrevious: "<b>Anterior</b>",
                            sNext: "<b>Siguiente</b>"
                        }
                    }
                });
                setTableStyle()
            });
            function setTableStyle() {
                setTimeout(function() {
                    $("select[name='DataTables_Table_0_length']").prop(
                        "class",
                        "custom-select"
                    );
                    $(".dataTables_length").prepend("<b>Mostrar</b> ");
                    $("select[name='table_asistencias_length']").prop(
                        "class",
                        "custom-select"
                    );
                    $("select[name='DataTables_Table_0_length']").prop(
                        "class",
                        "form-control"
                    );
                    $(".dataTables_length").append(" <b>elementos por página</b>");

                    $("input[type='search']").prop("class", "form-control");
                    $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
                }, 300);
            }
        </script>

    @endif
    <input type="hidden" id="txt_delete_candidate_route" value="{{ route('candidates_destroy') }}">
@endsection
