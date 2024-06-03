<?php
class commentsModel
{
    public $ID;
    public $IDworks;
    public $IDuser;
    public $Content;

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
     * Get the value of IDworks
     */
    public function getIDworks()
    {
        return $this->IDworks;
    }

    /**
     * Set the value of IDworks
     */
    public function setIDworks($IDworks): self
    {
        $this->IDworks = $IDworks;

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
     * Get the value of Content
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * Set the value of Content
     */
    public function setContent($Content): self
    {
        $this->Content = $Content;

        return $this;
    }
}
