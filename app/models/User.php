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
}