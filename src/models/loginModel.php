<?php

require_once './database/connect.php';

if (!function_exists('logUSer')) {
    function logUSer($username_, $passwordUser_)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("SELECT * FROM user WHERE username =:username");
            $stmt->bindParam(':username', $username_);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($passwordUser_, $user['passwordUser'])) {
                $_SESSION['idUser'] = $user['idUser'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['passwordUser'] = $user['passwordUser'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['isAdmin'] = $user['isAdmin'];

                echo '<script>window.location.replace("/resume");</script>';
            } else {
                echo "mot de passe incorrect";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}
