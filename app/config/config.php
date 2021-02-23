<?php
//DB params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pixel');


//approot wil be used when we need absolute path to our app dir.(kelias iki app folderio)
//define('APPROOT', dirname(dirname(__FILE__)));
//define('APPROOT', dirname(__FILE__, 2));
define('APPROOT', dirname(__DIR__));


//url ROOT will be the path in the url(kelias iki public folderio)
define('URLROOT', 'http://localhost/pixel');

//site name
define('SITENAME', 'Pixel');


//need to change.htaccess in public
//RewriteBase /__YOUR_SITE_DIR__/public
//replace __YOUR_SITE_DIR__ with root dir name of your site