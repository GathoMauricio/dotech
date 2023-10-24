<script>
    var proyectos_mesCtx = document.getElementById('proyectos_mes').getContext(
        '2d');
    proyectos_mesCtx = new Chart(proyectos_mesCtx, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($proyectos as $proyecto)
                    '{{ $proyecto->description }} - $ {{ $proyecto->estimated }}',
                @endforeach
            ],
            datasets: [{
                label: 'All',
                data: [
                    @foreach ($proyectos as $proyecto)
                        '{{ $proyecto->estimated }}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(142, 68, 173, 0.9)',
                ],
            }]
        },
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: '{{ count($proyectos) }} proyectos se han iniciado este mes sumando un precio total de $ {{ $proyectos->pluck('estimated')->sum() }}'
                }
            }
        },
    });
</script>
