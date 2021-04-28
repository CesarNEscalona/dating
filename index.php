<?php

// This is my controller for the Dating project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start a session
session_start();

// Require autoload file
require_once ('vendor/autoload.php');

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
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
        $_SESSION['method'] = $_POST['method'];
        header('location: profile');
    }

    // Display the personal page
    $view = new Template();
    echo $view->render('views/personalInfo.html');
});

$f3->route('GET /profile', function(){

    // Display the home page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Run Fat-Free
$f3->run();