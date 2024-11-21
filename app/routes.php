<?php
$router->get ('', 'PagesController@index');
$router->get ('index', 'PagesController@index');
$router->get ('about', 'PagesController@about');
$router->get ('videojuegos', 'VideojuegosController@index');
$router->get ('playstation', 'VideojuegosController@filter');
$router->get ('xbox', 'VideojuegosController@filter');
$router->get ('nintendo', 'VideojuegosController@filter');
$router->get ('retro', 'VideojuegosController@filter');
$router->get ('videojuegos/:id', 'VideojuegosController@show');
$router->post ('videojuegos/nuevo', 'VideojuegosController@nuevoJuego');
$router->get ('contacto', 'PagesController@contacto');