<?php

/*
 * Users class
 * Register user
 * Login user
 * Control Uses behavior and access
 */


class Users extends Controller
{
    private $userModel;

//    private Validation $vld;

    public function __construct()
    {
        $this->userModel = $this->model('User');

        //init validation class
//        $this->vld = new Validation();
    }

    public function index()
    {

        //pasikeisti gal redirect to all pixels?
        $data = [
            'welcome' => 'labas is users index page'
        ];

        $this->view('users/register', $data);
    }




}