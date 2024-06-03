<?php
class userManager
{
    private $bdd;
    public function __construct()
    {
        $bdd = new database();
        $this->bdd = $bdd->connect();
    }

    function SelectAll()
    {
        $result = $this->bdd->prepare("SELECT * from user");
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $user = new userModel();
                $user->setID($row["idUser"]);
                $user->setUsername($row["username"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["passwordUser"]);
                $user->setAge($row["age"]);
                $user->setPicture($row["pictures"]);
                $user->setIsAdmin($row["idAdmin"]);
                $users[] = $user;
            }
            return $users;
        }
        return null;
    }

    function SelectOnebyID($id)
    {
        $result = $this->bdd->prepare("SELECT * from user WHERE idUser = $id");
        $result->execute();
        if ($result->rowCount() > 0) {
            $userD = $result->fetch(PDO::FETCH_ASSOC);
            $user = new userModel();
            $user->setID($userD["idUser"]);
            $user->setUsername($userD["username"]);
            $user->setEmail($userD["email"]);
            $user->setPassword($userD["passwordUser"]);
            $user->setAge($userD["age"]);
            $user->setPicture($userD["pictures"]);
            $user->setIsAdmin($userD["isAdmin"]);
            return $user;
        }
        return null;
    }

    function UpdateImageById($id, $image)
    {
        $result = $this->bdd->prepare("UPDATE user SET pictures = '$image' WHERE idUser = $id");
        $result->execute();
    }
    function UpdateUserProfile($id, $username, $password)
    {
        $result = $this->bdd->prepare("UPDATE user SET username = '$username', passwordUser = '$password' WHERE idUser = $id");
        $result->execute();
    }
}
