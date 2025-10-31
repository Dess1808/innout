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
        //searsh only registry from dataBase
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
}