<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class summaryController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader, [
            'debug' => true,
            // ...
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function summary()
    {

        $idUser = $_SESSION["idUser"] ?? 0;
        $Workid = $_GET['id'];
        $WM = new worksManager;
        $work = $WM->selectOneById($Workid);
        $FM = new filterManager;
        $categories = $FM->selectAll("Category");
        $tags = $FM->selectAll("tag");
        $SM = new solunaslistManager();
        $list = $SM->selectAllByIdUser($idUser);
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        echo $this->twig->render('summary/summary.html.twig', ['Work' => $work, "Categories" => $categories, "Tags" => $tags, "SLs" => $list, "User" => $user]);
    }

    public function modify()
    {
        $id = $_POST["id"] ?? "";
        $name = $_POST["name"] ?? "";
        $summary = $_POST["summary"] ?? "";
        $episodes = $_POST["episodes"] ?? "";
        $status = $_POST["status"] ?? "";
        $season = $_POST["season"] ?? "";
        $tome = $_POST["tome"] ?? 0;
        $category = $_POST["category"] ?? "";

        if (empty($tome)) {
            $tome = 0;
        }

        $MW = new worksManager();
        $FW = new filterManager();
        $bdd = new database();
        $MW->updateOne($id, $name, $status, $summary, $episodes, $season, $tome);
        $FW->updateCategory($id, $category);
        $data = $bdd->connect();
        // print_r($_POST["tag" . 3]);
        if (count($_POST) > 8) {
            $data->prepare("DELETE FROM worksTag WHERE idWorks = $id")->execute();
            for ($c = 0; $c < count($_POST) - 8; $c++) {
                //$tag = $_POST["tag" . $c + 1] ?? "";
                if (empty($_POST["tag" . $c + 1])) {
                    $tag = "";
                    $data->prepare("DELETE From worksTag where idWorks == $id")->execute();
                } else {
                    $tag = $_POST["tag" . $c + 1];
                    $data->prepare("INSERT INTO worksTag(idWorks,idTag) VALUES($id,$tag)")->execute();
                }
            }
        }
        header("location: /resume?id=$id");
    }

    public function getImage()
    {
        $id = $_GET['id'];
        $img_blob = file_get_contents($_FILES['picture']['tmp_name']);
        $WM = new worksManager;
        $WM->UpdateImageById($id, base64_encode($img_blob));
        header("location: /resume?id=$id");
    }
}
