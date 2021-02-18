<?php

namespace App\Http\Controllers;
use Goutte\Client;
use Illuminate\Http\Request;
use App\Exports\ScrapingExport;
use Maatwebsite\Excel\Facades\Excel;
use App\ScrapingList;
class ScrapingController extends Controller
{
    public function index()
    {
        return view('miecocasa.index');
    }
    public function result(Request $request, Client $client)
    {
       set_time_limit(50000);
        $list = $request->list;
        $list = explode("\r", $list);
        $object = [];
        foreach($list as $item){
            $item = intval($item);
            $object[] =  $item;
        }
        $crawler = $client->request('GET', 'http://proveedoreco.infonavit.org.mx/proveedoresEcoWeb/');
        $form = $crawler->filter("form")->form();
        $crawler = $client->submit($form, ['usuario' => 'IEMECG07', 'password' => 'Mexico90']);
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
                if($request->visibility == 'todo' || $request->visibility == 'red')
                {
                    $itemAccount [] = [
                        'count' => $count,
                        'account' => $account,
                        'name' => $name,
                        'amount' => $amount,
                        'message' => $message->text(),
                    ];
                }
            }else{
                $account = $account;
                $section = explode('Datos del Acreditado',$crawler->filter('form[name=proveedoresForm]')->first()->text());
                $aux = explode('Nombre Acreditado: ',$section[1]);
                $aux = explode(' NSS: ',$aux[1]);
                $name = $aux[0];
                $aux = explode('Monto de la Constancia para la compra de ecotecnologías:',$section[1]);
                $aux = explode(' Ahorro Minimo',$aux[1]);
                $amount = $aux[0];
                $message = '';
                if($request->visibility == 'todo' || $request->visibility == 'green')
                {
                    $itemAccount [] = [
                        'count' => $count,
                        'account' => $account,
                        'name' => $name,
                        'amount' => $amount,
                        'message' => $message,
                    ];
                }
                

            }
        }
        $pdf = \PDF::loadView('pdf.miecocasa',
            ['items' => $itemAccount]
        );
        return $pdf->download('MiEcoCasa '.formatDate(date('Y-m-d H:i')).'.pdf');
    }
    public function result_ajax(Request $request, Client $client)
    {
        try{
            sleep(10);
            $crawler = $client->request('GET', 'http://proveedoreco.infonavit.org.mx/proveedoresEcoWeb/');
            $form = $crawler->filter("form")->form();
            $crawler = $client->submit($form, ['usuario' => 'IEMECG07', 'password' => 'Mexico21']);
            $form = $crawler->filter("form")->form();
            $crawler = $client->submit($form, [
                'numeroCredito' => $request->account
            ]);
            $message = $crawler->filter('.system_title')->first();
            if(count($message) > 0){
                $scrapingList = ScrapingList::create([
                    'account' => $request->account,
                    'name' => "",
                    'amount' => "",
                    'message' => $message->text(),
                    'timestamp_id'=>$request->timestamp_id
                ]);
                return [
                        'account' => $request->account,
                        'name' => "",
                        'amount' => "",
                        'message' => $message->text(),
                ];
            }else{
                $section = explode('Datos del Acreditado',$crawler->filter('form[name=proveedoresForm]')->first()->text());
                $aux = explode('Nombre Acreditado: ',$section[1]);
                $aux = explode(' NSS: ',$aux[1]);
                $name = $aux[0];
                $aux = explode('Monto de la Constancia para la compra de ecotecnologías:',$section[1]);
                $aux = explode(' Ahorro Minimo',$aux[1]);
                $amount = $aux[0];
                $scrapingList = ScrapingList::create([
                    'account' => $request->account,
                    'name' => $name,
                    'amount' => $amount,
                    'message' => "",
                    'timestamp_id'=>$request->timestamp_id
                ]);
                return [
                    'account' => $request->account,
                    'name' => $name,
                    'amount' => $amount,
                    'message' => "",
                ];
            }
        }catch(Exception $e){
            $this->result_ajax($request,$client);
        }
    }
    public function excel(Request $request)
    {
        return Excel::download(new ScrapingExport($request->timestamp_id) , 'Scraping'.formatDate(date('Y-m-d H:i')).'.xlsx');
    }
}
