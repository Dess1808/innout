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
            . static::getFilter($filters) . ';'; //estrategia de flexibilização com o where 1 = 1
        
        $result = DataBase::getResultFromQuery($sql);

        if ($result->num_rows > 0){
            return $result;
        } else {
            return null;
        }
    }

    //filters adicionado 'AND' aos filtros
    public static function getFilter($filters){
        $sql = '';
        if (count($filters) > 0){
            $sql = " WHERE 1 = 1";
            foreach($filters as $column => $value){
                //caso preciso adicionar um sql puro!
                if ($column == 'raw') {
                    $sql.= " AND {$value}";
                } else {
                    $sql .= " AND {$column} = " . self::getFormatedValue($value);
                } 
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

    //INSERT in database data generator
    public function insertFromDataGenerator(){
        $sql = "INSERT INTO " . static::$tableName . " (" 
            . implode(", ", static::$columns) . ") VALUES (";

        //add atributos de instancia 
        foreach(static::$columns as $col){
            $sql .= self::getFormatedValue($this->$col) . ", ";
        }

        //replace last value and semicolo, verificar !!!
        $sql[strlen($sql) - 2] = ')';
        $sql .= ';';
        
        DataBase::executeSQL($sql);
    }

    //UPDATE FROM data generator
    /*
    description updateFromDataGenerator
        Função que irá fazer o update, é feita a construção do sql em php, utilizando 
        foreach para inserir os campos e seus valores, depois e feito o update com a função
        estática executeSql()
    */
    public function updateFromDataGenerator(){
        $sql = "UPDATE " . static::$tableName . " SET ";
        foreach(static::$columns as $col){
            $sql .= " {$col} = ". static::getFormatedValue($this->$col) . ",";
        }

        //duplicate entry - 1-2026-01-21
        /*
        E preciso utilizar o 'and' no where, pos sao duas chaves que definimos 
        contraint no sql, pos o banco estava procurando apenas por uma chave, em vez
        das duas
        */

        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE user_id = {$this->user_id} AND work_date = '{$this->work_date}';";
    
        DataBase::executeSQL($sql);
    }

    //monthlyReport:
    /*
        decription: método que irá retornar o batimentos feitos pelo usuario logado no mês
        recorrente.
        detals: monthlyReport($userId, $date) recebe dois parametros, o $userId - id atual loga
        e $date - data atual de acordo com o DateTime?. $firtDay e $endDay, recebendo suas datas
        respectivamente pelas funções getFirstDayOfMonth() e getLastDayOfMonth
    */
    public static function getMonthlyReport($userId, $date) {
        $registries = [];

        //first and end day of the month
        $firstDay = getFirstDayOfMonth($date)->format('Y-m-d');
        $endDay = getLastDayOfMonth($date)->format('Y-m-d');;

        $result = static::getSelect([
            'user_id' => $userId,
            'raw' => "work_date BETWEEN '{$firstDay}' AND '{$endDay}';"
        ]);

        if ($result) {
            while($row = $result->fetch_assoc()) {
                //criando novas chaves no array com as datas    
                $registries[$row['work_date']] = new workingHours($row);
            }
        }

        return $registries;
    }

        
}