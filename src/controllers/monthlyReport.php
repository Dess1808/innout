<?php
session_start();
requireValidSession();

$currentDate = new DateTime();

$user = $_SESSION['user']; 
//informamos o id do usuario logado e uma data atual do relogio
$registries = workingHours::getMonthlyReport($user->id, new DateTime());

//calc workday hour
$report = [];
$workDay = 0;
$sumWorkedOfTime = 0;
$lastDay = getLastDayOfMonth($currentDate)->format('d'); //month only day

//get by date
for ($day = 1; $day <= $lastDay; $day++){
    $date = $currentDate->format('Y-m') . "-" . sprintf("%02d", $day);
    $registry = $registries[$date]; //verificar Undefined Key!!!!!

    //workday count, retornando uma data válida
    if (isPastWorkedDay($date)) $workDay++; //um dia válido

    if($registry){
        $sumWorkedOfTime += $registry->worked_time;
        array_push($report, $registry);
    } else {
        array_push($report, new WorkingHours([
            'work_date' => $date,
            'worked_time' => 0
        ]));
    }
}

//calc worked time
$expectedTime = $workDay * DAILY_TIME;
$balance = getTimeStringFromSeconds($expectedTime - $sumWorkedOfTime);
$sign = $sumWorkedOfTime >= $expectedTime ? '+' : '-';

loadTemplateView('monthlyReport', [
    'report' => $report,
    'sumWorkedOfTime' => $sumWorkedOfTime,
    'balance' => "{$sign}{$balance}"
]);




