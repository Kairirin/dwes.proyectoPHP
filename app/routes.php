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
$router->post ('videojuegos/nuevo', 'VideojuegosController@nuevoJuego', 'ROLE_ADMIN');
$router->post ('videojuegos/:id/nuevo', 'ReviewController@nueva', 'ROLE_USER');
$router->get ('contacto', 'PagesController@contacto');
$router->get ('login', 'AuthController@login');
$router->post('check-login', 'AuthController@checkLogin');
$router->get ('registro', 'AuthController@registro');
$router->post('check-registro', 'AuthController@checkRegistro');
$router->get ('logout', 'AuthController@logout');