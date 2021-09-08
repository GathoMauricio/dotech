@include('wire.partials.search')
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
{{ $sales->links('pagination-links') }}

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="15%">Fecha</th>
            <th width="15%">Proyecto</th>
            <th width="10%">Departamento</th>
            <th width="10%">Encargado</th>
            <th width="15%">Bitácoras del proyecto</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($sales as $sale)
        @php 
            $binnacles = App\Binnacle::where('sale_id', $sale->id)->get();
        @endphp
        <tr>
            <td>{{ onlyDate($sale->created_at) }}</td>
            <td>{{ $sale->description }}</td>
            <td>{{ $sale->department['name'] }}</td>
            <td>{{ $sale->department['manager'] }}</td>
            <td>
                @if(count($binnacles) <= 0)
                    No se han creado bitácoras
                @else
                    @foreach($binnacles as $binnacle)
                        <a href="{{ route('binnacle_pdf_client',$binnacle->id) }}" target="_blank">{{ $binnacle->description }}</a>
                        <br/>
                        <small class="float-right">{{ onlyDate($binnacle->created_at) }}</small>
                        <hr/>
                    @endforeach
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif