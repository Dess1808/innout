<?php
ini_set('display_errors', 1);

//exports
require_once(realpath(dirname(__FILE__, 2) . '/src/config/config.php'));

$uri = urldecode(
    //get only url, without params only
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri === '/' || $uri === ' ' || $uri === '/index.php'){
    $uri = '/dayRecords.php';
}

//load view 
require_once(CONTROLLER_PATH . "{$uri}");


