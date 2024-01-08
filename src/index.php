<?php

require_once __DIR__ . '/controllers/homeContoller.php';
require_once __DIR__ . '/controllers/summaryController.php';
require_once __DIR__ . '/controllers/loginController.php';
require_once __DIR__ . '/controllers/registerController.php';

$routes = [
    '/' => ['controller' => 'homeController', 'method' => 'home'],
    '/resume' => ['controller' => 'summaryController', 'method' => 'summary'],
    '/connexion' => ['controller' => 'loginController', 'method' => 'login'],
    '/inscription' => ['controller' => 'registerController', 'method' => 'register'],
];

$request = $_SERVER['REQUEST_URI'];
if (array_key_exists($request, $routes)) {
    $controllerName = $routes[$request]['controller'];
    $methodName = $routes[$request]['method'];

    $controller = new $controllerName();
    $controller->$methodName();
}
