<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-wught-bold">Seleccionar mes</label>
                <input type="month" wire:model ="searchMonth" class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-wught-bold">Nombre del proyecto</label>
                <input type="text" wire:model ="searchCriteria" class="form-control" placeholder="Aa" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="font-wught-bold">Estatus</label>
                <select wire:model = "searchStatus" class="form-control">
                    <option value>Todos</option>
                    <option value="Pendiente">Cotizaciones</option>
                    <option value="Proyecto">Proyectos</option>
                    <option value="Finalizado">Finalizados</option>
                </select>
            </div>
        </div>
        <!--
        <div class="col-md-3">
            <div class="form-group">
                <label class="font-wught-bold">Departamento</label>
                <select class="form-control">
                
                </select>
            </div>
        </div>
        -->
    </div>
</div>

<table class="table table-striped" id="table">
    <thead>
        <tr>
            <th width="15%">Fecha</th>
            <th width="15%"><span style="color:green">Proyectos</span> / <span style="color:orange">Cotizaciones</span></th>
            <th width="10%">Estatus</th>
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
            @if($binnacle->status == 'Pendiente')
            <td style="color:orange">Cotización</td>
            @endif
            @if($binnacle->status == 'Proyecto')
            <td style="color:green">{{ $binnacle->status }}</td>
            @endif
            @if($binnacle->status == 'Finalizado')
            <td style="color:green">{{ $binnacle->status }}</td>
            @endif
            <td>N/A</td>
            <td>N/A</td>
            <td>
                @if(count($binnacles) <= 0)
                    @if($binnacle->status == 'Pendiente')
                    <a href="{{ route('load_sale_pdf',$binnacle->id) }}" target="_blank">{{ $binnacle->description }}</a>
                    @endif
                    @if($binnacle->status == 'Proyecto')
                    No se han creado bitácoras para este proyecto
                    @endif
                    @if($binnacle->status == 'Finalizado')
                    No se crearon bitácoras para este proyecto
                    @endif
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
            @if($sale->status == 'Pendiente')
            <td style="color:orange">Cotización</td>
            @endif
            @if($sale->status == 'Proyecto')
            <td style="color:green">{{ $sale->status }}</td>
            @endif
            @if($sale->status == 'Finalizado')
            <td style="color:green">{{ $sale->status }}</td>
            @endif
            <td>{{ $sale->department['name'] }}</td>
            <td>{{ $sale->department['manager'] }}</td>
            <td>
                @if(count($binnacles) <= 0)
                    @if($sale->status == 'Pendiente')
                    <a href="{{ route('load_sale_pdf',$sale->id) }}" target="_blank">{{ $sale->description }}</a>
                    @endif
                    @if($sale->status == 'Proyecto')
                    No se han creado bitácoras para este proyecto
                    @endif
                    @if($sale->status == 'Finalizado')
                    No se crearon bitácoras para este proyecto
                    @endif
                @else
                    @foreach($binnacles as $binnacle)
                        <a href="{{ route('binnacle_pdf_client',$binnacle->id) }}" target="_blank">{{ $binnacle->description }}</a>
                        <br/>
                        <small class="float-right">{{ onlyDate($sale->created_at) }}</small>
                        <hr/>
                    @endforeach
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>