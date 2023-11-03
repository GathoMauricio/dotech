<script>
    function pintarGraficaPieProspectosClientes() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Prospectos Vs Clientes');
        data.addRows([
            ['Prospectos', {{ count($prospectos) }}],
            ['Clientes', {{ count($clientes) }}],
        ]);
        var options = {
            'title': 'Este mes se crearon {{ count($prospectos) }} prospectos y {{ count($clientes) }} Clientes',
            'width': '100%',
            'height': 300,
            'is3D': true,
            'colors': ['#8E44AD', '#F4D03F'],
        };
        var graficaProspectosClientes = new google.visualization.PieChart(document.getElementById(
            'grafica_prospectos_vs_clientes'));
        graficaProspectosClientes.draw(data, options);
    }
</script>
