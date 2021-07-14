<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
    <style type="text/css">
        body{
            background:url({{ env('APP_URL').'/img/background_blue.jpg' }});
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
            color:white;
            text-align: left;
            line-height: 15px;
            padding:5px;
        }
    </style>
</head>

<body style="padding:10px;">
    <header>
        <a href="https://www.facebook.com/DotRedes" target="_BLANK"><img src="{{ env('APP_URL').'/img/fb.png' }}" alt="fb" width="50" height="50"></a>
        <a href="https://twitter.com/dotredes" target="_BLANK"><img src="{{ env('APP_URL').'/img/tweeter.png' }}" alt="fb" width="50" height="50"></a>
        <a href="https://wa.me/5554159076?text=Qué%20tal%2C%20me%20interesa%20su%20servicio" target="_BLANK"><img src="{{ env('APP_URL').'/img/ws.png' }}" alt="fb" width="50" height="50"></a>
    </header>
    <div
        style="padding:10px;,width:80%;-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
        <center><img src="{{ env('APP_URL').'/img/dotech_fondo.png' }}" alt="dotech" style="width:240px;"></center>
        <h3 style="background-color:white;padding:10px;">
            Estimado {{ $sale->department['manager'] }}
            <br>
            Compañía: {{ $sale->company['name'] }}
            <br>
            Departamento: {{ $sale->department['name'] }}
        </h3>
        <h4 style="background-color:white;padding:10px;">Le invitamos a descargar el archivo adjunto con nuestra propuesta de solución, que amablemente hizo favor de solicitarnos</h4>
        <center>
            <p  style="background-color:white;padding:10px;text-align:left;">
                <b>sin mas por el momento quedamos a la espera de sus amables comentarios y le recordamos que estamos
                    para servirle
                    en el correo <a href="mailto:cat@dotredes.com">cat@dotredes.com</a> o directamente con su ejecutivo.
                    <br>
                    {{ $sale->author['name'] }} {{ $sale->author['middle_name'] }} {{ $sale->author['last_name'] }} <br>
                    Tel: <a href="tel:{{ $sale->author['phone'] }}">{{ $sale->author['phone'] }}</a> <br>
                    Email: <a href="tel:{{ $sale->author['email'] }}">{{ $sale->author['email'] }}</a> <br>
                </b>
                <br><br>
                <h2 style="color:white;">
                    Atentamente
                    <br>
                    Equipo DoTech.
                </h2>
                <br>
            </p>
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