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
function resumenJugador($jugador) 
{
    $resumen = 
    [
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

    $opcion = solicitarNumeroEntre(1,8);

    return $opcion;
}

/**
 * Pide al usuario que ingrese una palabra de 5 letras
 * @return string
 */
function ingresaPalabra()
{
    $cantCAracteres=0;
    do{
        echo "Ingrese una palabra de 5 letras:";
        $palabra= strtoupper(trim(fgets(STDIN)));
        $cantCaracteres= strlen($palabra);
        if($cantCaracteres != 5){
            echo "Palabra inválida, debe ser de 5 letras.";
        }
    }while($cantCaracteres === 5);
    
    return $palabra;
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



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
