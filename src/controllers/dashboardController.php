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
            echo $this->twig->render('dashboard/dashboard.html.twig', [
                'userDetails' => $result
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
            updateUser($user_username_select, $user_username_update, $user_email_update, $hashed_password_update, $user_isAdmin_update, $user_age_update);
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
                $hashed_password_add = password_hash($user_password_add, PASSWORD_DEFAULT);
                addUser($user_username_add, $user_email_add, $hashed_password_add, $user_age_add);
                echo "Utilisateur ajouté avec succès!";
            }
        }
        
        // condittion update pictures user
        else if (isset($_POST['update2'])) {
            $user_username_select = $_POST['usernameSelect'];
            if (isset($_FILES["pictures"]) && $_FILES["pictures"]["error"] == UPLOAD_ERR_OK) {
                $user_pictures_update = file_get_contents($_FILES["pictures"]["tmp_name"]);
                updateUserPictures($user_username_select, $user_pictures_update);
            } else {
                echo "Erreur lors du téléchargement de l'image.";
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
}
