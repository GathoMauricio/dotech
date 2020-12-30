<?php
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        $diassemanaN = array(
            "Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado"
        );
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        return $diassemanaN[date_format(new \DateTime($date), 'N')] 
        .' '.date_format(new \DateTime($date), 'd'). 
        ' de '.
        $mesesN[date_format(new \DateTime($date), 'n')].
        ' del '.
        date_format(new \DateTime($date), 'Y')
        .' a las '.
        date_format(new \DateTime($date),'g:i A');
    }
}
if (!function_exists('onlyDate')) {
    function onlyDate($date)
    {
        $d = explode(' ',$date);
        return $d[0];
    }
}
if (! function_exists('createSysLog')) {
    function createSysLog($body)
    {
        $log = new \App\Http\Controllers\SysLogsController();
        $log->store(
        Auth::user()->name." ".
        Auth::user()->middle_name." ".
        Auth::user()->last_name." ".
        $body);
    }
}