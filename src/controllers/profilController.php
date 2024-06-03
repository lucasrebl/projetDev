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
        $this->twig = $twig = new \Twig\Environment($this->loader, [
            'debug' => true,
            // ...✅❌
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());;
    }

    public function profil()
    {
        if (empty($_SESSION["idUser"]) || is_null($_SESSION["idUser"])) {
            header("Location: /connexion");
        } else {
            $UM = new userManager();
            if (empty($_SESSION['idUser'])) {
                $user1 = "";
            } else {
                $user1 = $UM->SelectOnebyID(($_SESSION['idUser']));
            }
            $SM = new solunaslistManager();
            $SM2 = new subcriberManager();
            $user = $UM->SelectOnebyID($_SESSION["idUser"]);
            $SL = $SM->selectAllByIdUser($_SESSION["idUser"]);
            $SLl = $SM->selectAllByLikeIdUser($_SESSION["idUser"]);
            $SLf = $SM->selectAllByFavIdUser($_SESSION["idUser"]);
            $followers = $SM2->SelectAllbySubscriber($_SESSION["idUser"]);
            $following = $SM2->SelectAllbyUser($_SESSION["idUser"]);
            // print_r($followers);
            echo $this->twig->render('profil/profil.html.twig', ["User1" => $user, "User" => $user1, "IDuser" => $_SESSION["idUser"], "SLs" => $SL, "SLl" => $SLl, "SLf" => $SLf, "FW1" => $followers, "FW2" => $following]);
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
    public function showProfil()
    {
        // header("location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user1 = "";
            $sus = 0;
        } else {
            $user1 = $UM->SelectOnebyID(($_SESSION['idUser']));
            $sus = $user1->ID;
        }
        $id = $_GET['id'] ?? 0;
        $SM = new solunaslistManager();
        $SM2 = new subcriberManager();
        $user = $UM->SelectOnebyID($id);
        $SL = $SM->selectAllByIdUser($id);
        $SLl = $SM->selectAllByLikeIdUser($id);
        $SLf = $SM->selectAllByFavIdUser($id);
        $linkp = $SM2->SelectOne($sus, $id);
        $followers = $SM2->SelectAllbySubscriber($id);
        $following = $SM2->SelectAllbyUser($id);
        echo $this->twig->render('profil/profil.html.twig', ["User1" => $user, "User" => $user1, "IDuser" => $_SESSION["idUser"], "SLs" => $SL, "SLl" => $SLl, "SLf" => $SLf, "linkP" => $linkp, "FW1" => $followers, "FW2" => $following]);
    }

    public function toogleSub()
    {
        $userid = $_GET['user'];
        $subid = $_GET['sub'];
        $SM = new subcriberManager();
        $sub = $SM->SelectOne($userid, $subid) ?? "";
        if (empty($sub)) {
            $SM->addSub($userid, $subid);
        } else {
            $SM->removeSub($userid, $subid);
        }
    }
}
