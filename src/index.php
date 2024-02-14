<?php
session_start();
include_once('_config.php');
date_default_timezone_set('Europe/Paris');
MyAutoLoad::start();

// $_SESSION['initD'] = null;

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
        $query2 = $connection->prepare("INSERT INTO tag(nameTag) VALUES('Action');
        INSERT INTO tag(nameTag) VALUES('Comédie');
        INSERT INTO tag(nameTag) VALUES('Horreur');
        INSERT INTO Category(nameCategory) VALUES('Series');
        INSERT INTO Category(nameCategory) VALUES('Films');
        INSERT INTO Category(nameCategory) VALUES('Livres');");
        $query2->execute();
    }
    $_SESSION['initD'] = 0;
}

$request = $_GET['action'] ?? 'home';

$routeur = new router($request);
$routeur->renderController();
