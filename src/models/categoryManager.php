<?php 
class categoryManager{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }

    function selectAll(){
    $result = $this->db->prepare("SELECT * from Category");
    $result->execute();
    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $category = new filterModel();
            $category->setID($row['idCategory']);
            $category->setName($row['nameCategory']);
            $categories[] = $category;
        };
        return $categories;
    }
    return null;
    }
}
?>