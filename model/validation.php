<?php

class DatingValidation
{
    // This function checks to see that a string is all alphabetic
    static function validName($name)
    {
        if ($name == "") {
            return !empty($name);
        } else if (ctype_alpha($name)) {
            return $name;
        }
    }

// This function checks to see that an age is numeric between 18 and 118
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

// This function checks to see that a phone number is valid
    static function validPhone($phoneNum)
    {
        if ($phoneNum == "") {
            return !empty($phoneNum);
        } else if (ctype_digit($phoneNum)) {
            return $phoneNum;
        }
        return $phoneNum;
    }

// This function checks to see that an email address is valid
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

// This function checks each selected indoor interest against a list of valid options
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

// This function checks each selected outdoor interest against a list of valid options
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
