<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class solunaslistController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function solunaslist()
    {
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        $SM = new solunaslistManager();
        $soluna = $SM->selectAll();
        echo $this->twig->render('solunaslist/solunaslist.html.twig', ["solunas" => $soluna, "User" => $user]);
    }
    public function solunasview()
    {
        $IDlist = $_GET["list"] ?? " ";
        $SM = new solunaslistManager();
        $soluna = $SM->selectOneById($IDlist);
        echo $this->twig->render('solunasview/solunasview.html.twig', ["soluna" => $soluna]);
    }
    public function addList()
    {
        $name = $_POST["name"] ?? " ";
        $SM = new solunaslistManager();
        $SM->addOne($name, $_SESSION["idUser"]);
        header("Location: /profil");
    }

    public function addToList()
    {
        $list = $_GET["list"] ?? " ";
        $work = $_GET["work"] ?? " ";
        $SM = new solunaslistManager();
        $SM->addWorkToList($list, $work);
        // header("Location: /viewList?list=$list");
        header("Location: /profil");
    }

    public function deleteList()
    {
        $id = $_GET["list"] ?? " ";
        $SM = new solunaslistManager();
        $SM->deleteOne($id);
        header("Location: /profil");
    }

    public function deleteFromList()
    {
        $list = $_GET["list"] ?? " ";
        $work = $_GET["work"] ?? " ";
        $SM = new solunaslistManager();
        $SM->deleteWorkFromList($list, $work);
        header("Location: /viewList?list=$list");
    }
    public function setView()
    {
        $list = $_GET["list"] ?? 0;
        $SM = new solunaslistManager();
        $SM->toogleView($list);
        header("Location: /profil");
    }

    public function getByNameJson()
    {
        $name = $_GET["listname"] ?? "";
        $bar = $_GET["bar"] ?? "";
        $SM = new solunaslistManager();
        if ($name != "") {
            $result = json_encode($SM->selectAllByName($name, $bar));
        } else {
            $result = json_encode($SM->selectAll());
        }
        echo $result;
    }

    public function toogleLike()
    {
        $IDlist = $_GET['list'] ?? 0;
        $LFM = new likeFavManager();
        $myLike = $LFM->selectLikebyUserlistID($_SESSION['idUser'], $IDlist);
        if (count($myLike) > 0) {
            $LFM->deleteLike($_SESSION['idUser'], $IDlist);
        } else {
            $LFM->addLike($_SESSION['idUser'], $IDlist);
        }
        $likes = $LFM->selectLikebyListID($IDlist);
        echo json_encode($likes);
    }

    public function toogleFav()
    {
        $IDlist = $_GET['list'] ?? 0;
        $LFM = new likeFavManager();
        $myLike = $LFM->selectFavbyUserlistID($_SESSION['idUser'], $IDlist);
        if (count($myLike) > 0) {
            $LFM->deleteFav($_SESSION['idUser'], $IDlist);
        } else {
            $LFM->addFav($_SESSION['idUser'], $IDlist);
        }
    }

    public function modifName()
    {
        $list = $_GET['list'] ?? 0;
        $name = $_GET['name'] ?? "";
        $SM = new solunaslistManager();
        $SM->modifName($list, $name);
        header("location: /profil");
    }
}
