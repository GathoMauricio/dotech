<br>
{{ $clientes->links('pagination::bootstrap-4') }}
<table class="table table-stripped">
    <thead>
        <tr>
            <th>Origen</th>
            <th>Cliente</th>
            <th>Enacargado</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->origin }}</td>
                <td>{{ $cliente->name }}</td>
                <td>{{ $cliente->responsable }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->phone }}</td>
                <td>{{ $cliente->address }}</td>
                <td>
                    <a href="javascript:void(0);" onclick="addQuoteByCompanyModal({{ $cliente->id }});">Crear
                        cotización</a>



                    {{--  <a href="#" onclick="addQuoteByCompanyModal(15);" style="cursor:pointer;color:black;"><span
                            title="Crear cotización..." class="icon icon-plus"></span> Crear cotización</a>
                    <br><a href="#" onclick="indexCompanyFollow(15);" style="cursor:pointer;color:black;">3<span
                            title="Ver seguimientos..." class="icon icon-bubble"></span> Ver seguimientos</a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/quotes/15"
                        style="cursor:pointer;color:#2980B9;">1<span title="Ver cotizaciones..."
                            class="icon icon-coin-dollar"></span> Ver cotizaciones</a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/projects/15"
                        style="cursor:pointer;color:#229954;">0<span title="Ver proyectos..."
                            class="icon icon-price-tag"></span> Ver proyectos</a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/finalized/15"
                        style="cursor:pointer;color:#F39C12;">2<span title="Ver finalizados..." class="icon icon-smile">
                            Ver finalizados</span></a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/rejects/15"
                        style="cursor:pointer;color:#C0392B;">0<span title="Ver rechazos..."
                            class="icon icon-sad"></span> Ver rechazos</a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/repository_company/15"
                        style="cursor:pointer;color:#7D3C98;"><span title="Repositorio..." class="icon icon-key"></span>
                        Repositorio</a><br><a href="http://dotech.dyndns.biz:16666/dotech/public/company_documents/15"
                        style="cursor:pointer;color:blue;"><span title="Documentación..."
                            class="icon icon-file-pdf"></span> Documentación</a><br><a
                        href="http://dotech.dyndns.biz:16666/dotech/public/edit_company/15"
                        style="cursor:pointer;color:orange;"><span title="Actualizar..."
                            class="icon icon-pencil"></span> Editar</a><br><a href="#" onclick="deleteCompany(15)"
                        style="cursor:pointer;color:red;"><span title="Eliminar.." class="icon icon-bin"
                            style="cursor:pointer;color:red;"> Eliminar</span></a>  --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
