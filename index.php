<?php

// This is my controller for the Dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once ('vendor/autoload.php');
require_once('model/validation.php');
require_once('model/data-layer.php');

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
    $userPhone = "";

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

        // Phone number
        $userPhone = $_POST['phoneNumber'];
        if(validPhone($userPhone)) {
            $_SESSION['phoneNumber'] = $userPhone;
        } else {
            $f3->set('errors["phoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
        }

        // method check for male or female
        $_SESSION['method'] = $_POST['method'];

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            // Redirect
            header('location: profile');
        }
    } // End of if form is submitted

    // Add the data to the hive
    $f3->set('userName', $userName);
    $f3->set('userLName', $userLName);
    $f3->set('Age', $userAge);
    $f3->set('phoneNum', $userPhone);

    // Display the personal page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

// Profile page
$f3->route('GET|POST /profile', function($f3){

    // initialize all variables to store user input
    $userEmail = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Email
        $userEmail = $_POST['email'];
        if(validEmail($userEmail)) {
            $_SESSION['email'] = $userEmail;
        } else {
            $f3->set('errors["Email"]', 'Please enter a valid email that contains "@" and ".com"');
        }

        // save the rest of optional data
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['seeking'] = $_POST['seeking'];

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            // Redirect
            header('location: interests');
        }
    }

    // Add the data to the hive
    $f3->set('Email', $userEmail);

    // Display the home page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Interests page
$f3->route('GET|POST /interests', function($f3){
    // initialize all variables to store user input
    $userOutdoor = array();
    $userIndoor = array();

    // If the form has been submitted add the data to session
    // and send the user to the next page
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['iInterests'])){
            $userIndoor = $_POST['iInterests'];
            // Check if the options are valid or not
            if(validIndoor($userIndoor)){
                $_SESSION['iInterests'] = implode(", ", $userIndoor);
            }
        }
        else {
            // if the indoor interests are empty and/or not valid, display an error
            $f3->set('errors["inDoorInterests"]', 'You must select a valid option');
        }

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            // Redirect
            header('location: summary');
        }



        // $_SESSION['iInterests'] = implode(", ", $_POST['iInterests']);
        // $_SESSION['oInterests'] = implode(", ", $_POST['oInterests']);



    }

    //Get the data from the Model and send them to the View
    $f3->set('indoorInterests', getIndoorInterests());
    // $f3->set('outdoorInterests', getOutoorInterests());

    // Add the data to the hive
    $f3->set('inDoorInterests', $userIndoor);

    // Display the interests page
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Summary page
$f3->route('GET /summary', function(){

    //Display the second order form
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();