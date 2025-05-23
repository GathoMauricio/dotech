@extends('layouts.app')
@section('content')
    <a href="{{ route('create_mailing') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small>
        Agregar template ]</a>
    <br>
    <a href="{{ route('listas_envios') }}" class="float-right font-weight-bold link-sys">[Listas de envio]</a>
    <h4 class="title_page">Templates</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Remitente</th>
                <th>Asunto</th>
                <th>Adjuntos</th>
                <th>Lstas</th>
                {{--  <th>Por defecto</th>  --}}
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailings as $mailing)
                <tr>
                    <td>{{ $mailing->from }}</td>
                    <td>{{ $mailing->subject }}</td>
                    <td>{{ $mailing->adjuntos->count() }}</td>
                    <td>
                        @if ($mailing->listas_pivot->count() > 0)
                            <ul>
                                @foreach ($mailing->listas_pivot as $piv)
                                    <li>{{ $piv->lista->nombre }}</li>
                                @endforeach
                            </ul>
                        @else
                            Sin listas
                        @endif
                    </td>
                    {{--  <td>{{ $mailing->selected }}</td>  --}}
                    <td>
                        <a href="{{ route('show_mailing', $mailing->id) }}">Ver</a>
                        <br>
                        <a href="{{ route('edit_mailing', $mailing->id) }}">Editar</a>
                        @if ($mailing->listas_pivot->count() > 0)
                            <br>
                            <a href="javascript:void(0);" onclick="enviarMailing({{ $mailing->id }})">Enviar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('custom_scripts')
    <script>
        function enviarMailing(mailing_id) {
            if (confirm("¿Iniciar proceso en segundo plano?")) {
                alert(
                    "El proceso ha comenzado a ejecutarse en segundo plano, esto puede tardar conderablemente pero puede seguir usando el sistema con normalidad..."
                    );
                $.ajax({
                    type: "GET",
                    url: "{{ route('enviar_mailing') }}/" + mailing_id,
                    success: (data) => {

                    },
                    error: (err) => console.log(err),
                });
            }
        }
    </script>
@endsection
