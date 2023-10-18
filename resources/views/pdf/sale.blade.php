<html>

<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 0.5cm 0.5cm 0.5cm;
        }

        header {
            position: fixed;
            top: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 0.5cm;
            padding: -80px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #d30035;
            color: white;
            text-align: left;
            line-height: 15px;
            padding: 5px;
        }
    </style>
</head>

<body>
    {{--  <header>
        <table style="width:100%;">
            <tr>
                <td width="30%" style="padding-top:50px;">
                    <img src="{{ $logo }}" width="50%" height="">
                </td>
                <td width="40%" style="color:black;">
                    <p>
                    <h1 style="color:#d30035;font-weight:bold;text-align:center;padding:10px;">Cotización</h1>
                    </p>
                    <small>Laguna San Cristóbal 99, Anáhuac I Secc.,</small>
                    <br />
                    <small>Anáhuac I Secc, Miguel Hidalgo, 11320 </small>
                    <br />
                    <small>Ciudad de México, CDMX</small>
                    <br />
                    <small>Tel: 55460615</small>
                </td>
                <td width="30%" style="text-align: right;padding-top:50px;">
                    <img src="{{ $logo2 }}" width="50%" height="">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="color:blue;width:100%;height:200px">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos illum amet vero nisi recusandae
                        impedit doloribus labore laboriosam quae vel est aliquam laudantium, asperiores vitae. Ad eum
                        unde in labore.
                    </div>
                </td>
            </tr>
        </table>

    </header>  --}}

    <main>
        <table style="width:100%;">
            <tr>
                <td width="30%" style="padding-top:50px;">
                    <img src="{{ $logo }}" width="50%" height="">
                </td>
                <td width="40%" style="color:black;">
                    <p>
                    <h1 style="color:#d30035;font-weight:bold;text-align:center;padding:10px;">Cotización</h1>
                    </p>
                    <small>Laguna San Cristóbal 99, Anáhuac I Secc.,</small>
                    <br />
                    <small>Anáhuac I Secc, Miguel Hidalgo, 11320 </small>
                    <br />
                    <small>Ciudad de México, CDMX</small>
                    <br />
                    <small>Tel: 55460615</small>
                </td>
                <td width="30%" style="text-align: right;padding-top:50px;">
                    <img src="{{ $logo2 }}" width="50%" height="">
                </td>
            </tr>
        </table>
        <p style="page-break-after: never;">
            <br><br><br>
        <table style="width:100%;">
            <tr>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Folio:
                    </span>
                    {{ $sale->folio_cotizacion }}
                </td>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Encargado:
                    </span>
                    {{ $sale->department['manager'] }}
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Compañía:
                    </span>
                    {{ $sale->company['name'] }}
                </td>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Teléfono:
                    </span>
                    {{ $sale->department['phone'] }}
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Departamento:
                    </span>
                    {{ $sale->department['name'] }}
                </td>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Email:
                    </span>
                    {{ $sale->department['email'] }}
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Fecha:
                    </span>
                    {{ onlyDate($sale->created_at) }}
                </td>
                <td width="50%">
                    <span style="color:#d30035;font-weight:bold;">
                        Vencimiento:
                    </span>
                    {{ onlyDate(date('Y-m-d', strtotime(explode(' ', $sale->created_at)[0] . ' + 5 days'))) }}

                </td>
            </tr>
        </table>
        <br />
        <div style="padding:10px;background-color:#d30035;">
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <th width="10%" style="background-color:#D5D8DC;">Cantidad</th>
                        <th width="10%" style="background-color:#D5D8DC;">U. Medida</th>
                        <th width="35%" style="background-color:#D5D8DC;">Descripción</th>
                        <th width="15%" style="background-color:#D5D8DC;">P. Unitario</th>
                        <th width="15%" style="background-color:#D5D8DC;">Descuento</th>
                        <th width="15%" style="background-color:#D5D8DC;">Importe</th>
                    </tr>
                    @foreach ($saleProducts as $saleProduct)
                        @php
                            $saleProduct->total_sell = $saleProduct->unity_price_sell * $saleProduct->quantity;
                            $saleProduct->total_sell = $saleProduct->total_sell - ($saleProduct->total_sell / 100) * $saleProduct->discount;
                        @endphp

                        <tr style="background-color:#D5D8DC;">
                            <td style="text-align:center">{{ $saleProduct->quantity }}</td>
                            @if (!empty($saleProduct->measure))
                                <td style="text-align:center">{{ $saleProduct->measure }}</td>
                            @else
                                <td style="text-align:center">N/A</td>
                            @endif
                            <td style="padding:3px;"><small>{{ $saleProduct->description }}</small></td>
                            <td style="text-align:center">${{ number_format($saleProduct->unity_price_sell, 2) }}</td>
                            <td style="text-align:center">{{ $saleProduct->discount }}%</td>
                            <td style="text-align:center">
                                ${{ number_format($saleProduct->unity_price_sell * $saleProduct->quantity - ($saleProduct->unity_price_sell * $saleProduct->quantity * $saleProduct->discount) / 100, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center;background-color:#D5D8DC;">DIVISA</td>
                        <td style="text-align:center;background-color:#D5D8DC;">{{ $sale->currency }}</td>
                    </tr>
                    @php

                        #suma el total de los productos
                        $subtotal = $saleProducts->sum('total_sell');
                        #calcula el iva
                        $iva = $subtotal * 0.16;
                        #calcula el total de la cotización
                        $total = $subtotal + $iva;
                    @endphp
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center;background-color:#D5D8DC;">SUBTOTAL</td>
                        <td style="text-align:center;background-color:#D5D8DC;">${{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center;background-color:#D5D8DC;">IVA</td>
                        <td style="text-align:center;background-color:#D5D8DC;">${{ number_format($iva, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center"></td>
                        <td style="text-align:center;background-color:#D5D8DC;">TOTAL</td>
                        <td style="text-align:center;;background-color:#D5D8DC;">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br /><br />
        <table style="width: 100%;">
            <tr>
                <td width="100%" colspan="2">
                    <span style="color:#d30035;font-weight:bold;">
                        Descripción:
                    </span>
                    {{ $sale->description }}
                </td>
            </tr>
            @if (!empty($sale->observation))
                <tr>
                    <td width="100%" colspan="2">
                        <span style="color:#d30035;font-weight:bold;">
                            Observaciones:
                        </span>
                        {{ $sale->observation }}
                    </td>
                </tr>
            @endif
        </table>
        </p>
    </main>

    <footer>
        * Los precios estan sujetos a cambios sin previo aviso. <br />
        * La garantía de todos los productos es de acuerdo al fabricante.<br />
        * La vigencia de esta cotización es de 5 dias a partir del día de su emisión.
    </footer>
</body>

</html>
