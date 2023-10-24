<script>
    var quotesVSprojectsCtx = document.getElementById('cotizaciones_vs_proyectos').getContext(
        '2d');
    quotesVSprojects = new Chart(quotesVSprojectsCtx, {
        type: 'pie',
        data: {
            labels: ['Pendientes', 'Proyectos'],
            datasets: [{
                label: '',
                data: [{{ count($cotizaciones->whereNull('project_at')) }},
                    {{ count($cotizaciones->whereNotNull('project_at')) }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                ],
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: '{{ count($cotizaciones->whereNotNull('project_at')) }} de {{ count($cotizaciones) }} cotizaciones de este mes, se han convertido en proyecto'
                }
            }
        }
    });
</script>
