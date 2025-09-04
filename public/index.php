<?php
ini_set('display_errors', 1);

//exports
require_once(realpath(dirname(__FILE__, 2) . '/src/config/config.php'));

$uri = urldecode($_SERVER['REQUEST_URI']);

if ($uri === '/' || $uri === ' ' || $uri === '/index.php'){
    $uri = '/login.php';
}

//load view 
require_once(CONTROLLER_PATH . "{$uri}");


