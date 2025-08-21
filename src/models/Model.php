<?php

//contrato inicial, esqueleto da conexao com o banco 
class Model{
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr) {
        $this->loadFromArray($arr);
    }

    //percorrendo o array personalizado e setando no array values
    public function loadFromArray($arr){
        if ($arr){
            //pegando chave e valor do array associativo $arr
            foreach($arr as $key => $value){
                //magic methods
                $this->$key = $value;
            }
        }
    }

    //set and gets
    //magic methods
    public function __get($key){
        return $this->values[$key];
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
    }
}