<?php

require_once './database/connect.php';

if (!function_exists('deleteUser')) {
    function deleteUser($user_username_delete)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM user WHERE username = :username");
            $stmt->bindParam(':username', $user_username_delete);
            if ($stmt->execute()) {
                echo "suppression réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateUser')) {
    function updateUser($user_username_select, $user_username_update, $user_email_update, $hashed_password_update, $user_isAdmin_update, $user_age_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($user_username_update)) {
                $setClauses[] = "username = :username";
            }
            if (!empty($user_email_update)) {
                $setClauses[] = "email = :email";
            }
            if (!empty($hashed_password_update)) {
                $setClauses[] = "passwordUser = :password";
            }
            if (!empty($user_isAdmin_update)) {
                $setClauses[] = "isAdmin = :isAdmin";
            }
            if (!empty($user_age_update)) {
                $setClauses[] = "age = :age";
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE user SET " . implode(', ', $setClauses) . " WHERE username = :usernameSelect";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':usernameSelect', $user_username_select);
            if (!empty($user_username_update)) {
                $stmt->bindParam(':username', $user_username_update);
            }
            if (!empty($user_email_update)) {
                $stmt->bindParam(':email', $user_email_update);
            }
            if (!empty($hashed_password_update)) {
                $stmt->bindParam(':password', $hashed_password_update);
            }
            if (!empty($user_isAdmin_update)) {
                $stmt->bindParam(':isAdmin', $user_isAdmin_update);
            }
            if (!empty($user_age_update)) {
                $stmt->bindParam(':age', $user_age_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addUser')) {
    function addUser($user_username_add, $user_email_add, $hashed_password_add, $user_age_add, $user_image_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("INSERT INTO user (username, email, passwordUser, age, pictures) VALUES (:username, :email, :password, :age, :pictures)");
            $stmt->bindParam(':username', $user_username_add);
            $stmt->bindParam(':email', $user_email_add);
            $stmt->bindParam(':password', $hashed_password_add);
            $stmt->bindParam(':age', $user_age_add);
            $stmt->bindParam(':pictures', $user_image_add, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "ajout réussis";
            } else {
                echo "ajout non réussis";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateUserPictures')) {
    function updateUserPictures($user_username_select, $user_pictures_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("UPDATE user SET pictures = :pictures WHERE username = :usernameSelect");
            $stmt->bindParam(':usernameSelect', $user_username_select);
            $stmt->bindParam(':pictures', $user_pictures_update, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "update réussis";
            } else {
                echo "echec update";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteOeuvres')) {
    function deleteOeuvres($oeuvres_id_delete)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM works WHERE idWorks = :id");
            $stmt->bindParam(':id', $oeuvres_id_delete);
            if ($stmt->execute()) {
                echo "suppression oeuvres réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateOeuvres')) {
    function updateOeuvres($oeuvres_id_select, $oeuvres_nameWorks_update, $oeuvres_status_update, $oeuvres_summary_update, $oeuvres_numberOfEpisodes_update, $oeuvres_numberOfSeason_update, $oeuvres_numberOfTome_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($oeuvres_nameWorks_update)) {
                $setClauses[] = "nameWorks = :nameWorks";
            }
            if (!empty($oeuvres_status_update)) {
                $setClauses[] = "status = :status";
            }
            if (!empty($oeuvres_summary_update)) {
                $setClauses[] = "summary = :summary";
            }
            if (!empty($oeuvres_numberOfEpisodes_update)) {
                $setClauses[] = "numberOfEpisodes = :numberOfEpisodes";
            }
            if (!empty($oeuvres_numberOfSeason_update)) {
                $setClauses[] = "numberOfSeason = :numberOfSeason";
            }
            if (!empty($oeuvres_numberOfTome_update)) {
                $setClauses[] = "numberOfTome = :numberOfTome";
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE works SET " . implode(', ', $setClauses) . " WHERE idWorks = :idWorks ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':idWorks', $oeuvres_id_select);
            if (!empty($oeuvres_id_select)) {
                $stmt->bindParam(':idWorks', $oeuvres_id_select);
            }
            if (!empty($oeuvres_nameWorks_update)) {
                $stmt->bindParam(':nameWorks', $oeuvres_nameWorks_update);
            }
            if (!empty($oeuvres_status_update)) {
                $stmt->bindParam(':status', $oeuvres_status_update);
            }
            if (!empty($oeuvres_summary_update)) {
                $stmt->bindParam(':summary', $oeuvres_summary_update);
            }
            if (!empty($oeuvres_numberOfEpisodes_update)) {
                $stmt->bindParam(':numberOfEpisodes', $oeuvres_numberOfEpisodes_update);
            }
            if (!empty($oeuvres_numberOfSeason_update)) {
                $stmt->bindParam(':numberOfSeason', $oeuvres_numberOfSeason_update);
            }
            if (!empty($oeuvres_numberOfTome_update)) {
                $stmt->bindParam(':numberOfTome', $oeuvres_numberOfTome_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addOeuvres')) {
    function addOeuvres($oeuvres_nameWorks_add, $oeuvres_status_add, $oeuvres_summary_add, $oeuvres_numberOfEpisodes_add, $oeuvres_numberOfSeason_add, $oeuvres_numberOfTome_add, $oeuvres_image_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("INSERT INTO works (nameWorks, status, image, summary, numberOfEpisodes, numberOfSeason, numberOfTome) VALUES (:nameWorks, :status, :image, :summary, :numberOfEpisodes, :numberOfSeason, :numberOfTome)");
            $stmt->bindParam(':nameWorks', $oeuvres_nameWorks_add);
            $stmt->bindParam(':status', $oeuvres_status_add);
            $stmt->bindParam(':summary', $oeuvres_summary_add);
            $stmt->bindParam(':numberOfEpisodes', $oeuvres_numberOfEpisodes_add);
            $stmt->bindParam(':numberOfSeason', $oeuvres_numberOfSeason_add);
            $stmt->bindParam(':numberOfTome', $oeuvres_numberOfTome_add);
            $stmt->bindParam(':image', $oeuvres_image_add, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "ajout réussis";
            } else {
                echo "ajout non réussis";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateOeuvresImage')) {
    function updateOeuvresImage($oeuvres_id_select, $oeuvres_image_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("UPDATE works SET image = :image WHERE idWorks = :idWorks");
            $stmt->bindParam(':idWorks', $oeuvres_id_select);
            $stmt->bindParam(':image', $oeuvres_image_update, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "update image réussis";
            } else {
                echo "echec update";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}