<?php
class likeFavModel
{
    public $ID;
    public $IDuser;
    public $IDlist;

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
     * Get the value of IDuser
     */
    public function getIDuser()
    {
        return $this->IDuser;
    }

    /**
     * Set the value of IDuser
     */
    public function setIDuser($IDuser): self
    {
        $this->IDuser = $IDuser;

        return $this;
    }

    /**
     * Get the value of IDlist
     */
    public function getIDlist()
    {
        return $this->IDlist;
    }

    /**
     * Set the value of IDlist
     */
    public function setIDlist($IDlist): self
    {
        $this->IDlist = $IDlist;

        return $this;
    }
}
