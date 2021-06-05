<?php

/**
 * dating/controller/controller.php
 * Cesar Escalona
 * 06/02/2021
 *
 * This is my controller for the Dating project
 */
class Controller
{
    // private instance field
    private $_f3; // router

    /**
     * parameterized controller constructor
     * @param $f3 - Our instance of Fat Free
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Displays the default route - home page.
     */
    function home()
    {
        // Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Displays the personal info page.
     */
    function personalInfo()
    {

        // Instantiate Member or Prem member obj *** based on checkbox isset
        if(isset($_POST['premium'])){
            $user = new PremiumMember();
        } else {
            $user = new Member();
        }

        //If the form has been submitted, add the data to session
        //and send the user to the next page
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user->setFname($_POST['fname']);
            $user->setLname($_POST['lname']);
            $user->setAge($_POST['age']);
            $user->setPhone($_POST['phoneNumber']);
            $user->setGender($_POST['method']);

            // First Name
            $userName = $_POST['fname'];
            if (DatingValidation::validName($userName)) {
                $user->setFname($userName);
            } else {
                $this->_f3->set('errors["name"]', 'Please enter a valid first name');
            }

            // Last Name
            $userLName = $_POST['lname'];
            if (DatingValidation::validName($userLName)) {
                $user->setLname($userLName);
            } else {
                $this->_f3->set('errors["lName"]', 'Please enter a valid last name');
            }

            // Age
            $userAge = $_POST['age'];
            if (DatingValidation::validAge($userAge)) {
                $user->setAge($userAge);
            } else {
                $this->_f3->set('errors["Age"]', 'Please enter an age between 18 and 118');
            }

            // Phone number
            $userPhone = $_POST['phoneNumber'];
            if (DatingValidation::validPhone($userPhone)) {
                $user->setPhone($userPhone);
            } else {
                $this->_f3->set('errors["phoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
            }

            // method check for male or female
            $userGender = $_POST['method'];
            $user->setGender($userGender);

            // store in the session
            $_SESSION['user'] = $user;

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: profile');
            }
        } // End of if form is submitted

        // Add the data to the hive
        $this->_f3->set('userName', $user->getFname());
        $this->_f3->set('userLName', $user->getLname());
        $this->_f3->set('Age', $user->getAge());
        $this->_f3->set('phoneNum', $user->getPhone());
        $this->_f3->set('method', $user->getGender());
        $this->_f3->set('premUser', $_POST['premium']);

        // Display the personal page
        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    /**
     * Displays the profile page.
     */
    function profile()
    {
        // initialize all variables to store user input
        $user = $_SESSION['user'];
        $user->setEmail("");
        $user->setState("");
        $user->setSeeking("");
        $user->setBio("");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Email
            $userEmail = $_POST['email'];
            if(DatingValidation::validEmail($userEmail)) {
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

                // if the user is a premium member, send to interests...otherwise, send to summary
                if($user instanceof PremiumMember){
                    header('location: interests');
                } else {
                    // Redirect
                    header('location: summary');
                }
            }
        }

        // Add the data to the hive (stickyness)
        $this->_f3->set('email', $user->getEmail());
        $this->_f3->set('State', $user->getState());
        $this->_f3->set('seeking', $user->getSeeking());
        $this->_f3->set('Bio', $user->getBio());

        // Display the home page
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Displays the interests page(Only Premium Members should see this view)
     */
    function interests()
    {
        // initialize all variables to store user input
        $user = $_SESSION['user'];
        $emptyOutdoor = "";
        $emptyIndoor = "";

        // If the form has been submitted...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $emptyIndoor = $_POST['iInterests'];
            $emptyOutdoor = $_POST['oInterests'];

            if(empty($emptyIndoor && $emptyOutdoor)){
                $user->setInDoorInterests($emptyIndoor);
                $user->setOutDoorInterests($emptyOutdoor);
            }

            if (!empty($_POST['iInterests'])) {
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

        //Add to the hive
        $this->_f3->set('indoorInterests', DataLayer::getIndoorInterests());
        $this->_f3->set('outdoorInterests', DataLayer::getOutdoorInterests());

        // Display the interests page
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     * Displays the summary page.
     */
    function summary()
    {
        //Display the second order form
        $view = new Template();
        echo $view->render('views/summary.html');
        // clearing the session bucket
        unset($_SESSION['user']);
    }
}