<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi Eco Casa</title>
</head>
<body>
    <h3 style="text-align:center;">Mi Eco Casa</h3>
    <h5 style="text-align:center;">Se procesaron {{ count($items) }} registros</h5>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Item</th>
                <th>Cuenta</th>
                <th>Monto</th>
                <th>Nombre</th>
                <th>Mensaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            @php 
            $color = "";
            if(empty($item['message']))
            {
                $color = "#58D68D";
            }else{
                $color = "#EC7063";
            }
            @endphp
            <tr style="background-color:{{ $color }}">
                <td>{{ $item['count'] }}</td>
                <td>{{ $item['account'] }}</td>
                <td>{{ $item['amount'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['message'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>