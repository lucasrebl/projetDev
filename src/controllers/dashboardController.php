<?php

require 'vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class dashboardController
{
    protected $twig;
    protected $loader;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../views/templates');
        $this->twig = new Environment($this->loader);
    }

    public function dashboard()
    {
        session_start();
        var_dump($_SESSION);
        $user = [
            'isAdmin' => $_SESSION['isAdmin']
        ];
        if ($user['isAdmin'] != 1) {
            echo '<script>window.location.replace("/");</script>';
        } else {
            include __DIR__ . '/../models/dashboardModel.php';
            $this->crudUser();
            $result = $this->readUser();
            $this->crudOeuvres();
            $result2 = $this->readOeuvres();
            $this->crudTag();
            $result3 = $this->readTag();
            echo $this->twig->render('dashboard/dashboard.html.twig', [
                'userDetails' => $result,
                'oeuvresDetails' => $result2,
                'tagDetails' => $result3
            ]);
        }
    }

    public function crudUser()
    {
        // condition delete user
        if (isset($_POST['delete'])) {
            $user_username_delete = $_POST['username'];
            deleteUser($user_username_delete);
        }
        // condition update user
        else if (isset($_POST['update'])) {
            $user_username_select = $_POST['usernameSelect'];
            $user_username_update = $_POST['username'];
            $user_email_update = $_POST['email'];
            $user_password_update = $_POST['password'];
            $user_isAdmin_update = $_POST['isAdmin'];
            $user_age_update = $_POST['age'];
            $hashed_password_update = !empty($user_password_update) ? password_hash($user_password_update, PASSWORD_DEFAULT) : null;
            if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] == UPLOAD_ERR_OK) {
                $user_pictures_update = file_get_contents($_FILES["pictures"]["tmp_name"]);
                updateUser($user_username_select, $user_username_update, $user_email_update, $hashed_password_update, $user_isAdmin_update, $user_age_update, $user_pictures_update);
            } else {
                updateUser($user_username_select, $user_username_update, $user_email_update, $hashed_password_update, $user_isAdmin_update, $user_age_update);
            }
        }
        // condition add user
        if (isset($_POST['submit'])) {
            $user_username_add = $_POST['username'];
            $user_email_add = $_POST['email'];
            $user_password_add = $_POST['password'];
            $user_age_add = $_POST['age'];
            if (empty($user_username_add) || empty($user_email_add) || empty($user_password_add) || empty($user_age_add)) {
                echo "Veuillez remplir les champs suivant: username, email, password, age";
            } else {
                if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] == UPLOAD_ERR_OK) {
                    $user_image_add = file_get_contents($_FILES["pictures"]["tmp_name"]);
                    $hashed_password_add = password_hash($user_password_add, PASSWORD_DEFAULT);
                    addUser($user_username_add, $user_email_add, $hashed_password_add, $user_age_add, $user_image_add);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            }
        }
    }

    public function readUser()
    {
        $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dsn->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as &$user) {
            if ($user['pictures'] !== null) {
                $user['pictures'] = base64_encode($user['pictures']);
            } else {
                $user['pictures'] = '';
            }
        }
        return $result;
    }

    public function crudOeuvres()
    {
        // conditions delete oeuvres
        if (isset($_POST['delete2'])) {
            $oeuvres_id_delete = $_POST['idSelect'];
            deleteOeuvres($oeuvres_id_delete);
        }
        // conditions update oeuvres
        else if (isset($_POST['update2'])) {
            $oeuvres_id_select = $_POST['idSelect'];
            $oeuvres_nameWorks_update = $_POST['nameWorks'];
            $oeuvres_status_update = $_POST['status'];
            $oeuvres_summary_update = $_POST['summary'];
            $oeuvres_numberOfEpisodes_update = $_POST['numberOfEpisodes'];
            $oeuvres_numberOfSeason_update = $_POST['numberOfSeason'];
            $oeuvres_numberOfTome_update = $_POST['numberOfTome'];
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                $oeuvres_image_update = file_get_contents($_FILES["image"]["tmp_name"]);
                updateOeuvres($oeuvres_id_select, $oeuvres_nameWorks_update, $oeuvres_status_update, $oeuvres_summary_update, $oeuvres_numberOfEpisodes_update, $oeuvres_numberOfSeason_update, $oeuvres_numberOfTome_update, $oeuvres_image_update);
            } else {
                updateOeuvres($oeuvres_id_select, $oeuvres_nameWorks_update, $oeuvres_status_update, $oeuvres_summary_update, $oeuvres_numberOfEpisodes_update, $oeuvres_numberOfSeason_update, $oeuvres_numberOfTome_update);
            }
        }
        // conditions add oeuvres
        if (isset($_POST['submit2'])) {
            $oeuvres_nameWorks_add = $_POST['nameWorks'];
            $oeuvres_status_add = $_POST['status'];
            $oeuvres_summary_add = $_POST['summary'];
            $oeuvres_numberOfEpisodes_add = $_POST['numberOfEpisodes'];
            $oeuvres_numberOfSeason_add = $_POST['numberOfSeason'];
            $oeuvres_numberOfTome_add = $_POST['numberOfTome'];
            if (empty($oeuvres_nameWorks_add) || empty($oeuvres_status_add) || empty($oeuvres_summary_add) || empty($oeuvres_numberOfEpisodes_add) || empty($oeuvres_numberOfSeason_add) || empty($oeuvres_numberOfTome_add)) {
                echo "Tous les champs doivent être remplis.";
            } else {
                if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                    $oeuvres_image_add = file_get_contents($_FILES["image"]["tmp_name"]);
                    addOeuvres($oeuvres_nameWorks_add, $oeuvres_status_add, $oeuvres_summary_add, $oeuvres_numberOfEpisodes_add, $oeuvres_numberOfSeason_add, $oeuvres_numberOfTome_add, $oeuvres_image_add);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            }
        }
    }

    public function readOeuvres()
    {
        $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dsn->prepare("SELECT * FROM works");
        $stmt->execute();
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result2 as &$user) {
            if ($user['image'] !== null) {
                $user['image'] = base64_encode($user['image']);
            } else {
                $user['image'] = '';
            }
        }
        return $result2;
    }

    public function crudTag()
    {
        // conditions delete tag
        if (isset($_POST['delete3'])) {
            $tag_name_select = $_POST['nameTagSelect'];
            deleteTag($tag_name_select);
        }
        // conditions update tag
        if (isset($_POST['update3'])) {
            $tag_name_select = $_POST['nameTagSelect'];
            $tag_nameTag_update = $_POST['nameTag'];
            if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] == UPLOAD_ERR_OK) {
                $tag_image_update = file_get_contents($_FILES["pictures"]["tmp_name"]);
                updateTag($tag_name_select, $tag_nameTag_update, $tag_image_update);
            } else {
                updateTag($tag_name_select, $tag_nameTag_update);
            }
        }
        // conditions add tag
        if (isset($_POST['submit3'])) {
            $tag_name_add = $_POST['nameTag'];
            if (empty($tag_name_add)) {
                echo "Tous les champs doivent être remplis.";
            } else {
                if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] == UPLOAD_ERR_OK) {
                    $tag_image_add = file_get_contents($_FILES["pictures"]["tmp_name"]);
                    addTag($tag_name_add, $tag_image_add);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            }
        }
    }

    public function readTag()
    {
        $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dsn->prepare("SELECT * FROM tag");
        $stmt->execute();
        $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result3 as &$user) {
            if ($user['pictures'] !== null) {
                $user['pictures'] = base64_encode($user['pictures']);
            } else {
                $user['pictures'] = '';
            }
        }
        return $result3;
    }
}
