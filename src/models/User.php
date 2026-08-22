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

    //inset user specific tratement
    public function insertFromDataGenerator() {
        //converting to 'number'
        $this->validateRegister();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if (!$this->end_date) $this->end_date = null;

        //criptrography password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        //chamando insertFromDataGenerator() pai para inseriro no banco
        return parent::insertFromDataGenerator();
    }

    //update user specific tratements
    public function updateFromDataGenerator(){
        //converting to 'number'
        $this->validateRegister();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if (!$this->end_date) $this->end_date = null;

        //criptrography password
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        //chamando updateFromDataFenerator() pai para inseriro no banco
        return parent::updateFromDataGenerator();
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
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email é inválido';
            }
        }
        
        //password
        if (!$this->password){
            $errors['password'] = 'Senha é obrigatória';
        }

        //confirm_password
        if (!$this->confirm_password){
            $errors['confirm_password'] = 'Confirmar senha é obrigatório';
        }

        //password equal confirm_password   
        if (($this->password && $this->confirm_password) && 
                ($this->password != $this->confirm_password)){
                    $errors['password'] = 'Senhas devem ser iguais';
                    $errors['confirm_password'] = 'Senhas devem ser iguais';
        }

        //start_date
        if (!$this->start_date){
            $errors['start_date'] = 'Data de admissão é obrigatória';
        } elseif (!DateTime::createFromFormat('Y-d-m', $this->start_date)){
            $errors['start_date'] = 'Data de admissão é inválida, formato correto dd/mm/YYYY';
        }

        // var_dump($this->start_date);
        // die();

        //end_date
        if ($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)){
            $errors['end_date'] = 'Data de desligamento é inválida, formato correto dd/mm/YYYY';
        }

        //throw exception!
        if (count($errors) > 0){
            throw new ValidationException($errors);
        }
    }
}