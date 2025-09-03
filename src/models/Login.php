<?php

loadModel('User');

//autenticacao! no caso autenticar senha em banco
class Login extends Model{
       
    //check login
    public function checkLogin(){
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