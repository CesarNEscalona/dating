<?php

class Controller
{
    private $_f3; // router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personalInfo()
    {
        // Reinitialize the session array
        $_SESSION = array();

        // Instantiate Member obj ***
        $member = new Member();
        $_SESSION['member'] = $member;
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
                $_SESSION['member']->setFname($userName);
            } else {
                $this->_f3->set('errors["name"]', 'Please enter a valid first name');
            }

            // Last Name
            $userLName = $_POST['lname'];
            if (DatingValidation::validName($userLName)) {
                $_SESSION['member']->setLname($userLName);
            } else {
                $this->_f3->set('errors["lName"]', 'Please enter a valid last name');
            }

            // Age
            $userAge = $_POST['age'];
            if (DatingValidation::validAge($userAge)) {
                $_SESSION['member']->setAge($userAge);
            } else {
                $this->_f3->set('errors["Age"]', 'Please enter an age between 18 and 118');
            }

            // Phone number
            $userPhone = $_POST['phoneNumber'];
            if (DatingValidation::validPhone($userPhone)) {
                $_SESSION['member']->setPhone($userPhone);
            } else {
                $this->_f3->set('errors["phoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
            }

            // method check for male or female
            $userGender = $_POST['method'];
            $_SESSION['member']->setGender($userGender);

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
        $userEmail = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Email
            $userEmail = $_POST['email'];
            if (DatingValidation::validEmail($userEmail)) {
                $_SESSION['email'] = $userEmail;
            } else {
                $this->_f3->set('errors["Email"]', 'Please enter a valid email that contains "@" and ".com"');
            }

            // save the rest of optional data
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['bio'] = $_POST['bio'];
            $_SESSION['seeking'] = $_POST['seeking'];

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: interests');
            }
        }

        // Add the data to the hive
        $this->_f3->set('Email', $userEmail);

        // Display the home page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        // initialize all variables to store user input
        $userOutdoor = array();
        $userIndoor = array();

        // If the form has been submitted...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['iInterests'])) {
                $userIndoor = $_POST['iInterests'];
                // Check if the options are valid or not
                if (DatingValidation::validIndoor($_POST['iInterests'])) {
                    $_SESSION['iInterests'] = implode(", ", $userIndoor);
                } else {
                    // if the indoor interests are empty and/or not valid, display an error
                    $this->_f3->set('errors["inDoorInterests"]', 'You must select a valid indoor interest');
                }
            }

            // Check if outdoor interests has a post
            if (!empty($_POST['oInterests'])) {
                $userOutdoor = $_POST['oInterests'];
                // Check if the options are valid or not
                if (DatingValidation::validOutdoor($_POST['oInterests'])) {
                    $_SESSION['oInterests'] = implode(", ", $userOutdoor);
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
        $this->_f3->set('inDoorInterests', $userIndoor);
        $this->_f3->set('outDoorInterests', $userOutdoor);

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
        unset($_SESSION['member']);
    }
}