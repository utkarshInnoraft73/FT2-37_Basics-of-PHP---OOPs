<?php

/**
 * Make a user class to perform all the functionality.
 */

class User
{

    /**
     * Array to store the errors for different fields.
     */
    public $errors = [];

    /**
     * Public method to set the errors.
     */
    function setError($field, $error)
    {
        $this->errors[$field] = $error;
    }

    /**
     * Method to validate the name.
     * @param --> data, error message, patter, and the field name.
     * @return --> data 
     */
    public function nameValidate($data, $pattern, $field)
    {
        if (empty($data)) {
            $this->setError($field, "This field is required");
            return "";
        } 
        else if (!preg_match($pattern, $data)) {
            $this->setError($field, "Please enter valid input.");
            return "";
        } 
        else {
            return $data;
        }
    }

    /**
     * Static method to check the input.
     * @param --> data.
     * @return --> data after checking.
     */
    public static function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     * Method to get the method.
     * @return -> a array stored the errors of different field.
     */
    function getError()
    {
        return $this->errors;
    }
}