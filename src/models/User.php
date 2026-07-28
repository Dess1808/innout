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

    //insertFromDataGenerator
    /*
        override insert... tratament(is_admin and end_date))
    */
    public function insertFromDataGenerator() {
        //converting to 'number'
        $this->validateRegister();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if (!$this->end_date) $this->end_date = null;

        //criptrography password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::insertFromDataGenerator();
    }

    //validations form
    private function validateRegister(){
        $errors = [];

        //name
        if (!$this->name) {
            $errors['name'] = 'Nome é obrigatório';
        }
        //email
        if (!$this->email) {
            $errors['email'] = 'Email é obrigatório';
        } else {
            
        }
        //password
        //confirm_password
        //start_date
        //end_date

    }
}