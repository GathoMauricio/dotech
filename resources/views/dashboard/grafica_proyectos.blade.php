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

    function cargarPreviewProyecto(proy) {
        $.ajax({
            type: 'GET',
            url: '{{ url('preview_proyecto') }}',
            data: {
                proy: proy
            }
        }).done(function(response) {
            $("#span_autor").text(response.author.name + ' ' + response.author.middle_name + ' ' + response
                .author
                .last_name);
            $("#span_folio_proyecto").text(response.folio_proyecto);
            $("#span_cliente").text(response.company.name);
            $("#span_departamento").text(response.department.name);
            $("#span_descripcion").text(response.description);
            $("#span_estimado").text(response.estimated);
            $("#span_observaciones").text(response.observation);
            $("#link_abrir_proyecto").prop('href', '{{ url('show_sale') }}/' + response.id);
            $("#modal_preview_proyecto").modal();
        }).fail(function(jqXHR, textStatus, errorThrown) {});
    }
</script>
