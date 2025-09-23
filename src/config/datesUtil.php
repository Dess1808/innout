<?php

function getDateAsDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isWeekend($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->fomart('N') >= 6; //fomrat('N') retorna o valor dia da semana
}

function isBefore($date1, $date2){
    $inputDate1 = getDateAsDateTime($date1);
    $inputDate2 = getDateAsDateTime($date2);
    return $inputDate1 <= $inputDate2;
}

function nextDay($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->modidy('+1 day');
}
