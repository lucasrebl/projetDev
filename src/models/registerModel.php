<?php

require_once './database/connect.php';

if (!function_exists('addUser')) {
    function addUser($username_, $email_, $hashed_passwordUser, $age_, $pictures)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("SELECT COUNT(*) FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username_);
            $stmt->bindParam(':email', $email_);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                echo "le nom d'utilisateur ou l'email est déja existant";
            } else {
                $stmt2 = $dsn->prepare("INSERT INTO user (username, email, passwordUser, age, pictures) VALUES (:username, :email, :passwordUser, :age, :pictures) ");
                $stmt2->bindParam(':username', $username_);
                $stmt2->bindParam(':email', $email_);
                $stmt2->bindParam(':passwordUser', $hashed_passwordUser);
                $stmt2->bindParam(':age', $age_);
                $stmt2->bindParam(':pictures', $pictures);
                $stmt2->execute();
                header("Location: /connexion");
            }
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }
}
