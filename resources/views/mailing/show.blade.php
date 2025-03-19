@extends('layouts.app')
@section('content')
    <h4 class="title_page">Detalle template</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Remitente</label>
                    {{ $mailing->from }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Por defecto</label>
                    {{ $mailing->selected }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Asunto</label>
                    {{ $mailing->subject }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Cuerpo del correo</label>
                    <br>
                    {!! $mailing->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection
