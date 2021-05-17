<?php

function validName($name){
    if($name == "") {
        return !empty($name);
    } else if(ctype_alpha($name)) {
        return $name;
    }
}

function validAge($age){
    return !empty($age);
}

function validPhone($phoneNum){
    return !empty($phoneNum);
}

function validEmail($email){
    return !empty($email);
}

function validOutdoor($oInterests){
    return !empty($oInterests);
}

function validIndoor($iInterests){
    return !empty($iInterests);
}