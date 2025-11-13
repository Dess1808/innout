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
//description populationWorkingHours:
/*
    Gerando templates de acordo com parametros informados
        $userId - id do usuario vindo da sessão
        $initialDate - primeiro dia da jornada de trabalho, deve ser igual ou menor ao dia atual
        $regularRate - valor de 0 a 100, probabilidade de vir um dia regular
        $extraRate - valor de 0 a 100 , probabilidade de vir um dia com hora extra
        $lazyRate - valor de 0 a 100, probabilidade de vir um dia com saida mais cedo
    
    objetivo function:
        recebe o dia informado inicialmente, pega o dia atual para ser usado como parametro de parada
        da função, pois a mesma repete enquanto o valor inicial for menor ou igual ao dia atual
        
        Os parametro $userId e $initialDate são atribuidos ao array $columns para posteriormente serem 
        usados como parametros no objeto "WorkingHours"

        e feito o teste em loop while, se o dia atual e igual ou menor que o dia de hoje, se sim
        e verificado se é um dia de final de semana, senão, a variavel $template recebe vinda de 
        "getDayTemplateByOdds" um template. Faz um merge depois com $columns, com o $columns finalizado 
        e feito a instanciação de um objeto do tipo WorkingHours com os parametros de $columns, $columns sendo um array
        chave valor, depois e chamado o metodo "save()" para fazer a inserção desses valores no banco, e como retorno
        , é retornando o valor do Id do usuario inserido. Para finalizar esse while e feito o incremento para o proximo dia 
        , pois precisamos desse valor de batimento de hora para o rage de dias calculados.


*/
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