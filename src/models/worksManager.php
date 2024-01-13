<?php 
class worksManager{
    private $db;
    function __construct()
    {
        $db = new database();
        $this->db = $db->connect();
    }

    function selectAll(){
    $result = $this->db->prepare("SELECT * from works");
    $result->execute();
    if($result->rowCount() > 0){
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $work = new worksModel();
            $work->setID($row['idWorks']);
            $work->setName($row['nameWorks']);
            $work->setStatus($row['status']);
            $work->setImage($row['image']);
            $work->setSummary($row['summary']);
            $work->setNbEpisodes($row['numberOfEpisodes']);
            $work->setNbSeason($row['numberOfSeason']);
            $work->setNbTome($row['numberOfTome']);
            $works[] = $work;
        };
        return $works;
    }
    return null;
    }

    function addOneA(){
        $url = "https://api.jikan.moe/v4/anime";
        $raw = file_get_contents($url);
        $json = json_decode($raw);
        foreach($json->data as $work){
            $texts = explode("'",$work->synopsis);
            if(count($texts)-1 > 0){
                foreach(explode("'",$work->synopsis,-1) as $value){
                    $tab[] = $value . "''";
                }
                $text = $tab[0];
                for($c = 1; $c < count($tab); $c++){
                    $text = $text . $tab[$c];
                }
                $work->synopsis = $text . $texts[count($texts)-1];
            } else {
                $text = $work->synopsis;
            }
            $result = $this->db->prepare("INSERT INTO works(nameWorks,status,image,summary,numberOfEpisodes,numberOfSeason,numberOfTome) 
            VALUES('$work->title','$work->status','','$work->synopsis',$work->episodes,0,null)");
            $result->execute();
        }
    }

    function addOneM($nameWorks,$status,$summary,$episodes,$season,$tome){
            $texts = explode("'",$summary);
            if(count($texts)-1 > 0){
                foreach(explode("'",$summary,-1) as $value){
                    $tab[] = $value . "''";
                }
                $text = $tab[0];
                for($c = 1; $c < count($tab); $c++){
                    $text = $text . $tab[$c];
                }
                $summary = $text . $texts[count($texts)-1];
            } else {
                $text = $summary;
            }
            $result = $this->db->prepare("INSERT INTO works(nameWorks,status,image,summary,numberOfEpisodes,numberOfSeason,numberOfTome) 
            VALUES('$nameWorks','$status','','$summary',$episodes,$season,$tome)");
            $result->execute();
    }

    function UpdateImageById($id, $image){
        $result = $this->db->prepare("UPDATE works SET image = '$image' WHERE idWorks = $id");
        $result->execute();
    }

    public function updateOne($id,$name,$status,$summary,$episodes,$season,$tome){
        $db = $this->db;
        $texts = explode("'",$summary);
            if(count($texts)-1 > 0){
                foreach(explode("'",$summary,-1) as $value){
                    $tab[] = $value . "''";
                }
                $text = $tab[0];
                for($c = 1; $c < count($tab); $c++){
                    $text = $text . $tab[$c];
                }
                $summary = $text . $texts[count($texts)-1];
            } else {
                $text = $summary;
            }
        $result = $db->prepare("UPDATE works SET nameWorks = '$name', status = '$status',
        summary = '$summary', numberOfEpisodes = '$episodes', numberOfSeason = $season, numberOfTome = $tome WHERE idWorks = $id");
        $result->execute();
    }

    function selectOneById($id){
        $result = $this->db->prepare("SELECT * from works where idWorks = $id");
        $result->execute();
        $work = new worksModel();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $work->setID($row['idWorks']);
            $work->setName($row['nameWorks']);
            $work->setStatus($row['status']);
            $work->setImage($row['image']);
            $work->setSummary($row['summary']);
            $work->setNbEpisodes($row['numberOfEpisodes']);
            $work->setNbSeason($row['numberOfSeason']);
            $work->setNbTome($row['numberOfTome']);
        };
        $result = $this->db->prepare("SELECT distinct worksCategory.*, worksTag.*, Category.nameCategory, tag.nameTag from worksCategory
        inner JOIN worksTag ON worksCategory.idWorks = worksTag.idWorks
        inner join Category on worksCategory.idCategory = Category.idCategory
        inner join tag on worksTag.idTag = tag.idTag
        where worksCategory.idWorks = $id;");
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $work->setCategory($row['nameCategory']);
            $tag = (object) array('id' => $row['idTag'], 'name' => $row['nameTag']);
            $Tags[] = $tag;
        };
            $work->setTags($Tags);
            return $work;
    }

    public function deleteOne($id){
        $db = $this->db;
        $result = $db->prepare("DELETE FROM worksTag WHERE idWorks = $id;
        DELETE FROM worksCategory WHERE idWorks = $id;
        DELETE FROM works WHERE idWorks = $id;");
        $result->execute();
    }

}
?>