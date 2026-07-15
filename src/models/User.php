<?php

class User extends Model {
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin'       
    ];   

    //getCountUsers()
    /*
        Return count all users
    */
    public static function getCountUsers($column){
        $result = static::getResultFromDataBaseOnly($filter = [], $column);
        return $result;
    }
}