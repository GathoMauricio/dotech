@extends('layouts.app')
@section('content')
<h4 class="title_page text-center">
    Detalles de la imagen
</h4>
<p class="text-center">
    <form action="{{ route('update_binnacle_image',$image->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold color-primary-sys">
                            Descripción
                        </label>
                        @if(Auth::user()->rol_user_id == 1)
                        <textarea name="description" class="form-control" required>{{ $image->description }}</textarea>
                        @else
                        <br/>
                        {{ $image->description }}
                        @endif
                    </div>
                </div>
            </div>
            @if(Auth::user()->rol_user_id == 1)
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary float-right" value="Actualizar">
                </div>
            </div>
            @endif
        </div>
    </form>
    <br/>
    <img src="{{ asset('storage') }}/{{ $image->image }}" width="100%" height="">
    <br/><br/>
    <center><a href="#" onclick="deleteBinnacleImage({{ $image->id }});" class="font-weight-bold"><span class="icon-bin">{</span> Eliminar imagen]</a></center>
</p>
<input type="hidden" id="txt_destroy_binnacle_image" value="{{ route('delete_binnacle_image') }}">
@endsection