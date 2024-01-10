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
        $Workid = $_GET['id'];
        $WM = new worksManager;
        $work = $WM->selectOneById($Workid);
        $CM = new categoryManager;
        $categories = $CM->selectAll();
        $TM = new tagManager;
        $tags = $TM->selectAll();
        // var_dump($work->Tags[0]->id);
        echo $this->twig->render('summary/summary.html.twig', ['Work' => $work, "Categories" => $categories, "Tags" => $tags]);
    }

    public function modify(){
        $image = $_POST['picture'];
        $image = new Imagick();
        var_dump($image);
        echo $image;
    }
}
