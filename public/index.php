<?php
ini_set('display_errors', 1);

//exports
require_once(realpath(dirname(__FILE__, 2) . '/src/config/config.php'));
require_once(realpath(dirname(__FILE__, 2) . '/src/models/User.php'));

$user1 = new User([
    'name'=> 'gabriel',
    'email' => 'gabriel@email.com'
]);

// echo $user1->getSelect([
//     'name' => 'gabriel', 
//     'email' => 'gabrielmartins@gmail.com'], 
//     "name, email"
// );

echo $user1->getSelect([]);