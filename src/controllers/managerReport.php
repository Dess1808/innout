<?php
session_start();
requireValidSession();

//active users
$activeUsers = User::getActiveUsersCount();

//absent users
$absentUsers = workingHours::getAbsentUsers();

//hours all users in month
$secondsInMonth = workingHours::getWorkedTimeMonth((new DateTime())->format('Y-m'));
$hoursInMonth = explode(':', getTimeStringFromSeconds($secondsInMonth))[0]; //only hour

loadTemplateView('managerReport', [
    'activeUsers' => $activeUsers,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth
]);
