<?php

// This is my controller for the Dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once ('vendor/autoload.php');

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

$f3->route('GET|POST /info', function(){
    //If the form has been submitted, add the data to session
    //and send the user to the next page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['method'] = $_POST['method'];
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
        header('location: profile');
    }

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