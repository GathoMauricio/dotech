@extends('layouts.app')
@section('content')
<img src="{{ asset('img/withdrawal_header.png') }}" style="width:100%;" height="200" />
<br><br>
<h4 class="title_page">Cuentas de retiro</h4> 
@include('config.menu')
<br/>
<a href="{{ route('create_account') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar departamento ]</a>
@if(count($accounts) <= 0)
@include('layouts.no_records')
@else

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Saldo</th>
            <th>Cuenta</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
        <tr>
            <td>{{ $account->name }}</td>
            <td>{{ $account->type }}</td>
            <td>${{ $account->balance }}</td>
            <td>{{ $account->number }}</td>
            <td>
                <a href="{{ route('edit_account', $account->id) }}"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="#" onclick="deleteAccount({{ $account->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                <br>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_delete_account_route" value="{{ route('delete_account') }}">
@endif
@endsection