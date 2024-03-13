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
    function updateUser($user_username_select, $user_username_update, $user_email_update, $hashed_password_update, $user_isAdmin_update, $user_age_update, $user_pictures_update = null)
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
            if (!is_null($user_pictures_update)) {
                $setClauses[] = "pictures = :pictures";
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
            if (!is_null($user_pictures_update)) {
                $stmt->bindParam(':pictures', $user_pictures_update, PDO::PARAM_LOB);
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
    function updateOeuvres($oeuvres_id_select, $oeuvres_nameWorks_update, $oeuvres_status_update, $oeuvres_summary_update, $oeuvres_numberOfEpisodes_update, $oeuvres_numberOfSeason_update, $oeuvres_numberOfTome_update, $oeuvres_image_update = null)
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
            if (!is_null($oeuvres_image_update)) {
                $setClauses[] = "image = :image";
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
            if (!is_null($oeuvres_image_update)) {
                $stmt->bindParam(':image', $oeuvres_image_update, PDO::PARAM_LOB);
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

if (!function_exists('deleteTag')) {
    function deleteTag($tag_name_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM tag WHERE nameTag = :name");
            $stmt->bindParam(':name', $tag_name_select);
            if ($stmt->execute()) {
                echo "suppression tag réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateTag')) {
    function updateTag($tag_name_select, $tag_nameTag_update,  $tag_image_update = null)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($tag_nameTag_update)) {
                $setClauses[] = "nameTag = :nameTag";
            }
            if (!is_null($tag_image_update)) {
                $setClauses[] = "pictures = :pictures";
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE tag SET " . implode(', ', $setClauses) . " WHERE nameTag = :nameTagSelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':nameTagSelect', $tag_name_select);
            if (!empty($tag_name_select)) {
                $stmt->bindParam(':nameTagSelect', $tag_name_select);
            }
            if (!empty($tag_nameTag_update)) {
                $stmt->bindParam(':nameTag', $tag_nameTag_update);
            }
            if (!is_null($tag_image_update)) {
                $stmt->bindParam(':pictures', $tag_image_update, PDO::PARAM_LOB);
            }

            if ($stmt->execute()) {
                echo "Mise à jour tag réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addTag')) {
    function addTag($tag_name_add, $tag_image_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("INSERT INTO tag (nameTag, pictures) VALUES (:nameTag, :pictures)");
            $stmt->bindParam(':nameTag', $tag_name_add);
            $stmt->bindParam(':pictures', $tag_image_add, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "ajout tag réussis";
            } else {
                echo "ajout non réussis";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteCategory')) {
    function deleteCategory($category_name_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM Category WHERE nameCategory = :name");
            $stmt->bindParam(':name', $category_name_select);
            if ($stmt->execute()) {
                echo "suppression Category réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateCategory')) {
    function updateCategory($category_name_select, $category_name_update,  $category_image_update = null)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($category_name_update)) {
                $setClauses[] = "nameCategory = :nameCategory";
            }
            if (!is_null($category_image_update)) {
                $setClauses[] = "pictures = :pictures";
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE Category SET " . implode(', ', $setClauses) . " WHERE nameCategory = :nameCategorySelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':nameCategorySelect', $category_name_select);
            if (!empty($category_name_select)) {
                $stmt->bindParam(':nameCategorySelect', $category_name_select);
            }
            if (!empty($category_name_update)) {
                $stmt->bindParam(':nameCategory', $category_name_update);
            }
            if (!is_null($category_image_update)) {
                $stmt->bindParam(':pictures', $category_image_update, PDO::PARAM_LOB);
            }

            if ($stmt->execute()) {
                echo "Mise à jour Category réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addCategory')) {
    function addCategory($category_name_add, $category_image_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("INSERT INTO Category (nameCategory, pictures) VALUES (:nameCategory, :pictures)");
            $stmt->bindParam(':nameCategory', $category_name_add);
            $stmt->bindParam(':pictures', $category_image_add, PDO::PARAM_LOB);
            if ($stmt->execute()) {
                echo "ajout Category réussis";
            } else {
                echo "ajout non réussis";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteList')) {
    function deleteList($list_id_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM list WHERE idList = :id");
            $stmt->bindParam(':id', $list_id_select);
            if ($stmt->execute()) {
                echo "suppression list réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateList')) {
    function updateList($list_id_select, $list_nameList_update,  $list_idUser_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($list_nameList_update)) {
                $setClauses[] = "nameList = :nameList";
            }

            if (!empty($list_idUser_update)) {
                $checkUserQuery = "SELECT COUNT(*) FROM user WHERE idUser = :idUser";
                $checkUserStmt = $dsn->prepare($checkUserQuery);
                $checkUserStmt->bindParam(':idUser', $list_idUser_update);
                $checkUserStmt->execute();

                if ($checkUserStmt->fetchColumn() > 0) {
                    $setClauses[] = "idUser = :idUser";
                } else {
                    echo "L'utilisateur avec l'ID $list_idUser_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE list SET " . implode(', ', $setClauses) . " WHERE idList = :idListSelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':idListSelect', $list_id_select);
            if (!empty($list_id_select)) {
                $stmt->bindParam(':idListSelect', $list_id_select);
            }
            if (!empty($list_nameList_update)) {
                $stmt->bindParam(':nameList', $list_nameList_update);
            }
            if (!empty($list_idUser_update)) {
                $stmt->bindParam(':idUser', $list_idUser_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour list réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}


if (!function_exists('addList')) {
    function addList($list_name_add, $list_idUser_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $checkUserQuery = $dsn->prepare("SELECT * FROM user WHERE idUser = :idUser");
            $checkUserQuery->bindParam(':idUser', $list_idUser_add);
            $checkUserQuery->execute();

            if ($checkUserQuery->rowCount() > 0) {
                $insertListQuery = $dsn->prepare("INSERT INTO list (nameList, idUser) VALUES (:nameList, :idUser)");
                $insertListQuery->bindParam(':nameList', $list_name_add);
                $insertListQuery->bindParam(':idUser', $list_idUser_add);

                if ($insertListQuery->execute()) {
                    echo "Liste insérée avec succès";
                } else {
                    echo "Erreur lors de l'insertion de la liste";
                }
            } else {
                echo "L'utilisateur avec l'ID $list_idUser_add n'existe pas dans la table user.";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteWorksCategory')) {
    function deleteWorksCategory($worksCategory_id_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM worksCategory WHERE id = :id");
            $stmt->bindParam(':id', $worksCategory_id_select);
            if ($stmt->execute()) {
                echo "suppression worksCategory réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateWorksCategory')) {
    function updateWorksCategory($worksCategory_id_select, $worksCategory_idWorks_update,  $worksCategory_idCategory_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($worksCategory_idWorks_update)) {
                $checkWorksQuery = "SELECT COUNT(*) FROM works WHERE idWorks = :idWorks";
                $checkWorksStmt = $dsn->prepare($checkWorksQuery);
                $checkWorksStmt->bindParam(':idWorks', $worksCategory_idWorks_update);
                $checkWorksStmt->execute();

                if ($checkWorksStmt->fetchColumn() > 0) {
                    $setClauses[] = "idWorks = :idWorks";
                } else {
                    echo "L'oeuvres avec l'ID $worksCategory_idWorks_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (!empty($worksCategory_idCategory_update)) {
                $checkCategoryQuery = "SELECT COUNT(*) FROM Category WHERE idCategory = :idCategory";
                $checkCategoryStmt = $dsn->prepare($checkCategoryQuery);
                $checkCategoryStmt->bindParam(':idCategory', $worksCategory_idCategory_update);
                $checkCategoryStmt->execute();

                if ($checkCategoryStmt->fetchColumn() > 0) {
                    $setClauses[] = "idCategory = :idCategory";
                } else {
                    echo "La category avec l'ID $worksCategory_idCategory_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE worksCategory SET " . implode(', ', $setClauses) . " WHERE id = :idWorksCategorySelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':idWorksCategorySelect', $worksCategory_id_select);
            if (!empty($worksCategory_id_select)) {
                $stmt->bindParam(':idWorksCategorySelect', $worksCategory_id_select);
            }
            if (!empty($worksCategory_idWorks_update)) {
                $stmt->bindParam(':idWorks', $worksCategory_idWorks_update);
            }
            if (!empty($worksCategory_idCategory_update)) {
                $stmt->bindParam(':idCategory', $worksCategory_idCategory_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour worksCategory réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addWorksCategory')) {
    function addWorksCategory($worksCategory_idWorks_add, $worksCategory_idCategory_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $checkWorksQuery = $dsn->prepare("SELECT * FROM works WHERE idWorks = :idWorks");
            $checkWorksQuery->bindParam(':idWorks', $worksCategory_idWorks_add);
            $checkWorksQuery->execute();

            $checkCategoryQuery = $dsn->prepare("SELECT * FROM Category WHERE idCategory = :idCategory");
            $checkCategoryQuery->bindParam(':idCategory', $worksCategory_idCategory_add);
            $checkCategoryQuery->execute();

            if ($checkWorksQuery->rowCount() > 0 && $checkCategoryQuery->rowCount() > 0) {
                $insertWorksCategoryQuery = $dsn->prepare("INSERT INTO worksCategory (idWorks, idCategory) VALUES (:idWorks, :idCategory)");
                $insertWorksCategoryQuery->bindParam(':idWorks', $worksCategory_idWorks_add);
                $insertWorksCategoryQuery->bindParam(':idCategory', $worksCategory_idCategory_add);

                if ($insertWorksCategoryQuery->execute()) {
                    echo "WorksCategory insérée avec succès";
                } else {
                    echo "Erreur lors de l'insertion de la WorksCategory";
                }
            } else {
                echo "L'ID $worksCategory_idWorks_add n'existe pas dans la table works.
                    ou L'ID $worksCategory_idCategory_add n'existe pas dans la table Category.";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteWorksTag')) {
    function deleteWorksTag($worksTag_id_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM worksTag WHERE id = :id");
            $stmt->bindParam(':id', $worksTag_id_select);
            if ($stmt->execute()) {
                echo "suppression worksTag réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateWorksTag')) {
    function updateWorksTag($worksTag_id_select, $worksTag_idWorks_update,  $worksTag_idTag_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($worksTag_idWorks_update)) {
                $checkWorksQuery = "SELECT COUNT(*) FROM works WHERE idWorks = :idWorks";
                $checkWorksStmt = $dsn->prepare($checkWorksQuery);
                $checkWorksStmt->bindParam(':idWorks', $worksTag_idWorks_update);
                $checkWorksStmt->execute();

                if ($checkWorksStmt->fetchColumn() > 0) {
                    $setClauses[] = "idWorks = :idWorks";
                } else {
                    echo "L'oeuvres avec l'ID $worksTag_idWorks_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (!empty($worksTag_idTag_update)) {
                $checkTagQuery = "SELECT COUNT(*) FROM tag WHERE idTag = :idTag";
                $checkTagStmt = $dsn->prepare($checkTagQuery);
                $checkTagStmt->bindParam(':idTag', $worksTag_idTag_update);
                $checkTagStmt->execute();

                if ($checkTagStmt->fetchColumn() > 0) {
                    $setClauses[] = "idTag = :idTag";
                } else {
                    echo "Le tag avec l'ID $worksTag_idTag_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE worksTag SET " . implode(', ', $setClauses) . " WHERE id = :idWorksTagSelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':idWorksTagSelect', $worksTag_id_select);
            if (!empty($worksTag_id_select)) {
                $stmt->bindParam(':idWorksTagSelect', $worksTag_id_select);
            }
            if (!empty($worksTag_idWorks_update)) {
                $stmt->bindParam(':idWorks', $worksTag_idWorks_update);
            }
            if (!empty($worksTag_idTag_update)) {
                $stmt->bindParam(':idTag', $worksTag_idTag_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour worksTag réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addWorksTag')) {
    function addWorksTag($worksTag_idWorks_add, $worksTag_idTag_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $checkWorksQuery = $dsn->prepare("SELECT * FROM works WHERE idWorks = :idWorks");
            $checkWorksQuery->bindParam(':idWorks', $worksTag_idWorks_add);
            $checkWorksQuery->execute();

            $checkTagQuery = $dsn->prepare("SELECT * FROM tag WHERE idTag = :idTag");
            $checkTagQuery->bindParam(':idTag', $worksTag_idTag_add);
            $checkTagQuery->execute();

            if ($checkWorksQuery->rowCount() > 0 && $checkTagQuery->rowCount() > 0) {
                $insertWorksTagQuery = $dsn->prepare("INSERT INTO worksTag (idWorks, idTag) VALUES (:idWorks, :idTag)");
                $insertWorksTagQuery->bindParam(':idWorks', $worksTag_idWorks_add);
                $insertWorksTagQuery->bindParam(':idTag', $worksTag_idTag_add);

                if ($insertWorksTagQuery->execute()) {
                    echo "WorksTag insérée avec succès";
                } else {
                    echo "Erreur lors de l'insertion de la WorksTag";
                }
            } else {
                echo "L'ID $worksTag_idWorks_add n'existe pas dans la table works.
                    ou L'ID $worksTag_idTag_add n'existe pas dans la table Tag.";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('deleteListWorks')) {
    function deleteListWorks($listWorks_id_select)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $dsn->prepare("DELETE FROM listWorks WHERE id = :id");
            $stmt->bindParam(':id', $listWorks_id_select);
            if ($stmt->execute()) {
                echo "suppression listWorks réussis";
            } else {
                echo "echec de la suppression";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('updateListWorks')) {
    function updateListWorks($listWorks_id_select, $listWorks_idWorks_update,  $listWorks_idList_update)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $setClauses = [];
            if (!empty($listWorks_idWorks_update)) {
                $checkWorksQuery = "SELECT COUNT(*) FROM works WHERE idWorks = :idWorks";
                $checkWorksStmt = $dsn->prepare($checkWorksQuery);
                $checkWorksStmt->bindParam(':idWorks', $listWorks_idWorks_update);
                $checkWorksStmt->execute();

                if ($checkWorksStmt->fetchColumn() > 0) {
                    $setClauses[] = "idWorks = :idWorks";
                } else {
                    echo "L'oeuvres avec l'ID $listWorks_idWorks_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (!empty($listWorks_idList_update)) {
                $checkListQuery = "SELECT COUNT(*) FROM list WHERE idList = :idList";
                $checkListStmt = $dsn->prepare($checkListQuery);
                $checkListStmt->bindParam(':idList', $listWorks_idList_update);
                $checkListStmt->execute();

                if ($checkListStmt->fetchColumn() > 0) {
                    $setClauses[] = "idList = :idList";
                } else {
                    echo "La list avec l'ID $listWorks_idList_update n'existe pas. Mise à jour annulée.";
                    return;
                }
            }

            if (empty($setClauses)) {
                echo "Aucun champ à mettre à jour.";
                return;
            }

            $query = "UPDATE listWorks SET " . implode(', ', $setClauses) . " WHERE id = :idListWorksSelect ";
            $stmt = $dsn->prepare($query);

            $stmt->bindParam(':idListWorksSelect', $listWorks_id_select);
            if (!empty($listWorks_id_select)) {
                $stmt->bindParam(':idListWorksSelect', $listWorks_id_select);
            }
            if (!empty($listWorks_idWorks_update)) {
                $stmt->bindParam(':idWorks', $listWorks_idWorks_update);
            }
            if (!empty($listWorks_idList_update)) {
                $stmt->bindParam(':idList', $listWorks_idList_update);
            }

            if ($stmt->execute()) {
                echo "Mise à jour listWorks réussie.";
            } else {
                echo "Échec de la mise à jour.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}

if (!function_exists('addListWorks')) {
    function addListWorks($listWorks_idWorks_add, $listWorks_idList_add)
    {
        try {
            $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $checkWorksQuery = $dsn->prepare("SELECT * FROM works WHERE idWorks = :idWorks");
            $checkWorksQuery->bindParam(':idWorks', $listWorks_idWorks_add);
            $checkWorksQuery->execute();

            $checkListQuery = $dsn->prepare("SELECT * FROM list WHERE idList = :idList");
            $checkListQuery->bindParam(':idList', $listWorks_idList_add);
            $checkListQuery->execute();

            if ($checkWorksQuery->rowCount() > 0 && $checkListQuery->rowCount() > 0) {
                $insertListWorksQuery = $dsn->prepare("INSERT INTO listWorks (idWorks, idList) VALUES (:idWorks, :idList)");
                $insertListWorksQuery->bindParam(':idWorks', $listWorks_idWorks_add);
                $insertListWorksQuery->bindParam(':idList', $listWorks_idList_add);

                if ($insertListWorksQuery->execute()) {
                    echo "listWorks insérée avec succès";
                } else {
                    echo "Erreur lors de l'insertion de la listWorks";
                }
            } else {
                echo "L'ID $listWorks_idWorks_add n'existe pas dans la table works.
                    ou L'ID $listWorks_idList_add n'existe pas dans la table List.";
            }

        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            echo $error;
        }
    }
}