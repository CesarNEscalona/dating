<?php


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
     * Member constructor.
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
     * @return mixed|string
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed|string $fname
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed|string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed|string $lname
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed|string
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param mixed|string $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * @return mixed|string
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param mixed|string $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed|string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed|string $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }



}