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
 * Visualiza el menú de opciones y solicita al usuario una opción válida
 * @return int
 */
function seleccionarOpcion()
{
    echo "***************************************************\n";
    echo "Menú de opciones:\n";
    echo "1) Jugar al Wordix con una palabra elegida\n";
    echo "2) Jugar al Wordix con una palabra aleatoria\n";
    echo "3) Mostrar una partida\n";
    echo "4) Mostrar la primer partida ganadora\n";
    echo "5) Mostrar resumen de Jugador\n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
    echo "7) Agregar una palabra de 5 letras a Wordix\n";
    echo "8) Salir\n";
    echo "***************************************************\n";
    echo "Seleccione una opción:";

    $opcion = solicitarNumeroEntre(1,8);

    return $opcion;
}




/**
 * Muestra en pantalla los datos de la partida seleccionada por el usuario
 * @param int $numeroDePartida
 * @param array $coleccionPartidas
 */
function mostrarPartida($numeroDePartida,$coleccionPartidas)
{
    echo "***************************************************\n";
    echo "Partida WORDIX ".($numeroDePartida-1).": palabra ".$coleccionPartidas[($numeroDePartida-1)]["palabraWordix"]."\n";
    echo "Jugador: ".$coleccionPartidas[($numeroDePartida-1)]["jugador"]."\n";
    echo "Puntaje: ".$coleccionPartidas[($numeroDePartida-1)]["puntaje"]." puntos\n";
    if($coleccionPartidas[($numeroDePartida-1)]["intentos"]==0)
    {
        echo "Intento: No adivinó la palabra";
    }
    else
    {
        echo "Intentos: Adivinó la palabra en ".$coleccionPartidas[($numeroDePartida-1)]["intentos"]." intentos\n";
    }
    echo "***************************************************\n";
}




/**
 * Agrega una palabra a una colección de palabras
 * @param array $coleccionPalabras Colección de palabras
 * @param string $palabra
 * @return array Colección de palabras modificada
 */ 
function agregarPalabra($coleccionPalabras, $palabra)
{
    array_push($coleccionPalabras, $palabra);
    print_r($coleccionPalabras);
    return $coleccionPalabras;
}




/**
 * Busca el indice de la primer partida ganada de un jugador
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
        if($coleccionPartidas[$indice]['jugador'] === $jugador){
            $partidaGanada= $coleccionPartidas[$indice]['puntaje'] ;
        }

        $indice++;
    }while($indice<$cantPartidas && $partidaGanada===0);
    
    if($partidaGanada===0){
        $indice=-1;
    }

    return $indice;
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
            $resumen['partidas']++;
            $resumen['puntaje'] += $partida['puntaje'];
            if ($partida['intentos'] > 0) {
                $resumen['victorias']++;
                $intento = $partida['intentos'];
                
                switch ($intento){
                    case 1:
                        $resumen['intento1']++;
                        break;
                    case 2:
                        $resumen['intento2']++;
                        break;
                    case 3:
                        $resumen['intento3']++;
                        break;
                    case 4:
                        $resumen['intento4']++;
                        break;
                    case 5:
                        $resumen['intento5']++;
                        break;    
                    case 6:
                        $resumen['intento6']++;
                        break;
                }
            }
        }
    }
    return $resumen;
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
 * @param array $coleccionPartidas
 */
function mostrarPartidasOrdenadas($coleccionPartidas) {
    // Usamos uasort para ordenar el array manteniendo las claves originales
    /*Uasort: Esta función ordena un array tal que los índices de array mantienen sus correlaciones con los 
    elementos del array con los que están asociados, usando una función de comparación definida por el usuario.
    Se usa pricipalmente cuando se ordenan arrays asociativos donde el orden del elemento mismo es significante.*/

    uasort($coleccionPartidas, function ($a, $b) {
        // Comparar por el nombre del jugador
        if ($a['jugador'] < $b['jugador']) {
            return -1; 
        } elseif ($a['jugador'] > $b['jugador']) {
            return 1; 
        } else {
            // Si los nombres son iguales, comparar por la palabra
            if ($a['palabraWordix'] < $b['palabraWordix']) {
                return -1; 
            } elseif ($a['palabraWordix'] > $b['palabraWordix']) {
                return 1; 
            } else {
                return 0; 
            }
        }
    });

    // Mostrar la colección ordenada
    print_r($coleccionPartidas);
    /*Print_r: print_r() muestra información sobre una variable en una forma que es legible por humanos.*/
}




/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//LA FUNCION MOSTRARPARTIDA: chequear con seleccionarNumeroEntre antes de invocarla.

//Declaración de variables:

/**
 * array $partidas
 * array $palabras
 * int $opcion
 * int $ $numeroPalabra
 * string $palabraElegida
 * bool $esLetra
 * int $n
 * int $i
 * bool $palabraUsada
 * array $partida
 * string $jugador
 * int $numeroPartida
 * int $indice
 * array $resumen
 */

//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);


$partidas= cargarPartidas();
$palabras= cargarColeccionPalabras();


do {
    $opcion = seleccionarOpcion();

    
    switch ($opcion) {
        case 1: 
            // Jugar al wordix con una palabra elegida
            $jugador= solicitarJugador();
            
            do{
                echo "Ingrese un número de palabra para jugar:";
                $numeroPalabra= trim(fgets(STDIN));

                // Verifico que ingrese un caracter de tipo numérico
                $esLetra= esPalabra( $numeroPalabra); 
                if($esLetra === true){
                    echo "Error, debe ser numérico";
                }else{
                    $palabraElegida= $palabras[ $numeroPalabra-1];

                    //Verifico que no haya utilizado la palabra
                    $palabraUsada= false;
                    $n= count($partidas); //Cantidad de partidas
                    $i=0;
                    do{
                      if($partidas[$i]['jugador']===$jugador){
                            if($partidas[$i]['palabraWordix']===$palabraElegida){
                                echo "Error, usted ya uso esta palabra.";
                                $palabraUsada= true;
                            }
                        }
                        $i++;
                    }while($i<$n && !$palabraUsada);
                }
            }while($esLetra === true);

            // Iniciar la partida de Wordix con la palabra seleccionada
            $partida= jugarWordix($palabraElegida,$jugador);

            // Guardar los datos de la partida en la estructura de datos de partidas
            $partidas[]=$partida;

        break;


        case 2:
            // Jugar al wordix con una palabra aleatoria
            $jugador= solicitarJugador();
            $numeroPalabra = rand(0, count($palabras) - 1);
            $palabraAleatoria = $palabras[$numeroPalabra];

            //Verifico que no haya utilizado la palabra
            $palabraUsada= false;
            $n= count($partidas); //Cantidad de partidas
            $i=0;
            do{
                if($partidas[$i]['jugador']===$jugador){
                    if($partidas[$i]['palabraWordix']===$palabraAleatoria){
                        $numeroPalabra = rand(0, count($palabras) - 1);
                        $palabraAleatoria = $palabras[$numeroPalabra];
                        $palabraUsada= true;
                    }
                }
                $i++;
            }
            while($i<$n && !$palabraUsada);

            // Iniciar la partida de Wordix con la palabra seleccionada
            $partida = jugarWordix($palabraAleatoria, $jugador);

            // Guardar los datos de la partida en la estructura de datos de partidas
            array_push($partidas,$partida);
        break;


        case 3: 
            // Mostrar una partida
            $n= count($partidas); //Cantidad de partidas
            echo "Ingrese numero de partida: ";
            $numeroPartida = solicitarNumeroEntre(0, ($n - 1));
            mostrarPartida($numeroPartida, $partidas);
        break;


        case 4:
            // Mostrar la primera partida ganadora
            $jugador = solicitarJugador();
            $indice = primerPartidaGanada($partidas, $jugador);
            if ($indice != -1) {
                mostrarPartida($indice, $partidas);
            } else {
                echo "***************************************************\n";
                echo "El jugador $jugador no ganó ninguna partida.\n";
                echo "***************************************************\n";
            }
        break;


        case 5:
            // Mostrar resumen de Jugador
            $jugador = solicitarJugador();
            $resumen = resumenJugador($partidas, $jugador);
            echo "***************************************************\n";
            echo "Jugador: " .$jugador."\n";
            echo "Partidas: ".$resumen['partidas']."\n";
            echo "Puntaje: ".$resumen['puntaje']."\n";
            echo "Victorias: ".$resumen['victorias']."\n";
            $porcentajeV= ($resumen['victorias']/$resumen['partidas']);
            echo "Porcentaje Victorias: ".$porcentajeV."\n";
            echo "Adivinadas: "."\n";
            echo"       Intento 1: ".$resumen['intento1']."\n";
            echo"       Intento 2: ".$resumen['intento2']."\n";
            echo"       Intento 3: ".$resumen['intento3']."\n";
            echo"       Intento 4: ".$resumen['intento4']."\n";
            echo"       Intento 5: ".$resumen['intento5']."\n";
            echo"       Intento 6: ".$resumen['intento6']."\n";
            echo "***************************************************\n";
        break;


        case 6:
            // Mostrar listado de partidas ordenadas por jugador y por palabra
            mostrarPartidasOrdenadas($partidas);
        break;


        case 7:
            // Agregar palabra de 5 letras
            $palabra= leerPalabra5Letras();
            $palabras=agregarPalabra($palabras, $palabra);
            echo "La palabra fue agregada con éxito\n";
            echo "La palabra ingresada es: $palabra\n";
        break;

    }
} while ($opcion != 8);

?>