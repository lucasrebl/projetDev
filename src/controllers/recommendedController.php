<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class recommendedController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function recommended()
    {
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        $SM2 = new subcriberManager();
        $following = $SM2->SelectAllbyUser($_SESSION["idUser"]);
        $SM = new solunaslistManager();
        if ($following != null) {
            foreach ($following as $follow) {
                $LS[] = $SM->selectAllByIdUser($follow->SubcriberID);
            }
        } else {
            $LS[] = null;
        }
        // print_r($LS);
        echo $this->twig->render('recommended/recommended.html.twig', ["User" => $user, "solunas" => $LS]);
    }
}
