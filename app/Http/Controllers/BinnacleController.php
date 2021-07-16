<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
use App\Sale;
class BinnacleController extends Controller
{
    public function index()
    {
        $binnacles = Binnacle::orderBy('created_at','DESC')->paginate(15);
        return view('binnacles.index',compact('binnacles'));
    }
    public function indexByProject($id)
    {
        $sale = Sale::findOrFail($id);
        $binnacles = Binnacle::where('sale_id',$id)->get();
        return view('binnacles.index_by_project',['binnacles' => $binnacles, 'sale' => $sale]);
    }
    public function create()
    {
        $sales = Sale::where('status','Proyecto')->get();
        return view('binnacles.create',compact('sales'));
    }
    public function store(Request $request,$id = null)
    {
        $binnacle = Binnacle::create($request->all());
        if(!empty($binnacle->sale['description']))
        {
            $message = 'Ha creado la bitácora: '.
            $binnacle->description.
            ' para el proyecto "'.$binnacle->sale['description'].'" 
            de la compañía '.$binnacle->sale->company['name'];
        }else{
            $message = 'Ha creado la bitácora: '.
            $binnacle->description.' sin proyecto asociado';
        }
        $msg = $message;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('wire_binnacles')
            ]));
        }
        \Mail::send('email.notification', ['binnacle' => $binnacle, 'msg' => $message], function ($mail){
            $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
            $mail->to(['rortuno@dotredes.com']);
        });
        if($id)
        { 
            return redirect()->route('wire_binnacles')
              ->with('message', 'La bitácora '.$binnacle->description.' se creó con éxito.');  
        }
        return redirect()->back()
            ->with('message', 'La bitácora '.$binnacle->description.' se creó con éxito.');
    }
    public function show($id)
    {
        //
    }
    public function showBinnacleAjax(Request $request)
    {
        $binnacle = Binnacle::findOrFail($request->id);

        $button1 ='<a href="#" onclick="addBinnacleImage('.$binnacle->id.')">
                        <span class="icon-plus" title="Agregar imagen..." style="cursor:pointer;color:#c52cec">
                            Nuevo
                        </span>
                    </a>';
        $button2 ='<a href="#" onclick="viewBinnacleImages('.$binnacle->id.','.count(\App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()).')">
                        <span class="icon-image" title="ver imágenes..." style="cursor:pointer;color:#2c49ec">
                        '.count(\App\BinnacleImage::where('binnacle_id',$binnacle->id)->get()).'
                            Imágenes
                        </span>
                    </a>';
        $button3 ='<a href="'.route('binnacle_pdf',$binnacle->id).'" target="_blank">
                    <span class="icon-file-pdf" title="Ver pdf..." style="cursor:pointer;color:#ec422c">
                        PDF
                    </span>
                </a>';
        $button4 ='<a href="#" onclick="sendBinnacle('.$binnacle->id.');">
                    <span class="icon-envelop" title="Enviar pdf..." style="cursor:pointer;color:#b3d420">
                        Enviar
                    </span>
                </a>';
        return [
            'binnacle' => $binnacle,
            'author' => $binnacle->author,
            'sale' => $binnacle->sale,
            'company' => $binnacle->sale->company,
            'department' => $binnacle->sale->department,
            'button1' => $button1,
            'button2' => $button2,
            'button3' => $button3,
            'button4' => $button4,
        ];
    }
    public function show_json($id){
        $binnacle = Binnacle::findOrFail($id);
        return [
            'binnacle' => $binnacle,
            'sale' => $binnacle->sale,
            'company' => $binnacle->sale->company,
            'department' => $binnacle->sale->department
        ];
    }
    public function sendPdf(Request $request)
    {
        $binnacle = Binnacle::findOrFail($request->binnacle_id);

        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        if(!empty($binnacle->sale['description']))
        {
           $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image'])); 
        }else{
            $logo2 = parseBase64(public_path("storage/compania.png")); 
        }
        if(!empty($binnacle->firm)) $firm = parseBase64(public_path("storage/".$binnacle->firm)); else $firm = NULL;
        $pdf = \PDF::loadView('pdf.binnacle',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'firm' => $firm,
                'binnacle' => $binnacle
            ]
        );
        \Mail::send('email.binnacle', ['binnacle' => $binnacle], function ($mail) use ($binnacle ,$pdf, $request) {
            $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
            $mail->to($request->email);
            $mail->attachData($pdf->output(), 'Bitacora '.$binnacle->created_at.'.pdf');
        });
        return redirect()->back()->with('message', 'La bitácora se envió con éxito. ');
    }
    public function sendAllPdf(Request $request)
    {
        set_time_limit(50000);
        $proyect = Sale::findOrFail($request->project_id);
        $binnacles = Binnacle::where('sale_id',$request->project_id)->get();
        $pdf = [];
        foreach($binnacles as $binnacle)
        {
            $logo = parseBase64(public_path("img/dotech_fondo.png"));
            if(!empty($binnacle->sale['description']))
            {
            $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image'])); 
            }else{
                $logo2 = parseBase64(public_path("storage/compania.png")); 
            }
            if(!empty($binnacle->firm)) $firm = parseBase64(public_path("storage/".$binnacle->firm)); else $firm = NULL;
            
            $pdf[] = \PDF::loadView('pdf.binnacle',
                [
                    'logo' => $logo,
                    'logo2' => $logo2,
                    'firm' => $firm,
                    'binnacle' => $binnacle
                ]
            )->output();

        }
        //$files = glob($pdf);
        //$zip = \Madzipper::make('storage/zipped/test.zip')->add($files)->close();
        //return dd($files);
        
        \Mail::send('email.binnacle_all', ['proyect' => $proyect], function ($mail) use ($proyect,$pdf, $request) {
            $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
            $mail->to($request->email);
            foreach($pdf as $p){
                $mail->attachData($p->output(), 'Bitacoras_proyecto_'.$proyect->description.'.pdf');
            }
        });
        
        //return redirect()->back()->with('message', 'La bitácora se envió con éxito. ');
        //return dd($pdf);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $binnacle = Binnacle::findOrFail($id);
        createSysLog('eliminó la bitácora '.$binnacle->description);
        $binnacle->delete();
        return redirect()->back()->with('message', 'La bitácora se eliminó con éxito. ');
    }
    public function makePdf($id)
    {
        $binnacle = Binnacle::findOrFail($id);
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        if(!empty($binnacle->sale['description']))
        {
           $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image'])); 
        }else{
            $logo2 = parseBase64(public_path("storage/compania.png")); 
        }
        if(!empty($binnacle->firm)) $firm = parseBase64(public_path("storage/".$binnacle->firm)); else $firm = NULL;
        $pdf = \PDF::loadView('pdf.binnacle',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'firm' => $firm,
                'binnacle' => $binnacle
            ]
        );
        return $pdf->stream('Bitacora_'.$binnacle->id.'.pdf');
    }
    public function searchBinnacleAjax(Request $request)
    {
        $binnacles = Binnacle::where('description','LIKE','%'.$request->q.'%')->limit(10)->get();
        $json = [];
        foreach($binnacles as $binnacle){
            $json [] = [
                'label' => $binnacle->sale['description'].' - '.$binnacle->description.' - '.onlyDate($binnacle->created_at),
                'value' => $binnacle->id
            ];
        }
        return $json;
    }
}
