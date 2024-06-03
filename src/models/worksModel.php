<?php
class worksModel
{
    public $ID;
    public $Name;
    public $Status;
    public $Image;
    public $Summary;
    public $NbEpisodes;
    public $NbSeason;
    public $NbTome;
    public $Category;
    public $Tags;
    public $isNsfw;


    /**
     * Get the value of ID
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Set the value of ID
     */
    public function setID($ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get the value of Name
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Name
     */
    public function setName($Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Status
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set the value of Status
     */
    public function setStatus($Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * Get the value of Image
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * Set the value of Image
     */
    public function setImage($Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * Get the value of Summary
     */
    public function getSummary()
    {
        return $this->Summary;
    }

    /**
     * Set the value of Summary
     */
    public function setSummary($Summary): self
    {
        $this->Summary = $Summary;

        return $this;
    }

    /**
     * Get the value of NbEpisodes
     */
    public function getNbEpisodes()
    {
        return $this->NbEpisodes;
    }

    /**
     * Set the value of NbEpisodes
     */
    public function setNbEpisodes($NbEpisodes): self
    {
        $this->NbEpisodes = $NbEpisodes;

        return $this;
    }

    /**
     * Get the value of NbSeason
     */
    public function getNbSeason()
    {
        return $this->NbSeason;
    }

    /**
     * Set the value of NbSeason
     */
    public function setNbSeason($NbSeason): self
    {
        $this->NbSeason = $NbSeason;

        return $this;
    }

    /**
     * Get the value of NbTome
     */
    public function getNbTome()
    {
        return $this->NbTome;
    }

    /**
     * Set the value of NbTome
     */
    public function setNbTome($NbTome): self
    {
        $this->NbTome = $NbTome;

        return $this;
    }

    /**
     * Get the value of Category
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * Set the value of Category
     */
    public function setCategory($Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * Get the value of Tags
     */
    public function getTags()
    {
        return $this->Tags;
    }

    /**
     * Set the value of Tags
     */
    public function setTags($Tags): self
    {
        $this->Tags = $Tags;

        return $this;
    }

    /**
     * Get the value of isNsfw
     */
    public function getIsNsfw()
    {
        return $this->isNsfw;
    }

    /**
     * Set the value of isNsfw
     */
    public function setIsNsfw($isNsfw): self
    {
        $this->isNsfw = $isNsfw;

        return $this;
    }
}
