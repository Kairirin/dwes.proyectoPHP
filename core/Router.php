<?php

namespace proyecto\core;

use proyecto\app\exceptions\AuthenticationException;
use proyecto\app\exceptions\NotFoundException;

class Router
{
    private $routes;

    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []/* ,
            'DELETE' => [] */
        ];
    }
    /**
     * @param string $file
     * @return Router
     */
    public static function load(string $file): Router
    {
        $router = new Router();
        require $file;
        return $router;
    }
    /**
     * @param array $routes
     * @return void
     */
    public function get(string $uri, string $controller, $role = 'ROLE_ANONYMOUS'): void
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }
    public function post(string $uri, string $controller, $role = 'ROLE_ANONYMOUS'): void
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }
/*     public function delete(string $uri, string $controller, $role = 'ROLE_ANONYMOUS'): void
    {
        $this->routes['DELETE'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    } */
    public function direct(string $uri, string $method): void
    {
        // Recorremos las rutas y separamos las dos partes: las rutas y sus controladores respectivamente
        foreach ($this->routes[$method] as $route => $routerData) {
            $controller = $routerData['controller'];
            $minRole = $routerData['role'];
            // Se cambia el contenido de la ruta por una forma que nos vendrá mejor
            $urlRule = $this->prepareRoute($route);
            if (preg_match($urlRule, $uri, $matches) === 1) {
                if (Security::isUserGranted($minRole) === false) {
                    if (!is_null(App::get('appUser'))) // Comprobamos si se está logueado
                        throw new AuthenticationException('Acceso no autorizado');
                    else
                        $this->redirect('login'); // Si el usuario no se ha logueado, redireccionamos al login// Comprobamos si se está logueado
                } else {
                    $parameters = $this->getParametersRoute($route, $matches);
                    // Extraemos el nombre del controlador (nombre de la clase) del nombre del
                    // action (nombre del método a llamar) y los pasamos a 2 variables
                    list($controller, $action) = explode('@', $controller);
                    // Se encarga de crear un objeto de la clase controller y llama al action adecuado
                    if ($this->callAction($controller, $action, $parameters) === true)
                        return;
                }
            }
        }
        throw new NotFoundException("No se ha definido una ruta para la uri solicitada");
    }
    private function prepareRoute(string $route): string
    {
        $urlRule = preg_replace('/:([^\/]+)/', '(?<\1>[^/]+)', $route);
        $urlRule = str_replace('/', '\/', $urlRule);
        return '/^' . $urlRule . '\/*$/s';
    }
    private function getParametersRoute(string $route, array $matches)
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);
        $parameterNames = array_flip($parameterNames[1]);
        return array_intersect_key($matches, $parameterNames);
    }
    /**
     * @param string $controller
     * @param string $action
     * @return void
     * @throws NotFoundException
     * @throws AppException
     */
    private function callAction(string $controller, string $action, array $parameters): bool
    {
        try {
            $controller = App::get('config')['project']['namespace'] . '\\app\\controllers\\' . $controller;
            $objController = new $controller();
            if (!method_exists($objController, $action))
                throw new NotFoundException("El controlador $controller no responde al action $action");
            call_user_func_array(array($objController, $action), $parameters);
            return true;
        } catch (\TypeError $typeError) {
            return false;
        }
    }
    public function redirect(string $path)
    {
        header('location: /' . $path);
        exit();
    }
}
