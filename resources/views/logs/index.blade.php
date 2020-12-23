@extends('layouts.app')
@section('content')
<h4 class="title_page">Logs</h4> 
<div class="float-right">
{{ $logs->links() }}
</div>
<br><br>
<div style="width:100%;background-color:black;">
    <table style="width:100%;">
        @foreach($logs as $log)
        <tr>
            <td style="color:#2ECC71" width="30%">
                {{ formatDate($log->created_at) }}
            </td>
            <td style="color:white;" width="70%">
                {{ $log->body }}
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="float-right">
    {{ $logs->links() }}
</div>
@endsection