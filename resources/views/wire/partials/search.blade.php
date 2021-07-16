<input wire:model="search" class="form-control" placeholder="Buscar..." />
<span id="span_result">@if(strlen($search) >0) Resultados de "{{ $search }}" @else &nbsp; @endif</span>
<br/>
<img src="{{ asset('img/wire.png') }}" width="120" class="float-right">