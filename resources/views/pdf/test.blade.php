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
            padding: 0.5cm;
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
    <table style="width:100%;">
        <tr>
            <td width="30%" >
                <img src="{{ $logo }}" width="50%" height="" style="padding:-30px;">
            </td>
            <td width="40%" style="color:black;">
                <p>
                    <h1 style="color:#d30035;font-weight:bold;text-align:center;padding:10px;">Examen de soporte técnico</h1>
                </p>
            </td>
            <td width="30%" style="text-align: right;padding-top:50px;">
                &nbsp;
            </td>
        </tr>
    </table>
</header>
<br/><br/>
<main style="padding-top:20px;"><br/><br/><br><br/>
<table style="width:100%;">
    <tr>
        <td width="100%" colspan="2">
            <span style="color:#d30035;font-weight:bold;">
                Nombre: 
            </span>
            {{ $oneTest->user['name'] }} {{ $oneTest->user['middle_name'] }} {{ $oneTest->user['last_name'] }}
        </td>
    </tr>
    <tr>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Fecha: 
            </span>
            {{ onlyDate($oneTest->created_at) }}
        </td>
        <td width="50%">
            <span style="color:#d30035;font-weight:bold;">
                Calificacion:
            </span>
            {{ $oneTest->evaluation }}
        </td>
    </tr>
</table>
<p style="text-align:center;font-weight:bold;">(Sección 1: Opción múltiple)</p>
@for($i = 1; $i <= 30; $i++)
<div class="row" style="padding-top:40px;">
    <div class="col-md-12">
        <div class="form-group">
            <label style="color:#7D3C98;font-size:18px">
                {{ $oneQuestion[$i-1] }}
            </label>
            @php
            $resp = explode("@=>",$oneTest['question_'.$i]);
            $respText = $resp[0];
            $respRes = $resp[1];
            @endphp
            @if($respRes == 'Correcta')
            <p style="color:green;">{{ $respText }}</p>
            @else
            <p style="color:red;">{{ $respText }}</p>
            @endif
        </div>
    </div>
</div>
@endfor

<p style="text-align:center;font-weight:bold;">(Sección 2: Diagnosticos)</p>
@for($i = 1; $i <= 19; $i++)
<div class="row" style="padding-top:40px;">
    <div class="col-md-12">
        <div class="form-group">
            <label style="color:#7D3C98;font-size:18px">
                {{ $twoQuestion[$i-1] }}
            </label>
            <p>{{ $twoTest['question_'.$i] }}</p>
        </div>
    </div>
</div>
@endfor

<p style="text-align:center;font-weight:bold;">(Sección 2: Redes)</p>
@for($i = 1; $i <= 18; $i++)
<div class="row" style="padding-top:40px;">
    <div class="col-md-12">
        <div class="form-group">
            <label style="color:#7D3C98;font-size:18px">
                {{ $threeQuestion[$i-1] }}
            </label>
            <p>{{ $threeTest['question_'.$i] }}</p>
        </div>
    </div>
</div>
@endfor

</main>

</body>
</html>