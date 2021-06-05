<?php

/**
 * Class DatingValidation
 * dating/model/validation.php
 * Cesar Escalona
 * 06/02/2021
 *
 * This file will interact with the controller for my dating project and should check
 * if the inputted data is valid
 */
class DatingValidation
{
    /**
     * Checks to make sure a name is valid
     *
     * @param $name - name variable that is being checked and returned
     * @return bool|mixed if name is empty, it fails, otherwise it should be a valid name
     *
     */
    static function validName($name)
    {
        if ($name == "") {
            return !empty($name);
        } else if (ctype_alpha($name)) {
            return $name;
        }
    }

    /**
     * Checks to make sure age is within parameters
     *
     * @param $age - age variable that is being checked and returned
     * @return bool|mixed - if age is empty, fails, otherwise should return a valid age
     */
    static function validAge($age)
    {
        $lower = 18;
        $higher = 118;
        if ($age == "") {
            return !empty($age);
        } else if (ctype_digit($age)) {
            if ($age < $lower) {
                return !ctype_digit($age);
            } else if ($age > $higher) {
                return !ctype_digit($age);
            }
            return $age;
        }
        return $age;
    }

    /**
     * Checks to make sure phone number is valid
     *
     * @param $phoneNum - required field that must contain digits
     * @return bool|mixed if empty, fails, otherwise it should be a valid phone number
     */
    static function validPhone($phoneNum)
    {
        if ($phoneNum == "") {
            return !empty($phoneNum);
        } else if (ctype_digit($phoneNum)) {
            return $phoneNum;
        }
        return $phoneNum;
    }

    /**
     * Checks to make sure email is valid
     *
     * @param $email - required field that must contain @ and .com
     * @return bool|mixed if empty, fails, otherwise it will return a valid email
     */
    static function validEmail($email)
    {
        $symbol = "/@/i";
        $pattern = "/.com/i";
        if ($email == "") {
            return !empty($email);
        } else if (preg_match($symbol, $email)) {
            if (preg_match($pattern, $email)) {
                return $email;
            }
        }
    }

    /**
     * Checks to make sure indoor interests are within the datalayer interests
     *
     * @param $iInterests - Checks against form spoofers
     * @return bool returns true if interests are valid, false otherwise
     */
    static function validIndoor($iInterests)
    {
        $validIndoor = DataLayer::getIndoorInterests();
        foreach ($iInterests as $iInterest) {
            if (!in_array($iInterest, $validIndoor)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Checks to make sure outdoor interests are within the datalayer interests
     *
     * @param $oInterests - checks against form spoofers
     * @return bool returns true if interests are valid, otherwise false
     */
    static function validOutdoor($oInterests)
    {
        $validOutdoor = DataLayer::getOutdoorInterests();
        foreach ($oInterests as $oInterest) {
            if (!in_array($oInterest, $validOutdoor)) {
                return false;
            }
        }
        return true;
    }
}
