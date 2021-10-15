@include('wire.partials.search')
@if(count($whitdrawals) <= 0)
@include('layouts.no_records')
@else
{{ $whitdrawals->links('pagination-links') }}
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="10%">Id</th>
            <th width="10%">Proyecto</th>
            <th width="10%">Descripcion</th>
            <th width="10%">Empelado</th>
            <th width="10%">Cantidad</th>
            <th width="10%">Fecha</th>
            <th width="10%">Pagado</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody id="tbl_projects_to_search">
        @if(strlen($search)>0)

        @foreach($whitdrawals as $whitdrawal)
        @if($whitdrawal->PAGADO == 'SI')
        <tr class="bg-info" id="tr_whitdrawal_{{ $whitdrawal->ID }}">
        @else
        <tr id="tr_whitdrawal_{{ $whitdrawal->ID }}">
        @endif
            <td>{{ $whitdrawal->ID }}</td>
            <td>
            <a href="{{ route('show_sale',$whitdrawal->ID_VENTA) }}" target="_blank">
            {{ $whitdrawal->ID_VENTA }} 
            {{ $whitdrawal->NOMBRE_COMPANIA }} 
            - 
            {{ $whitdrawal->PROYECTO }}</a>
            <br/>
            <span class="text-info">Proveedor: </span>
            <br/>
            {{ $whitdrawal->PROVEDOR }}
            </td>
            <td>{{ $whitdrawal->DESCRIPCION }}</td>
            <td>
                @if(!empty($whitdrawal->NOMBRE_AUTOR))
                {{ $whitdrawal->NOMBRE_AUTOR }} 
                {{ $whitdrawal->PATERNO_AUTOR }} 
                {{ $whitdrawal->MATERNO_AUTOR }}
                @else
                No definido
                @endif
            </td>
            <td>${{ $whitdrawal->CANTIDAD }}</td>
            <!--<td>{{ $whitdrawal->FACTURA }}</td>-->
            <td>{{ onlyDate($whitdrawal->FECHA) }}</td>
            <td>
                <center>
                    <select onchange="updateWhitdrawalPaid({{ $whitdrawal->ID }},this.value);" >
                        @if($whitdrawal->PAGADO == 'SI')
                            <option value="SI" selected>SI</option>
                            <option value="NO">NO</option>
                        @else
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                        @endif
                    </select>
                    <br>
                    <img src="{{ asset('img/sat.png') }}" alt="" width="40">
                    <br>
                    @if($whitdrawal->FACTURA == 'SI')
                        @if(!empty($whitdrawal->ESTADO_CFDI))
                        {{ $whitdrawal->ESTADO_CFDI }}
                        @else
                        No disponible
                        @endif
                    <br>
                    <span wire:click = "validarFactura({{$whitdrawal->ID}})" class = "icon-spinner11" style = "cursor:pointer;color:#3498DB;"></span>
                    @else
                    N/A
                    @endif
                </center>
            </td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="javascript:void(0)" onclick="aproveWithdrawalModal({{ $whitdrawal->ID }});"><span class="icon-point-up" title="Aprovar" style="cursor:pointer;color:#74DF00"> Aprobar</span></a>
                <br>
                <a href="javascript:void(0)" onclick="disaproveWithdrawal({{ $whitdrawal->ID }});"><span class="icon-point-down" title="Desaprobar" style="cursor:pointer;color:#FFBF00"> Rechazar</span></a>
                <br>
                <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->ID }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                <br>
                <a href="javascript:void(0)" onclick="deleteWithdrawal({{ $whitdrawal->ID }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#DF0101"> Eliminar</span></a>
                <br>
                @if($whitdrawal->FACTURA == 'SI')
                    @if(!empty($whitdrawal->DOCUMENTO))
                    <a href="{{ env('APP_URL').'/storage/'.$whitdrawal->DOCUMENTO }}" target="_BLANK"><span class="icon-eye"></span> Ver</a>
                    @else 
                    <a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->ID }});"><span class="icon-upload"></span> Cargar</a>
                    @endif
                @else
                    N/A
                @endif
            </td>
            @else
                @if($whitdrawal->FACTURA == 'SI')
                    @if(!empty($whitdrawal->DOCUMENTO))
                    <td class="text-center">
                        <a href="{{ env('APP_URL').'/storage/'.$whitdrawal->DOCUMENTO }}" target="_BLANK"><span class="icon-eye"></span></a>
                        <br>
                        <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->ID }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                    </td>
                    @else 
                    <td class="text-center">
                        <a href="javascript:void(0)" onclick="addWhitdralDocumentModal({{ $whitdrawal->ID }});"><span class="icon-upload"></span></a>
                        <br>
                        <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->ID }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                    </td>
                    @endif
                @else
                <td class="text-center">N/A</td>
                @endif
            @endif
        </tr>
        @endforeach

        @else

        @foreach($whitdrawals as $whitdrawal)
        @if($whitdrawal->paid == 'SI')
        <tr class="bg-info" id="tr_whitdrawal_{{ $whitdrawal->id }}">
        @else
        <tr id="tr_whitdrawal_{{ $whitdrawal->id }}">
        @endif
            <td>{{ $whitdrawal->id }}</td>
            <td>
            <a href="{{ route('show_sale',$whitdrawal->sale->id) }}" target="_blank">
            {{ $whitdrawal->sale['id'] }} 
            {{ $whitdrawal->sale->company['name'] }} 
            - 
            {{ $whitdrawal->sale['description'] }}</a>
            <br/>
            <span class="text-info">Proveedor: </span>
            <br/>
            {{ $whitdrawal->provider['name'] }}
            </td>
            <td>{{ $whitdrawal->description }}</td>
            <td>
                @if(!empty($whitdrawal->author['name']))
                {{ $whitdrawal->author['name'] }} 
                {{ $whitdrawal->author['middle_name'] }} 
                {{ $whitdrawal->author['last_name'] }}
                @else
                No definido
                @endif
            </td>
            <td>${{ $whitdrawal->quantity }}</td>
            <!--<td>{{ $whitdrawal->invoive }}</td>-->
            <td>{{ onlyDate($whitdrawal->created_at) }}</td>
            <td>
                <center>
                    <select onchange="updateWhitdrawalPaid({{ $whitdrawal->id }},this.value);" >
                        @if($whitdrawal->paid == 'SI')
                            <option value="SI" selected>SI</option>
                            <option value="NO">NO</option>
                        @else
                            <option value="SI">SI</option>
                            <option value="NO" selected>NO</option>
                        @endif
                    </select>
                    <br>
                    <img src="{{ asset('img/sat.png') }}" alt="" width="40">
                    <br>
                    @if($whitdrawal->invoive == 'SI')
                        @if(!empty($whitdrawal->estado_cfdi))
                        {{ $whitdrawal->estado_cfdi }}
                        @else
                            No disponible
                        @endif
                        <br>
                        <span wire:click = "validarFactura({{$whitdrawal->id}})" class = "icon-spinner11" style = "cursor:pointer;color:#3498DB;"></span>
                    @else
                    N/A
                    @endif
                </center>
            </td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="javascript:void(0)" onclick="aproveWithdrawalModal({{ $whitdrawal->id }});"><span class="icon-point-up" title="Aprovar" style="cursor:pointer;color:#74DF00"> Aprobar</span></a>
                <br>
                <a href="javascript:void(0)" onclick="disaproveWithdrawal({{ $whitdrawal->id }});"><span class="icon-point-down" title="Desaprobar" style="cursor:pointer;color:#FFBF00"> Rechazar</span></a>
                <br>
                <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->id }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                <br>
                <a href="javascript:void(0)" onclick="deleteWithdrawal({{ $whitdrawal->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#DF0101"> Eliminar</span></a>
                <br>
                @if($whitdrawal->invoive == 'SI')
                    @if(!empty($whitdrawal->document))
                    <a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span> Ver</a>
                    @else 
                    <a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span> Cargar</a>
                    @endif
                @else
                    N/A
                @endif
            </td>
            @else
                @if($whitdrawal->invoive == 'SI')
                    @if(!empty($whitdrawal->document))
                    <td class="text-center">
                        <a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span></a>
                        <br>
                        <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->id }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                    </td>
                    @else 
                    <td class="text-center">
                        <a href="javascript:void(0)" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span></a>
                        <br>
                        <a href="javascript:void(0)" wire:click="edit({{ $whitdrawal->id }});"><span class="icon-pencil" title="Desaprobar" style="cursor:pointer;color:#ff9100"> Editar</span></a>
                    </td>
                    @endif
                @else
                <td class="text-center">N/A</td>
                @endif
            @endif
        </tr>
        @endforeach
        
        @endif

    </tbody>
</table>
@endif

<input type="hidden" id="txt_disaprove_whitdrawal_route" value="{{ route('disaprove_whitdrawal') }}">
<input type="hidden" id="txt_delete_whitdrawal_route" value="{{ route('delete_whitdrawal') }}">
<input type="hidden" id="txt_show_whitdrawal_route" value="{{ route('show_whitdrawal') }}">
<input type="hidden" id="txt_update_whidrawal_paid" value="{{ route('update_whitdrawal_paid') }}">
@include('withdrawal.show_modal')
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_whitdrawal_document_modal')