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
    <table border="1" style="width:100%;">
            <tr>
                <td width="30%" >
                    <img src="{{ $logo }}" width="50%" height="">
                </td>
                <td width="40%" style="color:black;">
                    <p><h1 style="color:#d30035;font-weight:bold;text-align:center;">Bitácora</h1></p>
                    <small>Bahía de las Palmas #33, Verónica Anzúres,</small>
                    <small>11300 Ciudad de México, D.F.</small>
                    <small>Tel: 55460615</small>
                </td>
                <td width="30%" style="text-align: right">
                    <img src="{{ $logo2 }}" width="50%" height="">
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
            {{ $binnacle->sale->company['name'] }}
        </td>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Encargado:
            </span>
            {{ $binnacle->sale->department['manager'] }}
        </td>
    </tr>
    <tr>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Departamento: 
            </span>
            {{ $binnacle->sale->department['name'] }}
        </td>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Teléfono: 
            </span>
            {{ $binnacle->sale->department['phone'] }}
        </td>
    </tr>
    <tr>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                RFC: 
            </span>
            @if(!empty($binnacle->sale->department['rfc']))
            {{ $binnacle->sale->department['rfc'] }}
            @else
            No disponible
            @endif
        </td>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Email: 
            </span>
            {{ $binnacle->sale->department['email'] }}
        </td>
    </tr>
    <tr>
        <td width="100%" colspan="2">
            <span style="color:#d30035;font-weight:bold;">
                Proyecto {{ $binnacle->sale->id }}: 
            </span>
            {{ $binnacle->sale->description }}
        </td>
    </tr>
</table>
<br/><br>
<table style="width:100%;">
    <tbody>
        <tr>
            <th width="15%" style="background-color:#D5D8DC;">Fecha</th>
            <th width="25%" style="background-color:#D5D8DC;">Descripción</th>
            <th width="15%" style="background-color:#D5D8DC;">Firma</th>
        </tr>
        <tr>
            <td style="text-align:center">{{ formatDate($binnacle->created_at) }}</td>
            <td style="text-align:center">{{ $binnacle->description }}</td>
            <td style="text-align:center">
                @if(!empty($binnacle->firm))
                <img src="{{ $firm }}" width="80" height="80">
                @else
                No disponible
                @endif
            </td>
        </tr>
    </tbody>
</table>
<table style="width:100%;">
    <thead>
        <tr>
            <th width="100%" colspan="3" style="background-color:#D5D8DC;">Imagenes</th>
        </tr>
        <tr>
            <th width="15%" style="background-color:#D5D8DC;">Fecha</th>
            <th width="25%" style="background-color:#D5D8DC;">Descripción</th>
            <th width="15%" style="background-color:#D5D8DC;">Imagen</th>
        </tr>
    </thead>

    <tbody>
        @php 
        $images = \App\BinnacleImage::where('binnacle_id',$binnacle->id)->get();
        @endphp
        @foreach($images as $image)
        <tr>
            <td width="15%" style="background-color:#D5D8DC;">{{ formatDate($image->created_at) }}</td>
            <td width="25%" style="background-color:#D5D8DC;">{{ $image->description }}</td>
            <td width="15%" style="background-color:#D5D8DC;">
                <img src="{{ parseBAse64(public_path('storage/'.$image->image)) }}" width="80" height="">
            </td>
        </tr>
        @endforeach
        @if(count($images) <= 0)
        <th width="100%" colspan="3">No hay contenido para mostrar</th>
        @endif
    </tbody>

</table>
</main>
<!--
<footer>
    Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
    Est optio non eius vitae eos laborum vel quasi architecto 
    quibusdam ipsam fugit repudiandae tempore quos consequuntur 
    dignissimos dolore, corrupti repellat molestiae.
</footer>
-->
</body>
</html>