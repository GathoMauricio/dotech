@if (@Auth::user()->hasRole('administrador'))
    <h2>Eres un administrador</h2>
@endif


@if (@Auth::user()->hasPermissionTo('ver_retiros'))
    <h2>Puedes ver los retiros</h2>
@endif
