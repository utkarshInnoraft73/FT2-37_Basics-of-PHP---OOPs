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
     * Array to store the subjects name.
     */
    private $subject = [];

    /**
     * Array to store the marks of relavant subject.
     */
    private $marks = [];


    /**
     * Public method to set the errors.
     */
    function setError($field, $error)
    {
        $this->errors[$field] = $error;
    }

    /**
     * Public method to set the subject.
     * @param index  index of the array.
     * @param data   data.
     * 
     */
    function setSubject($index, $data)
    {
        $this->subject[$index] = $data;
    }

    /**
     * Public method to set the errors.
     * @param index index of the array.
     * @param data  data.
     * 
     */
    function setMarks($index, $data)
    {
        $this->marks[$index] = $data;
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
        } else if (!preg_match($pattern, $data)) {
            $this->setError($field, "Please enter valid input.");
            return "";
        } else {
            return $data;
        }
    }

    /**
     * Method to validate the name.
     * @param --> data, error message, patter, and the field name.
     * @return --> data 
     */
    public function validatePhone($data, $pattern, $field)
    {
        if (empty($data)) {
            $this->setError($field, "This field is required");
            return "";
        } else if (!preg_match($pattern, $data)) {
            $this->setError($field, "Please enter valid input.");
            return "";
        }
        else if( strlen($data) != 13){
            $this->setError($field, "Please enter valid input.");
            return "";
        } 
        else {
            return $data;
        }
    }

    /**
     * Method to validate the Subject marks pair.
     * @param --> data, and the field name.
     * 
     */
    public function validateSubjectMarks($data, $field)
    {
        if (empty($data)) {
            $this->setError($field, "This field is required, please enter valid input.");
        } else {
            $data = explode("\n", $_POST['marks']);
            $i = 0;
            foreach ($data as $lines) {

                // Exploding marks_line as subject and marks seperating by "|".
                $parts = explode("|", $lines);
                if (is_numeric(trim($parts[0])) && is_numeric(trim($parts[1])) || (empty(trim($parts[0])) || empty(trim($parts[1])))) {
                    $this->setError($field, "Invalid Input, please enter valid pattern.");
                    return "";
                } else if (is_numeric(trim($parts[0])) || !is_numeric(trim($parts[1]))) {
                    $this->setError($field, "Invalid Input, please enter valid pattern.");
                    return "";
                } else {

                    $this->setSubject($i, trim($parts[0]));
                    $this->setMarks($i, trim($parts[1]));
                    $i = $i + 1;
                }
            }
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
     * @return -> Array stored the subjects.
     */
    function getSubject()
    {
        return $this->subject;
    }

   
    /**
     * Method to get the method.
     * @return -> Array stored the marks.
     */
    function getMarks()
    {
        return $this->marks;
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