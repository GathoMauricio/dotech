<?php

namespace App\Http\Controllers;
use Goutte\Client;
use Illuminate\Http\Request;

class ScrapingController extends Controller
{
    public function index()
    {
        return view('miecocasa.index');
    }
    public function result(Request $request, Client $client)
    {
        set_time_limit(50000);
        //return ini_get('max_execution_time');
        $list = $request->list;
        $list = explode("\r", $list);
        $object = [];
        foreach($list as $item){
            $item = intval($item);
            $object[] =  $item;
        }
        $crawler = $client->request('GET', 'http://proveedoreco.infonavit.org.mx/proveedoresEcoWeb/');
        $form = $crawler->filter("form")->form();
        $crawler = $client->submit($form, ['usuario' => 'IEMECG07', 'password' => 'Mexico21']);
        $itemAccount = [];
        $count = 0;
        foreach($object as $account){
            $count++;
            $form = $crawler->filter("form")->form();
            $crawler = $client->submit($form, [
                'numeroCredito' => $account 
                //'numeroCredito' => '1920598288' 
            ]);
            $message = $crawler->filter('.system_title')->first();
            if(count($message) > 0){
                $account = $account;
                $name = "";
                $amount = "";
                $message->text();
                $itemAccount [] = [
                    'count' => $count,
                    'account' => $account,
                    'name' => $name,
                    'amount' => $amount,
                    'message' => $message->text(),
                ];
            }else{
                //No existe unmensaje de error
                $account = $account;
                $section = explode('Datos del Acreditado',$crawler->filter('form[name=proveedoresForm]')->first()->text());
                $aux = explode('Nombre Acreditado: ',$section[1]);
                $aux = explode(' NSS: ',$aux[1]);
                $name = $aux[0];
                $aux = explode('Monto de la Constancia para la compra de ecotecnologías:',$section[1]);
                $aux = explode(' Ahorro Minimo',$aux[1]);
                $amount = $aux[0];
                $message = '';
                $itemAccount [] = [
                    'count' => $count,
                    'account' => $account,
                    'name' => $name,
                    'amount' => $amount,
                    'menssage' => $message,
                ];
            }
        }
        return $itemAccount->paginate();
    }
    public function example(Client $client)
    {
        $crawler = $client->request('GET', 'http://proveedoreco.infonavit.org.mx/proveedoresEcoWeb/');
        $form = $crawler->filter("form")->form();
        $crawler = $client->submit($form, ['usuario' => 'IEMECG07', 'password' => 'Mexico21']);
        
        $form = $crawler->filter("form")->form();
        $crawler = $client->submit($form, [
            //'numeroCredito' => '1920654618' // Con saldo
            'numeroCredito' => '1920653488' //Sin saldo
            ]);
        $mensaje = $crawler->filter('.system_title')->first();
        
        if(count($mensaje) > 0){
            //Existe un mensaje de error
            return $mensaje->text();
        }else{
            //No existe unmensaje de error
            return $crawler->html();
        }
        
    }
}
