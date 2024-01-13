<?php 
class filterManager{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }

    function selectAll($filter){
    $result = $this->db->prepare("SELECT * from $filter");
    $result->execute();
    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $filter = new filterModel();
            $filter->setID($row['idCategory'] ?? $row['idTag']);
            $filter->setName($row['nameCategory'] ?? $row['nameTag']);
            $filters[] = $filter;
        };
        return $filters;
    }
    return null;
    }

    function updateCategory($idWorks, $idCategory){
        $result = $this->db->prepare("UPDATE worksCategory SET idCategory = $idCategory WHERE idWorks = $idWorks");
        $result->execute();
    }
}
?>