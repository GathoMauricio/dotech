<?php
Breadcrumbs::for('/', function ($trail) {
  $trail->push('Inicio', route('/'));
});
//Retros
Breadcrumbs::for('whitdrawal_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Retiros', route('whitdrawal_index'));
});

//Tareas
Breadcrumbs::for('task_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Tareas', route('task_index'));
});
Breadcrumbs::for('task_create', function ($trail) {
    $trail->parent('task_index');
    $trail->push('Nueva tarea', route('task_create'));
});
Breadcrumbs::for('task_edit', function ($trail) {
    $trail->parent('task_index');
    $trail->push('Editar tarea', route('task_edit',''));
});

//Cotizaciones
Breadcrumbs::for('index_quotes', function ($trail) {
    $trail->parent('/');
    $trail->push('Cotizaciones', route('index_quotes'));
});
Breadcrumbs::for('all_rejects', function ($trail) {
    $trail->parent('index_quotes');
    $trail->push('Rechazadas', route('all_rejects'));
});
Breadcrumbs::for('quote_products', function ($trail) {
    $trail->parent('index_quotes');
    $trail->push('Productos', route('quote_products',''));
});


//Proyectos
Breadcrumbs::for('index_proyects', function ($trail) {
    $trail->parent('/');
    $trail->push('Proyectos', route('index_proyects'));
});
Breadcrumbs::for('index_proyects_finished', function ($trail) {
    $trail->parent('index_proyects');
    $trail->push('Finalizados', route('index_proyects_finished'));
});
Breadcrumbs::for('binnacles_by_project', function ($trail) {
    $trail->parent('index_proyects');
    $trail->push('Bitácoras', route('binnacles_by_project',''));
});
Breadcrumbs::for('show_sale', function ($trail) {
    $trail->parent('index_proyects');
    $trail->push('Detalles', route('show_sale',''));
});


Breadcrumbs::for('index_binnacle', function ($trail) {
    $trail->parent('/');
    $trail->push('Bitácoras', route('index_binnacle'));
});

Breadcrumbs::for('company_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Compañías', route('company_index'));
});

Breadcrumbs::for('vehicle_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Vehiculos', route('vehicle_index'));
});

Breadcrumbs::for('stock_product_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Almacén', route('stock_product_index'));
});

Breadcrumbs::for('candidates', function ($trail) {
    $trail->parent('/');
    $trail->push('Aspirantes', route('candidates'));
});