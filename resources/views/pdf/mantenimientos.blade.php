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

        th {
            text-align: left;
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
                    <h1 style="color:#d30035;font-weight:bold;text-align:center;padding:10px;">
                        Reporte de mantenimientos
                    </h1>
                    </p>
                    <small>Laguna San Cristóbal 99, Anáhuac I Secc.,</small>
                    <br />
                    <small>Anáhuac I Secc, Miguel Hidalgo, 11320 </small>
                    <br />
                    <small>Ciudad de México, CDMX</small>
                    <br />
                    <small>Tel: 55460615</small>
                </td>
                {{--  <td width="30%" style="text-align: right;padding-top:50px;">
                    <img src="{{ $logo2 }}" width="50%" height="">
                </td>  --}}
            </tr>
        </table>
        <p style="page-break-after: never;">
        <div style="background-color:#d0d3d4;padding:20px;">
            <table width="100%" border="1">
                <tr>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Combustible</th>
                    <th>Kilometraje</th>
                </tr>
                <tr>
                    <td>{{ $vehiculo->type->type }}</td>
                    <td>{{ $vehiculo->brand }}</td>
                    <td>{{ $vehiculo->model }}</td>
                    <td>{{ $vehiculo->fuel }}</td>
                    <td>{{ $vehiculo->kilometers }}</td>
                </tr>
                <tr>
                    <th>Matrícula</th>
                    <th>Año</th>
                    <th>Cilindrada</th>
                    <th>Potencia</th>
                    <th>Color</th>
                </tr>
                <tr>
                    <td>{{ $vehiculo->enrollment }}</td>
                    <td>{{ $vehiculo->year }}</td>
                    <td>{{ $vehiculo->displacement }}</td>
                    <td>{{ $vehiculo->power }}</td>
                    <td>{{ $vehiculo->color }}</td>
                </tr>
            </table>
        </div>
        <br>
        <center>
            <h4>Registros</h4>
        </center>
        <br>
        @forelse($vehiculo->mantenimientos as $mantenimiento)
            <div style="background-color:#d0d3d4;padding:20px;">
                <table width="100%" border="1">
                    <tr>
                        <th>Author</th>
                        <th>Tipo</th>
                        <th>Kilometros</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                    <tr>
                        <td>
                            {{ $mantenimiento->author->name }}
                            {{ $mantenimiento->author->middle_name }}
                            {{ $mantenimiento->author->last_name }}
                        </td>
                        <td>{{ $mantenimiento->type->type }}</td>
                        <td>{{ $mantenimiento->kilometers }}</td>
                        <td>{{ explode(' ', $mantenimiento->date)[0] }}</td>
                        <td>${{ $mantenimiento->amount }}</td>
                    </tr>
                    <tr>
                        <th colspan="5">Descripcion</th>
                    </tr>
                    <tr>
                        <td colspan="5">{{ $mantenimiento->description }}</td>
                    </tr>
                </table>
                <center>
                    <h4>Fotos</h4>
                </center>
                <br>
                <table width="100%" border="1">
                    <tr>
                        <th>Imagen</th>
                        <th>Descripción</th>
                    </tr>
                    @forelse($mantenimiento->fotos as $foto)
                        <tr>
                            <td style="text-align: center;">
                                <br><br>
                                @if ($foto->source == 'API')
                                    <br>
                                    <br>
                                    <a href="http://dotech.dyndns.biz:16666/dotech_api/public/storage/mantenimientos_imagenes/{{ $foto->image }}"
                                        target="_blank">
                                        <img src="http://dotech.dyndns.biz:16666/dotech_api/public/storage/mantenimientos_imagenes/{{ $foto->image }}"
                                            width="160" />
                                    </a>
                                @else
                                    <br>
                                    <br>
                                    <a href="{{ asset('storage') }}/{{ $foto->image }}" target="_blank">
                                        <img src="http://dotech.dyndns.biz:16666/dotech/public/storage/{{ $foto->image }}"
                                            width="160" />
                                    </a>
                                @endif
                            </td>
                            <td style="text-align: center;">{{ $foto->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                <center>Sin fotos</center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
            <br><br><br>
        @empty
            <center>No existen mantenimientos</center>
        @endforelse
        </p>
        <br><br>
    </main>
    <br><br>
</body>

</html>
