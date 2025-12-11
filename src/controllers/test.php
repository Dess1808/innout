<?php

//controller of test
loadModel('workingHours');

$wh = workingHours::loadFromUserDate(4, date('Y-m-d'));

$interval = $wh->getWorkedInterval();

print_r($interval->format('%H:%I:%S'));