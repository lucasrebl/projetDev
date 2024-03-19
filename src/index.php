<?php
session_start();
include_once('_config.php');
date_default_timezone_set('Europe/Paris');
MyAutoLoad::start();

if (empty($_SESSION['initD'])) {
    $_SESSION['initD'] = null;
}

if ($_SESSION['initD'] == null) {
    $database = new database();
    $database->createDatabase();
    $connection = $database->connect();
    $query = $connection->prepare("SELECT * FROM Category");
    $query->execute();
    if ($query->rowCount() <= 0) {
        $database->init();
    }
    $_SESSION['initD'] = 0;
}

$request = $_GET['action'] ?? 'home';

$routeur = new router($request);
$routeur->renderController();
