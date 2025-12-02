<?php
session_start();
requireValidSession();

loadModel('workingHours');

//id informations
$user = $_SESSION['user'];
$userRecords = workingHours::loadFromUserDate($user->id, date('Y-m-d'));


//times
$currentTime = date('H:i:s', time());
$userRecords->innout($currentTime);

header('Location: dayRecords.php');

