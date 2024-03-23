<?php

class likeFavManager
{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }

    public function addLike($iduser, $idlist)
    {
        $result = $this->db->prepare("INSERT INTO `like`(idUser,idList) VALUES('$iduser',$idlist)");
        $result->execute();
    }
    public function deleteLike($iduser, $idlist)
    {
        $result = $this->db->prepare("DELETE FROM `like` WHERE idUser = $iduser AND idList = $idlist");
        $result->execute();
    }
    public function selectLikebyUserlistID($iduser, $idlist)
    {
        $result = $this->db->prepare("SELECT * FROM `like` WHERE idUser = $iduser AND idList = $idlist");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $like = new likeFavModel();
            $like->setID($row['id']);
            $like->setIDuser($row['idUser']);
            $like->setIDlist($row['idList']);
            $likes[] = $like;
        }
        return $likes ?? [];
    }
    public function selectLikebyUserID($iduser)
    {
        $result = $this->db->prepare("SELECT * FROM `like` WHERE idUser = $iduser");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $like = new likeFavModel();
            $like->setID($row['id']);
            $like->setIDuser($row['idUser']);
            $like->setIDlist($row['idList']);
            $likes[] = $like;
        }
        return $likes ?? [];
    }
    public function selectLikebyListID($idlist)
    {
        $result = $this->db->prepare("SELECT * FROM `like` WHERE idList = $idlist");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $like = new likeFavModel();
            $like->setID($row['id']);
            $like->setIDuser($row['idUser']);
            $like->setIDlist($row['idList']);
            $likes[] = $like;
        }
        return $likes ?? [];
    }
    public function selectAll()
    {
        $result = $this->db->prepare("SELECT * FROM `like`");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $like = new likeFavModel();
            $like->setID($row['id']);
            $like->setIDuser($row['idUser']);
            $like->setIDlist($row['idList']);
            $likes[] = $like;
        }
        return $likes ?? [];
    }
}
