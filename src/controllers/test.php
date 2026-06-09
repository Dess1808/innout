<?php
//functionaly test, select fitler year

session_start();
requireValidSession();

$currentTime = new DateTime();

$selectedPeriod = isset($_POST['period']) ? $_POST['period'] : $currentTime->format('Y-m');
$periods = [];
for ($yearDiff = 2; $yearDiff >= 0; $yearDiff--){
    $year = date('Y') - $yearDiff;
    for ($month = 1; $month <= 12; $month++){
        $date = new DateTime("{$year}-{$month}-1");
        $periods[$date->format("Y-m")] = ucfirst(currentTime($date->getTimestamp(), "MMMM 'de' yyy"));
    }
}

print_r($periods);
?>

<form action="POST">
    <select name="period" placeholder="select the period...">
        <?php
            foreach($periods as $key => $value){
                echo "<option value='{$key}'>{$value}</option>";
            }
        ?>
    </select>
</form>


