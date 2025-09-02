<?php
loadModel('Login');

if (count($_POST) > 0){
    $loginUserCheck = new Login([
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

    //usando try catch pos estamos utilizando throw no metodo checLogin
    try{
        $result = $loginUserCheck->checkLogin();
        echo "User {$result->name} logged in";
    } catch (Exception $e){
        echo "Error validation user";
    }
}

loadView('login', $_POST);



