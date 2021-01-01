@extends('layouts.app')
@section('content')
<h4 class="title_page">Configuración</h4>
@include('config.menu')
<br><br>

<center>
    <div id="user_image">
        <br><br><br><br><br>
        <p style="background-color:black;opacity:0.8;padding:5px;">
            <a href="#" class="font-weight-bold" style="color:white;"><span class="icon-pencil"></span> Editar</a>
        </p>
    </div>
    
</center>
<br>
<table class="table">
    <tr>
        <th width="45%"> <h5 class="font-weight-bold color-primary-sys">Nombre</h5> </th>
        <td width="45%"> 
            <h5 class="font-weight-bold">
                {{ Auth::user()->name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}
            </h5> 
        </td>
        <td width="10%"><a href="#" onclick="editNameModal();"><span class="icon-pencil"></span> Editar</a></td>
    </tr>
    <tr>
        <th width="45%"> <h5 class="font-weight-bold color-primary-sys">Contacto</h5> </th>
        <td width="45%"> 
            <h5 class="font-weight-bold">
                {{ Auth::user()->email }}
            </h5> 
        </td>
        <td width="10%"><a href="#"><span class="icon-pencil"></span> Editar</a></td>
    </tr>

    <tr>
        <th width="45%"> <h5 class="font-weight-bold color-primary-sys">Contraseña</h5> </th>
        <td width="45%"> 
            <h5 class="font-weight-bold">
                **************
            </h5> 
        </td>
        <td width="10%"><a href="#"><span class="icon-pencil"></span> Editar</a></td>
    </tr>

</table>
@include('config.edit_name_modal')
@php 
if(Auth::user()->image == 'perfil.png')
{
    $userImage= asset('img').'/'.Auth::user()->image;  
}else {
    $userImage= env('APP_URL').'/storage/'.Auth::user()->image;  
}
@endphp
<style>
    #user_image{
        background:url({{ $userImage }});
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        padding-top:10px;
        width:150px;
        height:150px;
    }
</style>

@endsection