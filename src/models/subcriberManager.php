<?php
class subcriberManager
{
    private $bdd;
    public function __construct()
    {
        $bdd = new database();
        $this->bdd = $bdd->connect();
    }

    function SelectAll()
    {
        $result = $this->bdd->prepare("SELECT * FROM subscriber");
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $subcriber = new subcriberModel();
                $subcriber->setID($row["id"]);
                $subcriber->setSubcriberID($row["idSubscriber"]);
                $subcriber->setUserID($row["idUser"]);
                $subcribers[] = $subcriber;
            }
            return $subcribers;
        }
        return null;
    }

    function SelectAllbyUser($userid)
    {
        $result = $this->bdd->prepare("SELECT subscriber.*, user.username, user.pictures FROM subscriber
        JOIN user ON user.idUser = subscriber.idUser WHERE idUser = $userid");
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $subcriber = new subcriberModel();
                $subcriber->setID($row["id"]);
                $subcriber->setSubcriberID($row["idSubscriber"]);
                $subcriber->setUserID($row["idUser"]);
                $subcriber->setUserName($row['username']);
                $subcriber->setUserPicture($row['pictures']);
                $subcribers[] = $subcriber;
            }
            return $subcribers;
        }
        return null;
    }

    function SelectAllbySubscriber($subid)
    {
        $result = $this->bdd->prepare("SELECT subscriber.*, user.username, user.pictures FROM subscriber
        JOIN user ON user.idUser = subscriber.idSubscriber WHERE idSubscriber = $subid");
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $subcriber = new subcriberModel();
                $subcriber->setID($row["id"]);
                $subcriber->setSubcriberID($row["idSubscriber"]);
                $subcriber->setUserID($row["idUser"]);
                $subcriber->setSubcriberName($row['username']);
                $subcriber->setSubcriberPicture($row['pictures']);
                $subcribers[] = $subcriber;
            }
            return $subcribers;
        }
        return null;
    }
    function addSub($userid, $subid)
    {
        $result = $this->bdd->prepare('INSERT INTO subscriber(idUser, idSubscriber) VALUES($userid, $subid)');
        $result->execute();
    }
    function removeSub($userid, $subid)
    {
        $result = $this->bdd->prepare('DELETE FROM subscriber WHERE idUser = $userid AND idSubscriber = $subid');
        $result->execute();
    }
}
