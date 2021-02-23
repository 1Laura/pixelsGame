<?php
//load config file
require_once "config/config.php";

//load helpers
require_once "helpers/sessionHelper.php";
require_once "helpers/urlHelper.php";
require_once "helpers/pixelsValidators.php";


// load libraries automatically
spl_autoload_register(function ($className) {
    require_once "libraries/$className.php";
});

