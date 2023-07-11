<?php
 /**
 * Clase Filtro que contiene funciones para filtrar un array de objetos por categoría, entrenador y precio.
 */
class Filtro {

    /**
     * Filtra un array de objetos por categoría.
     *
     * @param array $array El array de objetos a filtrar.
     * @param string $filtro El valor por el cual filtrar el array.
     * @return array El array filtrado por categoría.
     */
    public function filtradoPorCategoria(array $array, string $filtro): array {
        if ($filtro !== '') {
            $arrayFiltrado = [];
            foreach ($array as $objeto) {
                if ($objeto->getCategoria() === $filtro) {
                    $arrayFiltrado[] = $objeto;
                }
            }
            return $arrayFiltrado;
        } else {
            return $array;
        }
    }

    /**
     * Filtra un array de objetos por entrenador.
     *
     * @param array $array El array de objetos a filtrar.
     * @param string $filtro El valor por el cual filtrar el array.
     * @return array El array filtrado por entrenador.
     */
    public function filtradoPorEntrenador(array $array, string $filtro): array {
        if ($filtro !== '') {
            $arrayFiltrado = [];
            foreach ($array as $objeto) {
                if ($objeto->getusuarios_fk() === $filtro) {
                    $arrayFiltrado[] = $objeto;
                }
            }
            return $arrayFiltrado;
        } else {
            return $array;
        }
    }

    /**
     * Filtra un array de objetos por precio.
     *
     * @param array $array El array de objetos a filtrar.
     * @param int $minPrecio El valor mínimo del precio por el cual filtrar el array.
     * @param int $maxPrecio El valor máximo del precio por el cual filtrar el array.
     * @return array El array filtrado por precio.
     */
    public function filtradoPorPrecio(array $array, int $minPrecio, int $maxPrecio): array {
        if ($minPrecio !== 0 && $maxPrecio !== PHP_INT_MAX) {//PHP_INT_MAX  representa el valor máximo posible para un número entero (int) en PHP
            $arrayFiltrado = [];
            foreach ($array as $objeto) {
                if ($minPrecio <= $objeto->getPrecio() && $maxPrecio >= $objeto->getPrecio()) {
                    $arrayFiltrado[] = $objeto;
                }
            }
            return $arrayFiltrado;
        } else {
            return $array;
        }
    }
}
