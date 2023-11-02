@extends('layouts.app')
@section('content')
    <a href="{{ route('create_company') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small>
        Agregar compañía ]</a>
    {{--  <h4 class="title_page">Clientes</h4>  --}}
    <div id="exTab1" class="container">
        <ul class="nav nav-pills">
            <li class="nav-item active">
                <a href="#clientes" data-toggle="tab" class="nav-link active">Clientes</a>
            </li>
            <li class="nav-item">
                <a href="#prospectos" data-toggle="tab" class="nav-link">Prospectos</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="clientes">
                @include('companies.tabla_clientes')
            </div>
            <div class="tab-pane" id="prospectos">
                @include('companies.tabla_prospectos')
            </div>
        </div>
    </div>
    @include('companies.follow_modal')
    @include('quotes.add_quote_by_company_modal')
    @include('companies.add_department_company_modal')


    <!-- Bootstrap core JavaScript
                                                                                ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@endsection
