<?php

//controller of test

//s$wh = workingHours::loadFromUserDate(4, date('Y-m-d'));
/*$interval = $wh->getWorkedInterval();
print_r($interval->format('%H:%I:%S'));
echo '<br>';
$lunch = $wh->getLunchInterval();
print_r($lunch->format('%H:%I:%S'));
echo '<br>';
print_r($wh->getExitTime());*/

$wh = workingHours::getMonthlyReport(4, '2026-02-11');
print_r($wh);


