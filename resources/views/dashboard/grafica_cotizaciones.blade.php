<script>
    function pintarGraficaPieCotizaciones() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Cotizaciones Vs Proyectos');
        data.addRows([
            ['Cotizaciones', {{ count($cotizaciones->whereNull('project_at')) }}],
            ['Proyectos', {{ count($cotizaciones->whereNotNull('project_at')) }}],
        ]);
        var options = {
            'title': '{{ count($cotizaciones->whereNotNull('project_at')) }} de {{ count($cotizaciones) }} cotizaciones de este mes, se han convertido en proyecto',
            'width': '100%',
            'height': 300,
            'is3D': true,
            'colors': ['#3498DB', '#82E0AA'],
        };
        var graficaCotizacionesVsProyectos = new google.visualization.PieChart(document.getElementById(
            'grafica_cotizaciones_vs_proyectos'));
        graficaCotizacionesVsProyectos.draw(data, options);
    }
</script>
