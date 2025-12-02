<?php

class workingHours extends Model{
    protected static $tableName = 'working_hours';
    protected static $columns = [
        'id',
        'user_id', 
        'work_date', 
        'time1',  
        'time2',  
        'time3',
        'time4',
        'worked_time'
    ];


    public static function loadFromUserDate($userId, $workDate){
        //search only registry from dataBase
        $registry = self::getResultFromDataBaseOnly([
            'user_id' => $userId, 
            'work_date' => $workDate
        ]);


        //registry == null
        if (!$registry){
            $registry = new workingHours([
                'user_id' => $userId,
                'work_date' => $workDate,
                'time1' => null,
                'time2' => null,
                'time3' => null,
                'time4' => null,
                'worked_time' => 0
            ]);
        }

        return $registry;
    }   
    
    
    /*
        getNextTime()
        description: obter o proximo time para o batimento de ponto.
        obs: pertecente a instancia, nao estatico
        assunto: verificar qual batimento precisar ser atribuido no momento em que for chamado!
        retorna a string da coluna que deve ser atribuida um time, se todas tiverem ja preenchidas
        retorna null
    */ 
    public function getNextTime(){
        if (!$this->time1) return 'time1';
        if (!$this->time2) return 'time2';
        if (!$this->time3) return 'time3';
        if (!$this->time4) return 'time4';
        return null;
    }

    /*
        innout($time)  
        description: atribuir um time na banco de dados, tabela workingHours
        assunto: recebe um time ou nao, se nao, retornar uma execption ao sistema, informando 
        o usuario que todos o batimento ja foram feitos, se sim, atribui na tabela workingHours o novo 
        batimento.
        tecnico: Recebe um parametro string time -> "08:00:00" ou seja, um valor em hora no formato \
        de string. E feito
    */ 
    public function innout($time){
        $timeColumn = $this->getNextTime();
    
        //attention
        if (!$timeColumn){
            throw new AppException("you've alredy done all four clock in for the day!");
        }

        /*
        Quando chamarmos uns dos metodos "insertFrom.. ou updateFrom.." que precisar ser setado no 
        atributo time1, time2... vai esta "atualizado" para uso!!!
        */
        $this->$timeColumn = $time;
 
        //if seted, update, if not, insert
        if (!$this->id){
            $this->insertFromDataGenerator();
        } else {
            $this->updateFromDataGenerator();
        }
    }
}