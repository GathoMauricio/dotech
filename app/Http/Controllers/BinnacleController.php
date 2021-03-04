<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
use App\Sale;
class BinnacleController extends Controller
{
    public function index()
    {
        $binnacles = Binnacle::orderBy('id','DESC')->paginate(15);
        return view('binnacles.index',compact('binnacles'));
    }
    public function create()
    {
        $sales = Sale::where('status','Proyecto')->get();
        return view('binnacles.create',compact('sales'));
    }
    public function store(Request $request,$id = null)
    {
        $binnacle = Binnacle::create($request->all());
        $message = 'Ha creado la bitácora: '.
        $binnacle->description.
        ' para el proyecto "'.$binnacle->sale['description'].'" 
        de la compañía '.$binnacle->sale->company['name'];
        \Mail::send('email.notification', ['binnacle' => $binnacle, 'msg' => $message], function ($mail){
            $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
            $mail->to(['rortuno@dotredes.com']);
        });
        if($id)
        { 
            return redirect()->route('index_binnacle')
              ->with('message', 'La bitácora '.$binnacle->description.' se creó con éxito.');  
        }
        return redirect()->back()
            ->with('message', 'La bitácora '.$binnacle->description.' se creó con éxito.');
    }
    public function show($id)
    {
        //
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
        //
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
}
