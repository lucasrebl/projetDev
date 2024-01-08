<?php

require_once __DIR__ . '/controllers/registerController.php';

$routes = [
    '/inscription' => ['controller' => 'registerController', 'method' => 'register'],
];

$request = $_SERVER['REQUEST_URI'];
if (array_key_exists($request, $routes)) {
    $controllerName = $routes[$request]['controller'];
    $methodName = $routes[$request]['method'];

    $controller = new $controllerName();
    $controller->$methodName();
}
