<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../models/commentManager.php';

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
        $this->addComment();
        $idUser = $_SESSION["idUser"] ?? 0;
        $Workid = $_GET['id'];
        $WM = new worksManager;
        $work = $WM->selectOneById($Workid);
        $FM = new filterManager;
        $categories = $FM->selectAll("Category");
        $tags = $FM->selectAll("tag");
        $SM = new solunaslistManager();
        $list = $SM->selectAllSummary($idUser, $Workid);
        $UM = new userManager();
        if (empty($_SESSION['idUser'])) {
            $user = "";
        } else {
            $user = $UM->SelectOnebyID(($_SESSION['idUser']));
        }
        $CM = new commentsManager();
        $comments = $CM->getCommentsByWorkId($Workid);

        echo $this->twig->render('summary/summary.html.twig', [
            'Work' => $work,
            "Categories" => $categories,
            "Tags" => $tags,
            "SLs" => $list,
            "User" => $user,
            "Comments" => $comments,
            "Message" => $_SESSION['message'] ?? null
        ]);

        unset($_SESSION['message']);
    }

    public function modify()
    {
        // print_r($_POST["category"]);
        $id = $_POST["id"] ?? "";
        $name = $_POST["name"] ?? "";
        $summary = $_POST["summary"] ?? "";
        $episodes = $_POST["episodes"] ?? "";
        $status = $_POST["status"] ?? "";
        $season = $_POST["season"] ?? "";
        $tome = $_POST["tome"] ?? 0;
        $category = $_POST["category"] ?? "";
        $isnsfw = $_POST["isnsfw"] ?? 0;

        if (empty($tome)) {
            $tome = 0;
        }

        $MW = new worksManager();
        $FW = new filterManager();
        $bdd = new database();
        $MW->updateOne($id, $name, $status, $summary, $episodes, $season, $tome, $isnsfw);
        $FW->updateCategory($id, $category);
        $data = $bdd->connect();
        // print_r($_POST["tag" . 3]);
        if (count($_POST) > 8) {
            $data->prepare("DELETE FROM worksTag WHERE idWorks = $id")->execute();
            for ($c = 0; $c < count($_POST) - 8; $c++) {
                //$tag = $_POST["tag" . $c + 1] ?? "";
                if (empty($_POST["tag" . $c + 1])) {
                    // $tag = $_POST["tag" . $c + 1];
                    // $data->prepare("DELETE From worksTag where idWorks = $id")->execute();
                    // print_r($_POST);
                    // $data->prepare("INSERT INTO worksTag(idWorks,idTag) VALUES($id,$tag)")->execute();
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

    public function addComment()
    {
        $idUser = $_POST['idUser'] ?? "";
        $idWork = $_POST['idWork'] ?? "";
        $comment = $_POST['comment'] ?? "";

        if (!empty($idUser) && !empty($idWork) && !empty($comment)) {
            $CM = new commentsManager();
            if (!$CM->isCommentExists($idUser, $idWork, $comment)) {
                $CM->insertComment($idUser, $idWork, $comment);
            } else {
                $_SESSION['message'] = 'vous ne pouvez pas ajouter 2 fois le même commentaires';
            }
        }
    }
}
