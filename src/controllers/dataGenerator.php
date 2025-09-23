<?php

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate){
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => 'DAILY_TIME' //const de 8h em segundos, 28800s
    ];

    $extraHourDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '18:00:00',
        'worked_time' => 'DAILY_TIME' //const de 8h em segundos, 28800s
    ];

    $lazyDayTemplate = [
        'time1' => '09:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:30:00',
        'worked_time' => 'DAILY_TIME' //const de 8h em segundos, 28800s
    ];

    /*
        logica:
        sera sorteado um numero entre 0 a 100, tal numero sera comparado com 
        os rates que estao como parametro na funcao getDayTemplateByOdds, com isso 
        podemos retornar o template que bate com essa probabilidade calculada.
    */ 

    $valueProb = rand(0, 100);

    if ($valueProb <= $regularRate){
        return $regularDayTemplate;
    } else if ($valueProb <= $regularRate + $extraRate){
        return $extraHourDayTemplate;
    } else {
        return $lazyDayTemplate;
    }
}

print_r(getDayTemplateByOdds(10, 20, 70));