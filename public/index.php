<?php
ini_set('display_errors', 1);

//exports
require_once(realpath(dirname(__FILE__, 2) . '/src/config/config.php'));
// require_once(realpath(VIEW_PATH . '/login.php'));
require_once(realpath(MODEL_PATH  . '/Login.php'));

//hash created, hash = a
$userTeste = new Login([
    'email' => 'chaves@cod3r.com.br',
    'password' => 'a'
]);


try{
    $userTeste->checkLogin();
    echo "logged in";
} catch (Exception $e){
    echo "Error: password or User incorrect ";
}



