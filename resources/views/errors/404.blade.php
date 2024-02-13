@extends('errors::illustrated-layout')

@section('code', '404')
@section('title', __('Página no encontrada'))

@section('image')
    <div style="background-image: url('{{ asset('img/404.jpg') }}');"
        class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', 'La página a la que está tratando de acceder no existe. Por favos verifíquela y vuelva a
    intentarlo.')
