<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
class BinnacleController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $binnacle = Binnacle::create($request->all());
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
        $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image']));
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
        $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image']));
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
