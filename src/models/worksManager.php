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
        // echo $json->data[0]->episodes;
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
            $result = $this->db->prepare("INSERT INTO works(nameWorks,status,image,summary,numberOfEpisodes,numberOfSeason,numberOfTome) VALUES('$work->title','$work->status','','$work->synopsis',$work->episodes,0,null)");
            $result->execute();
        }
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
        $result = $this->db->prepare("SELECT * from works where idWorks = $id");
        $result->execute();
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
        return $work;
    }
}
?>