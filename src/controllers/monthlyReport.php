<?php
session_start();
requireValidSession();

$user = $_SESSION['user']; 
//informamos o id do usuario logado e um a data atual do relogio
$registries = workingHours::getMonthlyReport($user->id, new DateTime());

loadTemplateView('monthlyReport', [
    'registries' => $registries
]);





