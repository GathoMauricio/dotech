<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
class ApiBinnacleController extends Controller
{
    public function index($id)
    {
        $binnacles = Binnacle::where('sale_id',$id)->get();
        $json = [];
        foreach($binnacles as $binnacle)
        {
            $json[] = [
                'id' => $binnacle->id,
                'author' => $binnacle->author['name'].' '.$binnacle->author['middle_name'].' '.$binnacle->author['last_name'],
                'description' => $binnacle->description,
                'date' => onlyDate($binnacle->created_at),
            ];
        }
        return $json;
    }
    public function binnaclesAll(Request $request)
    {
        $binnacles = Binnacle::orderBy('id','DESC')->get();
        $json = [];
        foreach($binnacles as $binnacle)
        {
            $json[] = [
                'id' => $binnacle->id,
                'author' => $binnacle->author['name'].' '.$binnacle->author['middle_name'].' '.$binnacle->author['last_name'],
                'description' => $binnacle->description,
                'date' => onlyDate($binnacle->created_at),
            ];
        }
        return $json;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $binnacle = Binnacle::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description
        ]);
        if($binnacle)
        {
            $message = 'Ha creado la bitácora: '.
            $binnacle->description.
            ' para el proyecto "'.$binnacle->sale['description'].'" 
            de la compañía '.$binnacle->sale->company['name'];
            \Mail::send('email.notification', ['binnacle' => $binnacle, 'msg' => $message], function ($mail){
                $mail->from('dotechapp@dotredes.com',env('APP_NAME'));
                $mail->to(['rortuno@dotredes.com']);
            });
            return  [
                'error' => 0,
                'msg' => 'Bitácora creada ahora puede agregar imagenes.',
                'id' => $binnacle->id
            ];
        }else{
            return  [
                'error' => 1,
                'msg' => 'Error al crear registro..'
            ];
        }
    }
    public function storeFirm(Request $request)
    {
        $binnacle = Binnacle::findOrFail($request->binnacle_id);
        $image = $request->firma;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'BinnacleFirm_'.$binnacle->id.'.'.'png';
        \Storage::disk('local')->put($imageName,base64_decode($image));
        $binnacle->firm = $imageName;
        $binnacle->save();
        return $binnacle;
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
        return 'La bitácora se envió con éxito.';
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
}
