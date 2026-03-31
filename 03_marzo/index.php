<?php

function sumarRecursos(int $a, int $b): int {
    $resultado = $a + $b;
    return $resultado;
}

// Llamada a la función
echo sumarRecursos(2, 5);

// PROPÓSITO: Devuelve la cantidad total de recursos al combinar dos líneas de
//producción
// EJEMPLO: sumarRecursos(2,3) = 5

function tieneMasRecursos(int $a, int $b): bool{

        if($a > $b){
            echo "a tiene mas recursos que b";
            return true;
        }

        echo "b tiene mas recusos que a";
        return false;
}
echo "\n";
echo tieneMasRecursos(9,6);


// PROPÓSITO: Indica si la línea de producción $a tiene más recursos que la línea
//de producción $b.
// EJEMPLO: tieneMasRecursos(2,6) = false

function lineaMayor(int $a, int $b): int{

         if($a > $b){
            echo "$a";
            echo "\n";
            return true;
        }

        echo "$b";
        return false;
}

echo "\n";
echo lineaMayor(10,6);
// PROPÓSITO: Devuelve la línea de producción con mayor cantidad de recursos.
// EJEMPLO: lineaMayor(10,6) = 10

function existeLineaConRecursos(array $lineasDeProduccion, int $cantidad): bool {
    // Recorremos cada línea una por una gracias "foreach"
    foreach ($lineasDeProduccion as $linea) {

        if ($linea === $cantidad) {
            return true; 
        }
    }


    return false;
}


echo "\n";
echo (existeLineaConRecursos([10, 8, 9], 8)); // Devuelve: bool(true)

// PROPÓSITO: Indica si existe una línea de producción con exactamente esa
// cantidad de recursos.
// PRECONDICIÓN: $lineasDeProduccion no es vacía
// EJEMPLO: existeLineaConRecursos([10,6,9], 6) = true

function lineaMaxima(array $lineasDeProduccion): int {
    $maximoActual = $lineasDeProduccion[0];

    foreach ($lineasDeProduccion as $linea) {

        $maximoActual = elMayorEntre($maximoActual, $linea);
    }

    return $maximoActual;
}
// PROPÓSITO: Devuelve la línea de producción con la mayor cantidad de recursos dentro de una lista.
// PRECONDICIÓN: $lineasDeProduccion no es vacía
// EJEMPLO: lineaMaxima([10,6,9,-9,100,88]) = 100
// RESTRICCIONES:
// * Debes reutilizar funciones previamente definidas

function totalDeRecursos(array $lineasDeProduccion): int {
    return array_sum($lineasDeProduccion);
}


echo totalDeRecursos([1, 2, 3, 4]); // Resultado: 10

function produccionEnParalelo(int $cantidad, int $lineasDeProduccion): int {
    $bolsaDeRecursos = [];

    // Usamos una estructura de repetición (while)
    // usamos el conteo del array
    while (count($bolsaDeRecursos) < $lineasDeProduccion) {
        $bolsaDeRecursos[] = $cantidad;
    }

    // Reutilizamos la función previamente definida
    // y el totalDeRecursos se encarga de la lógica de la suma
    return totalDeRecursos($bolsaDeRecursos);
}

echo produccionEnParalelo(2, 3); // Devuelve 6
echo produccionEnParalelo(2, 0); // Devuelve 0

// PROPÓSITO: Devuelve la cantidad de recursos que se generan al tener varias
// líneas de producción generando la misma cantidad de recursos en paralelo.
// (Multiplicación)
// EJEMPLO:
// * produccionEnParalelo(2,3) = 6
// * produccionEnParalelo(2,0) = 0
// RESTRICCIONES:
// * No se pueden utilizar los operadores * y +
// * Debes usar alguna estructura de repetición
// * Debes reutilizar una función previamente definida

function produccionReplicada(int $base, int $nivel): int {
    $resultado = 1; // La base de cualquier potencia nivel 0 es 1
    $iteraciones = [];

    //Estructura de repetición (while)
    // el conteo del array 
    while (count($iteraciones) < $nivel) {
        
        // la función de multiplicación previa
        // multiplicamos el resultado acumulado por la base en cada nivel
        $resultado = produccionEnParalelo($resultado, $base);

        //incrementamos el contador agregando un elemento al array
        $iteraciones[] = "nivel_completado";
    }

    return $resultado;
}

echo produccionReplicada(2, 3); // Devuelve 8 (2 * 2 * 2)
echo produccionReplicada(2, 0); // Devuelve 1
// PROPÓSITO: Devuelve la producción total de recursos al aplicar múltiples
// niveles sobre una producción base, donde en cada nivel la producción acumulada
// se replica en paralelo tantas veces como indica la base.
// (Potenciación)
// EJEMPLO:
// * produccionReplicada(2,3) = 8
// * produccionReplicada(2,0) = 1
// RESTRICCIONES:
// * No se pueden utilizar los operadores *, + y **
// * No se puede usar la función pow
// * Debes usar alguna estructura de repetición
// * Debes reutilizar funciones previamente definidas

function lineasEnCrecimiento(array $lineasDeProduccion): array {

    $primerElemento = $lineasDeProduccion[0];
    $resultado = [$primerElemento];
    
    // Guardamos 
    $ultimoGuardado = $primerElemento;

    foreach ($lineasDeProduccion as $linea) {

        if ($linea > $ultimoGuardado) {
            $resultado[] = $linea; 
            $ultimoGuardado = $linea; 
        }
    }

    return $resultado;
}

echo(lineasEnCrecimiento([1, 3, 4, 2, 5, 6, 8, 3, 10]));
// Resultado: [1, 3, 4, 5, 6, 8, 10]
// PROPÓSITO: Devuelve las líneas de producción cuya cantidad de recursos es
// estrictamente mayor que la anterior. Incluyendo siempre la primera línea de
// producción como punto de partida.
// PRECONDICIÓN: $lineasDeProduccion no es vacía
// EJEMPLO: lineasEnCrecimiento([1,3,4,2,5,6,8,3,10]) = [1,3,4,5,6,8,10]
?>
