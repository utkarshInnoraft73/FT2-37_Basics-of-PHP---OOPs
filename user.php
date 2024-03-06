<?php
/**
 * Make a user class to perform all the functionality.
 */

class User {
    public $fname; //First name of user.
    public $lname; //Last name of user.
    public $email; //Email of user.
    public $phone; //Phone name of user.

    /**
     * Create a custructor.
     * Setting first name, last name, email and phone.
     */
    function __construct($fname, $lname, $email, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
    }


    
    /**
     * Create functions to return the first name, last name, email and phone number.
     */
    function getFirstName()
    {
        return $this->fname;
    }

    function getLastName()
    {
        return $this->lname;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPhone()
    {
        return $this->phone;
    }
}
?>