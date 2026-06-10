<?php
session_start();
requireValidSession();
$currentDate = new DateTime();
$user = $_SESSION['user']; 

//select's filter user
$users = null;
if ($user->is_admin){
    $users = User::getResultFromDataBase();
}


//select's filter years
$selectedPeriodPost = isset($_POST['period']) ? $_POST['period'] : $currentDate->format('Y-m'); //send to dataBase
$period = [];
for ($yearDiff = 2; $yearDiff >= 0; $yearDiff--){
    $year = date('Y') - $yearDiff;
    for ($month = 1; $month <= 12; $month++){
        $date = new DateTime("{$year}-{$month}-1");
        $period[$date->format('Y-m')] = ucfirst(currentTime($date->getTimestamp(), "MMMM 'de' yyyy"));
    }
}

//informamos o id do usuario logado e uma data atual do relogio
$registries = workingHours::getMonthlyReport($user->id, new DateTime());

//calc workday hour
$report = [];
$workDay = 0;
$sumWorkedOfTime = 0;
$selectedPeriod = new DateTime("{$selectedPeriodPost}-1");
$lastDay = getLastDayOfMonth($selectedPeriod)->format('d'); //month only day

//get by date
for ($day = 1; $day <= $lastDay; $day++){
    $date = $selectedPeriod->format('Y-m') . "-" . sprintf("%02d", $day);

    if (isset($registries[$date])){
        $registry = $registries[$date];
    } else {
        $registry = null;
    }
        
    //workday count, retornando uma data válida
    if (isPastWorkedDay($date)) $workDay++; //um dia válido

    if(isset($registry)){
        $sumWorkedOfTime += $registry->worked_time;
        array_push($report, $registry);
    } else {
        array_push($report, new WorkingHours([
            'work_date' => $date,
            'time1' => null,
            'time2' => null,
            'time3' => null,
            'time4' => null,
            'worked_time' => 0
        ]));
    }
}


//calc worked time
$expectedTime = $workDay * DAILY_TIME;
$balance = getTimeStringFromSeconds(abs($sumWorkedOfTime - $expectedTime));
$sign = ($sumWorkedOfTime >= $expectedTime) ? '+' : '-';

loadTemplateView('monthlyReport', [
    'report' => $report,
    'sumWorkedOfTime' => $sumWorkedOfTime,
    'balance' => "{$sign}{$balance}",
    'period' => $period,
    'users' => $users
]);




