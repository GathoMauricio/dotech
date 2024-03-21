<!DOCTYPE html>
<html>

<head>
    <title>Email</title>
    <style type="text/css">
        body {
            background: url({{ env('APP_URL') . '/img/background_blue.jpg' }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        header {


            color: white;
            text-align: right;
            line-height: 30px;
        }

        footer {


            background-color: #d30035;
            color: white;
            text-align: left;
            line-height: 15px;
            padding: 5px;
        }
    </style>
</head>

<body style="padding:10px;">
    <header>
        <a href="https://www.facebook.com/DotRedes" target="_BLANK"><img src="{{ env('APP_URL') . '/img/fb.png' }}"
                alt="fb" width="50" height="50"></a>
        <a href="https://twitter.com/dotredes" target="_BLANK"><img src="{{ env('APP_URL') . '/img/tweeter.png' }}"
                alt="fb" width="50" height="50"></a>
        <a href="https://wa.me/5554159076?text=Qué%20tal%2C%20me%20interesa%20su%20servicio" target="_BLANK"><img
                src="{{ env('APP_URL') . '/img/ws.png' }}" alt="fb" width="50" height="50"></a>
    </header>
    <div
        style="padding:10px;,width:80%;-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
        <center><img src="{{ env('APP_URL') . '/img/dotech_fondo.png' }}" alt="dotech" style="width:240px;"></center>
        <h4>
            <center>
                <strong style="color:white">Últimos seguimientos</strong>
            </center>
        </h4>
        <table border="1" style="background-color: white;">
            <thead>
                <tr>
                    <th>Estatus</th>
                    <th>Nombre</th>
                    <th>Días</th>
                    <th>Fecha</th>
                    <th>Autor</th>
                    <th>Seguimiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    @php
                        $item = App\CompanyFollow::where('company_id', $cliente->id)
                            ->orderBy('created_at', 'DESC')
                            ->first();
                    @endphp
                    @if ($item)
                        @php
                            $toDate = Carbon\Carbon::parse($item->created_at);
                            $fromDate = Carbon\Carbon::parse(date('Y-m-d'));
                            $dias = $toDate->diffInDays($fromDate);
                        @endphp
                        @if ($dias >= 30)
                            <tr>
                                <td>{{ $item->company->status }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td>{{ $dias }}</td>
                                <td>{{ explode(' ', $item->created_at)[0] }}</td>
                                <td>
                                    {{ $item->author->name . ' ' . $item->author->middle_name . ' ' . $item->author->last_name }}
                                </td>
                                <td>{{ $item->body }}</td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td>{{ $cliente->status }}</td>
                            <td>{{ $cliente->name }}</td>
                            <td>0</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>SIN SEGUIMIENTOS</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        </center>
    </div>
    <footer>
        NO CONTESTAR a este correo.
        <br>
        Es enviado desde un servicio automático no monitoreado.
        <br>
        En el cuerpo del correo encontrará la información de contacto.
        <br>
        La información contenida en este mensaje está dirigida solamente a las personas o entidades que
        figuran en el encabezado y puede contener información confidencial, por lo que si usted lo recibe
        por error, por favor destrúyalo sin copiarlo, usarlo, ni distribuirlo, comunicándolo inmediatamente
        al emisor del mensaje.
        <br>
        The information included in this message is only addressed to the persons or institutions that
        appear in the heading and may contain confidential information. If you receive it by error, please,
        destroy it without copying, using nor distributing it, and communicate it immediately to the message
        sender.
        <br>
    </footer>
</body>

</html>
