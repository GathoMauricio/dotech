<script>
    function pintarGraficaCostos() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Costos');
        data.addRows([
            ['Precio de venta ${{ $costoProyecto }}', {{ str_replace(',', '', $costoProyecto) }}],
            ['Utilidad ${{ $utilidad }}', {{ $utilidad }}],
            ['Total en retiros ${{ $totalRetiros }}', {{ $totalRetiros }}],
            ['Comisión ({{ $proyecto->commision_percent }}%) ${{ $comision }}', {{ $comision }}],
        ]);
        var options = {
            'title': 'Costos',
            'width': '100%',
            'height': 300,
            'bars': 'vertical',

        };
        var graficaCostos = new google.charts.Bar(document.getElementById('grafica_costos'));
        graficaCostos.draw(data, options);
    }
</script>
