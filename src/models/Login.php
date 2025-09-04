<?php

loadModel('User');

//autenticacao! no caso autenticar senha em banco
class Login extends Model{
       
    public function checkLoginValidation(){
        $errors = [];
        
        //validation email empty
        if (!$this->email){
            $errors['email'] = 'email not inserted';
        } 

        //validation password
        if (!$this->password){
            $errors['password'] = 'password not inserted';
        }

        //throw exception check
        if (count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    //check login
    public function checkLogin(){
        $this->checkLoginValidation();
        //select from database
        $user = User::getResultFromDataBaseOnly(['email' => $this->email]);

        if ($user){
            //error: end time
            if ($user->end_date){
                throw new AppException('Employee determined');
            }

            //como criamos o hash de um senha????/
            if (password_verify($this->password, $user->password)){
                return $user;
            }
        }   
        
        //error password or User
        throw new AppException('User or password invalid');
    }
}