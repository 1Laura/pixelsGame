<?php
//load config file
require_once "config/config.php";

// load libraries automatically
spl_autoload_register(function ($className) {
    require_once "libraries/$className.php";
});
