<?php

class Controller
{
    // private instance field
    private $_f3; // router

    // parameterized controller constructor
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    // default route, home page
    function home()
    {
        // Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    // personal info page
    function personalInfo()
    {
        // Reinitialize the session array
        //$_SESSION = array();

        // Instantiate Member or Prem member obj *** based on checkbox isset
        if(!isset($_POST['premium'])){
            $user = new Member();
            $_SESSION['user'] = $user;
        } else {
            $user = new PremiumMember();
            $_SESSION['user'] = $user;
        }
        // var_dump($member);

        // initialize all variables to store user input
        $userName = "";
        $userLName = "";
        $userAge = "";
        $userPhone = "";
        $userGender = "";

        //If the form has been submitted, add the data to session
        //and send the user to the next page
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // First Name
            $userName = $_POST['fname'];
            if (DatingValidation::validName($userName)) {
                $_SESSION['user']->setFname($userName);
            } else {
                $this->_f3->set('errors["name"]', 'Please enter a valid first name');
            }

            // Last Name
            $userLName = $_POST['lname'];
            if (DatingValidation::validName($userLName)) {
                $_SESSION['user']->setLname($userLName);
            } else {
                $this->_f3->set('errors["lName"]', 'Please enter a valid last name');
            }

            // Age
            $userAge = $_POST['age'];
            if (DatingValidation::validAge($userAge)) {
                $_SESSION['user']->setAge($userAge);
            } else {
                $this->_f3->set('errors["Age"]', 'Please enter an age between 18 and 118');
            }

            // Phone number
            $userPhone = $_POST['phoneNumber'];
            if (DatingValidation::validPhone($userPhone)) {
                $_SESSION['user']->setPhone($userPhone);
            } else {
                $this->_f3->set('errors["phoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
            }

            // method check for male or female
            $userGender = $_POST['method'];
            $_SESSION['user']->setGender($userGender);

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: profile');
            }
        } // End of if form is submitted

        // Add the data to the hive
        $this->_f3->set('userName', $userName);
        $this->_f3->set('userLName', $userLName);
        $this->_f3->set('Age', $userAge);
        $this->_f3->set('phoneNum', $userPhone);

        // Display the personal page
        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    function profile()
    {
        // initialize all variables to store user input
        $user = $_SESSION['user'];
        $userEmail = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Email
            $userEmail = $_POST['email'];
            if (DatingValidation::validEmail($userEmail)) {
                $user->setEmail($userEmail);
            } else {
                $this->_f3->set('errors["Email"]', 'Please enter a valid email that contains "@" and ".com"');
            }

            // save the rest of optional data
            $user->setState($_POST['state']);
            $user->setBio($_POST['bio']);
            $user->setSeeking($_POST['seeking']);

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: interests');
            }
        }

        // Add the data to the hive
        $this->_f3->set('Email', $user->getEmail());

        // Display the home page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        // initialize all variables to store user input
        $user = $_SESSION['user'];
        //$userOutdoor = array();
        //$userIndoor = array();

        // If the form has been submitted...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['iInterests'])) {
                //$userIndoor = $_POST['iInterests'];
                // Check if the options are valid or not
                if (DatingValidation::validIndoor($_POST['iInterests'])) {
                    $user->setInDoorInterests($_POST['iInterests']);
                } else {
                    // if the indoor interests are empty and/or not valid, display an error
                    $this->_f3->set('errors["inDoorInterests"]', 'You must select a valid indoor interest');
                }
            }

            // Check if outdoor interests has a post
            if (!empty($_POST['oInterests'])) {
                //$userOutdoor = $_POST['oInterests'];
                // Check if the options are valid or not
                if (DatingValidation::validOutdoor($_POST['oInterests'])) {
                    $user->setOutDoorInterests($_POST['oInterests']);
                } else {
                    // if the indoor interests are empty and/or not valid, display an error
                    $this->_f3->set('errors["outDoorInterests"]', 'You must select a valid outdoor interest');
                }
            }

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: summary');
            }
        }

        //Get the data from the Model and send them to the View
        $this->_f3->set('indoorInterests', DataLayer::getIndoorInterests());
        $this->_f3->set('outdoorInterests', DataLayer::getOutdoorInterests());

        // Add the data to the hive
        $this->_f3->set('inDoorInterests', $user->getInDoorInterests());
        $this->_f3->set('outDoorInterests', $user->getOutDoorInterests());

        // Display the interests page
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        //Display the second order form
        $view = new Template();
        echo $view->render('views/summary.html');
        // clearing the session bucket
        //unset($_SESSION['member']);
    }
}