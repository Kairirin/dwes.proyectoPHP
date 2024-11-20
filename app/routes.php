<?php
$router->get ('', 'app/controllers/index.php');
$router->get ('index', 'app/controllers/index.php');
$router->get ('about', 'app/controllers/about.php');
$router->get ('videojuegos', 'app/controllers/videojuegos.php');
$router->get ('playstation', 'app/controllers/videojuegos.php');
$router->get ('xbox', 'app/controllers/videojuegos.php');
$router->get ('nintendo', 'app/controllers/videojuegos.php');
$router->get ('retro', 'app/controllers/videojuegos.php');
$router->post ('videojuegos/nuevo', 'app/controllers/videojuego-nuevo.php');
$router->get ('contacto', 'app/controllers/contacto.php');