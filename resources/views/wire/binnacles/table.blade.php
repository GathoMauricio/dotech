@include('wire.partials.search')

@if(count($binnacles) <= 0)
@include('layouts.no_records')
@else
{{ $binnacles->links('pagination-links') }}
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="10%">Cliente</th>
            <th width="15%">Proyecto</th>
            <th width="10%">Autor</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($binnacles as $binnacle)
        <tr>
            <td width="10%">
            @if(empty($binnacle->sale->company['name']))
            No disponible
            @else
            {{ $binnacle->sale->company['name'] }}
            @endif
            </td>
            @if(!empty($binnacle->sale['description']))
            <td width="10%"><a href="{{ route('show_sale',$binnacle->sale['id']) }}" target="_blank">{{ $binnacle->sale['description'] }}</a></td>
            @else
            <td width="15%" class="text-center font-weight-bold">No asignado</td>
            @endif
            <td width="15%">{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
            <td width="25%">{{ $binnacle->description }}</td>
            <!--<td width="15%">{{ formatDate($binnacle->created_at) }}</td>-->
            <td width="15%">{{ explode(' ',$binnacle->created_at)[0] }}</td>
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
                @if(Auth::user()->rol_user_id == 1)
                <a href="#" onclick="deleteBinnacle({{ $binnacle->id }});">
                    <span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:red">
                        Eliminar
                    </span>
                </a>
                <br>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('binnacles.show_modal')
@include('sale.send_binnacle_pdf_modal')
@include('sale.add_binnacle_image_modal')
<input type="hidden" id="txt_get_binnacle" value="{{ route('binnacle_show_json') }}">
<input type="hidden" id="txt_show_binnacle_image_route" value="{{ route('show_binnacle_image') }}">
<input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}">
<input type="hidden" id="txt_delete_binnacle_route" value="{{ route('delete_binnacle') }}"/>
@endif