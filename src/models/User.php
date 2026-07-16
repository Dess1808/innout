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

    //getActiveUsersCount()
    /*
        Return count all users
    */
    public static function getActiveUsersCount(){
        return $activeUsers = static::getCount(['raw' => 'end_date IS NULL']);
    }
}