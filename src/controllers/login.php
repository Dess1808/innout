<?php
loadModel('Login');
session_start();

$exception = null;

//controller login e chamado pelo "post"?

if (count($_POST) > 0){
    $loginUserCheck = new Login([
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

    //usando try catch pos estamos utilizando throw no metodo checLogin
    try{
        $user = $loginUserCheck->checkLogin();
        //colocar usuario em sessao
        $_SESSION['user'] = $user;
        header("Location: dayRecords.php");
    } catch (AppException $e){
        $exception = $e;
    }
}

loadView('login', $_POST + ['exception' => $exception]);



