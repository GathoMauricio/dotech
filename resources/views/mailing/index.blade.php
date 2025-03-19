@extends('layouts.app')
@section('content')
    <a href="{{ route('create_mailing') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small>
        Agregar template ]</a>
    <h4 class="title_page">Templates</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Remitente</th>
                <th>Asunto</th>
                <th>Por defecto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailings as $mailing)
                <tr>
                    <td>{{ $mailing->from }}</td>
                    <td>{{ $mailing->subject }}</td>
                    <td>{{ $mailing->selected }}</td>
                    <td>
                        <a href="{{ route('show_mailing', $mailing->id) }}">Ver</a>
                        <br>
                        <a href="{{ route('edit_mailing', $mailing->id) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
