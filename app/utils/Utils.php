<?php
/* namespace proyecto\app\utils; */
require_once __DIR__ . "/../entity/Juego.php";

class Utils
{
    public static function esOpcionMenuActiva($opcion): bool
    {
        $actual = explode('/', $_SERVER['REQUEST_URI']);
        $actual = '/' . $actual[count($actual) - 1];
        if ($actual === $opcion) {
            return true;
        } else {
            return false;
        }
    }


    public static function extraerUnElemento($lista): ?array
    {
        if (sizeof($lista) == 0) return null;
        else {
            shuffle($lista);
            $listaNueva = array_slice($lista, 0, 1);
            return $listaNueva;
        }
    }

    public static function extraerElementosAleatorios($lista, $cantidad): ?array
    {
        if ($cantidad < 1 || sizeof($lista) == 0) return null;
        else {
            shuffle($lista);
            $listaNueva = array_chunk($lista, $cantidad);
            return $listaNueva[0];
        }
    }

    public static function extraerTopFive($lista): ?array 
    {
        if (sizeof($lista) < 1 ) return null;
        else 
        {
            uasort($lista, 'funcionOrdenar');
            return $lista;
        }
    }

    private function funcionOrdenar(Juego $j1, Juego $j2) {
        if ($j1->getNumRevs() == $j2->getNumRevs()) {
            return 0;
        }
        return ($j1->getNumRevs() < $j2->getNumRevs()) ? -1 : 1;
    }
}
