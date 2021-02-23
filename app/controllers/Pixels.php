<?php

/*
 * Pixels controller
 * Basic CRUD functionality
 *
 */

class Pixels extends Controller
{
    private $pixelModel;
//    private $userModel;
    private $vld;

    public function __construct()
    {
        $this->pixelModel = $this->model('Pixel');
        $this->userModel = $this->model('User');

        //init validation class
        $this->vld = new Validation();
    }

    public function index()
    {
        //get all pixels
        if ($this->pixelModel->getAllPixels()) {
            $pixels = $this->pixelModel->getAllPixels();
        }
        $data = [
            'title' => 'All pixels board from pixels controller index method',
            'pixels' => $pixels ?? [],
        ];
        $this->view('pixels/allPixels', $data);
    }

    public function addPixel()
    {
        //restrict access of this controller only logged in users //apribojam priejima
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        if ($this->vld->ifRequestIsPostAndSanitize()) {
            //data from post
            $postData = [
                'userId' => $_SESSION['userId'],
                'x' => trim($_POST['coordinateX']),
                'y' => trim($_POST['coordinateY']),
                'color' => trim($_POST['color']),
                'size' => trim($_POST['size']),
//                'xErr' => '',
//                'yErr' => '',
                'currentPage' => 'addPixel'
            ];

            $errors = [];

            $triggerX = true;
            $triggerY = true;

            // validate pixel x input
            if (!inputNotEmpty($postData['x'])) {
                $errors['xErr'] = 'Please enter coordinate X';
                $triggerX = false;
            } elseif (!validateNumericValue($postData['x'])) {
                $errors['xErr'] = 'Please enter number';
                $triggerX = false;
            } elseif (($postData['x'] + $postData['size']) > 500) {
                $errors['xErr'] = 'Please enter less number, coordinate X must stay within container';
                $triggerX = false;
            }

            // validate pixel y input
            if (!inputNotEmpty($postData['y'])) {
                $errors['yErr'] = 'Please enter coordinate Y';
                $triggerY = false;
            } elseif (!validateNumericValue($postData['x'])) {
                $errors['yErr'] = 'Please enter number';
                $triggerY = false;
            } elseif (($postData['y'] + $postData['size']) > 500) {
                $errors['yErr'] = 'Please enter less number, coordinate Y must stay within container';
                $triggerY = false;
            }

//            //validate pixel color radio
//            if (!isset($postData['color']) && ($postData['color'] !== '')) {
//                $errors['colorErr'] = 'Please choose valid ColorNo radio buttons were checked';
//            }
//            else {
//                $postData['checked'] = 'checked';
//            }

            // get all users pixels from db
            $pixels = $this->pixelModel->getAllPixels();
            // var_dump($pixels);
            // var_dump($data);
            // die();

            //If coordinates are entered correctly and its fit in container. Check if its are free
            if ($triggerX && $triggerY) {
                if (!validatePixelCoordinates($postData, $pixels)) {
                    $errors['pixelOutOfContainer'] = 'Coordinates are already entered';
                }
            }
            //if empty errors array, add pixel to db
            if ($this->vld->ifEmptyErrorsArray($errors)) {
                // empty($errors['xErr']) && empty($errors['yErr']) && empty($errors['color'])) {
                if ($this->pixelModel->addPixels($postData)) {
                    $feedback = 'Pixel added successfully';
                    //redirect('/pixels');
                } else {
                    $feedback = 'Something went wrong in adding pixels';
                }
            }
        }
        $data = [
//            'userId' => '',
            'fromPostData' => $postData ?? [],
            'errors' => $errors ?? [],
            'feedback' => $feedback ?? '',
            'currentPage' => 'addPixel',
        ];

        $this->view('pixels/addPixel', $data);

    }

}