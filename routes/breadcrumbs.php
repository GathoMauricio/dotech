<?php
Breadcrumbs::for('test', function ($trail) {
    $trail->push('Breadcum de prueba', route('test'));
  });
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

//Wire Projects
Breadcrumbs::for('wire_projects', function ($trail) {
    $trail->parent('/');
    $trail->push('Proyectos', route('wire_projects'));
});

//Bitácpras
Breadcrumbs::for('index_binnacle', function ($trail) {
    $trail->parent('/');
    $trail->push('Bitácoras', route('index_binnacle'));
});
Breadcrumbs::for('create_binnacle', function ($trail) {
    $trail->parent('index_binnacle');
    $trail->push('Crear bitácora', route('create_binnacle'));
});


//Compaías
Breadcrumbs::for('company_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Compañías', route('company_index'));
});
Breadcrumbs::for('create_company', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Crear compañía', route('create_company'));
});
Breadcrumbs::for('quotes', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Cotizaciones', route('quotes',''));
});
Breadcrumbs::for('projects', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Proyectos', route('projects',''));
});
Breadcrumbs::for('finalized', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Finalizados', route('finalized',''));
});
Breadcrumbs::for('rejects', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Cotizaciones rechazadas', route('rejects',''));
});
Breadcrumbs::for('repository_company', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Repositorio', route('repository_company',''));
});
Breadcrumbs::for('edit_company', function ($trail) {
    $trail->parent('company_index');
    $trail->push('Editar compañía', route('edit_company',''));
});

//Vehiculos
Breadcrumbs::for('vehicle_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Vehiculos', route('vehicle_index'));
});
Breadcrumbs::for('create_vehicle', function ($trail) {
    $trail->parent('vehicle_index');
    $trail->push('Crear vehiculo', route('create_vehicle'));
});
Breadcrumbs::for('vehicle_show', function ($trail) {
    $trail->parent('vehicle_index');
    $trail->push('Detalles', route('vehicle_show',''));
});

//Almacén
Breadcrumbs::for('stock_product_index', function ($trail) {
    $trail->parent('/');
    $trail->push('Almacén', route('stock_product_index'));
});
Breadcrumbs::for('product_exits', function ($trail) {
    $trail->parent('stock_product_index');
    $trail->push('Últimas salidas', route('product_exits'));
});
Breadcrumbs::for('stock_product_create', function ($trail) {
    $trail->parent('stock_product_index');
    $trail->push('Crear producto', route('stock_product_create'));
});
Breadcrumbs::for('stock_product_exit_index', function ($trail) {
    $trail->parent('stock_product_index');
    $trail->push('Salidas', route('stock_product_exit_index',''));
});
Breadcrumbs::for('stock_product_edit', function ($trail) {
    $trail->parent('stock_product_index');
    $trail->push('Editar producto', route('stock_product_edit',''));
});

//Aspirantes
Breadcrumbs::for('candidates', function ($trail) {
    $trail->parent('/');
    $trail->push('Aspirantes', route('candidates'));
});
Breadcrumbs::for('candidates_create', function ($trail) {
    $trail->parent('candidates');
    $trail->push('Agregar aspirante', route('candidates_create'));
});
Breadcrumbs::for('candidates_edit', function ($trail) {
    $trail->parent('candidates');
    $trail->push('Editar candidato', route('candidates_edit',''));
});

#Configuration

//Provedores de retiro
Breadcrumbs::for('provider_index', function ($trail) {
    $trail->push('Provedores de retiro', route('provider_index'));
});
Breadcrumbs::for('edit_provider', function ($trail) {
    $trail->parent('provider_index');
    $trail->push('Edición de retiro', route('edit_provider',''));
});

//Departamentos de retiro
Breadcrumbs::for('index_department', function ($trail) {
    $trail->push('Departamentos de retiro', route('index_department'));
});
Breadcrumbs::for('create_department', function ($trail) {
    $trail->parent('index_department');
    $trail->push('Agregar departamento de retiro', route('create_department'));
});
Breadcrumbs::for('edit_department', function ($trail) {
    $trail->parent('index_department');
    $trail->push('Editar departamento de retiro', route('edit_department',''));
});

//Cuentas de retiro
Breadcrumbs::for('index_account', function ($trail) {
    $trail->push('Cuentas de retiro', route('index_department'));
});
Breadcrumbs::for('create_account', function ($trail) {
    $trail->parent('index_account');
    $trail->push('Agregar cuenta de retiro', route('create_department'));
});
Breadcrumbs::for('edit_account', function ($trail) {
    $trail->parent('index_account');
    $trail->push('Editar cuenta de retiro', route('edit_department',''));
});

//Usuarios
//Cuentas de retiro
Breadcrumbs::for('index_user', function ($trail) {
    $trail->push('Cuentas de Usuarios', route('index_user'));
});
Breadcrumbs::for('create_user', function ($trail) {
    $trail->parent('index_user');
    $trail->push('Crear usuario', route('create_user'));
});
Breadcrumbs::for('edit_user', function ($trail) {
    $trail->parent('index_user');
    $trail->push('Editar', route('edit_user',''));
});