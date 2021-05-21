<div class="test-content">
    <div class="test-body">
        <p class="text-right p-3">
            <span class="icon-cross" onclick="closeTest();"></span>
        </p>
        <h4 class="text-center">Test de evaluación para soporte técnico</h4>
        <h5>
        A continuación se te presentan una serie de preguntas con tres posibles respuestas, selecciona la que creas que es la correcta. 
        Al terminar selecciona la opción "Terminar evaluación".
        <br/><br/>
        (Importante: Si terminas la evaluación sin contestar alguna pregunta esta se tomará como errorea, así mismo si cierras el test no se almacenará tu resultado y deberás comenzar el test de nuevo.)
        </h5>
        <div id="test"></div>
        <center>
            <button onclick="evaluar();" class="btn btn-primary float-center">Terminar evaluación</button>
        </center>
        <p id="resultado"></p>
    </div>
</div>

<style>
    .test-content{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        padding: 10px;
        z-index: 9999;
    }
    .test-body {
        background-color: white;
        border-radius: 10px;
        width: 100%;
        height: 100%;
        padding: 10px;
        overflow: hidden;
        overflow-y: auto;
    }

    .icon-cross {
        cursor: pointer;
    }
</style>

<script type="text/javascript">
const contenedor = document.getElementById("test");
const resultadoTest = document.getElementById("resultado");
let user_test_id = 0;
const preguntas = [
  {
    pregunta: "01.- Una hoja de cálculo es:",
    respuestas: {
      a: "Una matriz de filas y columnas enumeradas por números y letras.",
      b: "Un conjunto de hojas vacías en las que se pueden realizar cálculos aritméticos.",
      c: "Un programa que realiza cálculos aritméticos.",
      d: "Una matriz de filas y columnas que contiene sólo valores numéricos."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "02.-En una hoja de calculo, la fórmula =suma(C5;C10) obtiene:",
    respuestas: {
      a: "La suma de los valores de las celdas C5 y C10.",
      b: "La suma de los valores C6, C7, C8 y C9.",
      c: "La suma de los valores C5, C6, C7, C8, C9 y C10.",
      d: "Es un error."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "03.-Una diapositiva es:",
    respuestas: {
      a: "Cada una de las divisiones de tiempo que aparecen en la presentación.",
      b: "El conjunto de los elementos gráficos y de textos de una presentación.",
      c: "Cada una de las pantallas distintas que forman una presentación.",
      d: "Cada cambio que ocurre en los elementos visualizados en la pantalla."
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "04.-¿Qué nos permite saber la función ABS de Excel?",
    respuestas: {
      a: "El número de palabras de un texto",
      b: "El valor absoluto de un número",
      c: "El resultado de una serie de operaciones",
      d: "El número de letras de la palabra"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "05.-¿Cuál es la extensión de los archivos de Access?",
    respuestas: {
      a: "Doc",
      b: "Txt",
      c: "Bdd",
      d: "Mdb"
    },
    respuestaCorrecta: "d",
  },

  {
    pregunta: "06.-¿En qué progama nos encontramos con funciones de tipo lógico?",
    respuestas: {
      a: "Word",
      b: "Access",
      c: "Excel",
      d: "Power Point"
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "07.-¿Qué programa se emplea para hacer presentaciones?",
    respuestas: {
      a: "Word",
      b: "Power Point",
      c: "Excel",
      d: "Access"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "08.-¿Qué signo es escencial en Excel?",
    respuestas: {
      a: "&",
      b: "=",
      c: "*",
      d: "/"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "09.-Ejemplo de navegador de Web es:",
    respuestas: {
      a: "un motor de búsqueda",
      b: "Internet Explorer, mozilla firefox, chrome",
      c: "Un programa que lee hipertexto",
      d: "Ninguna de las anteriores"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "10.-Cuando el mouse cambia y es una mano señalando significa:",
    respuestas: {
      a: "que hay algo para ver",
      b: "que hay un vinculo para otra pagina",
      c: "que la pagina está abriendo",
      d: "que hay una ventana púrpura"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "11.-Usted tiene una computadora en reparación, la falla descrita por el cliente es : No enciende. Revisa la PC y nota que al encenderla ningún ventilador gira, no se enciende ninguna luz, y tampoco se escucha sonido alguno. ¿En donde se encuentra la posible falla?",
    respuestas: {
      a: "Memoria",
      b: "Disco duro",
      c: "Fuente de alimentacion",
      d: "Teclado",
      e: "Pila CR203"
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "12.-Se recibe un reclamo de un cliente porque su impresora nueva, comprada hace 2 meses no imprime correctamente. Usted realiza una hoja de prueba y nota que el color negro no esta imprimiendo como deberia. Revisa los niveles de tinta y estos estan casi lleno",
    respuestas: {
      a: "Realizar una limpieza de inyectores.",
      b: "Cambiar el cable USB.",
      c: "Reinstalar el driver de la impresora.",
      d: "Cambiar el cartucho de color negro.",
      e: "Verificar en la configuracion de impresoras del sistema, que esta no es la impresora predeterminada."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "13.-¿Qué es un 'hacker'?",
    respuestas: {
      a: "Un delincuente informático.",
      b: "Una persona estudiosa y experta en tecnología.",
      c: "Un virus muy peligroso.",
      d: "Un programa que le roba su Facebook."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "14.-La RAM es:",
    respuestas: {
      a: "La capacidad de almacenamiento de PC.",
      b: "La cantidad de fotos y canciones que le caben a un celular, PC o tableta.",
      c: "El chip que ayuda al procesador a tener datos y varias aplicaciones al tiempo.",
      d: "Rama de la tecnología que estudia el ‘hardware’."
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "15.-La 'computación en la nube' se le dice a:",
    respuestas: {
      a: "Servicios informáticos que operan desde Internet.",
      b: "El humo que habita dentro de la red de Internet.",
      c: "Los datos que viajan sin cables por el cielo.",
      d: "Las comunicaciones 4G LTE celulares."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "16.-¿Qué es Hardware ?",
    respuestas: {
      a: "Es la parte lógica de la computadora.",
      b: "Son los programas.",
      c: "Es la parte física de la computadora.",
      d: "Es un tipo de virus.",
      e: "Es el nombre de un programa."
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "17.-¿Cuáles de estas son unidades de medidas en informática ?",
    respuestas: {
      a: "Ultra, Hiper, Super, Multi y Plus.",
      b: "Big, Little, Short, Small y Fats.",
      c: "Poligonos, Antigonos, Pentagonos, Perimetros y Milímetros.",
      d: "Bit, Byte, Kilobyte, Megabyte y Gigabyte.",
      e: "Metros, Centímetros, Milímetros, Pixels y Pulgadas."
    },
    respuestaCorrecta: "d",
  },

  {
    pregunta: "18.-¿Qué es un backup ?",
    respuestas: {
      a: "Es una copia de seguridad de determinados archivos.",
      b: "Es un programa para rescatar los archivos de un disco duro formateado.",
      c: "Es un anti-virus.",
      d: "Es un programa del Windows XP.",
      e: "Es una tecnología para aumentar la performance de la computadora."
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "19.-¿Cuáles de estos son programas de OFFICE ?",
    respuestas: {
      a: "Fireworks, Flash y Dreamweaver",
      b: "Word, Excel y Access.",
      c: "Paint, Explorer y Movie Maker.",
      d: "WinAvi, Nero y Ares"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "20.-¿Cuáles de estos son versiones de Sistemas Operativos de WINDOWS ?",
    respuestas: {
      a: "Windows 7, Windows XP y Windows Vista",
      b: "Macintosh, Mac OS X e Intel",
      c: "Linux, Delphi y Gnome",
      d: "Ubuntu, Haiku y Solaris",
      e: "Windows Fedora, Windows Unix System V y Windows MS-DOS"
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "21.-¿Cuáles son las teclas de atajo usadas en este mismo orden para: Cortar, Copiar y Pegar ?",
    respuestas: {
      a: "Alt + N, Ctrl + Q y Ctrl + P",
      b: "Alt + F4, Ctrl + Del y Ctrl + A",
      c: "Ctrl + X, Ctrl + C y Ctrl + V",
      d: "Ctrl + Alt + Del, F5 y Ctrl + D",
      e: "Ctrl + N, F10 y Ctrl + Alt + F2"
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "22.-¿Qué es una UPS ?",
    respuestas: {
      a: "Es un dispositivo que ante la falta de energía continúa alimentando la PC por sólo cinco minutos, permitiendo apagar el equipo.",
      b: "Es un dispositivo que en el caso de falta de energía eléctrica, continúa alimentando la PC durante un tiempo determinado.",
      c: "Es un dispositivo que sólo estabiliza el voltaje de la energía en caso de caída de energía, pero en caso de falta de energía no continúa alimentando al equipo.",
      d: "Es un dispositivo que cuando es conectado a la placa-madre hace que tu computadora pueda permanecer encendida por horas.",
      e: "Es un dispositivo que se conecta a la computadora que no permite la entrada de virus cuando el equipo se encuentre conectado en una red."
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "23.-¿Cual crees que es la señal principal de que un disco duro se está deteriorando?",
    respuestas: {
      a: "Cuando Windows se bloquea seguido",
      b: "Cuando la conexión a Internet se cae continuamente.",
      c: "Cuando hace un ruido y se demora en arrancar",
      d: "Cuando el PC no arranca y el Bios advierte que no existe un disco duro"
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "24.-Tres valores que debe estar configurado para permitir que un PC para conectarse con una red? ",
    respuestas: {
      a: "Dirección de MAC, Dirección IP y Mascara",
      b: "Dirección IP, Mascara y Puerta de Enlace",
      c: "Direcciones de Correo, Puerta de Enlace y Dirección de MAC"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "25.-¿Qué comando, disponible en Windows se mostrará la información de configuración de red de un PC?",
    respuestas: {
      a: "CONFIG",
      b: "IPCONFIG",
      c: "IFCONFIG",
      d: "WINIPCFG"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "26.-¿El método a utilizar para poner fin a un proceso de forma manual en Windows XP?",
    respuestas: {
      a: "Presione Ctrl-Alt-Supr, a continuación, haga clic en Inicio",
      b: "Presione Ctrl-Alt-Supr, elija proceso, y luego haga clic en Finalizar tarea",
      c: "Haga clic en Inicio> Programas> Final Todos"
    },
    respuestaCorrecta: "b",
  },

  {
    pregunta: "27.-¿Opción del menú de inicio que permite el acceso a la línea de comando de entrada del espacio?",
    respuestas: {
      a: "Ejecutar",
      b: "Ayuda",
      c: "Configuracion"
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "28.-¿Que utilidad de Windows se utiliza para instalar manualmente un controlador de dispositivos?",
    respuestas: {
      a: "Administrador de Consola",
      b: "Administrador de Configuracion",
      c: "Administrador de dispositivos",
      d: "Administrador de Controladores.",
      e: "Explorador de Windows"
    },
    respuestaCorrecta: "c",
  },

  {
    pregunta: "29.-A un técnico de una empresa, se le ha pedido a la reparación de un PC. ¿Cuál es la primera tarea que el técnico debe llevar a cabo para solucionar problemas de la computadora?",
    respuestas: {
      a: "Solicitar información a los usuarios; para determinar donde y cuando se produce el error",
      b: "Volver a cargar el sistema operativo inmediatamente.",
      c: "Realizar un Documento de Fallas.",
      d: "Encontrar la falla; a prueba y error",
      e: "Levantar Backup de disco"
    },
    respuestaCorrecta: "a",
  },

  {
    pregunta: "30.-¿Cual es el modo de inicio que permite el acceso a Windows con sólo los controladores de dispositivos más básicos?",
    respuestas: {
      a: "Modo a Prueba de Fallos",
      b: "Modo de carga de controladores",
      c: "Solo Comandos",
      d: "Modo seguro desde la consola de comandos"
    },
    respuestaCorrecta: "a",
  },

];

function mostrarTest(show_user_test_id) {
user_test_id = show_user_test_id;
  const preguntasYrespuestas = [];

  preguntas.forEach((preguntaActual, numeroDePregunta) => {
    const respuestas = [];

    for (letraRespuesta in preguntaActual.respuestas) {
      respuestas.push(
        `<div class="row ">
              <div class="col-md-12 text-center bg-light">
              <input type="radio" name="${numeroDePregunta}" value="${letraRespuesta}" />
              ${letraRespuesta} ) ${preguntaActual.respuestas[letraRespuesta]}
              </div>
              
          </div>`
      );
    }

    preguntasYrespuestas.push(
      `<div class="row item-test">
      <div class="col-md-12">
      <div class="cuestion text-center">
      <label class="font-weight-bold " style="color:black;">
      ${preguntaActual.pregunta}
      </label>
      </div>
       <div class="respuestas container"> ${respuestas.join("")} </div>
      </div>
      </div>
      <br>
      `
    );
  });

  contenedor.innerHTML = preguntasYrespuestas.join("");
  $(".test-content").css('display', 'block');
}

evaluar = () => {

    if(confirm('¿Evaluar test?\nAl terminar el test ya no se podrá realizar nungún canbio'))
    {
        const respuestas = contenedor.querySelectorAll(".respuestas");
        let respuestasCorrectas = 0;

        preguntas.forEach((preguntaActual, numeroDePregunta) => {
        const todasLasRespuestas = respuestas[numeroDePregunta];
        const checkboxRespuestas = `input[name='${numeroDePregunta}']:checked`;
        const respuestaElegida = (
        todasLasRespuestas.querySelector(checkboxRespuestas) || {}
        ).value;

        if (respuestaElegida === preguntaActual.respuestaCorrecta) {
        respuestasCorrectas++;

        respuestas[numeroDePregunta].style.color = "green";
        } else {
        respuestas[numeroDePregunta].style.color = "red";
        }
    });
        let calif = (respuestasCorrectas * 10 ) / preguntas.length;
        
        $.ajax({
            type: "GET",
            url: "{{ route('update_evaluation_test') }}",
            data: { id:user_test_id, evaluation: calif },
            success: data => {
                $("#td_evaluation_"+data.id).text(data.evaluation);
                alert("Tu calificación ha sido de "+data.evaluation);
                $(".test-content").css('display', 'none');
            },
            error: err => console.log(err)
        });
    }
}

closeTest = () => {
    if(confirm("¿Realmente desea cerrar este test?\nAl cerrar el test no se guardará ningún cambio."))
    {
        $(".test-content").css('display', 'none');
    }
};
</script>