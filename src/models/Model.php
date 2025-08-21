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


    //select from database - test
    public static function getSelect($filters = [], $columns = '*'){
        return $sql = "SELECT {$columns} FROM "
            . static::$tableName
            . static::getFilter($filters) . ';';
    }

    //filters adicionado 'AND' aos filtros
    public static function getFilter($filters){
        $sql = '';
        if (count($filters) > 0){
            $sql = " WHERE 1 = 1";
            foreach($filters as $column => $value){
                $sql .= " AND {$column} = " . static::getFormatedValue($value);
            }
        }

        return $sql;
    }

    //values' treatment
    public static function getFormatedValue($value){
        if (is_null($value) || $value === ''){
            return "null";
        } elseif (gettype($value) === 'string'){
            return "'{$value}'";
        } else {
            return $value;
        }
    }
}

