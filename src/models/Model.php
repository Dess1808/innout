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
                $this->set($key, $value);
            }
        }
    }

    //set and gets
    public function get($key){
        return $this->values[$key];
    }

    public function set($key, $value){
        $this->values[$key] = $value;
    }
}