<?php
session_start();
requireValidSession();

loadModel('workingHours');

//id informations
$user = $_SESSION['user'];
$userRecords = workingHours::loadFromUserDate($user->id, date('Y-m-d'));


try {
    //times
    $currentTime = date('H:i:s', time());

    // forced time session simulation --test--
    if (isset($_POST['forcedTime'])){
        $currentTime = $_POST['forcedTime'];
    }

    $userRecords->innout($currentTime);

    addSuccessMsg('Success insert!');

} catch(AppException $e){
    addErrorMsg($e->getMessage());
}

header('Location: dayRecords.php');

