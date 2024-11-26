<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Stucke, Paloma. FAI-5544 . Tecnicatura en Desarrollo Web. paloma.stucke@est.fi.uncoma.edu.ar. palomaStucke */
/* Barrera, Carlos. FAI-1782. Tecnicatura en Desarrollo Web. carlos.barrera@est.fi.uncoma.edu.ar. bcarlos1508 */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "ALETA", "CALMA", "ZEBRA", "SIGNO", "RULOS"
        
    ];

    return ($coleccionPalabras);
}




/**
* Carga una colección de partidas con ejemplos variados.
* @return array
*/
function cargarPartidas()
{
   $coleccionPartidas=[];

   $coleccionPartidas[0]=["palabraWordix" => "QUESO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0];
   $coleccionPartidas[1]=["palabraWordix" => "CASAS", "jugador" => "rudolf", "intentos" => 3, "puntaje" => 14];
   $coleccionPartidas[2]=["palabraWordix" => "YUYOS", "jugador" => "alejandro", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[3]=["palabraWordix" => "TINTO", "jugador" => "juan", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[4]=["palabraWordix" => "NAVES", "jugador" => "luis", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[5]=["palabraWordix" => "ZEBRA", "jugador" => "maria", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[6]=["palabraWordix" => "CALMA", "jugador" => "julieta", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[7]=["palabraWordix" => "ALETA", "jugador" => "andres", "intentos" => 6, "puntaje" => 10];
   $coleccionPartidas[8]=["palabraWordix" => "GOTAS", "jugador" => "alejandro", "intentos" => 4, "puntaje" => 15];
   $coleccionPartidas[9]=["palabraWordix" => "GATOS", "jugador" => "andrea", "intentos" => 6, "puntaje" => 10];

   return ($coleccionPartidas);
}

/**
 * Retorna el resumen de un jugador.
 * @param array $coleccionPartidas Colección de partidas.
 * @param string $jugador Nombre del jugador.
 * @return array Resumen del jugador.
 */
function resumenJugador($coleccionPartidas, $jugador) {
    // Inicializamos el resumen del jugador
    $resumen = [
        "jugador" => $jugador,
        "partidas" => 0,
        "puntaje" => 0,
        "victorias" => 0,
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    // Iteramos sobre la colección de partidas
    foreach ($coleccionPartidas as $partida) {
        // Verificamos si la partida pertenece al jugador
        if ($partida['jugador'] == $jugador) {
            // Actualizamos el resumen del jugador
            actualizarResumenJugador($resumen, $partida);
        }
    }
    return $resumen;
}


/**
 * Visualiza el menú de opciones y solicita al usuario una opción válida
 * @return int
 */
function seleccionarOpcion()
{
    echo "***************************************************\n";
    echo "Menú de opciones:";
    echo "1) Jugar al Wordix con una palabra elegida";
    echo "2) Jugar al Wordix con una palabra aleatoria";
    echo "3) Mostrar una partida";
    echo "4) Mostrar la primer partida ganadora";
    echo "5) Mostrar resumen de Jugador";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra";
    echo "7) Agregar una palabra de 5 letras a Wordix";
    echo "8) Salir";
    echo "***************************************************\n";
    echo "Seleccione una opción:";

    $opcion = solicitarNumeroEntre(1,7);

    return $opcion;
}




/**
 * Muestra en pantalla los datos de la partida seleccionada por el usuario
 * @param int $numeroDePartida
 * @param array $coleccionPartidas
 */
function mostrarPartida($numeroDePartida,$coleccionPartidas)
{
    echo "Partida WORDIX ".($numeroDePartida-1).": palabra ".$coleccionPartidas[($numeroDePartida-1)]["palabraWordix"];
    echo "Jugador: ".$coleccionPartidas[($numeroDePartida-1)]["jugador"];
    echo "Puntaje: ".$coleccionPartidas[($numeroDePartida-1)]["puntaje"];
    if($coleccionPartidas[($numeroDePartida-1)]["intentos"]==0)
    {
        echo "Intento: No adivinó la palabra";
    }
    else
    {
        echo "Intentos: ".$coleccionPartidas[($numeroDePartida-1)]["intentos"];
    }
}




/**
 * Agrega una palabra a una colección de palabras
 * @param array $coleccionPalabras Colección de palabras
 * @param string $palabra
 * @return array Colección de palabras modificada
 */ 
function agregarPalabra($coleccionPalabras, $palabra)
{
    $coleccionPalabras[]= $palabra;

    return $coleccionPalabras;
}




/**
 * Busca la primer partida ganada de un jugador
 * @param array $coleccionPartidas
 * @param string $jugador
 * @return int Indice de la partida, -1 si no ganó ninguna partida
 */
function primerPartidaGanada($coleccionPartidas, $jugador)
{
    $indice=0; //Indice de la partida que buscamos

    $cantPartidas= count($coleccionPartidas);
    $partidaGanada=0;
    do{
        //Buscamos un puntaje mayor a 0 
        $partidaGanada=$coleccionPartidas['jugador']==$jugador["puntaje"];

        $indice++;
    }while($indice<$cantPartidas && $partidaGanada==0);
    
    if($partidaGanada===0){
        $indice=0;
    }

    return $indice-1;
}

/**
 * Actualiza el resumen de un jugador con los datos de una partida.
 * @param array $resumen Resumen del jugador.
 * @param array $partida Datos de la partida.
 */
function actualizarResumenJugador(&$resumen, $partida) {
    $resumen['partidas']++;
    $resumen['puntaje'] += $partida['puntaje'];
    if ($partida['intentos'] > 0) {
        $resumen['victorias']++;
        $intento = $partida['intentos'];
        if ($intento == 1) {
            $resumen['intento1']++;
        } elseif ($intento == 2) 
        {
            $resumen['intento2']++;
        } elseif ($intento == 3) 
        {
            $resumen['intento3']++;
        } elseif ($intento == 4) 
        {
            $resumen['intento4']++;
        } elseif ($intento == 5) 
        {
            $resumen['intento5']++;
        } elseif ($intento == 6) 
        {
            $resumen['intento6']++;
        }
    }
}

/**
 * solicita el nombre de un jugador en minusculas
 * @return string $nombre
 */
function solicitarJugador()
{
    $noEsLetra= false ;
    do{
        echo "Ingrese el nombre de un jugador:";
        $nombre= strtolower(trim(fgets(STDIN)));
        $primerCaracter= esPalabra(substr($nombre,0,1));
        if($primerCaracter === false){
            echo "Error, el nombre debe comenzar con una letra.";
        }else{
            $noEsLetra= true;
        }
    }while (!$noEsLetra);

    return $nombre;
}




/**
 * Ordena y muestra las partidas por nombre de jugador y por palabra
 * @param array $partidas
 */
function mostrarPartidasOrdenadas($partidas) {
    // Usamos uasort para ordenar el array manteniendo las claves originales
    uasort($partidas, function ($a, $b) {
        // Comparar por el nombre del jugador
        if ($a['jugador'] < $b['jugador']) {
            return -1; 
        } elseif ($a['jugador'] > $b['jugador']) {
            return 1; 
        } else {
            // Si los nombres son iguales, comparar por la palabra
            if ($a['palabra'] < $b['palabra']) {
                return -1; 
            } elseif ($a['palabra'] > $b['palabra']) {
                return 1; 
            } else {
                return 0; 
            }
        }
    });

    // Mostrar la colección ordenada
    print_r($partidas);
}




/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//LA FUNCION MOSTRARPARTIDA: chequear con seleccionarNumeroEntre antes de invocarla.

//Declaración de variables:


//Inicialización de variables:


//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);


$partidas= cargarPartidas();
$palabras= cargarColeccionPalabras();


do {
    $opcion = seleccionarOpcion();

    
    switch ($opcion) {
        case 1: 
            $jugador= solicitarJugador();
            do{
                echo "Ingrese un número de palabra para jugar:";
                $palabraElegida= trim(fgets(STDIN));

                // Verifico que ingrese un caracter de tipo numérico
                $esLetra= esPalabra($palabraElegida); 
                if($esLetra=== true){
                    echo "Error, debe ser numérico";
                }else{
                    $palabraElegida= $palabras[$palabraElegida-1];

                    //Verifico que no haya utilizado la palabra
                    $palabraUsada= false;
                    $n= count($partidas); //Cantidad de partidas
                    $i=0;
                    do{
                      if($partidas['jugador']===$jugador){
                            if($partidas['palabraWordix']===$palabraElegida){
                                echo "Error, usted ya uso esta palabra.";
                                $palabraUsada= true;
                            }
                        }
                        $i++;
                    }while($i<$n && !$palabraUsada);
                }
            }while(!$esLetra);

            $partida= jugarWordix($palabraElegida,$jugador);
            $partidas[]=$partida;

            break;
        case 2:
            $jugador= solicitarJugador();
            $numeroPalabra = rand(0, count($coleccionPalabras) - 1);
            $palabraAleatoria = $coleccionPalabras[$numeroPalabra];
            $palabraElegida=$palabraAleatoria;
            do
            {
                //Verifico que no haya utilizado la palabra
                $palabraUsada= false;
                $n= count($partidas); //Cantidad de partidas
                $i=0;
                do{
                    if($partidas['jugador']===$jugador){
                        if($partidas['palabraWordix']===$palabraElegida){
                            echo "Error, usted ya uso esta palabra.";
                            $palabraUsada= true;
                        }
                    }
                    $i++;
                }
                while($i<$n && !$palabraUsada);
            }
            while(!$esLetra);
            // Iniciar la partida de Wordix con la palabra seleccionada
            $partida = jugarWordix($palabraAleatoria, $jugador);

            // Guardar los datos de la partida en la estructura de datos de partidas
            $coleccionPartidas[] = $partida;
            break;
        case 3: 
            // Mostrar una partida
            $numeroPartida = solicitarNumeroEntre(0, count($coleccionPartidas) - 1);
            mostrarPartida($coleccionPartidas, $numeroPartida);
            break;
        case 4:
            // Mostrar la primera partida ganadora
            $jugador = solicitarJugador();
            $indice = primerPartidaGanada($coleccionPartidas, $jugador);
            if ($indice != -1) {
                mostrarPartida($coleccionPartidas, $indice);
            } else {
                echo "El jugador $jugador no ganó ninguna partida.\n";
            }
            break;
        case 5:
            // Mostrar resumen de Jugador
            $jugador = solicitarJugador();
            $resumen = resumenJugador($coleccionPartidas, $jugador);
            print_r($resumen);
        break;
    }
} while ($opcion != 8);

