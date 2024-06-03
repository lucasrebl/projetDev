<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class homeController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function home()
    {
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        echo $this->twig->render('home/home.html.twig', ["User" => $user]);
    }
}
