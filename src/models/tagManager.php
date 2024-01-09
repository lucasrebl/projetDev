<?php 
class tagManager{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }

    function selectAll(){
    $result = $this->db->prepare("SELECT * from tag");
    $result->execute();
    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $tag = new filterModel();
            $tag->setID($row['idTag']);
            $tag->setName($row['nameTag']);
            $tags[] = $tag;
        };
        return $tags;
    }
    return null;
    }
}
?>