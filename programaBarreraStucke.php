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
 * @param array $partidas Coleccion de partidas.
 * @param string $jugador Nombre del jugador.
 * @return array Resumen del jugador.
 */
function resumenJugador($partidas, $jugador) 
{

    foreach($partidas as $partida){
        if($partida['jugador']=== $jugador){
        
            if($partida['puntaje']!=0){
                $victorias++;
                if($partida['intentos']===1){
                    $intento1++;
                }elseif($partida['intentos']===2){
                    $intento2++;
                }elseif($partida['intentos']===3){
                    $intento3++;
                }elseif($partida['intentos']===4){
                    $intento4++;
                }elseif($partida['intentos']===5){
                    $intento5++;
                }else{
                    $intento6++;
                }
            }
            
            $contadorPartidas++;
            $puntaje+= $partida['puntaje'];
        }
    }

    $resumen = 
    [
        "jugador" => $jugador,
        "partidas" => $contadorPartidas,
        "puntaje" => $puntaje,
        "victorias" => $victorias,
        "porcentajeVictorias"=> $victorias/$contadorPartidas,
        "intento1" => $intento1,
        "intento2" => $intento2,
        "intento3" => $intento3,
        "intento4" => $intento4,
        "intento5" => $intento5,
        "intento6" => $intento6
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

                // Verifico que ingrese un caracter de tipo numerérico
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
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != 8);

