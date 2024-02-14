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

    function selectAllByIdUser($iduser)
    {
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
            $result2 = $this->db->prepare("SELECT listWorks.*, works.* from listWorks
            join works on works.idWorks = listWorks.idWorks
            where listWorks.idList = $list->ID");
            $result2->execute();
            while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                $work = (object) array('id' => $row2['idWorks'], 'name' => $row2['nameWorks'], 'picture' => $row2['image']);
                $Works[] = $work;
            };
            $list->setWorks($Works);
            $lists[] = $list;
        }
        return $lists ?? "";
    }
    function deleteOne($id)
    {
        //echo $id;
        $db = $this->db;
        $result = $db->prepare("DELETE FROM favorites WHERE idList = $id;
        DELETE FROM list WHERE idList = $id;
        DELETE FROM likes WHERE idList = $id;");
        $result->execute();
    }
}
