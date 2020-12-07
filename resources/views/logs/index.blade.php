@extends('layouts.app')
@section('content')
<h4 class="title_page">Logs</h4> 
<div class="float-right">
{{ $logs->links() }}
</div>
<br><br>
@foreach($logs as $log)
<div style="width:100%;">
    <span style="color:#2980B9">{{ formatDate($log->created_at) }}</span> : {{ $log->body }}
</div>
<br/>
@endforeach
<div class="float-right">
    {{ $logs->links() }}
</div>
@endsection