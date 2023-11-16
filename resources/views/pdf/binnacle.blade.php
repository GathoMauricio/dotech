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
            <br>
            @if (!empty($binnacle->sale['description']))
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
                            @if (!empty($binnacle->sale->department['rfc']))
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
            @endif
            <br /><br>
        <table style="width:100%;">
            <tbody>
                <tr>
                    <th width="100%" colspan="3" style="background-color:#D5D8DC;">Autor</th>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center">{{ $binnacle->author['name'] }}
                        {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
                </tr>
                <tr>
                    <th width="15%" style="background-color:#D5D8DC;">Fecha</th>
                    <th width="25%" style="background-color:#D5D8DC;">Descripción</th>
                    <th width="15%" style="background-color:#D5D8DC;">Firma</th>
                </tr>
                <tr>
                    <td style="text-align:center">{{ formatDate($binnacle->created_at) }}</td>
                    <td style="text-align:center">{{ $binnacle->description }}</td>
                    <td style="text-align:center">
                        @if (!empty($binnacle->firm))
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
                    <th width="100%"><br /></th>
                </tr>
                <tr>
                    <th width="100%" style="background-color:#D5D8DC;">Imagenes</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $images = \App\BinnacleImage::where('binnacle_id', $binnacle->id)->get();
                @endphp
                @foreach ($images as $image)
                    <tr>
                        <th width="100%"><br /></th>
                    </tr>
                    <tr>
                        <td width="80%"style="background-color:#D5D8DC;">
                            <center>
                                <img src="{{ parseBAse64(public_path('storage/' . $image->image)) }}"
                                    style="width:100%;height:400px">
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td width="80%"style="background-color:#D5D8DC;padding:5px;">
                            <b>Descripción: </b>{{ $image->description }}
                            <br /><br />
                            <span>{{ formatDate($image->created_at) }}</span>
                        </td>
                    </tr>
                @endforeach
                @if (count($images) <= 0)
                    <th width="100%" colspan="3">No hay contenido para mostrar</th>
                @endif
            </tbody>

        </table>
        <br><br>
        </p>
        <br><br>
    </main>
    <br><br>
    {{--  <footer>

    </footer>  --}}
</body>

</html>
