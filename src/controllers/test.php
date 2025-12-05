<?php

//controller of test

$d1 = DateInterval::createFromDateString('10 hours');
$d2 = DateInterval::createFromDateString('14 hours');

$result = subtractIntervals($d1, $d2);
print_r($result);
echo "<br>";

print_r(getDateFromInterval($result));
echo "<br>";

