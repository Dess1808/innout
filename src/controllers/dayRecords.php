<?php
// controller configs to dayRecords
session_start();
requireValidSession();
loadModel('workingHours');

$dataFormated = currentTime((new DateTime())->getTimestamp());

$user = $_SESSION['user'];

$userRecords = workingHours::loadFromUserDate($user->id, date('Y-m-d'));

// render view
loadTemplateView('dayRecords', [
    'today' => $dataFormated,
    'userRecords' => $userRecords
]);