<?php
/*
 * dating/index.php
 * Cesar Escalona
 * 06/02/2021
 *
 * Uses methods from the controller to reroute the user
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');

// Start a session
session_start();

// Instantiate Fat-Free and controller
$f3 = Base::instance();
$con = new Controller($f3);

// Define default route
$f3->route('GET /', function () {
    $GLOBALS['con']->home();
});
// Personal info page
$f3->route('GET|POST /info', function () {
    $GLOBALS['con']->personalInfo();
});

// Profile page
$f3->route('GET|POST /profile', function () {
    $GLOBALS['con']->profile();
});

// Interests page
$f3->route('GET|POST /interests', function () {
    $GLOBALS['con']->interests();
});

// Summary page
$f3->route('GET /summary', function () {
    $GLOBALS['con']->summary();
});

// Run Fat-Free
$f3->run();