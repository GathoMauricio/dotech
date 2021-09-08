@include('wire.partials.search')



<table class="table table-bordered">
    <thead>
        <tr>
            <th width="15%">Fecha</th>
            <th width="15%">Proyecto / Alias</th>
            <th width="10%">Departamento</th>
            <th width="10%">Encargado</th>
            <th width="15%">Bitácoras del proyecto</th>
        </tr>
    </thead>
    <tbody>
    @php 
        $binnacles = App\Binnacle::where('company_id',auth('clients')->user()->id)->get();
    @endphp
    @foreach($binnacles as $binnacle)
        <tr>
            <td>{{ onlyDate($binnacle->created_at) }}</td>
            <td>{{ $binnacle->alias }}</td>
            <td>N/A</td>
            <td>N/A</td>
            <td>
                @if(count($binnacles) <= 0)
                    No se han creado bitácoras para este proyecto
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
                No se han creado bitácoras para este proyecto
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