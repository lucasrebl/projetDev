<?php 

class commentsManager
{
    public function insertComment($idUser, $idWork, $comment)
    {
        $bdd = new database();
        $data = $bdd->connect();
        $stmt = $data->prepare("INSERT INTO Comments ( idWorks, idUser, content) VALUES (:idWorks, :idUser, :content)");
        $stmt->bindParam(':idWorks', $idWork);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':content', $comment);
        $stmt->execute();
    }

    public function getCommentsByWorkId($idWork)
    {
        $bdd = new database();
        $data = $bdd->connect();
        $stmt = $data->prepare("
            SELECT c.content, u.username 
            FROM Comments c 
            JOIN user u ON c.idUser = u.idUser
            WHERE c.idWorks = :idWorks
        ");
        $stmt->bindParam(':idWorks', $idWork);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isCommentExists($idUser, $idWork, $comment)
    {
        $bdd = new database();
        $data = $bdd->connect();
        $stmt = $data->prepare("
            SELECT COUNT(*) 
            FROM Comments 
            WHERE idWorks = :idWorks AND idUser = :idUser AND content = :content
        ");
        $stmt->bindParam(':idWorks', $idWork);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':content', $comment);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
