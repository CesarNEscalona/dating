<?php

class PremiumMember extends Member
{
    // private instance variables
    private $_inDoorInterests;
    private $_outDoorInterests;


    /**
     * @return mixed|string
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed|string $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests): void
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed|string
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed|string $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests): void
    {
        $this->_outDoorInterests = $outDoorInterests;
    }


}