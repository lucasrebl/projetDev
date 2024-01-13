<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class worksController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function works()
    {
        $WM = new worksManager();
        $FM = new filterManager();
        $works = $WM->selectAll();
        $categories = $FM->selectAll("Category");
        $tags = $FM->selectAll("tag");
        echo $this->twig->render('works/works.html.twig', ["Works" => $works, "Categories" => $categories, "Tags" => $tags]);
    }

    public function add(){
        $name = $_POST["name"] ?? "";
        $summary = $_POST["summary"] ?? "";
        $episodes = $_POST["episodes"] ?? 0;
        $status = $_POST["status"] ?? "";
        $season = $_POST["season"] ?? 0;
        $tome = $_POST["tome"] ?? 0;
        $category = $_POST["category"] ?? "";
        if(empty($tome)){
            $tome = 0;
        }

        $MW = new worksManager();
        $FW = new filterManager();
        $bdd = new database();
        $MW->addOneM($name,$status,$summary,$episodes,$season,$tome);
        $Works = count($MW->selectAll());
        $FW->addCategory($Works, $category);
        $data = $bdd->connect();
        if(count($_POST) > 7){
            // $data->prepare("DELETE FROM worksTag WHERE idWorks = $id")->execute();
            for($c = 0; $c < count($_POST) - 7; $c++){
                $tag = $_POST["tag" . $c + 1] ?? "";
                $data->prepare("INSERT INTO worksTag(idWorks,idTag) VALUES($Works,$tag)")->execute();
            }
        }
        header("Location: /oeuvres");
    }

    public function filters(){
        var_dump($_POST);
    }

}
