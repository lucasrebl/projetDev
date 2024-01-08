<?php

require_once __DIR__ . '/controllers/homeContoller.php';
require_once __DIR__ . '/controllers/summaryController.php';
require_once __DIR__ . '/controllers/loginController.php';
require_once __DIR__ . '/controllers/registerController.php';
require_once __DIR__ . '/controllers/dashboardController.php';
require_once __DIR__ . '/controllers/worksController.php';
require_once __DIR__ . '/controllers/profilController.php';
require_once __DIR__ . '/controllers/recommendedController.php';

$routes = [
    '/' => ['controller' => 'homeController', 'method' => 'home'],
    '/resume' => ['controller' => 'summaryController', 'method' => 'summary'],
    '/connexion' => ['controller' => 'loginController', 'method' => 'login'],
    '/inscription' => ['controller' => 'registerController', 'method' => 'register'],
    '/panelAdmin' => ['controller' => 'dashboardController', 'method' => 'dashboard'],
    '/oeuvres' => ['controller' => 'worksController', 'method' => 'works'],
    '/profil' => ['controller' => 'profilController', 'method' => 'profil'],
    '/recommande' => ['controller' => 'recommendedController', 'method' => 'recommended'],
];

$request = $_SERVER['REQUEST_URI'];
if (array_key_exists($request, $routes)) {
    $controllerName = $routes[$request]['controller'];
    $methodName = $routes[$request]['method'];

    $controller = new $controllerName();
    $controller->$methodName();
}
