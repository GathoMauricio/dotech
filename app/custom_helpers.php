<?php
if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        /*
        $diassemanaN = array(
            "Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado"
        );
        */
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        return
            //$diassemanaN[date_format(new \DateTime($date), 'N')] .
            ' ' . date_format(new \DateTime($date), 'd') .
            ' de ' .
            $mesesN[date_format(new \DateTime($date), 'n')] .
            ' del ' .
            date_format(new \DateTime($date), 'Y')
            . ' a las ' .
            date_format(new \DateTime($date), 'g:i A');
    }
}
/*
if (!function_exists('onlyDate')) {
    function onlyDate($date)
    {
        $d = explode(' ',$date);
        return $d[0];
    }
}
*/
if (!function_exists('onlyDate')) {
    function onlyDate($date)
    {
        $d = explode(' ', $date);
        //return $d[0];
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        return
            //$diassemanaN[date_format(new \DateTime($date), 'N')] .
            ' ' . date_format(new \DateTime($d[0]), 'd') .
            ' de ' .
            $mesesN[date_format(new \DateTime($d[0]), 'n')] .
            ' del ' .
            date_format(new \DateTime($d[0]), 'Y');
    }
}
if (!function_exists('onlyMonth')) {
    function onlyMonth($date)
    {
        $d = explode(' ', $date);
        //return $d[0];
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        return
            //$diassemanaN[date_format(new \DateTime($date), 'N')] .
            //' '.date_format(new \DateTime($d[0]), 'd'). 
            //' de '.
            $mesesN[date_format(new \DateTime($d[0]), 'n')] .
            ' del ' .
            date_format(new \DateTime($d[0]), 'Y');
    }
}
if (!function_exists('createSysLog')) {
    function createSysLog($body)
    {
        $log = new \App\Http\Controllers\SysLogsController();
        $log->store(
            Auth::user()->name . " " .
                Auth::user()->middle_name . " " .
                Auth::user()->last_name . " " .
                $body
        );
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
if (!function_exists('getUrl')) {
    function getUrl()
    {
        return env('APP_URL');
    }
}
if (!function_exists('sendFcm')) {
    function sendFcm($fcm_token, $title, $body, $dataArray)
    {
        $data = json_encode([
            "to" => $fcm_token,
            //"to" => "/topics/all",
            //"to" => "some_token",
            "notification" => [
                "title" => $title,
                "body" => $body,
                "icon" => "ic_launcher",
                "sound" => "default",
                "priority" => "high"
            ],
            "data" => $dataArray
        ]);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = env('FCM_KEY');
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return die('Oops! FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('validarCFDI')) {
    function validarCFDI($sEmisor, $sReceptor, $sTotal, $sUuid)
    {
        $emisor = $sEmisor;
        $receptor = $sReceptor;
        $total = $sTotal;
        $uuid = $sUuid;
        $SOAP = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/"><soapenv:Header/><soapenv:Body><tem:Consulta><tem:expresionImpresa>?re=' . $emisor . '&amp;rr=' . $receptor . '&amp;tt=' . $total . '&amp;id=' . $uuid . '</tem:expresionImpresa></tem:Consulta></soapenv:Body></soapenv:Envelope>';
        $headers = [
            'Content-Type: text/xml;charset=utf-8',
            'SOAPAction: http://tempuri.org/IConsultaCFDIService/Consulta',
            'Content-length: ' . strlen($SOAP)
        ];
        $url = 'https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $SOAP);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res = curl_exec($ch);
        curl_close($ch);
        $xml = simplexml_load_string($res);
        $data = $xml->children('s', true)->children('', true)->children('', true);
        $data = json_encode($data->children('a', true), JSON_UNESCAPED_UNICODE);
        return $data;
        //$json = json_decode($data);
        //return $json;
        //return $json->CodigoEstatus;
    }
}
