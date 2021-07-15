<div>
<table class="table" border="5">
        <tr>
            <td colspan="9" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Retiros</label>
                    <label style="float:right;padding:5px;">
                        <span
                            onClick="createWhitdrawal();"
                            class="icon-plus"
                            style="cursor:pointer;color:white;" title="Solicitar retiro...">
                        </span>
                    </label>
                </center>
            </td>
        </tr>
</table>
{{ $whitdrawals->links() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th><b>Fecha</b></th>
                <th><b>Proveedor</b></th>
                <th><b>Descripción</b></th>
                <th><b>Cuenta</b></th>
                <th><b>Departamento</b></th>
                <th><b>Tipo de retiro</b></th>
                <th><b>Cantidad</b></th>
                <th><b>Estatus</b></th>
                <th><b>Folio</b></th>
                <th><b>Pagado</b></th>
                <th><b>Documento</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($whitdrawals as $whitdrawal)
            <tr>
                <td>{{ onlyDate($whitdrawal->created_at) }}</td>
                <td>{{ $whitdrawal->provider['name'] }}</td>
                <td>{{ $whitdrawal->description }}</td>
                @if(!empty( $whitdrawal->account['name']))
                <td>{{ $whitdrawal->account['name'] }}</td>
                @else
                <td class="text-center">No definido</td>
                @endif
                @if(!empty( $whitdrawal->department['name']))
                <td>{{ $whitdrawal->department['name'] }}</td>
                @else
                <td class="text-center">No definido</td>
                @endif
                @if(!empty( $whitdrawal->type))
                <td>{{ $whitdrawal->type }}</td>
                @else
                <td class="text-center">No definido</td>
                @endif
                <td>${{  number_format($whitdrawal->quantity,2) }}</td>
                <td>
                    {{ $whitdrawal->status }}
                    @if(Auth::user()->rol_user_id == 1 && $whitdrawal->status == 'Pendiente')
                    <br/>
                    <a href="#" onclick="aproveWithdrawalModal({{ $whitdrawal->id }});"><span class="icon-checkmark"></span> Aprobar</a>
                    @endif
                </td>

                <td width="40%;">
                <input type="text" onkeyUp="updateWhitdrawalFolio({{ $whitdrawal->id }},this.value);" value="{{ $whitdrawal->folio }}" class="form-control"/>
                <input type="hidden" id="txt_update_whidrawal_folio" value="{{ route('update_whitdrawal_folio') }}">
                </td>

                <td width="40%;">
                <select onchange="updateWhitdrawalPaid({{ $whitdrawal->id }},this.value);" class="form-control">
                    @if($whitdrawal->paid == 'SI')
                        <option value="SI" selected>SI</option>
                        <option value="NO">NO</option>
                    @else
                        <option value="SI">SI</option>
                        <option value="NO" selected>NO</option>
                    @endif
                </select>
                <input type="hidden" id="txt_update_whidrawal_paid" value="{{ route('update_whitdrawal_paid') }}">
                </td>

                @if($whitdrawal->invoive == 'SI')
                @if(!empty($whitdrawal->document))
                    <td class="text-center"><a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span></a></td>
                    @else
                    <td class="text-center"><a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span></a></td>
                    @endif
                @else
                <td class="text-center">N/A</td>
                @endif
            </tr>
            @endforeach
        </tbody>
        @if(count($whitdrawals)<=0)
        <tr><td colspan="11" class="text-center">Sin registros</td></tr>
        @endif
    </table>
     <!--Wire Modals-->
@include('wire.whitdrawals.create')
</div>