<script>
    function pintarGraficaProyectosMes() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'precio total $ {{ $proyectos->pluck('estimated')->sum() }}');
        data.addColumn('number', 'Proyectos');
        data.addRows([
            @foreach ($proyectos as $proyecto)
                ['{{ $proyecto->folio_proyecto }}, {{ $proyecto->description }} ${{ $proyecto->estimated }}',
                    {{ $proyecto->estimated }}
                ],
            @endforeach
        ]);
        var options = {
            'title': '{{ count($proyectos) }} proyectos se han iniciado este mes sumando un precio total de $ {{ $proyectos->pluck('estimated')->sum() }}',
            'width': '100%',
            'height': 300,
            'bars': 'horizontal',

        };
        var graficaProyectosMes = new google.charts.Bar(document.getElementById('grafica_proyectos_mes'));
        google.visualization.events.addListener(graficaProyectosMes, 'select', selectHandler);
        graficaProyectosMes.draw(data, options);

        function selectHandler() {

            var selectedItem = graficaProyectosMes.getSelection()[0];
            if (selectedItem) {
                var selectedValue = data.getValue(selectedItem.row, 0);
                var data_array = selectedValue.split(',');
                cargarPreviewProyecto(data_array[0]);
            }
        }
    }

    {{--  function generarNuevoColor() {
        var simbolos, color;
        simbolos = "0123456789ABCDEF";
        color = "#";

        for (var i = 0; i < 6; i++) {
            color = color + simbolos[Math.floor(Math.random() * 16)];
        }
        return color;
    }  --}}
</script>
