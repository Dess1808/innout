<?php

function getDateAsDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isWeekend($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->format('N') >= 6; //fomrat('N') retorna o valor dia da semana
}

function isBefore($date1, $date2){
    $inputDate1 = getDateAsDateTime($date1);
    $inputDate2 = getDateAsDateTime($date2);
    return $inputDate1 <= $inputDate2;
}

function nextDay($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->modify('+1 day');
}


//date interval funcitons 

//sum intervals
/**
 * Description: criamos uma data "generica" 00:00:00 para podermos
 * calcular intervalos com o metodo Diff, essa data generica e criando com a 
 * classe "DateTime". Quando nao informamos dia especifico, o DateTime entendo que e o dia
 * atual, provavelmente!
*/
function sumIntervals($interval1, $interval2){
    //criando um dateTime "generico"
    $date = new DateTime('00:00:00');
    
    //add os "intervalos" ao objeto $date!
    $date->add($interval1);
    $date->add($interval2);

    /*
    Retornando o resultado do intervalo utilizando o "diff", 
    metodo para retornar intervalos de datas
    */
    return (new DateTime('00:00:00'))->diff($date);
}

//subtract intervals
function subtractIntervals($interval1, $interval2){
    $date = new DateTime('00:00:00');

    /*
    add e subtraindo datas, aparentemente vc define qual sera a operacoes que sera feita
    na datas atraves dos metodos "add()" e sub();
    */
    $date->add($interval1);
    $date->sub($interval2);

    //retorna do mesmo jeito
    return (new DateTime('00:00:00'))->diff($date);
}


//convert to date
function getDateFromInterval($interval){
    return new DateTimeImmutable($interval->format('%H:%i:%s'));
}

//convert to string
function getDateFromString($str){
    return DateTimeImmutable::createFromFormat('H:i:s', $str);
}