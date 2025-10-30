<?php

loadModel('workingHours');

//reset tabela workingHours
Database::executeSQL('DELETE FROM working_hours;');

//reset users 
Database::executeSQL('DELETE FROM working_hours WHERE id > 5');

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate){
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:00:00',
        'worked_time' => DAILY_TIME //const de 8h em segundos, 28800s
    ];

    $extraHourDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '18:00:00',
        'worked_time' => DAILY_TIME //const de 8h em segundos, 28800s
    ];

    $lazyDayTemplate = [
        'time1' => '09:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '17:30:00',
        'worked_time' => DAILY_TIME //const de 8h em segundos, 28800s
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

//population tables working hours
function populationWorkingHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate){
    $currentDate = $initialDate;
    $today = new DateTime();
    $columns = ['user_id' => $userId, 'work_date' => $initialDate];

    while(isBefore($currentDate, $today)){
        if (!isWeekend($currentDate)){
            $template = getDayTemplateByOdds($regularRate, $extraRate, $lazyRate);
            //tabela para o banco de dados 
            $columns = array_merge($columns, $template);
            //intancia 
            $workingHours = new workingHours($columns);
            $workingHours->save();
        }

        //next day
        $currentDate = nextDay($currentDate)->format('Y-m-d');
        $columns['work_date'] = $currentDate;
    }
}

//testar com "mes passado"

//teste
populationWorkingHours(1, date('Y-m-1'), 70, 20, 10);
populationWorkingHours(3, date('Y-m-1'), 20, 75, 5);
populationWorkingHours(4, date('Y-m-1'), 20, 10, 75);