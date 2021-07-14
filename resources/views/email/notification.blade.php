{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}
<br/>
{{ $msg }}
<br/>
Fecha: {{ formatDate($binnacle->created_at) }}
<br/>
<a href="{{ env('APP_URL').'/show_sale/'.$binnacle->sale_id }}"><h3>Ir al proyecto</h3></a>