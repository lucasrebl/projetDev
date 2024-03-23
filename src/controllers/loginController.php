<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class loginController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function login()
    {
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        echo $this->twig->render('login/login.html.twig', ["User" => $user]);
        if (isset($_POST['submit'])) {
            $username_ = $_POST['username'];
            $passwordUser_ = $_POST['passwordUser'];
            echo $passwordUser_ . "; ";
            if (empty($username_) || empty($passwordUser_)) {
                echo "veuiller remplir tous les champs";
            }

            include __DIR__ . '/../models/loginModel.php';
            logUSer($username_, $passwordUser_);
        }
    }

    public function myUser()
    {
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        echo json_encode($user);
    }
}
