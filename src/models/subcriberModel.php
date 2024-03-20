<?php
class subcriberModel
{
    public $ID;
    public $UserID;
    public $SubcriberID;
    public $SubcriberName;

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
     * Get the value of UserID
     */
    public function getUserID()
    {
        return $this->UserID;
    }

    /**
     * Set the value of UserID
     */
    public function setUserID($UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    /**
     * Get the value of SubcriberID
     */
    public function getSubcriberID()
    {
        return $this->SubcriberID;
    }

    /**
     * Set the value of SubcriberID
     */
    public function setSubcriberID($SubcriberID): self
    {
        $this->SubcriberID = $SubcriberID;

        return $this;
    }

    /**
     * Get the value of SubcriberName
     */
    public function getSubcriberName()
    {
        return $this->SubcriberName;
    }

    /**
     * Set the value of SubcriberName
     */
    public function setSubcriberName($SubcriberName): self
    {
        $this->SubcriberName = $SubcriberName;

        return $this;
    }
}
