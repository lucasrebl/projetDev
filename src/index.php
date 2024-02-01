<?php
session_start();
include_once('_config.php');
date_default_timezone_set('Europe/Paris');
MyAutoLoad::start();

// $_SESSION['initD'] = null;

if (empty($_SESSION['initD'])){
    $_SESSION['initD'] = null;
}

if ($_SESSION['initD'] == null){
    $database = new database();
    $database->createDatabase();
    $_SESSION['initD'] = 0;
}

$request = $_GET['action'] ?? 'home';

$routeur = new router($request);
$routeur->renderController();