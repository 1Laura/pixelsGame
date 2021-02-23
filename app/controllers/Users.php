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

    private Validation $vld;

    public function __construct()
    {
        $this->userModel = $this->model('User');

        //init validation class
        $this->vld = new Validation();
    }

    public function index()
    {
        $this->view('/pixels');
    }

    public function register()
    {

        if ($this->vld->ifRequestIsPostAndSanitize()) {
            $data = [
                'name' => trim($_POST['name']),
                'surname' => trim($_POST['surname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'errors' => [
                    'nameErr' => '',
                    'surnameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',
                ],
            ];

            // Validate name
            $data['errors']['nameErr'] = $this->vld->validateNameOrSurname($data['name']);
            // Validate surname
            $data['errors']['surnameErr'] = $this->vld->validateNameOrSurname($data['surname']);
            // Validate email
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);
            // Validate password, nuo 4 iki 10 simboliu
            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 4, 10);
            // Validate confirmPassword
            $data['errors']['confirmPasswordErr'] = $this->vld->validateConfirmPassword($data['confirmPassword']);

            //if there is no errors
            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {
                //hash password // save way to store password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //create user
                if ($this->userModel->register($data)) {
                    //success user added
                    //set feedback message
                    feedback('registerSuccess', 'You have registered successfully');
//                    header("Location: " . URLROOT . "/users/login");
                    redirect('/users/login');
                } else {
                    die('something went wrong in adding user to db');
                }
            } else {
                //set flash msg, register fail
                feedback('registerFail', 'Please check the form', 'alert alert-danger');
                $data['currentPage'] = 'register';

                //load view with errors
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'surname' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr' => '',
                    'surnameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',],
                'currentPage' => 'register'
            ];

            //load view paduodam
            $this->view('users/register', $data);
        }
    }


    public function login()
    {
        if ($this->vld->ifRequestIsPostAndSanitize()) {
            //create data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'errors' => [
                    'emailErr' => '',
                    'passwordErr' => '',
                ],
            ];
            //validate email
            $data['errors']['emailErr'] = $this->vld->validateLoginEmail($data['email'], $this->userModel);
            //validate password
            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Please enter your password');

            if ($this->vld->ifEmptyErrorsArray($data['errors'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['errors']['passwordErr'] = 'Wrong password';
                    //load view with errors
                    $this->view('users/login', $data);
                }
            } else {
                $data['currentPage'] = 'login';
                //load view with errors
                $this->view('users/login', $data);
            }
        } else {
            //if we go to users/login by url or link or btn
            //load form
            $data = [
                'email' => '',
                'password' => '',
                'errors' => [
                    'emailErr' => '',
                    'passwordErr' => '',
                ],
                'currentPage' => 'login'
            ];
//            $data['currentPage'] = 'login';
            //load view paduodam
            $this->view('users/login', $data);
        }

    }

    private function createUserSession($loggedInUser)
    {
        $_SESSION['userId'] = $loggedInUser->userId;
        $_SESSION['userName'] = $loggedInUser->name;
        $_SESSION['userEmail'] = $loggedInUser->email;

        // pakeisti kitur
        redirect('/pixels');
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        unset($_SESSION['userEmail']);

        session_destroy();
        redirect('/users/login');
    }


}