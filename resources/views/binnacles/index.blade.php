@extends('layouts.app')
@section('content')
<a href="{{ route('create_binnacle') }}" class="float-right">[<span class="icon-plus">Crear bitácora<span>]</a>
<h4 class="title_page ">Bitácoras</h4>
<br/>
<span class="float-right">{{ $binnacles->links() }}</span>
@if(count($binnacles) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th width="15%">Proyecto</th>
            <th width="15%">Autor</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($binnacles as $binnacle)
        <tr>
            @if(!empty($binnacle->sale['description']))
            <td width="15%"><a href="{{ route('show_sale',$binnacle->sale['id']) }}" target="_blank">{{ $binnacle->sale['description'] }}</a></td>
            @else
            <td width="15%" class="text-center font-weight-bold">No asignado</td>
            @endif
            <td width="15%">{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
            <td width="25%">{{ $binnacle->description }}</td>
            <td width="15%">{{ formatDate($binnacle->created_at) }}</td>
            <td width="15%">
                <a href="#" onclick="addBinnacleImage({{ $binnacle->id }})">
                    <span class="icon-plus" title="Agregar imagen..." style="cursor:pointer;color:#c52cec">
                        Nuevo
                    </span>
                </a>
                <br>
                <a href="#" onclick="viewBinnacleImages({{ $binnacle->id }},{{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }})">
                    <span class="icon-image" title="ver imágenes..." style="cursor:pointer;color:#2c49ec">
                        {{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }}
                        Imágenes
                    </span>
                </a>
                <br>
                <a href="{{ route('binnacle_pdf',$binnacle->id) }}" target="_blank">
                    <span class="icon-file-pdf" title="Ver pdf..." style="cursor:pointer;color:#ec422c">
                        PDF
                    </span>
                </a>
                <br>
                <a href="#" onclick="sendBinnacle({{ $binnacle->id }});">
                    <span class="icon-envelop" title="Enviar pdf..." style="cursor:pointer;color:#b3d420">
                        Enviar
                    </span>
                </a>
                <br>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('sale.send_binnacle_pdf_modal')
@include('sale.add_binnacle_image_modal')
<input type="hidden" id="txt_get_binnacle" value="{{ route('binnacle_show_json') }}">
<input type="hidden" id="txt_show_binnacle_image_route" value="{{ route('show_binnacle_image') }}">
<input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}">
@endif
@endsection