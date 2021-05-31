<?php
/*
 * Return data for the survey file
 */
class DataLayer
{
    // Creating a function that contains data for the indoor interests
    static function getIndoorInterests()
    {
        return array(
            "Tv", "Puzzles", "Movies", "Reading", "Cooking",
            "Playing Cards", "Board Games", "Video Games");
    }

// Creating a function that contains data for the outdoor interests
    static function getOutdoorInterests()
    {
        return array(
            "Hiking", "Walking", "Biking", "Climbing",
            "Swimming", "Collecting");
    }
}
