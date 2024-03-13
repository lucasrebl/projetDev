<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class registerController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function register()
    {

        if (isset($_POST['submit'])) {
            $username_ = $_POST['username'];
            $email_ = $_POST['email'];
            $passwordUser_ = $_POST['passwordUser'];
            $age_ = $_POST['age'];

            $hashed_passwordUser = password_hash($passwordUser_, PASSWORD_DEFAULT);

            include __DIR__ . '/../models/registerModel.php';
            addUser($username_, $email_, $hashed_passwordUser, $age_);
        } else {
            $UM = new userManager();
            if (empty($_SESSION['idUser'])) {
                $user = "";
            } else {
                $user = $UM->SelectOnebyID(($_SESSION['idUser']));
            }
            echo $this->twig->render('register/register.html.twig', ["User" => $user]);
        }
    }
}
