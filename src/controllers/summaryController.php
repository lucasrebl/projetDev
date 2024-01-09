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
        $this->twig = new Environment($this->loader);
    }

    public function summary()
    {
        $Workid = $_GET['id'];
        $WM = new worksManager;
        $work = $WM->selectOneById($Workid);
        echo $this->twig->render('summary/summary.html.twig', ['Work' => $work]);
    }
}
