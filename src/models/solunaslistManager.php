<?php
class solunaslistManager
{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }
    function addOne($name, $iduser)
    {
        try {
            $result = $this->db->prepare("INSERT INTO list(nameList,idUser) 
        VALUES('$name',$iduser)");
            $result->execute();
        } catch (PDOException $e) {
            header("Location: /profil");
        }
    }
    function addWorkToList($idList, $idWork)
    {
        try {
            $result = $this->db->prepare("INSERT INTO listWorks(idWorks,idList) 
        VALUES('$idWork',$idList)");
            $result->execute();
        } catch (PDOException $e) {
            header("Location: /profil");
        }
    }

    function selectAll()
    {
        $user = $_SESSION['idUser'] ?? 0;
        $result = $this->db->prepare("SELECT list.*, user.username, user.pictures as UP from list
         join user on user.idUser = list.idUser");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list = new solunaslistModel();
            $list->setID($row['idList']);
            $list->setName($row['nameList']);
            $list->setUserID($row['idUser']);
            $list->setUsername($row['username']);
            $list->setIsPublic($row['isPublic']);
            $list->setUserpicture($row['UP']);
            $LFM = new likeFavManager();
            $list->setLike($LFM->selectLikebyListID($list->ID));
            $list->setisLike(count($LFM->selectLikebyUserlistID($user, $list->ID)));
            $list->setFav($LFM->selectFavbyListID($list->ID));
            $list->setIsFav(count($LFM->selectFavbyUserlistID($user, $list->ID)));
            $Works = [];
            $result2 = $this->db->prepare("SELECT listWorks.*, works.* from listWorks
            join works on works.idWorks = listWorks.idWorks
            where listWorks.idList = $list->ID");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                $work = (object) array('id' => $row2['idWorks'], 'name' => $row2['nameWorks'], 'picture' => $row2['image']);
                $Works[] = $work;
            };
            $list->setWorks($Works ?? "");
            $lists[] = $list;
        }
        return $lists ?? [];
    }

    function selectAllByIdUser($iduser)
    {
        $user = $_SESSION['idUser'] ?? 0;
        $result = $this->db->prepare("SELECT list.*, user.username from list
         join user on user.idUser = $iduser
         where list.idUser = $iduser");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list = new solunaslistModel();
            $list->setID($row['idList']);
            $list->setName($row['nameList']);
            $list->setUserID($row['idUser']);
            $list->setUsername($row['username']);
            $list->setIsPublic($row['isPublic']);
            $LFM = new likeFavManager();
            $list->setLike($LFM->selectLikebyListID($list->ID));
            $list->setisLike(count($LFM->selectLikebyUserlistID($user, $list->ID)));
            $list->setFav($LFM->selectFavbyListID($list->ID));
            $list->setIsFav(count($LFM->selectFavbyUserlistID($user, $list->ID)));
            $Works = [];
            $result2 = $this->db->prepare("SELECT listWorks.*, works.* from listWorks
            join works on works.idWorks = listWorks.idWorks
            where listWorks.idList = $list->ID");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                $work = (object) array('id' => $row2['idWorks'], 'name' => $row2['nameWorks'], 'picture' => $row2['image']);
                $Works[] = $work;
            };
            $list->setWorks($Works ?? "");
            $lists[] = $list;
        }
        return $lists ?? [];
    }
    function selectOneById($id)
    {
        $user = $_SESSION['idUser'] ?? 0;
        $result = $this->db->prepare("SELECT list.*, user.username from list
         join user on user.idUser = list.idUser
         where list.idList = $id");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list = new solunaslistModel();
            $list->setID($row['idList']);
            $list->setName($row['nameList']);
            $list->setUserID($row['idUser']);
            $list->setUsername($row['username']);
            $list->setIsPublic($row['isPublic']);
            $LFM = new likeFavManager();
            $list->setLike($LFM->selectLikebyListID($list->ID));
            $list->setisLike(count($LFM->selectLikebyUserlistID($user, $list->ID)));
            $list->setFav($LFM->selectFavbyListID($list->ID));
            $list->setIsFav(count($LFM->selectFavbyUserlistID($user, $list->ID)));
            $result2 = $this->db->prepare("SELECT listWorks.*, works.* from listWorks
            join works on works.idWorks = listWorks.idWorks
            where listWorks.idList = $list->ID");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                $work = (object) array('id' => $row2['idWorks'], 'name' => $row2['nameWorks'], 'picture' => $row2['image']);
                $Works[] = $work;
            };
            $list->setWorks($Works ?? "");
        }
        return $list ?? "";
    }
    function deleteOne($id)
    {
        $db = $this->db;
        $result = $db->prepare("DELETE FROM favorites WHERE idList = $id;
        DELETE FROM list WHERE idList = $id;
        DELETE FROM likes WHERE idList = $id;");
        $result->execute();
    }

    function deleteWorkFromList($idList, $idWork)
    {
        try {
            $result = $this->db->prepare("DELETE FROM listWorks WHERE idWorks=$idWork AND idList=$idList");
            $result->execute();
        } catch (PDOException $e) {
            header("Location: /viewList?list=$idList");
        }
    }
    function toogleView($idlist)
    {
        try {
            $result = $this->db->prepare("SELECT isPublic FROM list WHERE idList = $idlist");
            $result->execute();
            $view = $result->fetch(PDO::FETCH_ASSOC)["isPublic"];
            if ($view == 0) {
                $view = 1;
            } else {
                $view = 0;
            }
            $result2 = $this->db->prepare("UPDATE list SET isPublic = $view WHERE idList = $idlist");
            $result2->execute();
        } catch (PDOException $e) {
            header("Location: /profil");
        }
    }

    function selectAllByName($name, $bar)
    {
        $user = $_SESSION['idUser'] ?? 0;
        if ($bar == 0) {
            $result = $this->db->prepare("SELECT list.*, user.username, user.pictures as UP from list
         join user on user.idUser = list.idUser
         where list.nameList LIKE '$name%'");
        } else {
            $result = $this->db->prepare("SELECT list.*, user.username, user.pictures as UP from list
         join user on user.idUser = list.idUser
         where username LIKE '$name%'");
        }
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $list = new solunaslistModel();
            $list->setID($row['idList']);
            $list->setName($row['nameList']);
            $list->setUserID($row['idUser']);
            $list->setUsername($row['username']);
            $list->setIsPublic($row['isPublic']);
            $list->setUserpicture($row['UP']);
            $LFM = new likeFavManager();
            $list->setLike($LFM->selectLikebyListID($list->ID));
            $list->setisLike(count($LFM->selectLikebyUserlistID($user, $list->ID)));
            $list->setFav($LFM->selectFavbyListID($list->ID));
            $list->setIsFav(count($LFM->selectFavbyUserlistID($user, $list->ID)));
            $Works = [];
            $result2 = $this->db->prepare("SELECT listWorks.*, works.* from listWorks
            join works on works.idWorks = listWorks.idWorks
            where listWorks.idList = $list->ID");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                $work = (object) array('id' => $row2['idWorks'], 'name' => $row2['nameWorks'], 'picture' => $row2['image']);
                $Works[] = $work;
            };
            $list->setWorks($Works ?? "");
            $lists[] = $list;
        }
        return $lists ?? [];
    }
}
