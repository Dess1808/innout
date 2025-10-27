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


    //-- specific methods

    //get only user from DB
    public static function getResultFromDataBaseOnly($filters = [], $columns = '*'){
        $classCalled = get_called_class();
        $result = static::getSelect($filters, $columns);
        //return array inserted, values is a object from class called 
        return $result ? new $classCalled($result->fetch_assoc()) : null;
    }


    //get all user selected
    public static function getResultFromDataBase($filters = [], $columns = '*'){
        $objs = [];
        
        //receber resultado bruto sql 
        $result = static::getSelect($filters, $columns);
        if ($result){
            //obtendo qual classe chamou o metodo 'getResultFromDataBase'
            $classCalled = get_called_class();        
            while($row = $result->fetch_assoc()){
                //fazendo o push desta forma pos queremos que o array seja de objetos
                array_push($objs, new $classCalled($row));
            }    
        }

        return $objs;
    }


    //select from database - retornando resultado sql
    public static function getSelect($filters = [], $columns = '*'){
        $sql = "SELECT {$columns} FROM "
            . static::$tableName
            . static::getFilter($filters) . ';';
        
        $result = DataBase::getResultFromQuery($sql);

        if ($result->num_rows > 0){
            return $result;
        } else {
            return null;
        }
    }

    //INSERT in database
    public function save(){
        $sql = "INSERT INTO " . static::$tableName . " (" 
            . implode(",", static::$columns) . ") VALUES (";

        //add atributos de instancia 
        foreach(static::$columns as $col){
            $sql .= self::getFormatedValue($this->$col) . ",";
        }

        //replace last value
        $sql[strlen($sql - 1)] = ")";

        $id = DataBase::executeSQL($sql);
        $this->id = $id;
    }


    //filters adicionado 'AND' aos filtros
    public static function getFilter($filters){
        $sql = '';
        if (count($filters) > 0){
            $sql = " WHERE 1 = 1";
            foreach($filters as $column => $value){
                $sql .= " AND {$column} = " . self::getFormatedValue($value);
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

