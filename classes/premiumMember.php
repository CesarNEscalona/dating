<?php

/**
 * Premium Member class
 * dating/classes/premuimMember.php
 * Cesar Escalona
 * 06/02/2021
 *
 * Used to build a premium member object for use during a session that extends from Member
 */
class PremiumMember extends Member
{
    // private instance variables
    private $_inDoorInterests;
    private $_outDoorInterests;


    /**
     * Getter for indoor interests
     *
     * @return mixed|string
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Setter for indoor interests
     *
     * @param mixed|string $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests): void
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Getter for outdoor interests
     *
     * @return mixed|string
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Setter for outdoor interests
     *
     * @param mixed|string $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests): void
    {
        $this->_outDoorInterests = $outDoorInterests;
    }


}