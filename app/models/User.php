<?php
//User class
//for getting and sending database values

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function findUserByEmail($email): bool
    {
        //check if given email is in database
        $this->db->query("SELECT * FROM users WHERE `email` = :email");

        //add values to statement / priskiriam reiksme
        $this->db->bind(':email', $email);

        // save result in row
        $row = $this->db->singleRow();

        //check if we got some results
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data): bool
    {
        //prepare statement
        $this->db->query("INSERT INTO users (`name`,`surname`, `email`, `password`) VALUES (:name, :surname, :email, :password)");

        //add values//priskirti reiksmes
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':surname', $data['surname']);
        $this->db->bind(':email', $data['email']);
        // hashed password
        $this->db->bind(':password', $data['password']);

        //make query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $notHashedPass)
    {
        //get the row with given email
        $this->db->query("SELECT * FROM users WHERE `email`= :email");

        $this->db->bind(':email', $email);

        $row = $this->db->singleRow();

        if ($row) {
            $hashedPassword = $row->password;
        } else {
            return false;
        }
        // check password
        if (password_verify($notHashedPass, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }

    }


}