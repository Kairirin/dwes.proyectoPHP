<?php
namespace proyecto\app\controllers;

use proyecto\core\App;
use proyecto\core\Response;

class PageController 
{
    public function index() 
    {
        $imagenesIndice = ["imagen1.png", "imagen2.png", "imagen3.png"];

        /* require __DIR__ . '/../views/index.view.php'; */
        Response::renderView(
            'index',
            'layout',
            compact('imagenesIndice', 'logoIndice')
        );
    }
    public function about()
    {
        Response::renderView(
            'about',
            'layout',
            compact('')
        );
    }
}