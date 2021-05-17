<?php

// This is my controller for the Dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once ('vendor/autoload.php');
require_once('model/validation.php');

// Start a session
session_start();

// Instantiate Fat-Fre
$f3 = Base::instance();

// Define default route
$f3->route('GET /', function(){

    // Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /info', function($f3){
    // Reinitialize the session array
    $_SESSION = array();

    // initialize all variables to store user input
    $userName = "";
    $userLName = "";
    $userAge = "";
    $userPhone = 0;
    $userEmail = "";
    $userOutdoor = array();
    $userIndoor = array();

    //If the form has been submitted, add the data to session
    //and send the user to the next page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // First Name
        $userName = $_POST['fname'];
        if(validName($userName)) {
            $_SESSION['fname'] = $userName;
        } else {
            $f3->set('errors["name"]', 'Please enter a valid first name');
        }

        // Last Name
        $userLName = $_POST['lname'];
        if(validName($userLName)) {
            $_SESSION['lname'] = $userLName;
        } else {
            $f3->set('errors["lName"]', 'Please enter a valid last name');
        }

        // Age
        $userAge = $_POST['age'];
        if(validAge($userAge)) {
            $_SESSION['age'] = $userAge;
        } else {
            $f3->set('errors["Age"]', 'Please enter an age between 18 and 118');
        }


        $_SESSION['method'] = $_POST['method'];
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            // Redirect
            header('location: profile');
        }

    }

    // Add the data to the hive
    $f3->set('userName', $userName);
    $f3->set('userLName', $userLName);
    $f3->set('Age', $userAge);

    // Display the personal page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET|POST /profile', function(){

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // If the form has been submitted add the data to session
        // and send the user to the next page
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['seeking'] = $_POST['seeking'];
        header('location: interests');
    }

    // Display the home page
    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interests', function(){
    // If the form has been submitted add the data to session
    // and send the user to the next page
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['iInterests'] = implode(", ", $_POST['iInterests']);
        $_SESSION['oInterests'] = implode(", ", $_POST['oInterests']);
        header('location: summary');
    }

    // Display the home page
    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3->route('GET /summary', function(){

    //Display the second order form
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();