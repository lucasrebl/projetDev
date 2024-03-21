<?php
class router
{
    private $request;
    private $routes = [
        'home' => ['controller' => 'homeController', 'method' => 'home'],
        'resume' => ['controller' => 'summaryController', 'method' => 'summary'],
        'connexion' => ['controller' => 'loginController', 'method' => 'login'],
        'inscription' => ['controller' => 'registerController', 'method' => 'register'],
        'panelAdmin' => ['controller' => 'dashboardController', 'method' => 'dashboard'],
        'oeuvres' => ['controller' => 'worksController', 'method' => 'works'],
        'profil' => ['controller' => 'profilController', 'method' => 'profil'],
        'recommande' => ['controller' => 'recommendedController', 'method' => 'recommended'],
        'solunasList' => ['controller' => 'solunaslistController', 'method' => 'solunaslist'],
        'viewList' => ['controller' => 'solunaslistController', 'method' => 'solunasview'],
        'deconnexion' => ['controller' => 'logOutController', 'method' => 'logOut'],
        'mWork' => ['controller' => 'summaryController', 'method' => 'modify'],
        'getImage' => ['controller' => 'summaryController', 'method' => 'getImage'],
        'aWork' => ['controller' => 'worksController', 'method' => 'add'],
        'getUserImage' => ['controller' => 'profilController', 'method' => 'getImage'],
        'mUser' => ['controller' => 'profilController', 'method' => 'updateUser'],
        'addList' => ['controller' => 'solunaslistController', 'method' => 'addList'],
        'deleteList' => ['controller' => 'solunaslistController', 'method' => 'deleteList'],
        'addToList' => ['controller' => 'solunaslistController', 'method' => 'addToList'],
        'deleteFromList' => ['controller' => 'solunaslistController', 'method' => 'deleteFromList'],
        'tview' => ['controller' => 'solunaslistController', 'method' => 'setView'],
        'getJSOName' => ['controller' => 'solunaslistController', 'method' => 'getByNameJson'],
    ];
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function renderController()
    {
        $request = $this->request;
        if (key_exists($request, $this->routes)) {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];
            $currentController = new $controller();
            $currentController->$method();
        } else {
            // include(CONTROLLER.'404Controller.php');
        }
    }
}
