@extends('layouts.app')
@section('content')
<h4 class="title_page ">Dashboard</h4>

<div class="container">

    <div class="row">
        <div class="col-md-6 card p-2">
        <div class="ribbon-wrapper">
            <div class="ribbon bg-info">
                &nbsp;
            </div>
        </div>
        @php
            $totalMes = App\Sale::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
            $cotizacionesMes = App\Sale::where('status','Pendiente')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
            $proyectosMes = App\Sale::where('status','Proyecto')->whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
            $totalVentaMes = 0;
            foreach ($proyectosMes as $p)
            {
                $totalVentaMes += $p->estimated;
            }
        @endphp
            <h4 class="text-center">
                Cotizaciones contra proyectos durante 
                <input type="month" value="{{ date('Y-m') }}" onChange="changeMonth(this.value);">
                <input type="hidden" id="change_graphic_month_route" value="{{ route('change_graphic_month') }}"/>
            </h4>
            <p class="font-weight-bold">
                se han creado 
                <span id="span_total_mes" class="text-info">{{ count($totalMes) }}</span> cotizaciones de las cuales 
                <span id="span_proyectos_mes" class="text-success">{{ count($proyectosMes) }}</span> han sido aprobadas para 
                proyecto y se ha logrado un total de 
                <span id="span_total_ventas_mes" class="text-primary">${{ number_format($totalVentaMes + ($totalVentaMes * 0.16),2) }}</span> en precio de venta.
            </p>
            <canvas id="quotes_vs_projects_per_month" ></canvas>
            <script>
            var quotesVSprojectsCtx = document.getElementById('quotes_vs_projects_per_month').getContext('2d');
            var quotesVSprojects = new Chart(quotesVSprojectsCtx, {
                type: 'pie',
                //type: 'pie',
                //type: 'bar',
                data: {
                    labels: ['Cotizaciones', 'Proyectos'],
                    datasets: [{
                        label: '',
                        data: [{{ count($totalMes) }}, {{ count($proyectosMes) }}],
                        backgroundColor: [
                            //'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            //'rgba(255, 206, 86, 0.2)',
                            //'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            //'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            //'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            //'rgba(255, 206, 86, 1)',
                            //'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            //'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            function changeMonth(month) {
                let route = $("#change_graphic_month_route").val();
                if(month.length > 0) {
                    $.ajax({
                        type: "GET",
                        url: route,
                        data: {month:month},
                        success: data => {
                            
                            $("#span_total_mes").text(data.totalMes);
                            $("#span_proyectos_mes").text(data.proyectosMes);
                            $("#span_total_ventas_mes").text(data.ventaMes);
                            quotesVSprojects = new Chart(quotesVSprojectsCtx, {
                                type: 'pie',
                                //type: 'pie',
                                //type: 'bar',
                                data: {
                                    labels: ['Cotizaciones', 'Proyectos'],
                                    datasets: [{
                                        label: '',
                                        data: [data.totalMes, data.proyectosMes],
                                        backgroundColor: [
                                            //'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            //'rgba(255, 206, 86, 0.2)',
                                            //'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            //'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            //'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            //'rgba(255, 206, 86, 1)',
                                            //'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            //'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });

                        },
                        error: err => console.log(err)
                    });
                }
            }
            </script>
        </div>
        <div class="col-md-6 card p-2">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-info">
                    &nbsp;
                </div>
            </div>
        @php
            $proyectosActivos = App\Sale::where('status','Proyecto')->get();
            
        @endphp
            <h4 class="text-center">
                Proyectos caducados
            </h4>
            <p class="font-weight-bold">
                La siguente lista Muestra el total de proyectos sin finalizar con más de 30 días desdé su creación.
            </p>
            <table class="table table-striped" id="index_table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Proyecto</th>
                        <th>Fecha</th>
                        <th>Días</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectosActivos as $p)
                        @php
                            $intervalo = date_diff(date_create($p->created_at),date_create(date("Y-m-d H:i:s")));
                        @endphp
                        @if($intervalo->format('%a') > 30)
                        <tr>
                            <td><a href="{{ route('show_sale',$p->id) }}" target="_blank">{{ $p->id }}</a></td>
                            <td>{{ $p->company['name'] .'-'. $p->description }}</td>
                            <td>{{ onlyDate($p->created_at) }}</td>
                            <td>{{ $intervalo->format('%a') }} Días</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 card p-2">
            <div class="ribbon-wrapper">
            <div class="ribbon bg-info">
                &nbsp;
            </div>
            </div>
                @php
                    foreach ($proyectosMes as $p)
                    {
                        $totalVentaMes += $p->estimated;
                    }
                @endphp
                <h4 class="text-center">
                    Utilidad generada en proyectos abiertos de {{ onlyMonth(date('Y-m')) }}
                </h4>
                <canvas id="utility_generated" ></canvas>
                <script>
                    var ctx = document.getElementById("utility_generated").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        //type: 'pie',
                        //type: 'bar',
                        data: {
                            labels: [
                                    @foreach ($proyectosMes as $p)
                                    @php
                                        $whitdrawals = \App\Whitdrawal::where('sale_id',$p->id)->where('status','Aprobado')->get();
                                        $totalRetiros = 0;
                                        foreach($whitdrawals as $whitdrawal)
                                        {
                                            $totalRetiros += floatval($whitdrawal->quantity);
                                        }
                                        $utilidad = number_format($p->estimated + ($p->estimated * 0.16) - $totalRetiros,2);
                                    @endphp
                                    '{{ $p->id }}\n{{ substr(preg_replace("/[\r\n|\n|\r]+/", " ", $p->description),0,15) }} Costo: ${{ number_format($p->estimated + ($p->estimated * 0.16),2) }} / Utilidad: ${{ $utilidad }}',
                                    @endforeach
                                
                                ],
                            datasets: [{
                                label: '',
                                data: [
                                    @foreach ($proyectosMes as $p)
                                        {{ $p->estimated + ($p->estimated * 0.16) }},


                                    @endforeach
                                ],
                                backgroundColor: [
                                    @foreach ($proyectosMes as $p)
                                        'rgba(57, 194, 128 ,0.2)',
                                    @endforeach
                                
                                ],
                                borderColor: [
                                    @foreach ($proyectosMes as $p)
                                        'rgba(57, 194, 128 ,0.2)',
                                    @endforeach
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            onClick: function(event, legendItem, legend){
                                let id = legendItem[0]._model.label.split("\n");
                                window.open('{{ route('show_sale') }}/'+id[0]);
                            },
                        }
                    });
                </script>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 card p-2">
        <div class="ribbon-wrapper">
            <div class="ribbon bg-info">
                &nbsp;
            </div>
        </div>
        @php
            $companiasConProyectosActivos = App\Sale::distinct()->where('status','Proyecto')->get('company_id');
        @endphp
        <h4 class="text-center">
                Proyectos activos por cliente
            </h4>
            <p class="font-weight-bold">
                En las siguentes gráficas se muestran 
                {{ count($companiasConProyectosActivos) }} clientes con proyectos activos así como
                el total en costo de proyectos y el total en pagos realizados.
            </p>
        </div>

        

        @foreach($companiasConProyectosActivos as $p)
        @php
            $company = \App\Company::find($p->company_id);
            $proyectosActivosPorCompania = App\Sale::where('company_id', $company->id)->where('status', 'Proyecto')->get();
            $sumaCostoTotal = 0;
            $sumaPagosTotal = 0;
            foreach($proyectosActivosPorCompania as $p)
            {
                $sumaCostoTotal += $p->estimated + ($p->estimated * 0.16); 
                $pagosPorProyecto = 0;
                $pagos = App\SalePayment::where('sale_id',$p->id)->get();
                foreach($pagos as $pay)
                {
                    $pagosPorProyecto += $pay->amount;
                }
                $sumaPagosTotal += $pagosPorProyecto;
            }
        @endphp
        @if(count($proyectosActivosPorCompania) > 3)
        <div class="col-md-12 card p-2">
        @else
        <div class="col-md-6 card p-2">
        @endif
        <div class="ribbon-wrapper">
            <div class="ribbon bg-info">
                &nbsp;
            </div>
        </div>
        <h4 class="text-center">
                {{ $company->name }}
            </h4>
            <p class="font-weight-bold">
                Cuenta con 
                <span class="text-primary">{{ count($proyectosActivosPorCompania) }}</span> proyectos activos los cuales suman 
                <span class="text-success">${{ number_format($sumaCostoTotal,2) }}</span> en costo de proyecto y un total de
                <span class="text-info">${{ number_format($sumaPagosTotal,2) }}</span> en pagos.
            </p>
            <canvas id="projects_by_client_{{ $company->id }}" ></canvas>
            <script>
            var ctx = document.getElementById("projects_by_client_{{ $company->id }}").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                //type: 'pie',
                //type: 'bar',
                data: {
                    labels: [
                        @foreach($proyectosActivosPorCompania as $p)
                        @php
                            $costo = $p->estimated + ($p->estimated * 0.16);
                            $pagosPorProyecto = 0;
                            $pagos = App\SalePayment::where('sale_id',$p->id)->get();
                            foreach($pagos as $pago){
                                $pagosPorProyecto += $pago->amount;
                            }

                        @endphp
                        '{{ $p->id }}\n{{ substr(preg_replace("/[\r\n|\n|\r]+/", " ", $p->description),0,15) }} \n Costo: ${{ number_format($costo,2) }} \n Pagos: ${{ number_format($pagosPorProyecto,2) }}',
                        @endforeach
                        ],
                    datasets: [{
                        label: '{{ count($proyectosActivosPorCompania) }} proyectos activos',
                        data: [
                        @foreach($proyectosActivosPorCompania as $p)
                        {{ $p->estimated + ($p->estimated * 0.16) }},
                        @endforeach
                        ],
                        backgroundColor: [
                            @foreach($proyectosActivosPorCompania as $p)
                            @php
                                $costo = $p->estimated + ($p->estimated * 0.16);
                                $pagosPorProyecto = 0;
                                $pagos = App\SalePayment::where('sale_id',$p->id)->get();
                                foreach($pagos as $pago){
                                    $pagosPorProyecto += $pago->amount;
                                }
                                $colorBarra = "";
                                if($costo <= $pagosPorProyecto)
                                {
                                    $colorBarra= "rgba(57, 194, 128 ,0.2)";
                                }else{
                                    $colorBarra= "rgba(255, 251, 25 ,0.2)";
                                }
                                if($pagosPorProyecto <= 0){
                                    $colorBarra= "rgba(238, 44, 4 ,0.2)";
                                }
                            @endphp
                            '{{ $colorBarra }}',
                            @endforeach
                        ],
                        borderColor: [
                            @foreach($proyectosActivosPorCompania as $p)
                                                        @php
                                $costo = $p->estimated + ($p->estimated * 0.16);
                                $pagosPorProyecto = 0;
                                $pagos = App\SalePayment::where('sale_id',$p->id)->get();
                                foreach($pagos as $pago){
                                    $pagosPorProyecto += $pago->amount;
                                }
                                $colorBarra = "";
                                if($costo <= $pagosPorProyecto)
                                {
                                    $colorBarra= "rgba(57, 194, 128 ,0.2)";
                                }else{
                                    $colorBarra= "rgba(255, 251, 25 ,0.2)";
                                }
                                if($pagosPorProyecto <= 0){
                                    $colorBarra= "rgba(238, 44, 4 ,0.2)";
                                }
                            @endphp
                            '{{ $colorBarra }}',
                            @endforeach
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    onClick: function(event, legendItem, legend){
                        let id = legendItem[0]._model.label.split("\n");
                        window.open('{{ route('show_sale') }}/'+id[0]);
                    },
                }
            });
            </script>
        </div>

        @endforeach




    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-info">
                    &nbsp;
                </div>
            </div>
                Proyectos activos por compañía
            </h4>
            @php $proyectos = \App\Sale::where('status','Proyecto')->orderBy('company_id')->get() @endphp
            <p class="font-weight-bold">
                A continuación se muestran {{ count($proyectos) }} proyectos activos así como el costo, la inverción y 
                la utilidad generada en cada uno.
                
            </p>
            <script>
                function exportTableToExcel(tableID, filename = ''){
                    var downloadLink;
                    var dataType = 'application/vnd.ms-excel';
                    var tableSelect = document.getElementById(tableID);
                    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
                    
                    // Specify file name
                    filename = filename?filename+'.xls':'excel_data.xls';
                    
                    // Create download link element
                    downloadLink = document.createElement("a");
                    
                    document.body.appendChild(downloadLink);
                    
                    if(navigator.msSaveOrOpenBlob){
                        var blob = new Blob(['ufeff', tableHTML], {
                            type: dataType
                        });
                        navigator.msSaveOrOpenBlob( blob, filename);
                    }else{
                        // Create a link to the file
                        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                    
                        // Setting the file name
                        downloadLink.download = filename;
                        
                        //triggering the function
                        downloadLink.click();
                    }
                }
            </script>
            <button onclick="exportTableToExcel('index_table_hidden','Proyectos_activos_{{ date('YmdHis') }}.xls')" class="btn btn-success float-right">Exportar excel</button>
            <table class="table table-striped" id="index_table2">
                <thead>
                    <tr>
                        <th>Companía</th>
                        <th>Proyecto</th>
                        <th>Retiros aprobados</th>
                        <th>Retiros pendientes</th>
                        <th>Costo</th>
                        <th>Pagos</th>
                        <th>Inversión</th>
                        <th>Utilidad</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                    @php 
                        $retiros_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Aprobado')->get();
                        $retiros_p_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Pendiente')->get();
                        $inversion_aux = 0;
                        foreach($retiros_aux as $retiro)
                        {
                            $inversion_aux += $retiro->quantity;
                        }
                        $utilidad_aux = ($proyecto->estimated + ($proyecto->estimated * 0.16)) - $inversion_aux;
                        
                        $pagos = \App\SalePayment::where('sale_id',$proyecto->id)->get();
                        $totalPagos = 0;
                        foreach($pagos as $pagos)
                        {
                            $totalPagos += $pago->amount;
                        }

                     @endphp
                    <tr>
                        <td>{{ $proyecto->company['name'] }}</td>
                        <td><a href="{{ route('show_sale',$proyecto->id) }}" target="_blank">{{ $proyecto->description }}</a></td>
                        <td>{{ count($retiros_aux) }}</td>
                        <td><a href="{{ route('show_whitdrawal_by_project',$proyecto->id) }}" target="_blank">{{ count($retiros_p_aux) }}</a></td>
                        <td>${{ number_format($proyecto->estimated + ($proyecto->estimated * 0.16),2) }}</td>
                        <td>${{ number_format($totalPagos,2) }}</td>
                        <td>${{ number_format($inversion_aux,2) }}</td>
                        <td>${{ number_format($utilidad_aux,2) }}</td>
                        <td>{{ onlyDate($proyecto->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table style="display:none;" id="index_table_hidden" border="1">
                <thead>
                    <tr>
                        <th>Companía</th>
                        <th>Proyecto</th>
                        <th>Retiros aprobados</th>
                        <th>Retiros pendientes</th>
                        <th>Costo</th>
                        <th>Pagos</th>
                        <th>Inversión</th>
                        <th>Utilidad</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                    @php 
                        $retiros_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Aprobado')->get();
                        $retiros_p_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Pendiente')->get();
                        $inversion_aux = 0;
                        foreach($retiros_aux as $retiro)
                        {
                            $inversion_aux += $retiro->quantity;
                        }
                        $utilidad_aux = ($proyecto->estimated + ($proyecto->estimated * 0.16)) - $inversion_aux;
                        
                        $pagos = \App\SalePayment::where('sale_id',$proyecto->id)->get();
                        $totalPagos = 0;
                        foreach($pagos as $pagos)
                        {
                            $totalPagos += $pago->amount;
                        }

                     @endphp
                    <tr>
                        <td>{{ $proyecto->company['name'] }}</td>
                        <td>{{ $proyecto->description }}</td>
                        <td>{{ count($retiros_aux) }}</td>
                        <td>{{ count($retiros_p_aux) }}</td>
                        <td>${{ number_format($proyecto->estimated + ($proyecto->estimated * 0.16),2) }}</td>
                        <td>${{ number_format($totalPagos,2) }}</td>
                        <td>${{ number_format($inversion_aux,2) }}</td>
                        <td>${{ number_format($utilidad_aux,2) }}</td>
                        <td>{{ onlyDate($proyecto->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <canvas id="proyect_by_company" ></canvas>
        </div>
    </div>

<!--




    <div class="row">
        <div class="col-md-6">
            <h4 class="text-center">
                Proyectos y Cotizaciones.
            </h4>
            <p class="font-weight-bold">
                En esta gráfica se muestra la cantidad de proyectos activos así como la cantidad de cotizaciones pendientes
                que no han sido aprobadas para convertirse en proyecto ni rechazadas para dejar de ser tomadas en cuenta.
            </p>
            <canvas id="projects_quotes" ></canvas>
        </div>
        <div class="col-md-6">
            <h4 class="text-center">
                Venta, Inversión y Utilidad
            </h4>
            <p class="font-weight-bold">
                En seguida se muestra el total de la utilidad esperada de todos los proyectos activos a partir de la inversión 
                realizada hasta el momento.
                <br/>
                El costo total de todos los proyectos activos es:  ${{ number_format($costoTotal,2) }}
            </p>
            <canvas id="sale_investment_utility" ></canvas>
        </div>
    </div>

    


</div>
<br/>



<script>
var ctx = document.getElementById('projects_quotes').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    //type: 'pie',
    //type: 'bar',
    data: {
        labels: ['Proyectos activos: {{ $projects }}', 'Cotizaciones pendientes: {{ $quotes }}'],
        datasets: [{
            //label: '# of Votes',
            data: [{{ $projects }}, {{ $quotes }}],
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                //'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                //'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById('sale_investment_utility').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    //type: 'pie',
    //type: 'bar',
    data: {
        labels: ['Inversión','Utilidad'],
        datasets: [{
            label: '',
            data: [{{ $inversionTotal }},{{ $utilidadTotal }}],
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                //'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                //'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>

var ctx = document.getElementById('proyect_by_company').getContext('2d');
var myChart = new Chart(ctx, {
    //type: 'line',
    //type: 'pie',
    type: 'bar',
    data: {
        
        labels: [
            @foreach($proyectos as $proyecto)
            '{{ $proyecto->company['name'] }} - {{ $proyecto->description }}',
            @endforeach
            ],
        datasets: [{
            //label: 'Venta total: $1000',
            data: [
                 @foreach($proyectos as $proyecto)
                {{ $proyecto->estimated }},
                 @endforeach
                ],
            
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                //'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
                 @foreach($proyectos as $proyecto)
                'rgba(255, 99, 132, 0.2)',
                 @endforeach
            ],
            borderColor: [
                //'rgba(255, 99, 132, 0.2)',
                //'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
                 @foreach($proyectos as $proyecto)
                'rgba(255, 99, 132, 0.2)',
                 @endforeach
            ],

            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>



-->




<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script>
            jQuery(document).ready(function(){

                $("#index_table").dataTable({
                    deferRender: true,
                    bJQueryUI: true,
                    bScrollInfinite: true,
                    bScrollCollapse: true,
                    bPaginate: true,
                    bFilter: true,
                    bSort: true,
                    aaSorting: [[0, "asc"]],
                    pageLength: 2,
                    bDestroy: true,
                    aoColumnDefs: [
                        {
                            
                        },
                    ],
                    oLanguage: {
                        sLengthMenu: "_MENU_ ",
                        sInfo:
                            "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                        sInfoEmpty: "No hay registros para mostrar",
                        sSearch: "",
                        oPaginate: {
                            sFirst: "Primer página",
                            sLast: "Última página",
                            sPrevious: "<b>Anterior</b>",
                            sNext: "<b>Siguiente</b>"
                        }
                    }
                });
                setTableStyle()
            });

            jQuery(document).ready(function(){

                $("#index_table2").dataTable({
                    deferRender: true,
                    bJQueryUI: true,
                    bScrollInfinite: true,
                    bScrollCollapse: true,
                    bPaginate: true,
                    bFilter: true,
                    bSort: true,
                    aaSorting: [[0, "asc"]],
                    pageLength: 10,
                    bDestroy: true,
                    aoColumnDefs: [
                        {
                            
                        },
                    ],
                    oLanguage: {
                        sLengthMenu: "_MENU_ ",
                        sInfo:
                            "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                        sInfoEmpty: "No hay registros para mostrar",
                        sSearch: "",
                        oPaginate: {
                            sFirst: "Primer página",
                            sLast: "Última página",
                            sPrevious: "<b>Anterior</b>",
                            sNext: "<b>Siguiente</b>"
                        }
                    }
                });
                setTableStyle()
            });

            function setTableStyle() {
                setTimeout(function() {
                    $("select[name='DataTables_Table_0_length']").prop(
                        "class",
                        "custom-select"
                    );
                    $(".dataTables_length").prepend("<b>Mostrar</b> ");
                    $("select[name='table_asistencias_length']").prop(
                        "class",
                        "custom-select"
                    );
                    $("select[name='DataTables_Table_0_length']").prop(
                        "class",
                        "form-control"
                    );
                    $(".dataTables_length").append(" <b>elementos por página</b>");

                    $("input[type='search']").prop("class", "form-control");
                    $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
                }, 300);
            }
        </script>








<!--


<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('whitdrawal_index') }}">Retiros pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('whitdrawal_index') }}" style="color:white;">{{ $withdrawals }} </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('task_index') }}">Tareas pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('task_index') }}" style="color:white;">{{ $tasks }}</a> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_quotes') }}">Cotizaciones pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_quotes') }}" style="color:white;">{{ $quotes }}</a> 
                    </h1>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_proyects') }}">Proyectos activos</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_proyects') }}" style="color:white;">{{ $projects }}</a> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_binnacle') }}">Bitácoras</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_binnacle') }}" style="color:white;">{{ $binnacles }}</a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('company_index') }}">Compañías</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('company_index') }}" style="color:white;">{{ $companies }} </a>
                    </h1>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="mobile/dotech_mobile_1-1-2.apk">App</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="mobile/dotech_mobile_1-1-2.apk" style="color:white;">1-1-2</a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('log_index') }}">Log</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        &nbsp; 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('config_index') }}">Config</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        &nbsp; 
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>





@php
$cog = asset('img/background_black_red.jpg');
@endphp
<style type="text/css">

.item_dashboard{
    background: url({{$cog}}) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    width: 100%;
    height: auto;
    overflow: hidden;
}
</style>

-->
@endsection