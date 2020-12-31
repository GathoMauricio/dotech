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
if (!function_exists('parseBase64')) {
    function parseBase64($image)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $imageData = file_get_contents($image, false, stream_context_create($arrContextOptions));
        $data64 = base64_encode($imageData);
        $data = 'data:image/' . $type . ';base64,' . $data64;
        return $data;
    }
}