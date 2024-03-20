<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class profilController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function profil()
    {
        if (empty($_SESSION["idUser"]) || is_null($_SESSION["idUser"])) {
            header("Location: /connexion");
        } else {
            $UM = new userManager();
            $SM = new solunaslistManager();
            $user = $UM->SelectOnebyID($_SESSION["idUser"]);
            $SL = $SM->selectAllByIdUser($_SESSION["idUser"]);
            // print_r(($SL[0]));
            echo $this->twig->render('profil/profil.html.twig', ["User" => $user, "IDuser" => $_SESSION["idUser"], "SLs" => $SL]);
        }
    }
    public function getImage()
    {
        $id = $_GET['id'];
        $img_blob = file_get_contents($_FILES['picture']['tmp_name']);
        $UM = new userManager;
        $UM->UpdateImageById($id, base64_encode($img_blob));
        header("location: /profil");
    }
    public function updateUser()
    {
        $id = $_POST["id"];
        $name = $_POST["name"] ?? "";
        $OP = $_POST["OP"] ?? "";
        $NP = $_POST["NP"] ?? "";
        $UM = new userManager();
        $user = $UM->SelectOnebyID($id);
        if (password_verify($OP, $user->password)) {
            $UM->UpdateUserProfile($id, $name, password_hash($NP, PASSWORD_DEFAULT));
            header("location: /profil");
        } else {
            echo "Mauvais Mot de passe, désolé";
            echo password_hash($NP, PASSWORD_DEFAULT);
        }
    }
}
