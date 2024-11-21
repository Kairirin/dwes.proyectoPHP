<?php
namespace proyecto\core;

class Request
{
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'); //Devuelve el path de la url, lo usaré para hacer el filter de videojuegos
    }
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
