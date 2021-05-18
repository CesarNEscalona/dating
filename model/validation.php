<?php

function validName($name){
    if($name == "") {
        return !empty($name);
    } else if(ctype_alpha($name)) {
        return $name;
    }
}

function validAge($age){
    $lower = 18;
    $higher = 118;
    if($age == "") {
        return !empty($age);
    }
    else if(ctype_digit($age)) {
        if($age < $lower) {
            return !ctype_digit($age);
        } else if($age > $higher) {
            return !ctype_digit($age);
        }
        return $age;
    }
    return $age;
}

function validPhone($phoneNum){
    if($phoneNum == "") {
        return !empty($phoneNum);
    } else if(ctype_digit($phoneNum)){
        return $phoneNum;
    }
    return $phoneNum;
}

function validEmail($email){
    $symbol = "/@/i";
    $pattern = "/.com/i";

    if($email == "") {
        return !empty($email);
    }
    else if(preg_match($symbol, $email)) {
        if(preg_match($pattern, $email)){
            return $email;
        }
    }
}

function validOutdoor($oInterests){
    return !empty($oInterests);
}

function validIndoor($iInterests){
    return !empty($iInterests);
}