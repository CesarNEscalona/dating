<?php

/**
 * Member class
 * dating/classes/member.php
 * Cesar Escalona
 * 06/02/2021
 *
 * Used to build a member object for use during a session.
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor. Constructs a member object
     *
     * @param string $fname the members first name
     * @param string $lname the members last name
     * @param string $age the members age
     * @param string $gender the members gender
     * @param string $phone the memebers phone
     */
    public function __construct($fname="", $lname="", $age="", $gender="", $phone="")
    {
        $this->_fname=$fname;
        $this->_lname=$lname;
        $this->_age=$age;
        $this->_gender=$gender;
        $this->_phone=$phone;
    }

    /**
     * Getter for the users first name
     *
     * @return mixed|string $_fname
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Setter for the users first name
     *
     * @param mixed|string $fname
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * Getter for the users last name
     *
     * @return mixed|string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Setter for the users last name
     *
     * @param mixed|string $lname
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * Getter for the users age
     *
     * @return mixed|string
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Setter for the users age
     *
     * @param mixed|string $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * Getter for the users gender
     *
     * @return mixed|string
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Setter for the users gender
     *
     * @param mixed|string $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * Getter for the users phone number
     *
     * @return mixed|string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Setter for the users phone number
     *
     * @param mixed|string $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * Getter for the users email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Setter for the users email
     *
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * Getter for the users state
     *
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Setter for the users state
     *
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * Getter for the user seeking
     *
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Setter for the user seeking
     *
     * @param mixed $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * Getter for the users bio
     *
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Setter for the users bio
     *
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }
}