@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Sin permiso'))

@section('image')
    <div style="background-image: url('{{ asset('img/403.jpg') }}');"
        class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message',
    'Lo sentimos, el usuario firmado no cuenta con los permisos necesarios para ver este contenido. Por
    favor consulte con el administrador del sistema.')
