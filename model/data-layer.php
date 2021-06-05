<?php
/**
 * Class Datalayer
 * dating/model/data-layer.php
 * Cesar Escalona
 * 06/02/2021
 *
 * This file will interact with the controller for my dating project
 */
class DataLayer
{
    /**
     * Getter for indoor interests to display array
     *
     * @return string[] array of indoor interests
     */
    static function getIndoorInterests()
    {
        return array(
            "Tv", "Puzzles", "Movies", "Reading", "Cooking",
            "Playing Cards", "Board Games", "Video Games");
    }

    /**
     * Getter for out door interests
     *
     * @return string[] array of outdoor interests
     */
    static function getOutdoorInterests()
    {
        return array(
            "Hiking", "Walking", "Biking", "Climbing",
            "Swimming", "Collecting");
    }
}
