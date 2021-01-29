<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0.5cm;
            left: 0.5cm;
            right: 0.5cm;
            height: 0.5cm;
            
            color: white;
            text-align: center;
            line-height: 30px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #d30035;
            color:white;
            text-align: left;
            line-height: 15px;
            padding:5px;
        }
    </style>
</head>
<body>
<header>
    <table border="1" style="width:100%">
        <tr>
            <td width="40%" >
                <img src="{{ $logo }}" width="150" height="80">
            </td>
            <td width="60%" style="color:black;">
                <p>Numero de cotización: <span style="color:#d30035;font-weight:bold;">{{ $sale->id }}</span></p>
                <small>Bahía de las Palmas #33, Verónica Anzúres,</small>
                <small>11300 Ciudad de México, D.F.</small>
                <small>Tel: 55460615</small>
                <small>Email: {{ $sale->author['email'] }}</small>
            </td>
        </tr>
    </table>
</header>

<main><br/><br/><br>
<table style="width:100%;">
    <tr>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Compañía: 
            </span>
            {{ $sale->company['name'] }}
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
                Departamento: 
            </span>
            {{ $sale->department['name'] }}
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
                RFC: 
            </span>
            {{ $sale->company['rfc'] }}
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
            {{ onlyDate($sale->company['created_at']) }}
        </td>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Vencimiento: 
            </span>
            {{ date("Y-m-d",strtotime(onlyDate($sale->company['created_at'])."+ ".$sale->delivery_days." days")) }}
        </td>
    </tr>
</table>
<br/><br>
<table style="width:100%;">
    <tbody>
        <tr>
            <th width="15%" style="background-color:#D5D8DC;">Cantidad</th>
            <th width="15%" style="background-color:#D5D8DC;">U. Medida</th>
            <th width="25%" style="background-color:#D5D8DC;">Descripción</th>
            <th width="15%" style="background-color:#D5D8DC;">P. Lista</th>
            <th width="15%" style="background-color:#D5D8DC;">Descuento</th>
            <th width="15%" style="background-color:#D5D8DC;">Importe</th>
        </tr>
        @foreach($saleProducts as $saleProduct)
        <tr>
            <td style="text-align:center">{{ $saleProduct->quantity }}</td>
            @if(!empty($saleProduct->measure))
            <td style="text-align:center">{{ $saleProduct->quantity }}</td>
            @else
            <td style="text-align:center">N/A</td>
            @endif
            <td style="padding:3px;">{{ $saleProduct->description }}</td>
            <td style="text-align:center">${{ number_format($saleProduct->unity_price_sell,2) }}</td>
            <td style="text-align:center">{{ $saleProduct->discount }}%</td>
            <td style="text-align:center">${{ number_format(($saleProduct->unity_price_sell * $saleProduct->quantity),2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="text-align:center"></td>
            <td style="padding:3px;"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center;background-color:#D5D8DC;">DIVISA</td>
            <td style="text-align:center;background-color:#D5D8DC;">{{ $sale->currency,2 }}</td>
        </tr>
        <tr>
            <td style="text-align:center"></td>
            <td style="padding:3px;"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center;background-color:#D5D8DC;">SUBTOTAL</td>
            <td style="text-align:center;background-color:#D5D8DC;">${{ number_format($subtotal,2) }}</td>
        </tr>
        <tr>
            <td style="text-align:center"></td>
            <td style="padding:3px;"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center;background-color:#D5D8DC;">IVA</td>
            <td style="text-align:center;background-color:#D5D8DC;">${{ number_format($iva,2) }}</td>
        </tr>
        <tr>
            <td style="text-align:center"></td>
            <td style="padding:3px;"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center;background-color:#D5D8DC;">TOTAL</td>
            <td style="text-align:center;;background-color:#D5D8DC;">${{ number_format($total,2) }}</td>
        </tr>
    </tbody>
</table>
</main>

<footer>
    * Los precios estan sujetos a cambios sin previo aviso. <br/>
    * La garantía de todos los productos es de acuerdo al fabricante.<br/>
    * La vigencia de esta cotización es de 5 dias a partir del día de su emisión.
</footer>
</body>
</html>