<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionOneUserTest;
use App\SectionTwoUserTest;
use App\SectionThreeUserTest;

class UserTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sectionOne = SectionOneUserTest::create([
            'user_id' => $request->user_id,
            'evaluation' => number_format($request->evaluation,1),
            'time' => $request->time
        ]);
        for($i = 1; $i <= 30; $i++){
            $sectionOne['question_'.$i] = $request->resp_one[$i - 1]['respuesta'];
        }
        $sectionOne->save();

        $sectionTwo = SectionTwoUserTest::create([
            'user_id' => $request->user_id,
        ]);
        for($i = 1; $i <= 19; $i++){
            $sectionTwo['question_'.$i] = $request->resp_two[$i - 1]['respuesta'];
        }
        $sectionTwo->save();

        $sectionThree = SectionThreeUserTest::create([
            'user_id' => $request->user_id,
        ]);
        for($i = 1; $i <= 18; $i++){
            $sectionThree['question_'.$i] = $request->resp_three[$i - 1]['respuesta'];
        }
        $sectionThree->save();

        return ['evaluation' => $sectionOne->evaluation];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkUserTest(Request $request,$id)
    {
        $oneTest = SectionOneUserTest::where('user_id',$id)->orderBy('id','desc')->first();
        if($oneTest)
        {
            return ['error' => 0];
        }else{
            return ['error' => 1];
        }
    }

    public function generateUserTest(Request $request,$id)
    {
        $oneTest = SectionOneUserTest::where('user_id',$id)->orderBy('id','desc')->first();
        $twoTest = SectionTwoUserTest::where('user_id',$id)->orderBy('id','desc')->first();
        $threeTest = SectionThreeUserTest::where('user_id',$id)->orderBy('id','desc')->first();
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        $oneQuestion = [
            '01.- Una hoja de cálculo es:',
            '02.-En una hoja de calculo, la fórmula =suma(C5;C10) obtiene:',
            '03.-Una diapositiva es:',
            '04.-¿Qué nos permite saber la función ABS de Excel?',
            '05.-¿Cuál es la extensión de los archivos de Access?',
            '06.-¿En qué progama nos encontramos con funciones de tipo lógico?',
            '07.-¿Qué programa se emplea para hacer presentaciones?',
            '08.-¿Qué signo es escencial en Excel?',
            '09.-Ejemplo de navegador de Web es:',
            '10.-Cuando el mouse cambia y es una mano señalando significa:',
            '11.-Usted tiene una computadora en reparación, la falla descrita por el cliente es : No enciende. Revisa la PC y nota que al encenderla ningún ventilador gira, no se enciende ninguna luz, y tampoco se escucha sonido alguno. ¿En donde se encuentra la posible falla?',
            '12.-Se recibe un reclamo de un cliente porque su impresora nueva, comprada hace 2 meses no imprime correctamente. Usted realiza una hoja de prueba y nota que el color negro no esta imprimiendo como deberia. Revisa los niveles de tinta y estos estan casi lleno',
            '13.-¿Qué es un hacker?',
            '14.-La RAM es:',
            '15.-La computación en la nube se le dice a:',
            '16.-¿Qué es Hardware ?',
            '17.-¿Cuáles de estas son unidades de medidas en informática ?',
            '18.-¿Qué es un backup ?',
            '19.-¿Cuáles de estos son programas de OFFICE ?',
            '20.-¿Cuáles de estos son versiones de Sistemas Operativos de WINDOWS ?',
            '21.-¿Cuáles son las teclas de atajo usadas en este mismo orden para: Cortar, Copiar y Pegar ?',
            '22.-¿Qué es una UPS ?',
            '23.-¿Cual crees que es la señal principal de que un disco duro se está deteriorando?',
            '24.-Tres valores que debe estar configurado para permitir que un PC para conectarse con una red?',
            '25.-¿Qué comando, disponible en Windows se mostrará la información de configuración de red de un PC?',
            '26.-¿El método a utilizar para poner fin a un proceso de forma manual en Windows XP?',
            '27.-¿Opción del menú de inicio que permite el acceso a la línea de comando de entrada del espacio?',
            '28.-¿Que utilidad de Windows se utiliza para instalar manualmente un controlador de dispositivos?',
            '29.-A un técnico de una empresa, se le ha pedido a la reparación de un PC. ¿Cuál es la primera tarea que el técnico debe llevar a cabo para solucionar problemas de la computadora?',
            '30.-¿Cual es el modo de inicio que permite el acceso a Windows con sólo los controladores de dispositivos más básicos?'
        ];
        $twoQuestion = [
            'Al intentar arrancar un equipo no enciende.',
            'El mismo equipo enciende pero no da video.',
            'El equipo enciende y se escuchan varios pitidos.',
            'Al encender el equipo marca un error de boot o boot.ini.',
            '¿Con qué tecla invocas el menú de inicio para iniciar en modo aprueba de fallos?.',
            '¿Normalmente con qué tipo de falla asocias los “Blue Screens”(pantallas azules) en Windows?.',
            'Al firmarse en Windows el tiempo de carga es demasiado lento.',
            'Si tuvieses que formatear el equipo. ¿Qué procedimiento utilizarías para respaldar el equipo y dejarlo EXACTAMENTE igual?.',
            '¿Cómo respaldarías los drivers y que información del usuario respaldarías?.',
            'Al firmarse en Windows carga demasiados programas residentes. ¿Qué comando utilizas para modificar los programas que se cargan al inicio?.',
            '¿Qué comando utilizas para salir al prompt?.',
            '¿En qué casos recomiendas el uso de Scandisk y Defrag?.',
            '¿Qué extensión tienen los archivos de datos de Microsoft Outlook?.',
            '¿Qué extensión tienen los archivos de datos de Outlook Express?.',
            '¿Qué es un normal.dot?',
            'Describe un problema de spool32 y una posible solución.',
            '¿Qué es un archivo con extensión .csv?.',
            '¿En qué modos puedes configurar un disco duro o cd rom?.',
            'Tenemos un equipo PIV 3.06 GHz con 512 Mb en RAM el usuario se queja de lentitud del sistema a pesar de que le has hecho un mantenimiento preventivo y problemas de software no tiene el equipo. ¿Cual sería tu recomendación?.',
        ];
        $threeQuestion = [
            '¿Qué tipo de cable se ocupa para cablear nodos de datos Cat 5e?.',
            'Indica el orden de los colores para rematar un cable de datos, puedes utilizar el standard A o B según lo desees.',
            'Indica el orden de colores para un cable “crossover ” (cruzado).',
            '¿Para qué se ocupa un patch panel?.',
            'Según el standard. ¿Cuál es la longitud máxima que un cable de red puede tener?.',
            '¿Es posible que viajen juntos un cable de datos y un cable de corriente?. Si o no y ¿Por qué?.',
            '¿En qué tipos de redes se ocupa la seguridad WEP?.',
            '¿Qué comando puedes utilizar para saber si un equipo está conectado a la red?.',
            '¿Qué es un DHCP?.',
            '¿Qué es un DNS?.',
            '¿Qué es un Router?.',
            '¿Qué hace un switch?.',
            '¿Qué es un FTP?.',
            '¿Con qué comando puedes saber la ip de una maquina?.',
            '¿Con qué comando puedes verificar si otro equipo esta en red?.',
            'De acuerdo a la siguiente configuración de red contesta las siguientes preguntas:',
            '¿Es posible compartir una impresora por medio de una red?',
            '¿Y un disco duro?',
        ];
        $pdf = \PDF::loadView('pdf.test',
            [
                'logo' => $logo,
                'oneTest' => $oneTest,
                'oneQuestion' => $oneQuestion,
                'twoTest' => $twoTest,
                'twoQuestion' => $twoQuestion,
                'threeTest' => $threeTest,
                'threeQuestion' => $threeQuestion,
            ]
        );
        return $pdf->stream('Test_'.$oneTest->user['name'].'_'.$oneTest->user['middle'].' .pdf');
    }
}
