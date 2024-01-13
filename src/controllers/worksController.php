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
        $works = $WM->selectAll();
        echo $this->twig->render('works/works.html.twig', ["Works" => $works]);
    }

    public function add(){
        
    }
}
