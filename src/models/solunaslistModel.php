<?php
class solunaslistModel
{
    public $ID;
    public $name;
    public $userID;
    public $username;
    public $Works;
    public $isPublic;
    public $userpicture;
    public $like;
    public $fav;
    public $isLike;
    public $isFav;

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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of userID
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set the value of userID
     */
    public function setUserID($userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of Works
     */
    public function getWorks()
    {
        return $this->Works;
    }

    /**
     * Set the value of Works
     */
    public function setWorks($Works): self
    {
        $this->Works = $Works;

        return $this;
    }

    /**
     * Get the value of isPublic
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set the value of isPublic
     */
    public function setIsPublic($isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    /**
     * Get the value of userpicture
     */
    public function getUserpicture()
    {
        return $this->userpicture;
    }

    /**
     * Set the value of userpicture
     */
    public function setUserpicture($userpicture): self
    {
        $this->userpicture = $userpicture;

        return $this;
    }

    /**
     * Get the value of like
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set the value of like
     */
    public function setLike($like): self
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get the value of fav
     */
    public function getFav()
    {
        return $this->fav;
    }

    /**
     * Set the value of fav
     */
    public function setFav($fav): self
    {
        $this->fav = $fav;

        return $this;
    }

    /**
     * Get the value of isLike
     */
    public function getIsLike()
    {
        return $this->isLike;
    }

    /**
     * Set the value of isLike
     */
    public function setIsLike($isLike): self
    {
        $this->isLike = $isLike;

        return $this;
    }

    /**
     * Get the value of isFav
     */
    public function getIsFav()
    {
        return $this->isFav;
    }

    /**
     * Set the value of isFav
     */
    public function setIsFav($isFav): self
    {
        $this->isFav = $isFav;

        return $this;
    }
}
