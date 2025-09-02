<?php

require_once(MODEL_PATH . '/User.php');

//autenticacao! no caso autenticar senha em banco
class Login extends Model{
       
    //check login
    public function checkLogin(){
        //select from database
        $user = User::getResultFromDataBaseOnly(['email' => $this->email]);
        if ($user){
            //como criamos o hash de um senha????/
            if (password_verify($this->password, $user->password)){
                return $user;
            }
        }
        
        throw new Exception();
    }
}