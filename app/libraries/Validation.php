<?php
//this is a class to validate  different inputs and data

class Validation
{
    private $password;


    //checks if server request is post
    public function ifRequestIsPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') return true;
        return false;
    }

    public function sanitizePost()
    {
        // sanitize post array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public function ifRequestIsPostAndSanitize()
    {
        if ($this->ifRequestIsPost()) {
            $this->sanitizePost();
            return true;
        }
        return false;
    }

    public function validateNameOrSurname($name): string
    {
        if (empty($name)) {
            // empty field
            return "Please enter your Name";
        }
        if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
            return "Name must only contain Name characters";
        }
        //falsy
        return '';
    }

    //email validation
    public function validateEmail($email, &$userModel): string
    {
        //validate empty
        if (empty($email)) return "Please enter Your Email";

        //check email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) return 'Please check Your Email';

        // if email already exists
        if ($userModel->findUserByEmail($email)) {
            return 'Email already taken';
        }
        return '';
    }

    //password validation
    public function validatePassword($passwordField, $min, $max): string
    {
        //validate empty
        if (empty($passwordField)) {
            return "Please enter a Password";
        }

        //save password for later
        $this->password = $passwordField;

        //if password lenght is less then min
        if (strlen($passwordField) < $min) {
            return "Password must be more $min characters length";
        }

        //if password lenght is mores then max
        if (strlen($passwordField) > $max) {
            return "Password must be less $max characters length";
        }
        return '';
    }

    public function validateConfirmPassword($confirmPassword): string
    {
        if (empty($confirmPassword)) {
            return "Please repeat a password";
        }
        if (!$this->password) {
            return "No password saved";
        }

        if ($confirmPassword !== $this->password) {
            return "Password must match";
        }
        return '';
    }

    public function ifEmptyErrorsArray($errorsArray): bool
    {
        foreach ($errorsArray as $error) {
            if (!empty($error)) {
                return false;
            }
        }
        return true;
    }

    public function validateLoginEmail($email, &$userModel)
    {
        //validate empty
        if (empty($email)) return "Please enter Your Email";

        //check email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return 'Please check Your Email';
        }

        // if email already exists
        if (!$userModel->findUserByEmail($email)) {
            return 'Email not found';
        }
        return '';

    }

    public function validateEmpty($field, $msg)
    {
        if (empty($field)) {
            return $msg;
        }
        return '';
    }


}