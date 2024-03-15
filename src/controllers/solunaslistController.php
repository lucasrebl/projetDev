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
        echo $this->twig->render('solunaslist/solunaslist.html.twig');
    }
    public function solunasview()
    {
        $IDlist = $_GET["list"] ?? " ";
        $SM = new solunaslistManager();
        $soluna = $SM->selectOneById($IDlist);
        //print_r($soluna);
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
        header("Location: /viewList?list=$list");
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
}
