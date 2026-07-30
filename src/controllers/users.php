<?php
session_start();
requireValidSession();

//controller delete user
$exception = null;
if (isset($_GET['delete'])){
    try {
        User::deleteUserById($_GET['delete']);
        addSuccessMsg('Usuário deletado com sucesso');
    } catch (Exception $e) {
        //trantement message
        if (stripos($e->getMessage(), 'FOREIGN KEY')){
           addErrorMsg('Usuário possuem pelo menos um batimento de horas feito, não pode ser excuído'); 
        } else {
            $exception = $e;
        }   
    }
}

$users = User::getResultFromDataBase();
//format date
foreach($users as $user){
    $user->start_date = (new DateTime($user->start_date))->format('d-m-Y');
    
    if ($user->end_date){
        $user->end_date = (new DateTime($user->end_date))->format('d-m-Y');
    }
}

loadTemplateView('users', [
    'users' => $users,
    'exception' => $exception
]);