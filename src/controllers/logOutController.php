<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class logOutController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function logOut()
    {
        $_SESSION['idUser'] = null;
        $_SESSION['username'] = null;
        $_SESSION['email'] = null;
        $_SESSION['passwordUser'] = null;
        $_SESSION['age'] = null;
        $_SESSION['isAdmin'] = null;
        header("location: /home");
    }
}
