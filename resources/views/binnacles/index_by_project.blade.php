@extends('layouts.app')
@section('content')
<h4 class="title_page ">Bitácoras del proyecto {{ $sale->description }}</h4>
@if(count($binnacles) <= 0)
@include('layouts.no_records')
@else
<table class="table" border="5">
        <tr>
            <td colspan="6" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Bitácoras</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addBinnacle({{ $sale->id }});" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar bitácora..."></span></label>
                    <!--
                    <br/>
                    <a href="#" onclick="sendBinnacleAll({{ $sale->id }})" style="color:white;"><span class="icon-envelop"></span> Enviar todas las bitácoras</a>
                    -->
                </center>
            </td>
        </tr>
        <tr>
            <td><b>Fecha</b></td>
            <td><b>Autor</b></td>
            <td><b>Descripción</b></td>
            <td><b>Firma</b></td>
            <td><b>Observaciones</b></td>
            <td><b>Imágenes</b></td>
        </tr>
        @foreach($binnacles as $binnacle)
        <tr>
            <td>{{ formatDate($binnacle->created_at) }}</td>
            <td>{{ $binnacle->author['name'] }} {{ $binnacle->author['middle_name'] }} {{ $binnacle->author['last_name'] }}</td>
            <td>{{ $binnacle->description }}</td>
            <td>
                @if(!empty($binnacle->firm))
                <img src="{{ asset('storage') }}/{{ $binnacle->firm }}" width="80" height="80">
                
                @else
                <center>No disponible</center>
                @endif
            </td>
            <td>{{ $binnacle->feedback }}</td>
            <td>
                <a href="#" onclick="addBinnacleImage({{ $binnacle->id }})">
                    <span class="icon-plus" title="Agregar imagen..." style="cursor:pointer;color:#c52cec">
                        Nuevo
                    </span>
                </a>
                <br>
                <a href="#" onclick="viewBinnacleImages({{ $binnacle->id }},{{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }})">
                    <span class="icon-image" title="ver imágenes..." style="cursor:pointer;color:#2c49ec">
                        {{ count(App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()) }}
                        Imágenes
                    </span>
                </a>
                <br>
                <a href="{{ route('binnacle_pdf',$binnacle->id) }}" target="_blank">
                    <span class="icon-file-pdf" title="Ver pdf..." style="cursor:pointer;color:#ec422c">
                        PDF
                    </span>
                </a>
                <br>
                <a href="#" onclick="sendBinnacle({{ $binnacle->id }});">
                    <span class="icon-envelop" title="Enviar pdf..." style="cursor:pointer;color:#b3d420">
                        Enviar
                    </span>
                </a>
                <br>
            </td>
        </tr>
        @endforeach
        @if(count($binnacles)<=0)
        <tr><td colspan="6" class="text-center">Sin registros</td></tr>
        @endif
    </table>
@endif
<input type="hidden" id="txt_get_binnacle" value="{{ route('binnacle_show_json') }}">
<input type="hidden" id="txt_get_project_data" value="{{ route('show_quote_ajax') }}">
<input type="hidden" id="txt_show_binnacle_image_route" value="{{ route('show_binnacle_image') }}">
<input type="hidden" id="txt_view_binnacle_images_route" value="{{ route('binnacle_images_index') }}">
<input type="hidden" id="txt_set_project_as_finish" value="{{ route('set_project_as_finish')}}">
@include('sale.send_binnacle_pdf_modal')
@include('sale.send_all_binnacle_pdf_modal')
@include('withdrawal.add_provider_modal')
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_binnacle_modal')
@include('sale.add_binnacle_image_modal')
@include('sale.add_whitdrawal_document_modal')
@include('sale.add_sale_payment_modal')
@include('sale.add_sale_document_modal')
@include('sale.add_sale_whitdrawal_modal')
@endsection