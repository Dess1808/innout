<?php
loadModel('Login');

$exception = null;

if (count($_POST) > 0){
    $loginUserCheck = new Login([
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

    //usando try catch pos estamos utilizando throw no metodo checLogin
    try{
        $result = $loginUserCheck->checkLogin();
        header("Location: dayRecords.php");
    } catch (AppException $e){ //primeira excecao lancada ele o try captura???
        $exception = $e;
    }
}

loadView('login', $_POST + ['exception' => $exception]);



